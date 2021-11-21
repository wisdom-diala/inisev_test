<?php

namespace App\Jobs;

use App\Mail\SendMail;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    public $timeout = 7200; // 2 hours
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        $website_id = $this->details['website_id'];
        $title = $this->details['title'];
        $description = $this->details['description'];
        $data = Subscriber::query()
                ->where('website_id', $website_id)
                ->get();
        foreach ($data as $key => $value) {
            Mail::to($value->email)->send(new SendMail($title, $description));
        }
    }
}
