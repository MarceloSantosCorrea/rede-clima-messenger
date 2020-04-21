<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessagePusher implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var array
     */
    public $data;

    /**
     * SendMessagePusher constructor.
     * @param  array  $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return Channel|\Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]
     */
    public function broadcastOn()
    {
        $appName = \Str::slug(\Config::get('app.url'));

        return new Channel("{$appName}-redeclima");
    }

    public function broadcastAs()
    {
        return 'comment';
    }
}
