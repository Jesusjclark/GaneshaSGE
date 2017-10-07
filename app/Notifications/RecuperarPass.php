<?php

namespace GaneshaSIGE\Notifications;
use Illuminate\Support\Facades\DB;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use GaneshaSIGE\User;
use GaneshaSIGE\ModelPlandeEvaluacion;
use Illuminate\Support\Facades\Crypt;

class RecuperarPass extends Notification
{
    use Queueable;

    public function __construct($user)
    {
        $this->user=$user;
       
        $description = Crypt::decrypt($user->password);

    
   }
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $description = 'hola';
       
        return (new MailMessage)
       /* 'correo.plantilla_correo', ['invoice' => $this->uni]);*/

        
                    ->greeting('Saludos! '.$this->user->name.' '.$this->user->ape_usu.'')
                    ->subject('¡Nueva solicitud de Contraseña Olvidada!')
                    ->line('Ganesha -SIGE le informa que se ha solicitado la contraseña actual de su usuario, la cual es:<b>'.$description.'</b>')
                    ->line('Para mayor seguridad le sugerimos que ingrese al sistema Ganesha-SIGE y cambie su contraseña')
                    ->action('Ir a Ganesha-SIGE', 'Solicitud de Contraseña')
           
                    ->line('Gracias por usar Ganesha-SIGE!');
                    
    }

   
    public function toArray($notifiable)
    {
        return [
         
        ];
    }
}
