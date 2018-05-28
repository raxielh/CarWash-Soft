@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Buscar Concepto</h1>
    </section>
    <div class="content">

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    <div><a href="/comandas/{{$id}}" class="btn btn-primary">Atras</a></div>
                    <div class="col-xs-5" style="font-size: 25px;text-align: center;"><strong>Subtotal: </strong><spam id="total">0</spam></div>
                    <div class="col-xs-7">
                        {!! Form::label('descuentos_id', 'Descuentos:') !!}
                        {!! Form::select('descuentos_id',$descuento,null,['class'=>'form-control chosen-select']) !!} 
                        <input type="hidden" id="descuento">   
                    </div>    
                </div>

                <div class="row" style="padding: 2em">
                    @foreach ($l_conceptos as $c)
                    <div id="concepto-{{$c->id}}" class="col-xs-4 col-sm-4 col-md-2" style="padding: 1px;background-image: url({{ Storage::url($c->imagen)}});background-size: 180px;background-repeat: no-repeat;background-position:center;">
                        <div class="card" style="height: 180px">
                            <div style="word-wrap: break-word;background-color: #33333394;color: #fff;position: relative;text-align: center;padding:5px;font-size: 16px;line-height: 22px;">
                                <strong>{{ $c->codigo }}</strong> <br>
                                {{ $c->descripcion }} <br>
                                {{ number_format($c->valor+($c->valor*($c->impuesto/100))) }} <br>
                                <!--comanda_id,concepto_id,cantidad,descuentos_id,descuento,valor,comision,impuesto-->
                                <button type="button" onclick="add({{$id}},{{$c->id}},1,0,0,{{ $c->valor }},{{ $c->comision }},{{ $c->impuesto }});" class="btn btn-success"><i class="fa fa-check"></i></button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                   
                </div>

            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
    <script>
        $(function() {
            calcular({!!$id!!});
            cargar_descuento($('#descuentos_id').val());
            $('#descuentos_id').change(function(event) {
                cargar_descuento($('#descuentos_id').val());
            });            
        });

        //comanda_id,concepto_id,cantidad,descuentos_id,descuento,valor,comision,impuesto
        function add(_comanda_id,_concepto_id,_cantidad,_descuentos_id,_descuento,_valor,_comision,_impuesto)
        {
            if (confirm("Estas seguro de agregar este concepto?"))
            {
                var _descuentos_id=parseInt($('#descuentos_id').val());
                var _descuento=parseInt($('#descuento').val());
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  
                $.ajax({
                    url: '/comandaDetallesAjax',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        comanda_id:_comanda_id,
                        concepto_id:_concepto_id,
                        cantidad:_cantidad,
                        descuentos_id:_descuentos_id,
                        descuento:_descuento,
                        valor:_valor,
                        comision:_comision,
                        impuesto:_impuesto
                    },
                    //contentType: "application/json",
                    success: function (data) {
                        calcular({!!$id!!});
                        console.log(data);
                        $('#concepto-'+_concepto_id).fadeOut('slow');
                    },error: function (request, status, error) {
                        alert("Este producto ya fue agregado");
                    }
                }); 



            }
        }

        function cargar_descuento(id)
        {
            $.getJSON( "../comandas/valor_concepto_descuento/"+id, function( data ) {
                $('#descuento').val(data.porcentaje);
            });
        }

        function calcular(id)
        {
            $.getJSON( "../comandas/calcular_subtotal/"+id, function( data ) {
                $('#total').text(data[0].sub);
            });
        }

    </script>
@endsection

