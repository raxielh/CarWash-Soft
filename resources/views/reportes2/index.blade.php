@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Reporte Lavadores y Administradores</h1><br>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body" style="padding: 3em">
              <div class="row">
              <form action="/reportes2/adminlavadores/">
                <div class="col-sm-2">
                  <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" name="fecha">
                </div>
                <div class="col-sm-10">
                   <button type="submit" class="btn btn-warning">Generar Reporte</button>
                </div>
              </form>
              </div>
              <div class="row">
              </div>
            
                
                

            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

