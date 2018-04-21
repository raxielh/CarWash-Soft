<table class="table table-responsive table-striped" style="width:100%" id="comandaDetalles-table">
    <thead>
        <tr>
            <th>Comanda Id</th>
        <th>Concepto Id</th>
        <th>Descuentos Id</th>
        <th>Valor</th>
        <th>Users Id</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($comandaDetalles as $comandaDetalle)
        <tr>
            <td>{!! $comandaDetalle->comanda_id !!}</td>
            <td>{!! $comandaDetalle->concepto_id !!}</td>
            <td>{!! $comandaDetalle->descuentos_id !!}</td>
            <td>{!! $comandaDetalle->valor !!}</td>
            <td>{!! $comandaDetalle->users_id !!}</td>
            <td>
                {!! Form::open(['route' => ['comandaDetalles.destroy', $comandaDetalle->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('comandaDetalles.show', [$comandaDetalle->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('comandaDetalles.edit', [$comandaDetalle->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xl', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>