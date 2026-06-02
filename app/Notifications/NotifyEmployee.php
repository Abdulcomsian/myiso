<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyEmployee extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($empName)
    {
        $this->empName = $empName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('You have been added to MYISOOnline')
                    ->view('mails.notifyEmployee', ['empName' => $this->empName]);
                    // ->greeting('Dear ' . $this->empName)
                    // ->line('We are pleased to inform you that your email address has been successfully added to MYISOonline. You are now eligible to access and take advantage of our free MYISOonline courses')
                    // ->line('To get started, please register on our LMS system using your official email address:')
                    // ->action('Register Now', url('https://myisoonline.com/public/lms/account/?action=register'))
                    // ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
