<table class="table table-responsive" id="comandas-table">
    <thead>
        <tr>
            <th>Persona Id</th>
        <th>Vehiculo Id</th>
        <th>Estado Id</th>
        <th>Observacion</th>
        <th>Creado Por</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($comandas as $comanda)
        <tr>
            <td>{!! $comanda->persona_id !!}</td>
            <td>{!! $comanda->vehiculo_id !!}</td>
            <td>{!! $comanda->estado_id !!}</td>
            <td>{!! $comanda->observacion !!}</td>
            <td>{!! $comanda->name !!}</td>
            <td>
                {!! Form::open(['route' => ['comandas.destroy', $comanda->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('comandas.show', [$comanda->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('comandas.edit', [$comanda->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xl', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>