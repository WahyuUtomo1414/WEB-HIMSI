<?php

namespace App\Mail;

use App\Models\Recruitment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecruitmentVerifiedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Recruitment $recruitment,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[HIMSI UBSI] Pendaftaran Anda Telah Diverifikasi',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.recruitment_verified',
            with: [
                'recruitment' => $this->recruitment,
                'branch' => $this->recruitment->branch,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
