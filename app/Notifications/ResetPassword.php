<?php

namespace GaneshaSIGE\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use GaneshaSIGE\User;


class ResetPassword extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
             ->greeting('Nueva Solicitud de Recuperación de Contraseña:')
            ->line('<b>Para recuperar su contraseña, porfavor diríjase al siguiente enlace:</b><br>'.url( '/password/reset',$this->token).' <br><br><b>Si tiene algún problema, copie y pegue el enlace en la barra de direcciones del navegador en donde posea conexión al servidor local.</b>')
            ->line('<b><h2>Si ud. no ha solicitado recuperar '. ''.'su contraseña o tuvo algun inconveniente, porfavor comuniquese con al administrador del sistema</h2></b>')

            ->action('Ganesha -SIGE', 'Recuperar Contraseña');
    }
}
