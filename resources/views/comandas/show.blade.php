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
            cargar_descuento($('#descuentos_id').val());
            cargar_valor_concepto($('#concepto_id').val());

            $('#concepto_id').change(function(event) {
                cargar_valor_concepto($('#concepto_id').val());
            });
            
            $('#descuentos_id').change(function(event) {
                cargar_descuento($('#descuentos_id').val());
            });

            $("#valor").keyup(function(){
                var v=parseInt($('#valor').val());
                var d=parseInt($('#descuento').val());
                var c=parseInt($('#cantidad').val());
                calcular(v,d,c);
            });

            $("#cantidad").keyup(function(){
                var v=parseInt($('#valor').val());
                var d=parseInt($('#descuento').val());
                var c=parseInt($('#cantidad').val());
                calcular(v,d,c);
            });

        });
        
        function cargar_descuento(id)
        {
            $.getJSON( "valor_concepto_descuento/"+id, function( data ) {
                $('#descuento').val(data.porcentaje);
                var v=parseInt($('#valor').val());
                var d=parseInt($('#descuento').val());
                var c=parseInt($('#cantidad').val());
                calcular(v,d,c);
            });
        }

        function cargar_valor_concepto(id)
        {
            $.getJSON( "concepto_valor/"+id, function( data ) {
                if(data.length==0){
                    $("#valor").prop('disabled', true);
                    $('#valor').val('');
                    var v=parseInt($('#valor').val());
                    var d=parseInt($('#descuento').val());
                    var c=parseInt($('#cantidad').val());
                    calcular(v,d,c);
                }else{
                    if(data[0].des=='Producto'){
                        $('.cantidad').show();
                    }else{
                        $('.cantidad').hide();
                    }
                    $("#valor").prop('disabled', false);
                    $('#valor').val(data[0].valor);
                    var v=parseInt($('#valor').val());
                    var d=parseInt($('#descuento').val());
                    var c=parseInt($('#cantidad').val());
                    calcular(v,d,c);
                }
            });
        }

        function calcular(v,d,c){
            //console.log(v+" "+d+" "+c);
            $('#totalc').val((v-(v*(d/100)))*c);
            $('#total').val((v-(v*(d/100)))*c);
        }

    </script>

@endsection
