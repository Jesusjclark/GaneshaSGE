<?php

namespace GaneshaSIGE\Notifications;
use Illuminate\Support\Facades\DB;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use GaneshaSIGE\User;
use GaneshaSIGE\ModelPlandeEvaluacion;

class NewPost extends Notification
{
    use Queueable;

    public function __construct($user,$busquedasec,$uni)
    {
        $this->user=$user;
        $this->uni=$uni;
        $this->busquedasec=$busquedasec;
        //dd($this);
   }
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        //dd($this->busquedasec);
       
        return (new MailMessage)
       /* 'correo.plantilla_correo', ['invoice' => $this->uni]);*/

        
                    ->greeting('Saludos! '.$this->user->name.' '.$this->user->ape_usu.'')
                    ->subject('¡Tienes Planes de Evaluacion con fallos en su ejecución!')
                    ->line('Ganesha -SIGE le informa que <b>Debe Subir las calificaciones</b> de las Evaluaciones fijadas para el Plan de Evaluación <br>De la Unidad Curricular<b> '.$this->uni[0].'</b> <br> Para la Sección <b>'.$this->busquedasec[0]->cod_sec.'<br> </b> Turno:<b> '.$this->busquedasec[0]->turno.' </b>, su plazo de asignación ha caducado.')
                    ->action('Ir a Ganesha-SIGE', 'Tiene Planes de Evaluacion Retrasados')
           
                    ->line('Gracias por usar Ganesha-SIGE!');
                    
    }

   
    public function toArray($notifiable)
    {
        return [
         
        ];
    }
}
