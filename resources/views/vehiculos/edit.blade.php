@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Vehiculos
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($datos['vehiculos'], ['route' => ['vehiculos.update', $datos['vehiculos']->id], 'method' => 'patch']) !!}

                        @include('vehiculos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection