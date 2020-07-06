<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Note;
use Illuminate\Http\Request;

/**
 * @authenticated
 * @group Note
 */
class NoteController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Note::class);
    }

    /**
     * Create a new note
     * 
     * @bodyParam for_id int required Id for the note's associated object Example: 1
     * @bodyParam for_type string required Class name for the note's associated object Example: App\User
     * @bodyParam text string required The note's content Example: More than expected
     * @bodyParam conference_id int required The conference to bind this note to (used for App\User) Example: 1
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteRequest $request)
    {
        $data = $request->only(['for_id', 'for_type', 'text', 'conference_id']);
        $data['creator_id'] = auth()->user()->id;
        $note = new Note($data);
        if ($note->save()) {
            return ["result" => $note->refresh(), "message" => "Note created"];
        } else {
            return ["result" => false, "message" => "Note could not be created"];
        }
    }

    /**
     * Delete a note
     * @urlParam note required The note's id Example: 1
     *
     * @response 200 {
     * "result": true, "message": "Note deleted"
     * }
     * 
     * @response 404 {
     * "message": "No query results for model [App\\Note] 1"
     * }
     * 
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        if ($note->delete()) {
            return ["result" => true, "message" => "Note deleted"];
        } else {
            return ["result" => false, "message" => "Note could not be deleted"];
        }
    }
}
