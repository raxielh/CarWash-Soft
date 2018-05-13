<li class="{{ Request::is('home*') ? 'active' : '' }}">
    <a href="/home"><i class="fa fa-home"></i><span> Inicio</span></a>
</li>
@if (obtenerRol() === 'Super Root')
<li>
    <a class="tree-toggle nav-header" style="cursor: pointer;"><i class="fa fa-gear"></i> <span>Administrador</span></a>
    <ul class="nav nav-list tree" style="display: none;background:rgb(55, 65, 69);width: 230px;">
        <li class="{{ Request::is('roles*') ? 'active' : '' }}">
            <a href="{!! route('roles.index') !!}"><i class="fa fa-gears"></i><span> Roles</span></a>
        </li>
        <li class="{{ Request::is('permisos*') ? 'active' : '' }}">
            <a href="{!! route('permisos.index') !!}"><i class="fa fa-gears"></i><span> Permisos</span></a>
        </li>
        <li class="{{ Request::is('tipoIdentificacions*') ? 'active' : '' }}">
            <a href="{!! route('tipoIdentificacions.index') !!}"><i class="fa fa-gears"></i><span> Tipo Identificacions</span></a>
        </li>
        <li class="{{ Request::is('estados*') ? 'active' : '' }}">
            <a href="{!! route('estados.index') !!}"><i class="fa fa-gears"></i><span> Estados</span></a>
        </li>
        <li class="{{ Request::is('estadoFacturas*') ? 'active' : '' }}">
            <a href="{!! route('estadoFacturas.index') !!}"><i class="fa fa-gears"></i><span> Estado Facturas</span></a>
        </li>

        <li class="{{ Request::is('estadoComandas*') ? 'active' : '' }}">
            <a href="{!! route('estadoComandas.index') !!}"><i class="fa fa-gears"></i><span> Estado Comandas</span></a>
        </li>

    </ul>
</li>
@endif

<li>
    <a class="tree-toggle nav-header" style="cursor: pointer;"><i class="fa fa-gear"></i> <span>Usuarios</span></a>
    <ul class="nav nav-list tree" style="display: none;background:rgb(55, 65, 69);width: 230px;">
        <li class="{{ Request::is('usuarios*') ? 'active' : '' }}">
            <a href="{!! route('usuarios.index') !!}"><i class="fa fa-gears"></i><span> Usuarios</span></a>
        </li>

        <li class="{{ Request::is('usuariosRols*') ? 'active' : '' }}">
            <a href="{!! route('usuariosRols.index') !!}"><i class="fa fa-gears"></i><span> Usuarios Roles</span></a>
        </li>
    </ul>
</li>



<li>
    <a class="tree-toggle nav-header" style="cursor: pointer;"><i class="fa fa-cubes"></i> <span>Parametros</span></a>
    <ul class="nav nav-list tree" style="display: none;background:rgb(55, 65, 69);width: 230px;">
        <li class="{{ Request::is('tipoConceptos*') ? 'active' : '' }}">
            <a href="{!! route('tipoConceptos.index') !!}"><i class="fa fa-edit"></i><span> Tipo Conceptos</span></a>
        </li>

        <li class="{{ Request::is('conceptos*') ? 'active' : '' }}">
            <a href="{!! route('conceptos.index') !!}"><i class="fa fa-edit"></i><span> Conceptos</span></a>
        </li>

        <li class="{{ Request::is('valoresConceptos*') ? 'active' : '' }}">
            <a href="{!! route('valoresConceptos.index') !!}"><i class="fa fa-edit"></i><span> Valores Conceptos</span></a>
        </li>

        <li class="{{ Request::is('equipos*') ? 'active' : '' }}">
            <a href="{!! route('equipos.index') !!}"><i class="fa fa-edit"></i><span> Equipos</span></a>
        </li>

        <li class="{{ Request::is('descuentos*') ? 'active' : '' }}">
            <a href="{!! route('descuentos.index') !!}"><i class="fa fa-edit"></i><span> Descuentos</span></a>
        </li>

    </ul>
