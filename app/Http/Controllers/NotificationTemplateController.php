<?php

namespace App\Http\Controllers;

use App\Conference;
use App\Http\Requests\NotificationTemplateRequest;
use App\NotificationTemplate;
use Carbon\Carbon;

class NotificationTemplateController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(NotificationTemplate::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = NotificationTemplate
            ::with('conference:id,key')
            ->get();
        return $templates;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\NotificationPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotificationTemplateRequest $request)
    {
        $conference = Conference::find($request->conference_id);
        $data = [
            'name' => $request->name,
            'data' => json_encode($request->data),
            'year' => Carbon::create($conference->start_date)->year,
            'conference_id' => $request->conference_id,
        ];

        $template = new NotificationTemplate($data);

        if ($template->save()) {
            return ["result" => true, "message" => "Template created"];
        } else {
            return ["result" => true, "message" => "Template could not be created"];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NotificationTemplate  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotificationTemplate $notification_template)
    {
        if ($notification_template->delete()) {
            return ["result" => true, "message" => "Template deleted"];
        } else {
            return ["result" => true, "message" => "Template could not be deleted"];
        }
    }
}