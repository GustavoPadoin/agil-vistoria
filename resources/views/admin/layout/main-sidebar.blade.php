<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left info">
        <p style="font-size: 12px;">{{ Auth::user()->nome }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

	<div style="padding: 20px;"><img src="{{ asset('img/logo.png') }}" class="img-fluid" width="120"></div>

    <ul class="sidebar-menu" data-widget="tree">
      <li>
        <a href="{{ route('vistoria.index') }}">
          <i class="fa fa-fw fa-check-square-o"></i> <span>Vistorias</span>
        </a>
      </li>
      @if (Auth::user()->id == 1)
        <li>
          <a href="{{ route('servico.index') }}">
            <i class="fa fa-fw fa-cog"></i> <span>Serviços</span>
          </a>
        </li>
        <li>
          <a href="{{ route('cidade.index') }}">
            <i class="fa fa-fw fa-building"></i> <span>Cidades</span>
          </a>
        </li>
        <li>
          <a href="{{ route('marca.index') }}">
            <i class="fa fa-fw fa-cogs"></i> <span>Marcas</span>
          </a>
        </li>
        <li>
          <a href="{{ route('modelo.index') }}">
            <i class="fa fa-fw fa-car"></i> <span>Veículos</span>
          </a>
        </li>
        <li>
          <a href="{{ route('usuario.index') }}">
            <i class="fa fa-fw fa-user"></i> <span>Usuários</span>
          </a>
        </li>
      @endif
      <li>
        <a href="{{ route('admin.sair') }}">
          <i class="fa fa-fw fa-sign-out"></i> <span>Sair</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
