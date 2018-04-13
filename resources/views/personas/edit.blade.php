@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Personas
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($datos['personas'], ['route' => ['personas.update', $datos['personas']->id], 'method' => 'patch']) !!}

                        @include('personas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection