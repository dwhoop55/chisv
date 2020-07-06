<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

/**
 * @authenticated
 * @group Notification
 */
class NotificationController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(DatabaseNotification::class);
    }

    /**
     * Get all notifications of the authenticated user
     * 
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $since = $request->since ? Carbon::create($request->since) : Carbon::createFromTimestamp(0);

        $data = DatabaseNotification
            ::where('notifiable_type', 'App\User')
            ->where('notifiable_id', $user->id)
            ->where('created_at', '>', $since)
            ->orderBy('created_at', 'asc')
            ->get(['id', 'type', 'data', 'read_at', 'created_at']);

        $data = $data->map(function ($notification) {
            $n = $notification->only(['id', 'type', 'read_at', 'created_at']);
            $n['subject'] = $notification->data['subject'];
            $n['conference_key'] = $notification->data['conference']['key'] ?? '';
            return $n;
        });

        // We fetch the max notification date to prevent that when something
        // in the backend goes wrong and we have created_at > now we fetch the
        // notification again and again
        $now = Carbon::create('now');
        $maxNotificationDate = $data->max('created_at');
        $clearUntil = max($now, $maxNotificationDate, $since);

        return ["data" => $data, "clearUntil" => $clearUntil->toDateTimeString()];
    }

    /**
     * Get a notification
     * 
     * @urlParam database_notification required Notification's UUID Example: f8f02574-a9eb-408b-9836-c7408b248afb
     * 
     * @response {
     * {"id":"f8f02574-a9eb-408b-9836-c7408b248afb","type":"App\\Notifications\\Announcement","data":{"elements":[{"type":"action","data":{"caption":"Click to view","url":"https://chisv.org/conference/chi20"}}],"subject":"SV Announcement","greeting":null,"salutation":"Regards,\n\nSV Chairs CHI20, Honolulu, Hawaii, USA\n\n[noreply@chisv.org](mailto:noreply@chisv.org)\n\n[ACM](https://www.acm.org/)","conference":{"id":1,"key":"chi20","name":"CHI 2020"}},"read_at":null,"created_at":"2020-07-06T18:11:53.000000Z"}
     * }
     * 
     * @response 404 {
     * "message": "No query results for model [Illuminate\\Notifications\\DatabaseNotification] fd8f02574-a9eb-408b-9836-c7408b248afb"
     * }
     *
     * @return \Illuminate\Http\Response
     */
    public function show(DatabaseNotification $databaseNotification)
    {
        $notification = $databaseNotification->only(['id', 'type', 'data', 'read_at', 'created_at']);
        $notifiable = $databaseNotification->notifiable;
        if ($notifiable instanceof User && $notifiable->id == auth()->user()->id) {
            $databaseNotification->update(['read_at' => Carbon::create('now')]);
        }

        return $notification;
    }
}
