@extends('layouts.app')

@section('content')

    <section class="content-header oc">
        <h1>
            Comanda
        </h1>
    </section>
    <div class="content oc">
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
                //console.log(data);
                if(data.length==0){
                    $("#valor").prop('disabled', true);
                    $('#valor').val('');
                    $('#totalc').val('');
                    $('.cantidad').hide();
                }else{
                    if(data[0].des=='Producto'){
                        $('.cantidad').show();
                    }else{
                        $('.cantidad').hide();
                    }
                    $("#valor").prop('disabled', false);
                    //var valor=data[0].valor+(data[0].valor*(data[0].impuesto/100));
                    $('#valor').val(data[0].valor);
                    $('#impuesto').val(data[0].impuesto);
                    $('#comision').val(data[0].comision);
                    var v=parseInt($('#valor').val());
                    var d=parseInt($('#descuento').val());
                    var c=parseInt($('#cantidad').val());
                    calcular(v,d,c);
                }
            });
        }

        function calcular(){
            var v=parseInt($('#valor').val());
            var d=parseInt($('#descuento').val());
            var c=parseInt($('#cantidad').val());
            var i=parseInt($('#impuesto').val());

            var sub=v*c;
            var des=(sub*(d/100));
            var imp=(sub*(i/100));
            var total=(sub+imp)-des;

            console.log(des+' '+imp);
            console.log(total);

           $('#totalc').val(total);
           $('#total').val(sub);
        }

    </script>

@endsection
