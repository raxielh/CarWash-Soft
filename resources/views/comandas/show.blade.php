@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Comanda
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('comandas.show_fields')
                    <a href="{!! route('comandas.index') !!}" class="btn btn-default">Atras</a>
                </div>
            </div>
        </div>
    </div>
    
    <script>

        $(function()
        {
            cargar_valor_concepto($('#concepto_id').val());
            cargar_valor_concepto_total($('#descuentos_id').val());

            $('#concepto_id').change(function(event) {
                cargar_valor_concepto($('#concepto_id').val());
            });
            
            $('#descuentos_id').change(function(event) {
                cargar_valor_concepto_total($('#descuentos_id').val());
            });

            $("#valor").keyup(function(){
                var v=parseInt($('#valor').val());
                var t=parseInt($('#total').val());
                calcular(v,t);
            });

        });

        function cargar_valor_concepto(id)
        {
            $.getJSON( "concepto_valor/"+id, function( data ) {
                if(data.length==0){
                    alert("No hay valor Asignado para este producto");
                    $('#valor').val('');
                    var v=parseInt($('#valor').val());
                    var t=parseInt($('#total').val());
                    calcular(v,t);
                }else{
                    $('#valor').val(data[0].valor);
                    var v=parseInt($('#valor').val());
                    var t=parseInt($('#total').val());
                    calcular(v,t);
                }
            });
        }

        function cargar_valor_concepto_total(id)
        {
            $.getJSON( "valor_concepto_descuento/"+id, function( data ) {
                $('#total').val(data.porcentaje);
                var v=parseInt($('#valor').val());
                var t=parseInt($('#total').val());
                calcular(v,t);
            });
        }

        function calcular(v,t){
            $('#totalc').val(v-(v*(t/100)));
        }

    </script>

@endsection
