@if(isset($listaUC) )
    @foreach($listaUC as $uc)
        @if($uc->cod_uc_pnf == $cod_vuelta)
<div  class="modal fade" data-backdrop="static" data-keyboard=”false” id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"> 
                <div class="box-header with-border">
                    <h3 class="box-title">Modificar {{$uc->nom_uc}}</h3>
                </div>
                 <div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Ya existen Usuarios asignados para esta Unidad Curricular, Si lo desea puede modificar los registros y guardar los cambios. De lo contrario presione el botón 'Cancelar'<b>.<br>

                <h4>Ganesha -SIGE.</h4> </div>
                                     
                <div class="box-body">  
                                <div class="table-responsive">
                                <form role="form" method="POST" action="/controllerusers/actualizarasignaruc">
                                    {{ csrf_field() }}
                                    <table class="table no-margin">
                                        <thead>
                                            <th>Codigo De Seccion</th>
                                            <th>Docentes</th>
                                        </thead>
                                        
            <input class="hide" type="text" name="cod_uc" value="{{$uc->cod_uc_pnf}}">
                                       
                                    @foreach($listaSec as $lisSec)
                                            <tr>      
                                        @foreach($listaSecvalid as $valid)
                                            @if($valid==$lisSec->cod_sec)
                        
                                                <tbody>
                                                <td> 
                                                    {{ $lisSec->cod_sec}}
                                                    <input class="hide" type="text" name="cod_secc[]" value="{{ $lisSec->cod_sec}}">

                                                </td>


                                                <td>
                                                    <select name="docente[]">

                                                        @foreach($listaUse as $lisUse)
                                                            @foreach($docentes as $doc)
                                                                @if($lisUse->id == $doc->id_tru)

                                                                <option @foreach($puente2 as $pu) @if($pu->cod_seccion == $lisSec->cod_sec && $pu->id_usu ==$doc->id_tru) selected @endif @endforeach value="{{$lisUse->id}}">
                                                                            {{$lisUse->name}}
                                                                        </option>
                                                                @endif
                                                            @endforeach 

                                                        @endforeach 
                                                    </select>
                                                </td>
                                                </tbody>
                                            @endif
                                        @endforeach
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
      
