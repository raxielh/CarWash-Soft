@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Lavado
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($lavado, ['route' => ['lavados.update', $lavado->id], 'method' => 'patch']) !!}

                        @include('lavados.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection