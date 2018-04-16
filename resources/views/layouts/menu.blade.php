@if (obtenerRol() === 'Super Root')
<li class="{{ Request::is('roles*') ? 'active' : '' }}">
    <a href="{!! route('roles.index') !!}"><i class="fa fa-edit"></i><span>Roles</span></a>
</li>
@endif

<li class="{{ Request::is('permisos*') ? 'active' : '' }}">
    <a href="{!! route('permisos.index') !!}"><i class="fa fa-edit"></i><span>Permisos</span></a>
</li>

<li class="{{ Request::is('usuarios*') ? 'active' : '' }}">
    <a href="{!! route('usuarios.index') !!}"><i class="fa fa-edit"></i><span>Usuarios</span></a>
</li>

<li class="{{ Request::is('usuariosRols*') ? 'active' : '' }}">
    <a href="{!! route('usuariosRols.index') !!}"><i class="fa fa-edit"></i><span>Usuarios Roles</span></a>
</li>

<li class="{{ Request::is('estados*') ? 'active' : '' }}">
    <a href="{!! route('estados.index') !!}"><i class="fa fa-edit"></i><span>Estados</span></a>
</li>

<li class="{{ Request::is('tipoConceptos*') ? 'active' : '' }}">
    <a href="{!! route('tipoConceptos.index') !!}"><i class="fa fa-edit"></i><span>Tipo Conceptos</span></a>
</li>

<li class="{{ Request::is('conceptos*') ? 'active' : '' }}">
    <a href="{!! route('conceptos.index') !!}"><i class="fa fa-edit"></i><span>Conceptos</span></a>
</li>

<li class="{{ Request::is('valoresConceptos*') ? 'active' : '' }}">
    <a href="{!! route('valoresConceptos.index') !!}"><i class="fa fa-edit"></i><span>Valores Conceptos</span></a>
</li>

<li class="{{ Request::is('combos*') ? 'active' : '' }}">
    <a href="{!! route('combos.index') !!}"><i class="fa fa-edit"></i><span>Combos</span></a>
</li>

<li class="{{ Request::is('tipoIdentificacions*') ? 'active' : '' }}">
    <a href="{!! route('tipoIdentificacions.index') !!}"><i class="fa fa-edit"></i><span>Tipo Identificacions</span></a>
</li>

<li class="{{ Request::is('personas*') ? 'active' : '' }}">
    <a href="{!! route('personas.index') !!}"><i class="fa fa-edit"></i><span>Personas</span></a>
</li>

<li class="{{ Request::is('vehiculos*') ? 'active' : '' }}">
    <a href="{!! route('vehiculos.index') !!}"><i class="fa fa-edit"></i><span>Vehiculos</span></a>
</li>
<li class="{{ Request::is('galeriaVehiculos*') ? 'active' : '' }}">
    <a href="{!! route('galeriaVehiculos.index') !!}"><i class="fa fa-edit"></i><span>Galeria Vehiculos</span></a>
</li>

<li class="{{ Request::is('equipos*') ? 'active' : '' }}">
    <a href="{!! route('equipos.index') !!}"><i class="fa fa-edit"></i><span>Equipos</span></a>
</li>

<li class="{{ Request::is('estadoFacturas*') ? 'active' : '' }}">
    <a href="{!! route('estadoFacturas.index') !!}"><i class="fa fa-edit"></i><span>Estado Facturas</span></a>
</li>

<li class="{{ Request::is('estadoComandas*') ? 'active' : '' }}">
    <a href="{!! route('estadoComandas.index') !!}"><i class="fa fa-edit"></i><span>Estado Comandas</span></a>
</li>

<li class="{{ Request::is('descuentos*') ? 'active' : '' }}">
    <a href="{!! route('descuentos.index') !!}"><i class="fa fa-edit"></i><span>Descuentos</span></a>
</li>

