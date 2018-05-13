@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Ganancia Administrivo
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('ganancia_administrivos.show_fields')
                    <a href="{!! route('gananciaAdministrivos.index') !!}" class="btn btn-default">Atras</a>
                </div>
            </div>
        </div>
    </div>
@endsection
