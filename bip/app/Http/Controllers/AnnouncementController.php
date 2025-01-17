<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::query()
            ->when(auth()->guest(), function($query) {
                $query->where(function($q) {
                    $q->whereNull('publish_at')
                      ->orWhere('publish_at', '<=', now());
                })->where(function($q) {
                    $q->whereNull('expire_at')
                      ->orWhere('expire_at', '>', now());
                });
            })
            ->latest()
            ->paginate(10);
        
        return view('announcements.index', compact('announcements'));
    }

    public function show(Announcement $announcement)
    {
        return view('announcements.show', compact('announcement'));
    }

    public function create()
    {
        return view('announcements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'is_important' => 'boolean',
            'publish_at' => 'nullable|date',
            'expire_at' => 'nullable|date|after:publish_at'
        ]);

        $announcement = new Announcement($validated);
        $announcement->created_by = auth()->id();
        $announcement->save();

        return redirect()
            ->route('announcements.index')
            ->with('success', 'Ogłoszenie zostało dodane.');
    }

    public function edit(Announcement $announcement)
    {
        return view('announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'is_important' => 'boolean',
            'publish_at' => 'nullable|date',
            'expire_at' => 'nullable|date|after:publish_at'
        ]);

        $announcement->fill($validated);
        $announcement->updated_by = auth()->id();
        $announcement->save();

        return redirect()
            ->route('announcements.show', $announcement)
            ->with('success', 'Ogłoszenie zostało zaktualizowane.');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()
            ->route('announcements.index')
            ->with('success', 'Ogłoszenie zostało usunięte.');
    }
}