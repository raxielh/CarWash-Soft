@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Comanda
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'comandas.store']) !!}

                        @include('comandas.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <script>

        $(function() {
            //$('#persona_id').empyt();
            cambiar($('#vehiculo_id').val());

            $('#vehiculo_id').change(function(event) {
                cambiar($('#vehiculo_id').val());
            });

        });

        function cambiar(id_v)
        {
            $.getJSON('/buscar_propietario/'+id_v, function(json, textStatus) {
                $.each(json, function(index, val) {
                    //console.log(val.persona_id);
                    $('#persona_id').val(val.persona_id);
                    $('#persona_id').trigger("chosen:updated");
                    //$('#persona_id option[value='+val.persona_id+']').attr('selected','selected');
                });
            });
        }

    </script>
@endsection
