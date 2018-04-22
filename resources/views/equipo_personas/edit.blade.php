@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Equipo Personas
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($datos['equipoPersonas'], ['route' => ['equipoPersonas.update', $datos['equipoPersonas']->id], 'method' => 'patch']) !!}

                        @include('equipo_personas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection