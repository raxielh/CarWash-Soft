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
        <h1 class="pull-left">Salidas y entradas</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body" style="padding: 3em">
              <div class="row">
              <form action="/reportes3/salidaentrada/">
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


                <h4 style="text-align: center;background-color: yellow">Lavadores</h4>
                

                    @foreach ($datos['adminlava'] as $cd)
 
                     @if($cd->secu === '1')
                     <table>
                        <tr>
                         <td colspan="5" ><p align="center"><b>{{ $cd->apellido." ".$cd->nombre }}</b></p></td>
                        </tr>
                        <tr>
                        <th><b>Descripción</b></th>
                        <th><b>Comisión</b></th>
                        <th><b>Cantidad</b></th>
                        <th><b>Valor</b></th>
                        <th><b>Valor Comi</b></th>
                      </tr>
                     @endif

                      @if($cd->orden === 2)
                         <tr>
                        <td colspan="4">{{ $cd->descripcion }}</td>                      
                        <td><b>{{ $cd->valor_comi }}</b></td>
                      </tr>                        
                       </table>
                       <br>
                      @else
                      <tr>
                        <td>{{ $cd->descripcion }}</td>
                        <td>{{ $cd->comision }}</td>
                        <td>{{ $cd->cantidad }}</td>
                        <td>{{ $cd->valor }}</td>
                        <td> {{ $cd->valor_comi }}</td>
                      </tr>
                          
                      @endif

                    @endforeach


<h4 style="text-align: center;background-color: yellow">Administradores</h4>


 <table>
                    <thead>
                      <tr>
                        <th>Nombres</th>
                        <th>Comisión</th>
                        <th>Total Ventas</th>
                        <th>Valor Comi</th>
                        <th>Fecha Actualización</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($datos['admin'] as $cd)
                      <tr>
                        <td>{{ $cd->apellido." ".$cd->nombre }}</td>
                        <td>{{ $cd->comision }}</td>
                        <td>{{ $cd->valorventasdia }}</td>
                        <td>{{ $cd->valorcomi }}</td>
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

