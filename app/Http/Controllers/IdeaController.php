<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        /** @var User */
        $user = Auth::user();

        $query = $user->ideas();

        $search = $request->query('search', null);

        if ($search) {
            $query->where(function ($data) use($search) {
                $data->where('title', 'like', "%{$search}%")->orWhere('description', 'like', "%{$search}%");
            });
        }

        $ideas = $query->get();

        return view('dashboard', ['ideas' => $ideas, 'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ideas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string'
        ]);

        /** @var User */
        $user = Auth::user();

        $user->ideas()->create($validated);
        
        return redirect()->route('dashboard')->with('success', 'Idée ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea)
    {   
        $this->authorize('update', $idea);

        return view('ideas.edit', ['idea' => $idea]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Idea $idea)
    {   
        $this->authorize('update', $idea);

        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string'
        ]);

        $idea->update($validated);

        return redirect()->route('dashboard')->with('success', 'Idée mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {   
        $this->authorize('delete', $idea);

        $idea->delete();

        return redirect()->route('dashboard')->with('success', 'Idée supprimée avec succès');
    }
}
