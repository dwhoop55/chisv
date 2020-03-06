<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class Announcement extends Notification implements ShouldQueue
{
    use Queueable;

    private $subject;
    private $greeting;
    private $salutation;
    private $elements;
    private $conference;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($elements, $conference = null, $subject = null, $greeting = null, $salutation = null)
    {
        $this->elements = collect($elements);
        $this->subject = $subject;
        $this->greeting = $greeting;
        $this->salutation = $salutation;
        $this->conference = $conference;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if ($notifiable && isset($notifiable->id)) {
            return ['mail', 'database'];
        } else {
            return ['mail'];
        }
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $mail = new MailMessage();
        if ($this->conference && isset($this->conference->email_chair)) {
            $mail->replyTo($this->conference->email_chair);
        }
        if ($this->greeting) {
            $mail->greeting($this->greeting);
        } else if ($notifiable && isset($notifiable->firstname)) {
            $mail->greeting("Hello $notifiable->firstname,");
        }
        $mail->subject($this->subject);
        $mail->salutation(new HtmlString(str_replace("\n", "<br>", $this->salutation)));
        $this->elements->each(function ($element) use (&$mail) {
            if ($element['type'] == 'markdown') {
                $data = explode("\n", $element['data']);
                foreach ($data as $line) {
                    $mail->line($line);
                }
            } else if ($element['type'] == 'action') {
                $mail->action($element['data']['caption'], $element['data']['url']);
            }
        });

        return $mail;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'elements' => $this->elements,
            'subject' => $this->subject,
            'greeting' => $this->greeting,
            'salutation' => $this->salutation
        ];
    }
}