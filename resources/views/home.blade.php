@extends('layouts.app')

@section('content')
<style>
.box.box-primary {
    opacity: 0.9;
    border-top-width: 11px;
}

.b1 {
    border-top-color: #ff0053 !important;
}
.b2 {
    border-top-color: #10d16f !important;
}
.b3 {
    border-top-color: #fff700 !important;
}
.b4 {
    border-top-color: #ff0000 !important;
}
.b5 {
    border-top-color: #7029cf !important;
}
</style>
<div style="background: url({{URL::asset('img/bg.jpg')}}) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  height: 100%  !important;">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <div class="row" style="padding: 1em">
    	<div class="col-md-12">
			<div class="box box-primary b1">
			    <div class="box-body">
    				<div id="basegancia" style="height: 350px"></div>	
				    <script type="text/javascript">
						 google.charts.load('current', {'packages':['line']});
						google.charts.setOnLoadCallback(drawBasic);

						function drawBasic() {

						      var data = new google.visualization.DataTable();
						      data.addColumn('string', 'Fecha');
						      data.addColumn('number', 'Valor Inicio');
						      data.addColumn('number', 'Valor Cierre');
						      data.addRows([
								<?php 
									foreach ($basegancia as $valor) {
										echo "['".$valor->fecha."',".$valor->valor_inicia.",".$valor->valor_cierre."],";
									}
								?>
						      ]);

						      var options = {
						        chart: {
						          title: 'Grafico Valor de Cierre e Inicio de Dia',
						        },
						        chartArea:{left:0,top:0,width:"100%",height:"100%"},

						      };

						      var chart = new google.charts.Line(document.getElementById('basegancia'));


						      chart.draw(data, options);
						    }
				    </script>		    
			    </div>
		    </div>
    	</div>
    	<div class="col-md-6">
			<div class="box box-primary b2">
			    <div class="box-body">
    				<div id="basegancia1" style="height: 300px"></div>	
				    <script type="text/javascript">
						 google.charts.load('current', {'packages':['line']});
						google.charts.setOnLoadCallback(drawBasic);

						function drawBasic() {

						      var data = new google.visualization.DataTable();
						      data.addColumn('string', 'Fecha');
						      data.addColumn('number', 'Cafeteria');
						      data.addColumn('number', 'Servicio');
						      data.addRows([
								<?php 
									foreach ($basegancia as $valor) {
										echo "['".$valor->fecha."',".$valor->valor_ventas_cafeteria.",".$valor->valor_ventas_servicios."],";
									}
								?>
						      ]);

						      var options = {
						        chart: {
						          title: 'Grafico de Ventas y Servicios',
						        },
						        chartArea:{left:0,top:0,width:"100%",height:"100%"},

						      };

						      var chart = new google.charts.Line(document.getElementById('basegancia1'));


						      chart.draw(data, options);
						    }
				    </script>		    
			    </div>
		    </div>
    	</div>
    	<div class="col-md-6">
			<div class="box box-primary b3">
			    <div class="box-body">
    				<div id="basegancia2" style="height: 300px"></div>	
				    <script type="text/javascript">
						 google.charts.load('current', {'packages':['line']});
						google.charts.setOnLoadCallback(drawBasic);

						function drawBasic() {

						      var data = new google.visualization.DataTable();
						      data.addColumn('string', 'Fecha');
						      data.addColumn('number', 'Salida');
						      data.addColumn('number', 'Entrada');
						      data.addRows([
								<?php 
									foreach ($basegancia as $valor) {
										echo "['".$valor->fecha."',".$valor->valor_salidas_remisiones.",".$valor->valor_entrada_remisiones."],";
									}
								?>
						      ]);

						      var options = {
						        chart: {
						          title: 'Grafico de Valores de Entrada y Salida',
						        },
						        chartArea:{left:0,top:0,width:"100%",height:"100%"},

						      };

						      var chart = new google.charts.Line(document.getElementById('basegancia2'));


						      chart.draw(data, options);
						    }
				    </script>		    
			    </div>
		    </div>
    	</div>
    	<div class="col-md-6">
			<div class="box box-primary b4">
			    <div class="box-body">
    				<div id="cantidad_servicios" style="height: 300px"></div>	
				    <script type="text/javascript">
				      google.charts.load('current', {'packages':['line']});
				      google.charts.setOnLoadCallback(drawChart);

				    function drawChart() {

				      var data = new google.visualization.DataTable();
				      data.addColumn('string', 'Meses');
				      data.addColumn('number', 'Cantidad');

				      data.addRows([
				        <?php 
							foreach ($servicios as $valor) {
								if($valor->fecha=='01'){$f='Enero';}
								if($valor->fecha=='02'){$f='Febrero';}
								if($valor->fecha=='03'){$f='Marzo';}
								if($valor->fecha=='04'){$f='Abril';}
								if($valor->fecha=='05'){$f='Mayo';}
								if($valor->fecha=='06'){$f='Junio';}
								if($valor->fecha=='07'){$f='Julio';}
								if($valor->fecha=='08'){$f='Agosto';}
								if($valor->fecha=='09'){$f='Septiembre';}
								if($valor->fecha=='10'){$f='Octubre';}
								if($valor->fecha=='11'){$f='Noviembre';}
								if($valor->fecha=='12'){$f='Diciembre';}
								echo "[' ".$f."',  ".$valor->cantidad."],";
							}
						?>
				      ]);

				      var options = {
				        chart: {
				          title: 'Grafico Cantidad de Servicios Por Mes',
				        },
				        chartArea:{left:0,top:0,width:"100%",height:"100%"},

				      };

				      var chart = new google.charts.Line(document.getElementById('cantidad_servicios'));

				      chart.draw(data, google.charts.Line.convertOptions(options));
				    }
				    </script>		    
			    </div>
		    </div>
    	</div>
    	<div class="col-md-6">
			<div class="box box-primary b5">
			    <div class="box-body">
    				<div id="nuevos_clientes" style="height: 300px"></div>	
				    <script type="text/javascript">
				      google.charts.load('current', {'packages':['line']});
				      google.charts.setOnLoadCallback(drawChart);

				    function drawChart() {

				      var data = new google.visualization.DataTable();
				      data.addColumn('string', 'Meses');
				      data.addColumn('number', 'Cantidad');

				      data.addRows([
				        <?php 
							foreach ($nuevos as $valor) {
								if($valor->fecha=='01'){$f='Enero';}
								if($valor->fecha=='02'){$f='Febrero';}
								if($valor->fecha=='03'){$f='Marzo';}
								if($valor->fecha=='04'){$f='Abril';}
								if($valor->fecha=='05'){$f='Mayo';}
								if($valor->fecha=='06'){$f='Junio';}
								if($valor->fecha=='07'){$f='Julio';}
								if($valor->fecha=='08'){$f='Agosto';}
								if($valor->fecha=='09'){$f='Septiembre';}
								if($valor->fecha=='10'){$f='Octubre';}
								if($valor->fecha=='11'){$f='Noviembre';}
								if($valor->fecha=='12'){$f='Diciembre';}
								echo "[' ".$f."',  ".$valor->cantidad."],";
							}
						?>
				      ]);

				      var options = {
				        chart: {
				          title: 'Grafico de Nuevos Clientes',
				        },
				        chartArea:{left:0,top:0,width:"100%",height:"100%"},

				      };

				      var chart = new google.charts.Line(document.getElementById('nuevos_clientes'));

				      chart.draw(data, google.charts.Line.convertOptions(options));
				    }
				    </script>		    
			    </div>
		    </div>
    	</div>
    </div>
    
  </div>
@endsection
