<?php

namespace App\Http\Controllers;

use App\Faq;
use App\Http\Requests\FaqRequest;
use Illuminate\Http\Request;

/**
 * @authenticated
 * @group FAQ
 */
class FaqController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Faq::class);
    }

    /**
     * Get all FAQs
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::orderBy('view_count', 'desc')
            ->get(['id', 'role_id', 'title', 'keywords', 'view_count'])
            ->filter(function ($faq) {
                return auth()->user()->can('view', $faq);
            })
            ->map(function ($faq) {
                return collect($faq)->except(['role', 'role_id']);
            });

        return $faqs->values();
    }

    /**
     * Get an FAQ entry
     * 
     * @urlParam faq required The FAQ's id Example:1
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        $faq->view_count++;
        $faq->save();
        $faq->loadMissing('role');
        return collect($faq)->only(['id', 'keywords', 'title', 'body', 'view_count', 'role_id', 'role']);
    }

    /**
     * Update an FAQ
     * 
     * @urlParam faq required The FAQ's id Example: 1
     * @bodyParam title string required The FAQ's title Example: How to logout
     * @bodyParam body string required The FAQ's content Example: You just click logout
     * @bodyParam role_id int The FAQ's required minimum role to view Example: 10
     * @bodyParam keywords array required The FAQ's keywords
     * @bodyParam keywords[0] string A keyword Example: Authentication
     * @bodyParam keywords[1] string A keyword Example: User
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(FaqRequest $request, Faq $faq)
    {
        $data = $request->only(['title', 'body', 'keywords', 'role_id']);
        if ($faq->update($data)) {
            $faq->refresh();
            $faq->loadMissing('role');
            $faq = collect($faq)->only(['id', 'keywords', 'title', 'body', 'view_count', 'role_id', 'role']);
            return ["result" => $faq, "message" => "Faq updated"];
        } else {
            return ["result" => null, "message" => "Faq could not be updated"];
        }
    }

    /**
     * Remove an FAQ
     * 
     * @urlParam faq required The FAQ's id Example: 1
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        if ($faq->delete()) {
            return ["result" => true, "message" => "Faq removed"];
        } else {
            return ["result" => false, "message" => "Faq could not be removed"];
        }
    }

    /**
     * Create an FAQ
     * 
     * @bodyParam title string required The FAQ's title Example: How to logout
     * @bodyParam body string required The FAQ's content Example: You just click logout
     * @bodyParam role_id int The FAQ's required minimum role to view Example: 10
     * @bodyParam keywords array required The FAQ's keywords
     * @bodyParam keywords[0] string A keyword Example: Authentication
     * @bodyParam keywords[1] string A keyword Example: User
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqRequest $request)
    {
        $data = $request->only(['title', 'body', 'keywords', 'role_id']);

        $faq = new Faq($data);
        if ($faq->save()) {
            $faq->refresh();
            $faq = collect($faq)->only(['id', 'keywords', 'title', 'body', 'view_count', 'role_id']);
            return ["result" => $faq, "message" => "Faq created"];
        } else {
            return ["result" => null, "message" => "Faq could not be created"];
        }
    }
}
