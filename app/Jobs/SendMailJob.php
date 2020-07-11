<?php

namespace App\Jobs;

use App\Model\Post;
use App\Mail\TestMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
        // dd($data);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $posts = Post::select('id', 'title')->take(10)->get();
        foreach($this->data as $user){
            $data = [
                'user' => $user->name,
                'posts' => $posts
            ];
            // dd($data);
            \Mail::to($user->email)->send(new TestMail($data));
        }
    }
}
