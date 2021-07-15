@extends('admin.layout.site')

@section('content')

    <h2><i class="fa fa-fw fa-car"></i> Veículos </h2>

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
            <h3 class="box-title">Cadastro de Veículos</h3>
        </div>
        <div class="box-body">
            @php
                if ($action == 'store')
                    $route = 'modelo.'.$action;
                else
                    $route = ['modelo.'.$action, $modelo->id];
            @endphp

           {{ Form::model($modelo, array('route' => $route, 'method' => $method)) }}

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::label('nome', 'Nome*') }}
                            {{ Form::text('nome', null, array('class' => 'form-control')) }}
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <?php $itens = ['' => 'Selecione o status', 1 => 'Ativo', 0 => 'Inativo']; ?>
                            {{ Form::label('status', 'Status*') }}
                            {{ Form::select('status', $itens, null, array('class' => 'form-control')) }}
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <?php 
                                $itens2[''] = 'Selecione a marca';
                                foreach ($marcas as $marca){
                                    $itens2[$marca->id] = $marca->nome;
                                }
                            ?>
                            {{ Form::label('marca_id', 'Marcas*') }}
                            {{ Form::select('marca_id', $itens2, null, array('class' => 'form-control')) }}
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