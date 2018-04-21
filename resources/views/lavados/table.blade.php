<table class="table table-responsive table-striped" id="lavados-table" style="width:100%">
    <thead>
        <tr>
            <th>Comanda Id</th>
        <th>Equipo Id</th>
        <th>Users Id</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($lavados as $lavado)
        <tr>
            <td>{!! $lavado->comanda_id !!}</td>
            <td>{!! $lavado->equipo_id !!}</td>
            <td>{!! $lavado->users_id !!}</td>
            <td>
                {!! Form::open(['route' => ['lavados.destroy', $lavado->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('lavados.show', [$lavado->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('lavados.edit', [$lavado->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xl', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>