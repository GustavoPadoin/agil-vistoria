<!-- Example DataTables Card-->
    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
              <th width="10">Id</th>
              <th>Cliente</th>				
              <th>Data/Hora</th>								
              <th>Serviço</th>				
              <th>Cidade</th>				
              <th>Tipo Pagamento</th>
              <th>Status Pagamento</th>
              <th>Ações</th>
          </tr>
        </thead>
        <tbody>
			  @foreach ($itens as $item)
          <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->cliente }}</td>
            <td>{{ $item->data . ' - ' . $item->hora }}</td>
            <td>{{ $item->servico . ' - R$ ' . $item->valor }}</td>
            <td>{{ $item->cidade }}</td>
            <td>@if ($item->pagamento == 1) ONLINE @else BALCÃO @endif</td>
            <td>
                @if ( ($item->pagamento == 2) && (!is_null($item->data_pagamento)) )
                  <span class="label label-success" style="font-size: 14px;">Pago: {{ $item->data_pagamento }}</span>
                @else
                  <span class="label label-danger" style="font-size: 14px;">Aguardando</span>
                @endif
            </td>
            <td>
                <div class="btn-group">
                  <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                    <i class="fa fa-fw fa-gear"></i>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="{{ route($route.'.show', $item->id) }}"><i class="fa fa-edit"></i> Visualizar</a></li>
                      @if ( ($item->pagamento == 2) && (is_null($item->data_pagamento)) )
                        <li><a onclick="baixamanual({{ $item->id }})" style="cursor: pointer;"><i class="fa fa-credit-card"></i> Baixa Manual</a></li>
                        {{ Form::open(array('route' => array($route.'.edit', $item->id), 'method' => 'get', 'id' => 'form-baixa'.$item->id)) }}
                        {{ Form::close() }}
                      @endif
                      <li><a onclick="deletar({{ $item->id }})" style="cursor: pointer;"><i class="fa fa-trash"></i> Deletar</a></li>
                      {{ Form::open(array('route' => array($route.'.destroy', $item->id), 'method' => 'delete', 'id' => 'form'.$item->id)) }}
                      {{ Form::close() }}
                    </ul>
                  </div>
              </td>
          </tr>
			  @endforeach
        </tbody>
      </table>
    </div>
