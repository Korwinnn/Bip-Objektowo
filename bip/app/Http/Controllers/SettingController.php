<?php
namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::pluck('value', 'key')->all();
        return view('settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'institution_name' => 'required|string|max:255',
            'institution_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:max_height=120',
        ]);

        // Aktualizacja nazwy instytucji
        Setting::updateOrCreate(
            ['key' => 'institution_name'],
            ['value' => $request->institution_name]
        );

        // Obsługa logo
        if ($request->hasFile('institution_logo')) {
            $file = $request->file('institution_logo');
            
            // Zapisz obraz
            $filename = 'institution_logo.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('images', $filename, 'public');
            Setting::updateOrCreate(
                ['key' => 'institution_logo'],
                ['value' => $filename]
            );
        }

        return redirect()->back()->with('success', 'Ustawienia zostały zaktualizowane.');
    }
}