<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Setting;

class InstitutionHeader extends Component
{
    public $institutionName;
    public $institutionLogo;

    public function __construct()
    {
        // Pobieramy ustawienia instytucji z bazy danych
        $this->institutionName = Setting::where('key', 'institution_name')->value('value');
        $this->institutionLogo = Setting::where('key', 'institution_logo')->value('value');
    }

    public function render()
    {
        return view('components.institution-header');
    }
}
