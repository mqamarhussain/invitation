<?php

namespace App\Jobs;

use App\Models\BusinessProfile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class sendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public $to, public $subject,public BusinessProfile $profile, public $view)
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // $to = $this->to;
        // $subject = $this->subject;

        // $headers = [
        //     'MIME-Version' => '1.0',
        //     'Content-type' => 'text/html; charset=iso-8859-1',
        //     'From' => env('MAIL_FROM_ADDRESS'),
        //     'Reply-To' => 'yourname@example.com',
        // ];

        // $html = view($this->view, ['profile' => $this->profile]);

        // mail($to, $subject, $html, $headers);
        info('email sent successfull through log');
    }
}
