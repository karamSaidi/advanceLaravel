<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $user_img;
    public $title;
    public $content;
    public $user_id;
    public $created_at;
    public $url;
    public $name;
    public $post_id;
    public $comment;

    public function __construct($data)
    {

        $this->user_img = $data['user_img'];
        $this->title = $data['title'];
        $this->content = $data['content'];
        $this->user_id = $data['user_id'];
        $this->created_at = Carbon::now()->diffForHumans();
        $this->url =  $data['url'];
        $this->name = $data['name'];
        $this->post_id = $data['post_id'];
        $this->comment = $data['comment'];

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('channel-comments-notification');
        // return ['channel-comments-notification'];
    }

    public function broadcastAs()
    {
        return 'comments-notification';
    }



}
