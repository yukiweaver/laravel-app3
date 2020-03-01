<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactSendmail extends Mailable
{
    use Queueable, SerializesModels;

    private $email;
    private $title;
    private $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inputs)
    {
      $this->email  = $inputs['email'];
      $this->title  = $inputs['title'];
      $this->body   = $inputs['body'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this
      ->from('example@gmail.com')
      ->subject('エンタメトーク：お問い合わせ')
      ->view('contact.mail')
      ->with([
          'email' => $this->email,
          'title' => $this->title,
          'body'  => $this->body,
      ]);
    }
}
