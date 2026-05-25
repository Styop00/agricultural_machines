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

class CareerApplicationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @param  array{full_name: string, phone: string, email: string, position: string, message?: string|null}  $data
     */
    public function __construct(
        public readonly array $data,
        private readonly ?string $attachmentPath = null,
        private readonly ?string $attachmentName = null,
        private readonly ?string $attachmentMime = null,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: [
                new Address($this->data['email'], $this->data['full_name']),
            ],
            subject: 'New career application: '.$this->data['position'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.career-application',
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
        if (! $this->attachmentPath || ! $this->attachmentName) {
            return [];
        }

        $attachment = Attachment::fromPath($this->attachmentPath)
            ->as($this->attachmentName);

        if ($this->attachmentMime) {
            $attachment->withMime($this->attachmentMime);
        }

        return [$attachment];
    }
}
