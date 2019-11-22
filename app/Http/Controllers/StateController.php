<?php

namespace App\Http\Controllers;

use App\State;
use Illuminate\Http\Request;
use App\Http\Resources\States;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new States(State::all());
    }
}