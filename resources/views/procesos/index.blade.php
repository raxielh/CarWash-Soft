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
                <div class="col-sm-4">
                    <div class="card" style="width:100%;padding: 6em">
                      <img class="card-img-top" width="100%" src="{{URL::asset('img/bt01.jpg')}}" alt="Card image cap">
                      <div class="card-body">
                        <h5 class="card-title">Calcular Comision Administrativos</h5>
                        <form action="{!! route('procesos_admin') !!}">
                          <input type="date" name="fecha" value="<?php echo date('Y-m-d'); ?>">
                          <input type="submit" value="Calcular" class="btn btn-primary">
                        </form>
                      </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card" style="width: 100%;padding: 6em">
                      <img class="card-img-top"  width="100%" src="{{URL::asset('img/bt02.jpg')}}" alt="Card image cap">
                      <div class="card-body">
                        <h5 class="card-title">Calcular Comision Lavaderos</h5>
                        <form action="/procesos/lavadero/">
                          <input type="date" name="fecha" value="<?php echo date('Y-m-d'); ?>">
                          <input type="submit" value="Calcular" class="btn btn-primary">
                        </form>
                      </div>
                    </div>                    
                </div>
                <div class="col-sm-4">
                    <div class="card" style="width: 100%;padding: 6em">
                      <img class="card-img-top"  width="100%" src="{{URL::asset('img/bt03.jpg')}}" alt="Card image cap">
                      <div class="card-body">
                        <h5 class="card-title">Cerrar Dia</h5>
                        <form action="/procesos/cargar/">
                          <input type="date" name="fecha" value="<?php echo date('Y-m-d'); ?>">
                          <input type="submit" value="Cerrar" class="btn btn-primary">
                        </form>
                      </div>
                    </div>                    
                </div>    
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

