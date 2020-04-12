<?php

namespace App\Http\Controllers;

use App\Faq;
use App\Http\Requests\FaqRequest;
use Illuminate\Http\Request;

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
     * Display a listing of the resource.
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
     * Display the specified resource.
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
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
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
     * Store a newly created resource in storage.
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