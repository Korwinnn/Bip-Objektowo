<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;  // Dodajemy ten import

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
            'name.required' => 'Login jest wymagany',
            'email.email' => 'Podaj prawidłowy adres email',
            'email.unique' => 'Ten email jest już używany',
            'password.required' => 'Hasło jest wymagane',
            'password.min' => 'Hasło musi mieć minimum 8 znaków',
            'password.confirmed' => 'Hasła nie są identyczne',
        ];

        $request->validate([
            'username' => 'required|unique:users',
            'name' => 'required',
            'email' => 'nullable|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ], $messages);

        User::create([
            'username' => $request->username,
            'name' => $request->name,
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
}