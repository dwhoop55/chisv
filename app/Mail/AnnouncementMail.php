<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\HtmlString;

class AnnouncementMail extends Mailable
{
    use Queueable, SerializesModels;

    public $elements;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($elements, $subject = null, $greeting = null, $salutation = null)
    {
        $this->elements = collect($elements);
        if ($subject) $this->subject = $subject;
        if ($salutation) $this->salutation = new HtmlString(str_replace("\n", "<br>", $salutation));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // foreach ($this->elements as $element) {
        //     $data = new HtmlString(str_replace("\n", "<br>", $element['data']));
        //     switch ($element['type']) {
        //         case 'text':
        //             $this->line($data);
        //             break;
        //         case 'title':
        //             $this->lline(new HtmlString("<h2>" . $data . "</h2>"));
        //             break;
        //         case 'action':
        //             $this->laction($element['data']['caption'], $element['data']['url']);
        //             break;
        //     }
        // }

        return $this->view('mail.announcement');
    }
}