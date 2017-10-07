<?php

namespace GaneshaSIGE\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use GaneshaSIGE\User;
use GaneshaSIGE\ModelPlandeEvaluacion;

class InvoicePaid extends Notification
{
    use Queueable;
    //private $workout;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
  
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

    public function toMail($notifiable)
    {
        //$line =  nl2br('<img src="/img/logoss.png"/>');
        return (new MailMessage)


                    ->greeting('Saludos  '.' '.$this->user->name.' '.$this->user->ape_usu.'!!')
                    ->subject('¡Bienvenid@ al equipo de Gestión de Evaluaciones del PNF en Informatica!  '.$this->user->name.''.$this->user->ape_usu.'')
                    
                    ->line('Se te ha registrado en el sistema Ganesha -SIGE del departamento de Informática')
                    ->line('Tus contraseña de acceso es: "<b>'.$this->user->ci_usu.'  </b> " Recuerda cambiarla para mayor seguridad')
                    ->line('Juntos emprenderemos una travesía en este nuevo lapso acádemico ')
                    ->action('Ir a GaneshaSIGE','Nuevo Usuario Registrado');

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
            'workout' => $this->workout->id
        ];
    }
}
