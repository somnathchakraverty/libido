<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class Emailer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $emailTemplate = $this->data['emailTemplate'];
        $emailData = $this->data['emailData'];
        \Mail::send($emailTemplate, $emailData, function($message) use ($emailData) {
            $message->to($emailData['email'], $emailData['name'])->subject($emailData['subject']);
            $message->from(config('constants.ADMIN_EMAIL'), config('constants.ORG_NAME'));
        });
    }
}