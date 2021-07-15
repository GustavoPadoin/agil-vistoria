@extends('admin.layout.site')

@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>.ui-datepicker-trigger{ width: 28px; height: 32px; }</style>
@endsection

@section('content')

    <h2><i class="fa fa-fw fa-check-square-o"></i> Vistorias </h2>

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
            <h3 class="box-title">Agendamento Vistorias</h3>
        </div>
        <div class="box-body">
            @php
                if ($action == 'store')
                    $route = 'vistoria.'.$action;
                else
                    $route = ['vistoria.'.$action, $vistoria->id];
            @endphp

           {{ Form::model($vistoria, array('route' => $route, 'method' => $method)) }}

                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <?php 
                                $itens[''] = 'Selecione um servico ...';
                                foreach ($servicos as $servico){
                                    $itens[$servico->id] = $servico->nome . ' - R$ ' . $servico->valor;
                                }
                            ?>
                            {{ Form::label('servico_id', 'Serviço*') }}
                            {{ Form::select('servico_id', $itens, null, array('class' => 'form-control')) }}
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <?php 
                                $itens3[''] = 'Selecione uma cidade ...';
                                foreach ($cidades as $cidade){
                                    $itens3[$cidade->id] = $cidade->nome;
                                }
                            ?>   
                            {{ Form::label('cidade_id', 'Cidade*') }}
                            {{ Form::select('cidade_id', $itens3, null, array('class' => 'form-control')) }}
                        </div> 
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            {{ Form::label('data', 'Data*') }}<br/>
                            {{ Form::text('data', null, array('class' => 'form-control', 'id' => 'datepicker', 'style' => 'display: inline-block; width: 85%;')) }}
                        </div>        
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            {{ Form::label('hora', 'Hora*') }}
                            {{ Form::select('hora', [], null, array('class' => 'form-control')) }}
                        </div>
                    </div>
                </div>
                <div class="row">       
                    <div class="col-sm-3">
                        <div class="form-group">
                            <?php 
                                $itens2[''] = 'Selecione uma marca ...';
                                foreach ($marcas as $marca){
                                    $itens2[$marca->id] = $marca->nome;
                                }
                            ?>    
                            {{ Form::label('marca_id', 'Marca') }}
                            {{ Form::select('marca_id', $itens2, null, array('class' => 'form-control', 'onchange' => 'carrega_modelos(this.value)')) }}
                        </div>    
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            {{ Form::label('modelo_id', 'Veiculo') }}
                            {{ Form::select('modelo_id', [], null, array('class' => 'form-control')) }}
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            {{ Form::label('outro', 'Outro') }}
                            {{ Form::text('outro', null, array('class' => 'form-control', 'maxlength' => '60')) }}
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            {{ Form::label('placa', 'Placa*') }}
                            {{ Form::text('placa', null, array('class' => 'form-control', 'maxlength' => '7')) }}
                        </div>
                    </div>
                    <div class="col-sm-2">
                         <div class="form-group">
                            <?php $itens4 = ['' => 'Selecione uma opção', 1 => 'Pagamento Online', 2 => 'Pagamento Balcão']; ?>
                            {{ Form::label('pagamento', 'Pagamento*') }}
                            {{ Form::select('pagamento', $itens4, null, array('class' => 'form-control')) }}  
                        </div>  
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::label('nome', 'Nome*') }}
                            {{ Form::text('nome', null, array('class' => 'form-control', 'maxlength' => '60')) }}
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            {{ Form::label('cpf', 'CPF') }}
                            {{ Form::text('cpf', null, array('class' => 'form-control')) }}
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            {{ Form::label('cnpj', 'CNPJ') }}
                            {{ Form::text('cnpj', null, array('class' => 'form-control')) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            {{ Form::label('telefone', 'Telefone*') }}
                            {{ Form::text('telefone', null, array('class' => 'form-control')) }}
                         </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::label('email', 'Email*') }}
                            {{ Form::text('email', null, array('class' => 'form-control', 'maxlength' => '80')) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        {{ Form::submit('Agendar', array('class' => 'btn btn-primary pull-right')) }}    
                    </div>        
                </div>

           {{ Form::close() }}
           
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('js/bootbox.min.js') }}"></script>
    <script src="{{ asset('js/vistorias.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection