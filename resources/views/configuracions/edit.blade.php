@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Configuracion
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($datos['configuracion'], ['route' => ['configuracions.update', $datos['configuracion']->id], 'method' => 'patch']) !!}

                        @include('configuracions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection