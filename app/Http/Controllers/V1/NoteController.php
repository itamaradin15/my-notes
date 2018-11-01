<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Note::where('user_id', 1)->orderBy('created_at','desc')->get();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $note = Note::create([
            'user_id' => auth()->user()->id,
            'title' => $request['title'],
            'content' => $request['content'],
        ]);
        return response($note, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        return response($note, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {

        if ($note->user_id !== auth()->user()->id) {
            return response()->json('Unauthorized', 401);
        }
        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);
        $note->update($data);
        return response($note, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note $note
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Note $note)
    {
        if ($note->user_id !== auth()->user()->id) {
            return response()->json('Unauthorized', 401);
        }
        $note->delete();
        return response()->json('Deleted todo item', 200);
    }
}
