@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Linea
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($linea, ['route' => ['lineas.update', $linea->id], 'method' => 'patch']) !!}

                        @include('lineas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection