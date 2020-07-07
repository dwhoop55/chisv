<?php

namespace App\Http\Controllers;

use App\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * @authenticated
     * @group Generic Resources
     * Get all states
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return State::all();
    }
}