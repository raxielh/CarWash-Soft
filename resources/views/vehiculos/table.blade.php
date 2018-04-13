<table class="table table-responsive" id="vehiculos-table">
    <thead>
        <tr>
            <th>Persona Id</th>
        <th>Placa</th>
        <th>Modelo</th>
        <th>Color</th>
        <th>Users Id</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($vehiculos as $vehiculos)
        <tr>
            <td>{!! $vehiculos->persona_id !!}</td>
            <td>{!! $vehiculos->placa !!}</td>
            <td>{!! $vehiculos->modelo !!}</td>
            <td>{!! $vehiculos->color !!}</td>
            <td>{!! $vehiculos->users_id !!}</td>
            <td>
                {!! Form::open(['route' => ['vehiculos.destroy', $vehiculos->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('vehiculos.show', [$vehiculos->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('vehiculos.edit', [$vehiculos->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xl', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>