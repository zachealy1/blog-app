<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

/**
 * Notification class for when a post is liked.
 *
 * This class handles the creation and delivery of a notification
 * whenever a user likes a post. It supports queuing for asynchronous
 * notification processing and delivers the notification via the database.
 */
class PostLikedNotification extends Notification
{
    use Queueable;

    // Allows the notification to be queued for deferred delivery.

    /**
     * @var Post $post The post that was liked.
     */
    protected $post;

    /**
     * @var mixed $liker The user who liked the post.
     */
    protected $liker;

    /**
     * Constructor to initialise the notification instance.
     *
     * @param Post $post The liked post.
     * @param mixed $liker The user who liked the post. Typically an instance of User.
     */
    public function __construct(Post $post, $liker)
    {
        $this->post = $post;
        $this->liker = $liker;
    }

    /**
     * Determine the delivery channels for the notification.
     *
     * This method specifies how the notification will be delivered.
     * Here, it is stored in the database.
     *
     * @param mixed $notifiable The notifiable entity (e.g., a User instance).
     * @return array The delivery channels for the notification.
     */
    public function via($notifiable): array
    {
        return ['database']; // Deliver the notification via the database.
    }

    /**
     * Get the array representation of the notification.
     *
     * This defines the structure of the notification data
     * to be stored in the database. It includes details about the post
     * and the user who liked it.
     *
     * @param mixed $notifiable The notifiable entity (e.g., a User instance).
     * @return array The notification data stored in the database.
     */
    public function toArray($notifiable): array
    {
        return [
            'message' => $this->liker->name . " liked your post: {$this->post->title}", // The notification message.
            'post_id' => $this->post->id,  // ID of the liked post.
            'liker_id' => $this->liker->id, // ID of the user who liked the post.
        ];
    }
}
