<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Degree;
use App\Shirt;

class UserController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // This will only authorize CRUD, not the index
        // we authorize it manually
        $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // Ask the UserPolicy if index is allowed for that user
        $this->authorize('index', User::class);
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $authUser = auth()->user();
        $degrees = Degree::all();
        $shirts = Shirt::all();
        return view("user.edit", compact('authUser', 'user', 'degrees', 'shirts'));
    }
}