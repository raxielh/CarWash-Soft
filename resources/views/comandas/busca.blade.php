@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Buscar Concepto</h1>
    </section>
    <div class="content">

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    
                    <a href="/comandas/{{$id}}" class="btn btn-primary">Atras</a>
                    
                </div>

                <div class="row" style="padding: 2em">
                    @foreach ($l_conceptos as $c)
                    <div class="col-xs-4 col-sm-4 col-md-2" style="  background-image: url(https://mdn.mozillademos.org/files/8971/firefox_logo.png);background-size: 150px;background-repeat: no-repeat;background-position:center;">
                        <div class="card" style="height: 150px">
                            <div style="word-wrap: break-word;background-color: #333333b0;color: #fff;position: relative;text-align: center;padding:5px;font-size: 12px">{{ $c->descripcion }}
                                <a href="#" class="btn btn-success"><i class="fa fa-check"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                   
                </div>

            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

