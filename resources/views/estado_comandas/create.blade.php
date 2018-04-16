@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Estado Comanda
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'estadoComandas.store']) !!}

                        @include('estado_comandas.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
