<?php

namespace App\Http\Controllers;

use App\Models\System;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SystemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $systems = System::latest()->paginate(10);
        return view('systems.index', compact('systems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('systems.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:active,inactive',
        ]);

        System::create($validated);

        return redirect()->route('systems.index')
            ->with('success', 'システムが正常に登録されました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(System $system): View
    {
        return view('systems.show', compact('system'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(System $system): View
    {
        return view('systems.edit', compact('system'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, System $system): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:active,inactive',
        ]);

        $system->update($validated);

        return redirect()->route('systems.index')
            ->with('success', 'システムが正常に更新されました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(System $system): RedirectResponse
    {
        $system->delete();

        return redirect()->route('systems.index')
            ->with('success', 'システムが正常に削除されました。');
    }
}
