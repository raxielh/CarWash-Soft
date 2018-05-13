{!! Form::open(['route'=>'comandas.index','method'=>'GET','class'=>'navbar-form pull-right','role'=>'search']) !!}
    <div class="form-group">

        <input type="text" name="campo" class="form-control" autofocus placeholder="Buscar por placa..." value="{{ @$_GET['campo'] }}" autofocus="">

        <select name="estado" class="form-control">
            <option value="">Todos</option>
          <option value="1">Activa</option>
          <option value="2">Inactiva</option>
          <option value="3">Facturada</option>
        </select>

    </div>
    <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-filter"></i> Filtrar</button>
    <a href="/comandas" class="btn btn-warning btn-xl"><i class="glyphicon glyphicon-tasks"></i> Todos Hoy</a>
    <a href="/comandas_h" class='btn btn-info btn-xl'><i class="glyphicon glyphicon-book"></i> Historial</a>
{!! Form::close() !!}

<table class="table1 table-responsive table-striped" style="width:100%" id="comandas-table" style="width:100%">
    <thead>
        <tr>
            <th>Cliente</th>
        <th>Placa</th>        
        <th>Observacion</th>
        <th>Estado</th>
        <th>Creado Por</th>
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
                       
            <td>
                {!! Form::open(['route' => ['comandas.destroy', $comanda->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('comandas.show', [$comanda->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-eye-open"></i></a>

                    <a href="{!! route('comandas.edit', [$comanda->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-edit"></i></a>

                    <a href="{!! route('facturar', [$comanda->id]) !!}" onclick="return confirm('Estas seguro de generar esta factura?')" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-shopping-cart"></i></a>


                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xl', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{$comandas->render()}}