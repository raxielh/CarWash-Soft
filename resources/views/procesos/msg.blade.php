@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Procesos</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body" style="padding: 3em">
                <h2>{{ ($dato[0]->salida) }}</h2>   
                <a href="javascript:history.back()" class="btn btn-info"><i class="glyphicon glyphicon-arrow-left"></i> Atras</a>
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

