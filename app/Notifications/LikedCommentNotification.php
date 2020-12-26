<?php

namespace App\Notifications;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
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
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'user' => $this->user,
            'message' => '{{USER}} liked your comment.',
            'link' => route('read', ['p' => $this->post->id]),
            'comment' => $this->comment,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return [];
    }
}
