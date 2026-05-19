<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;

class CertificateReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $expiredCertificates;
    public $expiringCertificates;

    public function __construct($expiredCertificates, $expiringCertificates)
    {
        $this->expiredCertificates = $expiredCertificates;
        $this->expiringCertificates = $expiringCertificates;
    }

    public function build()
    {
        return $this->subject('Certificate Reminder Notification')
            ->view('emails.certificate-reminder');
    }
}