<?php

namespace App\Mail;

use App\Models\Recruitment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecruitmentNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public Recruitment $recruitment;

    /**
     * Create a new message instance.
     */
    public function __construct(Recruitment $recruitment)
    {
        $this->recruitment = $recruitment;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[HIMSI UBSI] Konfirmasi Pendaftaran Open Recruitment 2026',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.recruitment_confirmation',
            with: [
                'recruitment' => $this->recruitment,
                'branch' => $this->recruitment->branch,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
