@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Estado Factura
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($estadoFactura, ['route' => ['estadoFacturas.update', $estadoFactura->id], 'method' => 'patch']) !!}

                        @include('estado_facturas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection