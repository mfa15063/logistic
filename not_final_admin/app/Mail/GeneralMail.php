<?php

namespace App\Mail;

use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GeneralMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $type,$subject,$body,$data;
    public function __construct($type,$subject,$data)
    {
        $data['date'] = date('Y');
        $emailtemplates = EmailTemplate::where('type',$type)->first();

        $this->subject =  $emailtemplates->subject ?? $subject;
        $this->body = $this->replacePlaceholders($emailtemplates->body,$data);
    }
    private function replacePlaceholders($content, $data)
    {
        if ($data !== null) {
            foreach ($data as $key => $value) {
                $content = str_replace("{{$key}}", $value, $content);
            }
        }

        return $content;
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.general',
            with:[
                'body'=>$this->body
            ]        );
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
