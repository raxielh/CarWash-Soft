<table class="table table-responsive table-striped" id="estadoComandas-table">
    <thead>
        <tr>
            <th>Descripcion</th>
        <th>Crado Por</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($estadoComandas as $estadoComanda)
        <tr>
            <td>{!! $estadoComanda->descripcion !!}</td>
            <td>{!! $estadoComanda->name !!}</td>
            <td>
                {!! Form::open(['route' => ['estadoComandas.destroy', $estadoComanda->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('estadoComandas.show', [$estadoComanda->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('estadoComandas.edit', [$estadoComanda->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xl', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>