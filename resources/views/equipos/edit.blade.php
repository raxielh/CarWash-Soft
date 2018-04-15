@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Equipos
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($equipos, ['route' => ['equipos.update', $equipos->id], 'method' => 'patch']) !!}

                        @include('equipos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection