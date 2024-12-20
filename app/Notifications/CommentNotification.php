<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CommentNotification extends Notification
{
    use Queueable;

    // Enable notifications to be queued for asynchronous processing.

    public $comment; // Holds the Comment model instance, providing access to comment data like the commenter and associated post.

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via(mixed $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray(mixed $notifiable): array
    {
        return [
            'message' => $this->comment->user->name . ' commented on your post: ' . $this->comment->post->title,
            'comment_id' => $this->comment->id,
            'commenter_id' => $this->comment->user_id,
        ];
    }
}
