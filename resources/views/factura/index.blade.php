@extends('layouts.app')

@section('content')
<style>
    .col-md-8{
        padding: 2em;
    }
    .cantidad{
        display: none;
    }

    @media print {
        .main-sidebar,.btn,form,.dataTables_length,.dataTables_filter,.comandaDetalles-table_info,.dataTables_paginate,.dataTables_info,.main-footer,h4,#update,.quitar{
            display: none;
        }
        .box.box-primary{
            border-top-color:#fff;
        }
        .titulo{
            display: block;
        }
        .col-md-8{
            padding: 0px !important;
        }
        *{
            margin:2px !important;
            padding: 0px !important;
        }
        .form-group{
            text-align: center;
        }
    }
</style>
    <section class="content-header">
        <h1>
            Factura
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    <a href="javascript:history.back()" class="btn btn-default">Atras</a>
                </div>
                <div class="row">
                    <a href="#" class="btn btn-info pull-right" onclick="window.print();" style="margin-right: 30px;"><i class="fa fa-print"></i> Imprimir</a>
                </div>
                <div class="row" style="padding: 2em">

                    <div class="titulo">
                        
                        
<table width="100%" align="center" cellpadding="0" cellspacing="0">
  <col width="185" />
  <col width="95" />
  <col width="70" />
  <col width="78" />
  <tr height="35">
    <td colspan="6" height="35" width="428"><div align="center"><h3 style="text-align: center;"><span style="color: red">BRILLAN</span>COR</h3></div></td>
  </tr>
  <tr height="19">
    <td colspan="6" height="19"><div align="center"><h5 style="text-align: center;">CRA 2 # 45-775</h5></div></td>
  </tr>
  <tr height="19">
    <td colspan="6" height="19"><div align="center"><h5 style="text-align: center;">NIT: 1110473453-2</h5></div></td>
  </tr>
  <tr height="19">
    <td colspan="6" height="19">&nbsp;</td>
  </tr>
  <tr height="19">
    <td colspan="2" height="19"><strong>FECHA:  {!! $datos['factura'][0]->fecha !!} </strong></td>
    <td colspan="4"><strong>HORA: {!! $datos['factura'][0]->hora !!}</strong></td>
  </tr>
  <tr height="19">
    <td colspan="6" height="19"><strong># FACTURA: {!! $datos['factura'][0]->numero !!}</strong></td>
  </tr>
  <tr height="19">
    <td colspan="6" height="19">&nbsp;</td>
  </tr>
  <tr height="19">
    <td height="19"><strong>CLIENTE:</strong></td>
    <td colspan="5">{!! $datos['factura'][0]->nom !!} {!! $datos['factura'][0]->ape !!}</td>
  </tr>
  <tr height="19">
    <td height="19"><strong>CC/NIT:</strong></td>
    <td colspan="5">{!! $datos['factura'][0]->iden !!}</td>
  </tr>
  <tr height="19">
    <td height="19"><strong>TEL:</strong></td>
    <td colspan="5">{!! $datos['factura'][0]->nom !!} {!! $datos['factura'][0]->telefono1 !!}</td>
  </tr>
  <tr height="19">
    <td height="19"><strong>DIRECCION:</strong></td>
    <td colspan="5">{!! $datos['factura'][0]->nom !!} {!! $datos['factura'][0]->direccion !!}</td>
  </tr>
  <tr height="19">
    <td height="19"><strong>VEHICULO:</strong></td>
    <td colspan="5">{!! $datos['factura'][0]->placa !!}</td>
  </tr>
  <tr height="19">
    <td colspan="6" height="22">&nbsp;</td>
  </tr>
  <tr height="19">
    <td height="19"><div align="center"><strong>Servicio</strong></div></td>
    <td><div align="center"><strong>Valor U</strong></div></td>
    <td><div align="center"><strong>Cantidad</strong></div></td>
    <td><div align="center"><strong>Impuesto</strong></div></td>
    <td><div align="center"><strong>Descuento</strong></div></td>
    <td><div align="center"><strong>Total</strong></div></td>
  </tr>
<?php $t = 0; ?>
@foreach($datos['detalles'] as $comandaDetalle)
    <tr height="19">
        <td><div align="center">{!! $comandaDetalle->descripcion !!}</div></td>
        <td><div align="center">{!! $v=$comandaDetalle->valor !!}</div></td>
        <td><div align="center">{!! $c=$comandaDetalle->cantidad !!}</div></td>
        <td><div align="center">{!! $i=($v*$c*($comandaDetalle->impuesto/100)) !!}</div></td>
        <td><div align="center">{!! $d=($v*$c*($comandaDetalle->descuento/100)) !!}</div></td>
        <td><div align="center">{!! number_format($x=(($v*$c)+$i)-$d) !!}</div></td>
        <div style="display: none;">{{$t=$t+$x}}</div>
    </tr>
@endforeach
  <tr height="19">
    <td>&nbsp;</td><td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><strong>TOTAL</strong></td>
    <td align="center"><strong>{{$t}}</strong></td>
  </tr>
  <tr height="19">
    <td height="19"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr height="61">
    <td colspan="6" height="61" width="428" style="font-size:10px">A LA PRESENTE FACTURA SE LE APLICARAN LAS NORMAS RELATIVAS A LA    LETRA DE CAMBIO (ARTS 772 S.S. Y 779 DEL CODIGO DE COMERCIO) ART 617 DEL ESTATUTO TRIBUTARIO; MODIF LEY 1231/2008.</td>
  </tr>
</table>

            









                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
