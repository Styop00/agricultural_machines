<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InformationRequestMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @param  array{full_name: string, phone: string, email: string, preferred_contact_time?: string|null, request_type?: string|null, source_page?: string|null, message: string}  $data
     */
    public function __construct(
        public readonly array $data,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: [
                new Address($this->data['email'], $this->data['full_name']),
            ],
            subject: 'New '.($this->data['request_type'] ?? 'information').' request',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.information-request',
            with: [
                'data' => $this->data,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
