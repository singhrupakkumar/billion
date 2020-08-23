<?php


namespace App\Notifications;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;




class ResetPasswordNotification extends ResetPassword
{
    // use Queueable;

    // /**
    //  * Create a new notification instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     //
    // }

    // /**
    //  * Get the notification's delivery channels.
    //  *
    //  * @param  mixed  $notifiable
    //  * @return array
    //  */
    // public function via($notifiable)
    // {
    //     return ['mail'];
    // }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }
        back()->with('info','Check your email address for reset your password');   
       
        return (new MailMessage)
            ->view(
                'auth.emails.password', ['token' => $this->token]
            )
            ->subject('Reset Password Notification')
            ->from('rupak@avainfotech.com', 'Aliance Parcel'); 
            
           
    }   

    
}
