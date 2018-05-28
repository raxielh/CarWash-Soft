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
</style>
    <section class="content-header">
        <h1 class="pull-left">Reporte de ingreso y egreso</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body" style="padding: 3em">
              <div class="row">
              <form action="/reportes2/adminlavadores/">
                <div class="col-sm-2">
                  <input type="date" value="{{$datos['fecha']}}" class="form-control" name="fecha">
                </div>
                <div class="col-sm-10">
                   <button type="submit" class="btn btn-warning">Generar Reporte</button>
                </div>
              </form>
              </div>
              <div class="row">

                <h4 style="background-color:#1d79fa;color: #333"><strong>Fecha:</strong> {{$datos['fecha']}}</h4>

                @foreach ($datos['base'] as $base)
                    <h4 style="background-color: #333;color: red;margin-top: 0px"><strong>Base:</strong> {{ $base->valor_inicia }}</h4>
                @endforeach

                <h4 style="text-align: center;background-color: yellow">Patio</h4>
                <table>
                    <thead>
                      <tr>
                        <th>Lavador</th>
                        <th>Descripción</th>
                        <th>Comisión</th>
                        <th>Cantidad</th>
                        <th>Valor</th>
                        <th>Valor Comi</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($datos['adminlava'] as $cd)
                      <tr>
                        <td>{{ $cd->apellido." ".$cd->nombre }}</td>
                        <td>{{ $cd->descripcion }}</td>
                        <td>{{ $cd->comision }}</td>
                        <td>{{ $cd->cantidad }}</td>
                        <td>{{ $cd->valor }}</td>
                        <td>{{ $cd->valor_comi }}</td>
                      </tr>
                    @endforeach
 

                    </tbody>
                </table>
               <h4 style="text-align: center;background-color: yellow">CAFETERIA</h4>


              </div>
            
                
                

            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

