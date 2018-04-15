<table class="table table-responsive" id="vehiculos-table">
    <thead>
        <tr>
            <th>Propietario</th>
             <th>Identificacion</th>
        <th>Placa</th>
        <th>Modelo</th>
        <th>Color</th>
        <th>Creado por</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($vehiculos as $vehiculos)
        <tr>
            <td>{!! $vehiculos->nom !!} {!! $vehiculos->ape !!}</td>
            <td>{!! $vehiculos->iden !!} </td>
            <td>{!! $vehiculos->placa !!}</td>
            <td>{!! $vehiculos->modelo !!}</td>
            <td><div style="background-color:{!! $vehiculos->color !!};width: 100%;height: 15px"></div></td>
            <td>{!! $vehiculos->name !!}</td>
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