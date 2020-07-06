<?php

namespace App\Http\Controllers;

use App\State;
use Illuminate\Http\Request;

/**
 * @authenticated
 * @group State
 */
class StateController extends Controller
{
    /**
     * Get all states
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return State::all();
    }
}
