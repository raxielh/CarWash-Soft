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
        <h1 class="pull-left">Salidas y entradas</h1><br>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body" style="padding: 3em">
              <div class="row">
              <form action="/reportes3/salidaentrada/" id="frm">
                <div class="col-sm-2">
                  <input type="date" value="{{$datos['fecha']}}" class="form-control" name="fecha">
                </div>
                <div class="col-sm-10">
                   <button type="submit" class="btn btn-warning">Generar Reporte</button>
                </div>
              </form>
                              <div class="row" id="print">
                    <a href="#" class="btn btn-info pull-right" onclick="window.print();" style="margin-right: 30px;"><i class="fa fa-print"></i> Imprimir</a>
                </div>
              </div>
              <div class="row">

                <h4 style="color: #333"><strong>Fecha:</strong> {{$datos['fecha']}}</h4>


            
                



<h4 style="text-align: center;">Salidas</h4>


 <table>
                    <thead>
                      <tr>
                        <th>Concepto</th>
                        <th>Proveedor</th>
                        <th>T.Identifi</th>
                        <th>Identifi</th>
                        <th>Persona</th>
                        <th>Valor</th>
                        <th>Fecha</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($datos['salidas'] as $cd)
                      <tr>
                        <td>{{ $cd->descconcepto}}</td>
                        <td>{{ $cd->proveedor }}</td>
                        <td>{{ $cd->tipo_identificacion_id }}</td>
                        <td>{{ $cd->identificacion }}</td>                        
                        <td>{{ $cd->apellido." ".$cd->nombre }}</td>
                        
                        <td>{{ $cd->valor }}</td>
                        <td>{{ $cd->updated_at }}</td>          
                      </tr>
                    @endforeach


                    </tbody>
                </table>




<h4 style="text-align: center;">Entradas</h4>


 <table>
                    <thead>
                      <tr>
                        <th>Concepto</th>
                        <th>Proveedor</th>
                        <th>T.Identifi</th>
                        <th>Identifi</th>
                        <th>Persona</th>
                        <th>Valor</th>
                        <th>Fecha</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($datos['entradas'] as $cd)
                      <tr>
                        <td>{{ $cd->descconcepto}}</td>
                        <td>{{ $cd->proveedor }}</td>
                        <td>{{ $cd->tipo_identificacion_id }}</td>
                        <td>{{ $cd->identificacion }}</td>                        
                        <td>{{ $cd->apellido." ".$cd->nombre }}</td>
                        
                        <td>{{ $cd->valor }}</td>
                        <td>{{ $cd->updated_at }}</td>          
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

