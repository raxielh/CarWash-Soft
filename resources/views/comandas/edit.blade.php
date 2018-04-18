@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Comanda
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($comanda, ['route' => ['comandas.update', $comanda->id], 'method' => 'patch']) !!}

                        @include('comandas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection