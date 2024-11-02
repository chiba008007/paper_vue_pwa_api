<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use App\Consts\CommonConst;

class MailRegistForget extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->registUrl = $data['registUrl'];
        $this->email = $data['email'];
    }

    public function build()
    {

        return $this->view('body')
        ->with([
          'name' => $this->name,
          'email' => $this->email,
          'registUrl' => $this->registUrl
        ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'パスワード再設定のお知らせ',
            from: new Address(CommonConst::ADMINMAIL, '私の名刺'),
            to: $this->email
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'bodyRegistForget',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
