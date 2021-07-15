@extends('admin.layout.site')

@section('content')

    <h2><i class="fa fa-fw fa-user"></i> Usuários </h2>

    @if ($errors->any())
      <div class="alert alert-danger">
          <ul style="margin-bottom: 0px;">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Cadastro de Usuários</h3>
        </div>
        <div class="box-body">
            @php
                if ($action == 'store')
                    $route = 'usuario.'.$action;
                else
                    $route = ['usuario.'.$action, $usuario->id];
            @endphp

           {{ Form::model($usuario, array('route' => $route, 'method' => $method)) }}

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::label('name', 'Nome*') }}
                            {{ Form::text('name', null, array('class' => 'form-control')) }}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::label('email', 'Email*') }}
                            {{ Form::text('email', null, array('class' => 'form-control')) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            {{ Form::label('password', 'Senha*') }}
                            {{ Form::password('password', array('class' => 'form-control')) }}
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <?php $itens = ['' => 'Selecione o status', 1 => 'Ativo', 0 => 'Inativo']; ?>
                            {{ Form::label('status', 'Status*') }}
                            {{ Form::select('status', $itens, null, array('class' => 'form-control')) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        {{ Form::submit('Salvar', array('class' => 'btn btn-primary pull-right')) }}
                    </div>
                </div>

           {{ Form::close() }}

        </div>
    </div>

@endsection