<table class="table table-responsive table-striped" id="proveedores-table">
    <thead>
        <tr>
            <th>Codigo</th>
        <th>Persona Id</th>
        <th>Razon Social</th>
        <th>Nit</th>
        <th>Direccion</th>
        <th>Telefono2</th>
        <th>Telefono1</th>
        <th>Creado Por</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($proveedores as $proveedores)
        <tr>
            <td>{!! $proveedores->codigo !!}</td>
            <td>{!! $proveedores->persona_id !!}</td>
            <td>{!! $proveedores->razon_social !!}</td>
            <td>{!! $proveedores->nit !!}</td>
            <td>{!! $proveedores->direccion !!}</td>
            <td>{!! $proveedores->telefono2 !!}</td>
            <td>{!! $proveedores->telefono1 !!}</td>
            <td>{!! $proveedores->name !!}</td>
            <td>
                {!! Form::open(['route' => ['proveedores.destroy', $proveedores->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('proveedores.show', [$proveedores->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('proveedores.edit', [$proveedores->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xl', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>