@if(isset($listaUC) )
    @foreach($listaUC as $uc)
            @if($uc->cod_uc_pnf == $cod_vuelta)

<div  class="modal fade" data-backdrop="static" data-keyboard=”false”  id="myModal2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"> 
                <div class="box-header with-border">
                    <h3 class="box-title">Asignar {{$uc->nom_uc}}</h3>
                </div>

                <div class="box-body">  
                                <div class="table-responsive">
                                <form role="form" method="POST" action="/controllerusers/actualizarasignaruc">
                                    {{ csrf_field() }}
                                    <table class="table no-margin">
                                        <thead>
                                            <th>Codigo De Seccion</th>
                                            <th>Docentes</th>
                                        </thead>
                                        <tbody>
            <input class="hide" type="text" name="cod_uc" value="{{$uc->cod_uc_pnf}}">
                                       

                                        @foreach($listaSec as $lisSec)
                                            <tr> 

                                            @foreach($listaSecvalid as $valid)
                                               
                                                @if($valid==$lisSec->cod_sec)
                                                    <td>
                                                    {{ $lisSec->cod_sec}}
                                                    <input class="hide" type="text" name="cod_secc[]" value="{{ $lisSec->cod_sec}}">
</td>
                                                    <td>
                                                    <select name="docente[]">

                                                        @foreach($listaUse as $lisUse)
                                                        @foreach($docentes as $doc)
                                                        @if($lisUse->id == $doc->id_tru)

                                                                <option value="{{$lisUse->id}}">
                                                                    {{$lisUse->name}}
                                                                </option>
                                                        @endif
                                                        @endforeach 

                                                        @endforeach 
                                                    </select>
                                                </td>



                                                
                                                @else
                                                @endif
                                            @endforeach
                                            </tr>
                                         @if($lisSec->trayecto == $uc->trayecto)
                                        
                                                


                                                
                                        </tbody>
                                        @endif
                                        @endforeach
                                    </table>
                                        <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>  
                                </form>
                            </div>
                        </div>    

                    </div>
                </div>
            </div>
        </div>
        @endif
    @endforeach
@endif
      
