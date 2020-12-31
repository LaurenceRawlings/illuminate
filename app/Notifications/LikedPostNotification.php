<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LikedPostNotification extends Notification
{
    use Queueable;

    /**
     * @var Post
     */
    private $post;
    /**
     * @var User
     */
    private $user;

    /**
     * Create a new notification instance.
     *
     * @param Post $post
     * @param User $user
     */
    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
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
            'message' => '{{USER}} liked your post.',
            'link' => route('posts.show', [$this->post]),
            'post' => $this->post,
        ];
    }

    public function toBroadcast($notifiable): array
    {
        return [];
    }
}
