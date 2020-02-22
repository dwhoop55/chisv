<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Degree;
use App\Shirt;
use App\Http\Resources\Users;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $universityId = request()->university_id;
        $universityFallback = request()->university_fallback;
        $search = request()->search;

        $query = User
            ::with([
                'degree',
                'shirt',
                'university',
                'permissions'
            ])
            ->orderBy(request()->sort_by, request()->sort_order);

        if ($universityId) {
            $query->where('university_id', $universityId);
        }

        if ($universityFallback) {
            $query->where(function ($query) use ($universityFallback) {
                $query->where('university_fallback', $universityFallback);
                $query->orWhereHas('university', function ($query) use ($universityFallback) {
                    $query = $query->where('name', 'LIKE', '%' . $universityFallback . '%');
                });
            });
        }

        if ($search != "") {
            $query->where(function ($query) use ($search) {
                $searchColumns = ['firstname', 'lastname', 'email'];
                foreach ($searchColumns as $column) {
                    $query = $query->orWhere($column, 'LIKE', '%' . $search . '%');
                }
            });
        }

        return $query->paginate(request()->per_page);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user = User::where('id', $user->id)
            ->with([
                'avatar',
                'languages',
                'permissions' => function ($query) {
                    $query->orderBy('created_at', 'DESC');
                },
                'university',
                'city'
            ])
            ->first();

        $user->location = $user->city->location();
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {

        $data = $request->only(
            'firstname',
            'lastname',
            'email',
            'timezone_id',
            'date_format',
            'time_format',
            'time_sec_format',
            'timezone_id',
            'degree_id',
            'shirt_id',
            'past_conferences',
            'past_conferences_sv',
            'password'
        );

        if (isset($data["password"])) {
            // change password
            $data['password'] = Hash::make($data['password']);
        }

        // Prepare city
        if (isset($request->location["city"])) {
            $data['city_id'] = $request->location["city"]["id"];
        }

        // Prepare university
        if (isset($request->university["id"])) {
            $data['university_id'] = $request->university["id"];
            $data['university_fallback'] = null;
        } else if (isset($request->university["name"])) {
            $data['university_fallback'] = $request->university["name"];
            $data['university_id'] = null;
        }

        $user->update($data);

        // Update languages
        if (isset($request->languages)) {
            $existingLanguages = $user->languages->keyBy('id')->keys();
            $updatedLanguages = collect($request->languages)->keyBy('id')->keys();

            foreach ($existingLanguages as $language) {
                if ($updatedLanguages->search($language) === false) {
                    // has been removed
                    $user->languages()->detach($language);
                };
            }

            foreach ($updatedLanguages as $language) {
                if ($existingLanguages->search($language) === false) {
                    // has been added
                    $user->languages()->attach($language);
                };
            }
        }

        return ["result" => $user->loadMissing(['avatar', 'permissions']), "message" => "User updated"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $result = $user->delete();
        return ["success" => $result, "message" => "User deleted"];
    }


    // Blade view routes (web route endpoints)

    /**
     * Render the user index form
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function showIndex()
    {
        return view('user.index');
    }

    /**
     * Render the user edit form
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function showEdit(User $user)
    {
        return view('user.edit', compact('user'));
    }
}