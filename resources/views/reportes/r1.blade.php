@extends('layouts.app')

@section('content')
<style>
table {
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
td,th{
    border: 1px solid #5d4040;
    text-align: left;
    padding: 8px;
}
</style>
<style>
    @media print {
        #print,#frm{
            display: none;
        }
        .box box-primary{
              border-top-color: #fff;
        }
    }
</style>
    <section class="content-header">
        <h1 class="pull-left">Reporte de ingreso y egreso</h1><br>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body" style="padding: 3em">
              <div class="row">
              <form action="/reportes/ingresosyegresos/" id="frm">
                <div class="col-sm-2">
                  <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" name="fecha">
                </div>
                <div class="col-sm-10">
                   <button type="submit" class="btn btn-warning">Generar Reporte</button>
                </div>
              </form>
              </div>
                <div class="row" id="print">
                    <a href="#" class="btn btn-info pull-right" onclick="window.print();" style="margin-right: 30px;"><i class="fa fa-print"></i> Imprimir</a>
                </div>
              <div class="row">

                <h4><strong>Fecha:</strong> {{$datos['fecha']}}</h4>

                @foreach ($datos['base'] as $base)
                    <h4 style="color: red;margin-top: 0px"><strong>Base:</strong> {{ number_format($base->valor_inicia) }}</h4>
                @endforeach

                <h4 style="text-align: center;">PATIO</h4>
                <table>
                    <thead>
                      <tr>
                        <th>Tipo Concepto</th>
                        <th>Cantidad</th>
                        <th>Tipo valor</th>
                        <th>Valor total</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($datos['comda_detalle'] as $cd)
                      <tr>
                        <td>{{ $cd->tipoconcepto }}</td>
                        <td>{{ $cd->cantidad }}</td>
                        <td>{{ number_format($cd->valor) }}</td>
                        <td>{{ number_format($cd->valortotal) }}</td>
                      </tr>
                    @endforeach

                  @foreach ($datos['numero_carros'] as $base)

                    <tr>
                        <td><b># DE CARROS DIA</b></td>
                        <td></td>
                        <td></td>
                        <td>{{ $base->numerocarros }}</td>
                      </tr>

                @endforeach
                  @foreach ($datos['total_patio'] as $base)

                    <tr>
                        <td><b>VENTAS TOTALES PATIO</b></td>
                        <td></td>
                        <td></td>
                        <td>{{ number_format($base->totalpatio) }}</td>
                      </tr>

                @endforeach

                    </tbody>
                </table>
               <h4 style="text-align: center;">CAFETERIA</h4>
<table>
                    <thead>
                      <tr>
                        <th>Tipo Concepto</th>
                        <th>Cantidad</th>
                        <th>Tipo valor</th>
                        <th>Valor total</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($datos['comda_detalle_cafetaria'] as $cd)
                      <tr>
                        <td>{{ $cd->tipoconcepto }}</td>
                        <td>{{ $cd->cantidad }}</td>
                        <td>{{ number_format($cd->valor) }}</td>
                        <td>{{ number_format($cd->valortotal) }}</td>
                      </tr>
                    @endforeach


                  @foreach ($datos['total_cafetaria'] as $base)

                    <tr>
                        <td><b>VENTAS TOTALES PATIO</b></td>
                        <td></td>
                        <td></td>
                        <td>{{ number_format($base->totalpatio) }}</td>
                      </tr>

                @endforeach

                    </tbody>
                </table>
 <h4 style="text-align: center;">GRAN TOTAL</h4>

 <table>
                    <thead>
                      <tr>
                        <th>Tipo Concepto</th>
                        <th>Cantidad</th>
                        <th>Tipo valor</th>
                        <th>Valor total</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($datos['base'] as $base)
              
                      <tr>
                        <td>PATIO</td>
                        <td></td>
                        <td></td>
                        <td>{{ number_format($base->valor_ventas_servicios) }}</td>
                      </tr>

                      <tr>
                        <td>BASE</td>
                        <td></td>
                        <td></td>
                        <td>{{ number_format($base->valor_inicia) }}</td>
                      </tr>  
                        <tr>
                        <td>CAFETERIA</td>
                        <td></td>
                        <td></td>
                        <td>{{ number_format($base->valor_ventas_cafeteria) }}</td>
                      </tr> 

                    <tr>
                        <td><b>Total</b></td>
                        <td></td>
                        <td></td>
                        <td>{{ number_format($base->valor_ventas_servicios+$base->valor_inicia+$base->valor_ventas_cafeteria) }}</td>
                      </tr>

               @endforeach

                    </tbody>
                </table>

                 <h4 style="text-align: center;">ENTRADAS</h4>
<table>
                    <thead>
                      <tr>
                        <th>Tipo Concepto</th>
                        <th>Cantidad</th>
                        <th>Tipo valor</th>
                        <th>Valor total</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($datos['entradas'] as $cd)
                      <tr>
                        <td>{{ $cd->descconcepto }}</td>
                        <td>{{ $cd->cantidad }}</td>
                        <td></td>
                        <td>{{ number_format($cd->valor) }}</td>
                      </tr>
                    @endforeach


                  @foreach ($datos['base'] as $base)

                    <tr>
                        <td><b>Total Entradas</b></td>
                        <td></td>
                        <td></td>
                        <td>{{ number_format($base->valor_entrada_remisiones) }}</td>
                      </tr>

                @endforeach

                    </tbody>
                </table>

                 <h4 style="text-align: center;">SALIDAS</h4>
<table>
                    <thead>
                      <tr>
                        <th>Tipo Concepto</th>
                        <th>Cantidad</th>
                        <th>Tipo valor</th>
                        <th>Valor total</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($datos['salidas'] as $cd)
                      <tr>
                        <td>{{ $cd->descconcepto }}</td>
                        <td>{{ $cd->cantidad }}</td>
                        <td></td>
                        <td>{{ number_format($cd->valor) }}</td>
                      </tr>
                    @endforeach


                  @foreach ($datos['base'] as $base)

                    <tr>
                        <td><b>Total Entradas</b></td>
                        <td></td>
                        <td></td>
                        <td>{{ number_format($base->valor_salidas_remisiones) }}</td>
                      </tr>

                @endforeach

                    </tbody>
                </table>


                <h4 style="text-align: center;">EN CAJA</h4>

 <table>
                    <thead>
                      <tr>
                        <th>Tipo Concepto</th>
                        <th>Cantidad</th>
                        <th>Tipo valor</th>
                        <th>Valor total</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($datos['base'] as $base)
              
                      <tr>
                        <td>Gran total</td>
                        <td></td>
                        <td></td>
                        <td>{{ number_format($base->valor_ventas_servicios+$base->valor_inicia+$base->valor_ventas_cafeteria) }}</td>
                      </tr>

                      <tr>
                        <td>Entradas</td>
                        <td></td>
                        <td></td>
                        <td>{{ number_format($base->valor_entrada_remisiones) }}</td>
                      </tr>  
                        <tr>
                        <td>Salidas</td>
                        <td></td>
                        <td></td>
                        <td> - {{ number_format($base->valor_salidas_remisiones) }}</td>
                      </tr> 

                    <tr>
                        <td><b>Total</b></td>
                        <td></td>
                        <td></td>
                        <td>{{ number_format($base->valor_cierre) }}</td>
                      </tr>

               @endforeach

                    </tbody>
                </table>

              </div>
            
                
                

            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

