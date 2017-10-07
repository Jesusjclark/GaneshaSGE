<?php

namespace GaneshaSIGE;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class ModelBitacora extends Model
{
    protected $table = "bitacoras";
    protected $primaryKey = "id_bitacora";
     
   protected $fillable = ['id_bitacora','nombre','fecha','id_usuario','accion','observación'];

public function registra($id,$accion,$observacion,$name){

   $bitacora[]= ['nombre'=>$name, 'id_usuario'=>$id,'accion'=>$accion,'observación' =>$observacion, 'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()];

        DB::table('bitacoras')->insert($bitacora);
}
}
