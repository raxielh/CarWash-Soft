@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Proveedores
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($proveedores, ['route' => ['proveedores.update', $proveedores->id], 'method' => 'patch']) !!}

                        @include('proveedores.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection