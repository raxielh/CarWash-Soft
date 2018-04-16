@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Descuento
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($descuento, ['route' => ['descuentos.update', $descuento->id], 'method' => 'patch']) !!}

                        @include('descuentos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection