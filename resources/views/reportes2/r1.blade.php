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
        <h1 class="pull-left">Reporte Lavadores y Administradores</h1><br>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body" style="padding: 3em">
              <div class="row">
              <form action="/reportes2/adminlavadores/" id="frm">
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


                <h4 style="text-align: center;">Lavadores</h4>
                

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
                        <td><b>{{ number_format($cd->valor_comi) }}</b></td>
                      </tr>                        
                       </table>
                       <br>
                      @else
                      <tr>
                        <td>{{ $cd->descripcion }}</td>
                        <td>{{ $cd->comision }}</td>
                        <td>{{ $cd->cantidad }}</td>
                        <td>{{ number_format($cd->valor) }}</td>
                        <td> {{ number_format($cd->valor_comi) }}</td>
                      </tr>
                          
                      @endif

                    @endforeach



<h4 style="text-align: center;">Administradores</h4>


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
                        <td>{{ number_format($cd->comision) }}</td>
                        <td>{{ number_format($cd->valorventasdia) }}</td>
                        <td>{{ number_format($cd->valorcomi) }}</td>
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

