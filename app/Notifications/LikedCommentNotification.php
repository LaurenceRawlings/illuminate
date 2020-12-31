<?php

namespace App\Notifications;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LikedCommentNotification extends Notification
{
    use Queueable;

    /**
     * @var Comment
     */
    private $comment;
    /**
     * @var User
     */
    private $user;
    /**
     * @var Post
     */
    private $post;

    /**
     * Create a new notification instance.
     *
     * @param Comment $comment
     * @param Post $post
     * @param User $user
     */
    public function __construct(Comment $comment, Post $post, User $user)
    {
        $this->comment = $comment;
        $this->user = $user;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            'user' => $this->user,
            'message' => '{{USER}} liked your comment.',
            'link' => route('posts.show', [$this->post]),
            'comment' => $this->comment,
        ];
    }

    public function toBroadcast($notifiable): array
    {
        return [];
    }
}
