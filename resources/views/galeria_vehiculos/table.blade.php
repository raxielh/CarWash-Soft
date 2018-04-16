<table class="table table-responsive table-striped" id="galeriaVehiculos-table">
    <thead>
        <tr>
            <th>Vehiculo</th>
        <th>Foto</th>
        <th>Creado por</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($galeriaVehiculos as $galeriaVehiculos)
        <tr>
            <td>{!! $galeriaVehiculos->placa !!}</td>
            <td><center><img width="150px" src="{{ Storage::url($galeriaVehiculos->foto) }}"></center></td>
            <td>{!! $galeriaVehiculos->name !!}</td>
            <td>
                {!! Form::open(['route' => ['galeriaVehiculos.destroy', $galeriaVehiculos->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('galeriaVehiculos.show', [$galeriaVehiculos->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('galeriaVehiculos.edit', [$galeriaVehiculos->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xl', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>