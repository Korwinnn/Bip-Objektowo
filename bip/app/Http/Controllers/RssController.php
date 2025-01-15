<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;
use App\Models\Setting;

class RssController extends Controller
{
    public function index()
    {
        $categories = Category::with(['children'])
            ->orderBy('updated_at', 'desc')
            ->take(100)
            ->get();

        $institutionName = Setting::where('key', 'institution_name')
            ->first()->value ?? 'Biuletyn Informacji Publicznej';

        $content = view('rss.feed', [
            'categories' => $categories,
            'institutionName' => $institutionName,
        ])->render();

        return response($content, 200)
            ->header('Content-Type', 'application/xml');
    }
}