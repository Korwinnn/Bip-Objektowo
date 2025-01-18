<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'username.required' => 'Nazwa użytkownika jest wymagana',
            'username.unique' => 'Ta nazwa użytkownika jest już zajęta',
            'email.required' => 'Email jest wymagany',
            'email.email' => 'Podaj prawidłowy adres email',
            'email.unique' => 'Ten email jest już używany',
            'password.required' => 'Hasło jest wymagane',
            'password.min' => 'Hasło musi mieć minimum 8 znaków',
            'password.confirmed' => 'Hasła nie są identyczne',
        ];
    
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ], $messages);
    
        User::create([
            'username' => $request->username,
            'name' => $request->username, // tutaj ustawiamy name takie samo jak username
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        return redirect()->route('admin.dashboard')
            ->with('success', 'Użytkownik został pomyślnie utworzony.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Nie można usunąć własnego konta.');
        }

        try {
            DB::beginTransaction();

            // Ustawiamy NULL dla created_by i updated_by w kategoriach
            Category::where('created_by', $user->id)
                ->update(['created_by' => null]);
            
            Category::where('updated_by', $user->id)
                ->update(['updated_by' => null]);

            // Usuń użytkownika
            $user->delete();

            DB::commit();
            return back()->with('success', 'Użytkownik został usunięty.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Wystąpił błąd podczas usuwania użytkownika.');
        }
    }
    public function showChangePasswordForm()
{
    return view('admin.users.change-password');
}

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'Aktualne hasło jest wymagane',
            'password.required' => 'Nowe hasło jest wymagane',
            'password.min' => 'Hasło musi mieć minimum 8 znaków',
            'password.confirmed' => 'Hasła nie są identyczne',
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors([
                'current_password' => 'Aktualne hasło jest nieprawidłowe',
            ]);
        }

        auth()->user()->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Hasło zostało zmienione pomyślnie.');
    }
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'name' => 'required|exists:users,name'
        ], [
            'name.required' => 'Login jest wymagany',
            'name.exists' => 'Nie znaleziono użytkownika o podanym loginie'
        ]);

        $user = User::where('name', $request->name)->first();
        
        if(!$user->email) {
            return back()->withErrors(['name' => 'Użytkownik nie posiada przypisanego adresu email']);
        }

        // Usuń stary token jeśli istnieje
        DB::table('password_reset_tokens')->where('email', $user->email)->delete();

        $token = Str::random(64);

        // Dodaj nowy token
        DB::table('password_reset_tokens')->insert([
            'email' => $user->email,
            'token' => $token,
            'created_at' => now()
        ]);

        Mail::send('emails.reset-password', ['token' => $token], function($message) use($user) {
            $message->to($user->email);
            $message->subject('Reset hasła');
        });

        return back()->with('status', 'Link do resetu hasła został wysłany na adres email przypisany do konta!');
    }

    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:8|confirmed',
            'token' => 'required'
        ]);

        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])->first();

        if(!$updatePassword) {
            return back()->withInput()->with('error', 'Nieprawidłowy token!');
        }

        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();

        return redirect('/login')->with('status', 'Twoje hasło zostało zmienione!');
    }
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
        ], [
            'username.required' => 'Nazwa użytkownika jest wymagana',
            'username.unique' => 'Ta nazwa użytkownika jest już zajęta',
            'email.required' => 'Email jest wymagany',
            'email.email' => 'Podaj prawidłowy adres email',
            'email.unique' => 'Ten email jest już używany',
        ]);

        $user->update([
            'username' => $request->username,
            'name' => $request->username,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Dane użytkownika zostały zaktualizowane.');
    }
}