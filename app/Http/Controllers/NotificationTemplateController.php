<?php

namespace App\Http\Controllers;

use App\Conference;
use App\Http\Requests\NotificationTemplateRequest;
use App\NotificationTemplate;
use Carbon\Carbon;

/**
 * @authenticated
 * @group Notification
 */
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
     * Get all notification templates
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
     * Create a new notification template
     * 
     * @bodyParam name string required Give the template a unique name Example: My New Template!
     * @bodyParam data string required The enrollment form template in JSON encoded form
     * @bodyParam year int required YYYY formatted year Example: 2020
     * @bodyParam conference_id int required Bind to this conference Example: 1
     * 
     * @bodyParam data.destinations array required Multiple destinations, see below for 3 examples
     * @bodyParam data.destinations[0].type string Must be 'group' Example:group
     * @bodyParam data.destinations[0].role_id int Pointing to the role by id Example: 10
     * @bodyParam data.destinations[0].state_id int Pointing to the state by id Example: 12
     * 
     * @bodyParam data.elements array required Multiple elements, see below for action and markdown below
     * @bodyParam data.elements[0].type required One of 'action', 'markdown' Example: action
     * @bodyParam data.elements[1].type required One of 'action', 'markdown' Example: markdown
     * @bodyParam data.elements[0].data.caption string Is required if type is 'action' Example: CHISV Website
     * @bodyParam data.elements[0].data.url string Is required if type is 'action' Example: https://chisv.org
     * @bodyParam data.elements[1].data string Is required if type is 'markdown' Example: !See text below
     *
     * @param  \Illuminate\Http\NotificationTemplateRequest  $request
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
     * Delete a notification template
     * 
     * @urlParam notification_template required The notification template's id to delete Example: 1
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
