<?php

namespace App\Http\Controllers;

use App\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::all(['id', 'role_id', 'title', 'keywords'])
            ->filter(function ($faq) {
                return auth()->user()->can('view', $faq);
            })
            ->map(function ($faq) {
                return collect($faq)->except(['role', 'role_id']);
            });

        return $faqs;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        return collect($faq)->only(['id', 'keywords', 'title', 'body']);
    }
}