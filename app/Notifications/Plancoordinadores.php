<?php

namespace GaneshaSIGE\Notifications;
use Illuminate\Support\Facades\DB;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use GaneshaSIGE\User;
use GaneshaSIGE\ModelPlandeEvaluacion;

class Plancoordinadores extends Notification
{
    use Queueable;

    public function __construct($user,$user2,$busquedasec, $uni)
    {
        $this->user=$user;
        $this->busquedasec=$busquedasec;
        $this->uni=$uni;
        $this->docente=$user2;

   }
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        //dd($this->docente);
       
        return (new MailMessage)
       /* 'correo.plantilla_correo', ['invoice' => $this->uni]);*/

        
                    ->greeting('Saludos! '.$this->user->name.' '.$this->user->ape_usu.'')
                    ->subject('Notificación de Planes de Evaluacion con fallos!')
                    ->line('Ganesha -SIGE le informa que el Plan de Evaluación de La Unidad Curricular <b>'.$this->uni[0].'</b><br>De la Sección <b>'.$this->busquedasec[0]->cod_sec.'</b><br> Turno: <b>'.$this->busquedasec[0]->turno.'</b> <br>Tiene Evaluaciones retrasadas, Ya que el docente responsable: <b>'.$this->docente->name.' '.$this->docente->ape_usu.'</b> <br> No ha asignado las calificaciones.')
                    ->action('Ir a Ganesha-SIGE', 'Existen Planes Retrasados')
           
                    ->line('Gracias por usar Ganesha-SIGE!');
                    
    }

   
    public function toArray($notifiable)
    {
        return [
         
        ];
    }
}
