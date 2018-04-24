<form method="GET" action="comandas_h" accept-charset="UTF-8" class="navbar-form pull-right" role="search">
    <div class="form-group">

        <input type="date" name="fi" class="form-control" placeholder="Fecha Inicial..." value="<?php 
            if(isset($_GET['fi'])){
                echo $_GET['fi'];
            }else{
                echo date('Y-m-d');
            }?>">
        <input type="date" name="ff" class="form-control" placeholder="Fecha Final..." value="<?php 
            if(isset($_GET['fi'])){
                echo $_GET['fi'];
            }else{
                echo date('Y-m-d');
            }?>">

        <input type="text" name="campo" class="form-control" autofocus="" placeholder="Buscar por placa..." value="{{ @$_GET['campo'] }}">

        <select name="estado" class="form-control">
            <option value="">Todos</option>
            <option value="1">Activa</option>
            <option value="2">Inactiva</option>
            <option value="3">Facturada</option>
        </select>

    </div>
    <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-filter"></i> Filtrar</button>
    <a href="/comandas_h" class="btn btn-warning btn-xl"><i class="glyphicon glyphicon-tasks"></i> Todos</a>
    <a href="/comandas" class="btn btn-info btn-xl"><i class="glyphicon glyphicon-circle-arrow-left"></i> Atras</a>
</form>

<table class="table1 table-responsive table-striped" style="width:100%" id="comandas-table" style="width:100%">
    <thead>
        <tr>
            <th>Cliente</th>
        <th>Placa</th>        
        <th>Observacion</th>
        <th>Estado</th>
        <th>Creado Por</th>
        <th>Fecha</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($comandas as $comanda)
        <tr>
            <td>{!! $comanda->nom !!}</td>
            <td>{!! $comanda->placa !!}</td>
            <td>{!! $comanda->observacion !!}</td>
            <td>{!! $comanda->estadodesc !!}</td> 
            <td>{!! $comanda->name !!}</td>
            <td>{!! $comanda->fecha !!}</td>       
            <td>

                <div class='btn-group'>
                    <a href="{!! url('comandas_h_s', [$comanda->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-eye-open"></i></a>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{$comandas->render()}}