</li>

<li class="{{ Request::is('personas*') ? 'active' : '' }}">
    <a href="{!! route('personas.index') !!}"><i class="fa fa-male"></i><span> Personas</span></a>
</li>

<li class="{{ Request::is('proveedores*') ? 'active' : '' }}">
    <a href="{!! route('proveedores.index') !!}"><i class="fa fa-shopping-cart"></i><span> Proveedores</span></a>
</li>

<li>
    <a class="tree-toggle nav-header" style="cursor: pointer;"><i class="fa fa-automobile"></i> <span>Vehiculos</span></a>
    <ul class="nav nav-list tree" style="display: none;background:rgb(55, 65, 69);width: 230px;">
        <li class="{{ Request::is('marcas*') ? 'active' : '' }}">
            <a href="{!! route('marcas.index') !!}"><i class="fa fa-gears"></i><span> Marcas</span></a>
        </li>

        <li class="{{ Request::is('lineas*') ? 'active' : '' }}">
            <a href="{!! route('lineas.index') !!}"><i class="fa fa-gears"></i><span> Lineas</span></a>
        </li>

        <li class="{{ Request::is('vehiculos*') ? 'active' : '' }}">
            <a href="{!! route('vehiculos.index') !!}"><i class="fa fa-edit"></i><span> Vehiculos</span></a>
        </li>
    </ul>
</li>


<li class="{{ Request::is('comandas*') ? 'active' : '' }}">
    <a href="{!! route('comandas.index') !!}"><i class="fa fa-shopping-bag"></i><span> Comandas</span></a>
</li>


<li class="{{ Request::is('remisions*') ? 'active' : '' }}">
    <a href="{!! route('remisions.index') !!}"><i class="fa fa-credit-card-alt"></i><span> Remision</span></a>
</li>


<li>
    <a class="tree-toggle nav-header" style="cursor: pointer;"><i class="fa fa-signal"></i> <span> Reportes</span></a>
    <ul class="nav nav-list tree" style="display: none;background:rgb(55, 65, 69);width: 230px;">
        <li>
            <a href="#"><i class="fa fa-edit"></i><span> Ventas</span></a>
        </li>
    </ul>
</li>



<!--

<li class="{{ Request::is('lavados*') ? 'active' : '' }}">
    <a href="{!! route('lavados.index') !!}"><i class="fa fa-edit"></i><span>Lavados</span></a>
</li>
<li class="{{ Request::is('galeriaVehiculos*') ? 'active' : '' }}">
    <a href="{!! route('galeriaVehiculos.index') !!}"><i class="fa fa-edit"></i><span> Galeria Vehiculos</span></a>
</li>
<li class="{{ Request::is('comandaDetalles*') ? 'active' : '' }}">
    <a href="{!! route('comandaDetalles.index') !!}"><i class="fa fa-edit"></i><span>Comanda Detalles</span></a>
</li>
<li class="{{ Request::is('combos*') ? 'active' : '' }}">
    <a href="{!! route('combos.index') !!}"><i class="fa fa-edit"></i><span>Combos</span></a>
</li>
<li class="{{ Request::is('equipoPersonas*') ? 'active' : '' }}">
    <a href="{!! route('equipoPersonas.index') !!}"><i class="fa fa-edit"></i><span>Equipo Personas</span></a>
</li>




-->


<li class="{{ Request::is('configuracions*') ? 'active' : '' }}">
    <a href="{!! route('configuracions.index') !!}"><i class="fa fa-edit"></i><span>Configuracions</span></a>
</li>

<li class="{{ Request::is('administrativos*') ? 'active' : '' }}">
    <a href="{!! route('administrativos.index') !!}"><i class="fa fa-edit"></i><span>Administrativos</span></a>
</li>

