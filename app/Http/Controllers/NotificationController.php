<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

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
     * Show a notification.
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
