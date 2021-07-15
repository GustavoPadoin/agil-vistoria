{{ Form::model(null, array('route' => 'vistoria.filtro', 'method' => 'post')) }}
    <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
                {{ Form::label('data_ini', 'Data Inicial') }}<br/>
                {{ Form::text('data_ini', null, array('class' => 'form-control', 'style' => 'display: inline-block; width: 85%;')) }}
            </div>        
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                {{ Form::label('data_fin', 'Data Final') }}<br/>
                {{ Form::text('data_fin', null, array('class' => 'form-control', 'style' => 'display: inline-block; width: 85%;')) }}
            </div>        
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <?php 
                    $itens[''] = 'Selecione um servico ...';
                    foreach ($servicos as $servico){
                        $itens[$servico->id] = $servico->nome . ' - R$ ' . $servico->valor;
                    }
                ?>
                {{ Form::label('servico_id', 'Serviço') }}
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
                {{ Form::label('cidade_id', 'Cidade') }}
                {{ Form::select('cidade_id', $itens3, null, array('class' => 'form-control')) }}
            </div> 
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <?php $itens4 = ['' => 'Selecione uma opção', 1 => 'Pagamento Online', 2 => 'Pagamento Balcão']; ?>
                {{ Form::label('pagamento', 'Pagamento') }}
                {{ Form::select('pagamento', $itens4, null, array('class' => 'form-control')) }}  
            </div>  
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            {{  Form::submit('Pesquisar', array('class' => 'btn btn-primary pull-right')) }}        
        </div>
    </div>
{{ Form::close() }}