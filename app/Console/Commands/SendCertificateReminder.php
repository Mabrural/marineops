<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\VesselCertificate;
use App\Models\UserCompany;
use App\Mail\CertificateReminderMail;
use Illuminate\Support\Facades\Mail;

class SendCertificateReminder extends Command
{
    protected $signature = 'certificates:reminder';

    protected $description = 'Send certificate reminder email';

    public function handle()
    {
        /*
        |--------------------------------------------------------------------------
        | Get All Companies That Have Certificates
        |--------------------------------------------------------------------------
        */

        $companyIds = VesselCertificate::select('company_id')
            ->distinct()
            ->pluck('company_id');

        foreach ($companyIds as $companyId) {

            /*
            |--------------------------------------------------------------------------
            | Expired Certificates
            |--------------------------------------------------------------------------
            */

            $expiredCertificates = VesselCertificate::with('vessel')
                ->where('company_id', $companyId)
                ->whereDate(
                    'expiry_date',
                    '<',
                    now()->startOfDay()
                )
                ->orderBy('expiry_date')
                ->get();

            /*
            |--------------------------------------------------------------------------
            | Expiring Within 30 Days
            |--------------------------------------------------------------------------
            */

            $expiringCertificates = VesselCertificate::with('vessel')
                ->where('company_id', $companyId)
                ->whereBetween(
                    'expiry_date',
                    [
                        now()->startOfDay(),
                        now()->addDays(30)->endOfDay()
                    ]
                )
                ->orderBy('expiry_date')
                ->get();

            /*
            |--------------------------------------------------------------------------
            | Skip If No Certificates
            |--------------------------------------------------------------------------
            */

            if (
                !$expiredCertificates->count()
                && !$expiringCertificates->count()
            ) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Get Company Users Emails
            |--------------------------------------------------------------------------
            */

            $emails = UserCompany::with('user')
                ->where('company_id', $companyId)
                ->where('is_active', true)
                ->get()
                ->pluck('user.email')
                ->filter()
                ->unique()
                ->values()
                ->toArray();

            /*
            |--------------------------------------------------------------------------
            | Skip If No Emails
            |--------------------------------------------------------------------------
            */

            if (empty($emails)) {
                $this->warn("No active users found for company ID {$companyId}");
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Send Email
            |--------------------------------------------------------------------------
            */

            Mail::to($emails)
                ->send(
                    new CertificateReminderMail(
                        $expiredCertificates,
                        $expiringCertificates
                    )
                );

            $this->info(
                "Reminder sent to company ID {$companyId}"
            );
        }

        return Command::SUCCESS;
    }
}