<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

/**
 * @authenticated
 * @group Role
 */
class RoleController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Role::class);
    }

    /**
     * Get all roles
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all()->filter(function ($role) {
            return auth()->user()->can('view', $role);
        });

        return $roles;
    }
}
