<?php

namespace App\Listeners;

use App\Events\RepliesRead;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\PostComment;

class SetRepliesToViewed
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    private $comment;

    public function __construct(PostComment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Handle the event.
     *
     * @param  RepliesRead  $event
     * @return void
     */
    public function handle(RepliesRead $event)
    {
        $ids = $event->replies->pluck('id')->toArray();

        $this->comment->whereIn('id', $ids)->update(['viewed' => 1]);
    }
}
