<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $notes = Note::where('user_id', Auth::id())->where('archived', 0)
            ->when($request->has('search') && $request->filled('search'), function ($query) {
                $search = request('search');
                $query->where('title', 'LIKE', "%$search%")->orWhere('content', 'LIKE', "%$search%");
            })
            ->latest()->get();

        return view('dashboard', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.x
     */
    public function store(Request $request)
    {
        Note::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $note = Note::findOrFail($id);

        $note->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        // Retrieve a note, including soft-deleted (trashed) ones, by its ID
        $note = Note::withTrashed()->findOrFail($id);

        if ($request->permanent_delete == 0){
            $note->delete();
        }else{
            $note->forceDelete();
        }

        return redirect()->back();
    }

    public function changeAppearance(Request $request)
    {
        $notes = Note::where('user_id', Auth::id())->where('id', $request->id)->first();

        $notes->update([
            'color_name' => $request->color,
            'appearance_type' => $request->type,
            'image_path' => $request->image,
        ]);

        return response()->json(['message' => 'success', 'status' => true]);
    }

    public function archived(Request $request)
    {
        $notes = Note::where('user_id', Auth::id())->where('archived', 1)
            ->when($request->has('search') && $request->filled('search'), function ($query) {
                $search = request('search');
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'LIKE', "%$search%")->orWhere('content', 'LIKE', "%$search%");
                });
            })
            ->latest()->get();

        return view('archived', compact('notes'));
    }

    public function toogleArchive($id)
    {
        $note = Note::where('user_id', Auth::id())->where('id', $id)->first();

        if ($note) {
            $note->update([
                'archived' => !$note->archived, // Toggles between 1 and 0
            ]);
        }

        return redirect()->back();
    }

    public function bin(Request $request)
    {
        $notes = Note::where('user_id', Auth::id())
            ->when($request->has('search') && $request->filled('search'), function ($query) {
                $search = request('search');
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'LIKE', "%$search%")->orWhere('content', 'LIKE', "%$search%");
                });
            })
            ->onlyTrashed()->latest('deleted_at')->get();

        return view('bin', compact('notes'));
    }

    public function restore(string $id)
    {
        $note = Note::where('user_id', Auth::id())->onlyTrashed()->findOrFail($id);

        $note->restore();

        return redirect()->back();
    }

}
