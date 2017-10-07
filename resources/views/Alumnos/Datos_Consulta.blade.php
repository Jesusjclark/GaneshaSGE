

<form class="form-horizontal" role="form" method="POST" action="/Consulta/Alumnos_Nota">
{{ csrf_field() }}


<div class="{{ $errors->has('ci_usu') ? ' has-error' : '' }}">
    <label for="ci_usu" class="control-label">Cedula de Identidad</label>
    <input id="ci_usu" type="text" class="ci form-control" name="ci_usu" value="{{ old('ci_usu') }}" maxlength="8" minlength="7" onKeyPress="return soloNumeros(event)" placeholder="xxxxxxxxx"  required autofocus>
    @if ($errors->has('ci_usu'))
        <span class="help-block">
            <strong>{{ $errors->first('ci_usu') }}</strong>
        </span>
    @endif
</div>

    <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="control-label">Password (Cedula)</label>
            <input id="password" type="password" class="pass form-control" name="password" maxlength="8" minlength="7" onKeyPress="return soloNumeros(event)" placeholder="xxxxxxxxx" required autofocus>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
    </div>    <br>
    <button type="button" id="guardar" class="btn btn-danger btn-xs  col-md-offset-11">
        Entrar
    </button>
</form>