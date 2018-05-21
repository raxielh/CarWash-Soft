<!-- Persona Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('persona_id', 'Propietario:') !!}
    {!! Form::select('persona_id',$datos['personas'], null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Placa Field -->
<div class="form-group col-sm-6">
    {!! Form::label('placa', 'Placa:') !!}
    {!! Form::text('placa', null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('marcas_id', 'Marca:') !!}
    {!! Form::select('marcas_id',$datos['marca'], null, ['class' => 'form-control chosen-select','required' => 'required']) !!}
</div>

<div class="form-group col-sm-6">
    <label for="lineas_id">Linea:</label>
    <select class="form-control" required="required" name="lineas_id" id="lineas_id">
    </select>
</div>

<!-- Modelo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('modelo', 'Modelo:') !!}
    {!! Form::number('modelo', null, ['class' => 'form-control']) !!}
</div>

<!-- Color Field -->
<div class="form-group col-sm-6">
    {!! Form::label('color', 'Color:') !!}
    {!! Form::color('color', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('vehiculos.index') !!}" class="btn btn-default">Cancelar</a>
</div>

<script>
    $(function() {
        cargar_lineas($('#marcas_id').val());
        $('#marcas_id').change(function(event) {
            //console.log($('#marcas_id').val());
            var marca=$('#marcas_id').val();
            cargar_lineas(marca);
        });
    });

    function cargar_lineas(marca){
        $("#lineas_id").empty();
        <?php 
            if(isset($datos['vehiculos'])==1){
                echo 'var linea='.$datos['vehiculos']->lineas_id.';';
        ?>
        $.getJSON('{{ url('lineas_marca')}}'+'/'+marca, function( data ) {
            console.log(data);
            $.each(data, function(id,value){
                if(value.id==linea){
                    $("#lineas_id").append('<option value="'+value.id+'" selected>'+value.descripcion+'</option>');
                }else{
                    $("#lineas_id").append('<option value="'+value.id+'">'+value.descripcion+'</option>');
                }
            });
        });
        <?php 
            }else{
        ?>
        $.getJSON('{{ url('lineas_marca')}}'+'/'+marca, function( data ) {
            //console.log(data);
            $.each(data, function(id,value){
                console.log(value.descripcion);
                $("#lineas_id").append('<option value="'+value.id+'">'+value.descripcion+'</option>');
            });
        });

        <?php } ?>
    }
</script>