<!-- Example DataTables Card-->
    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
              <th width="50">Status</th>
              <th width="50">Id</th>
              <th>Nome</th>
              @if ($route == 'servico')				
                <th>Valor</th>
              @elseif ($route == 'modelo')
                <th>Marca</th>
              @endif											
              <th width="50">Ações</th>
          </tr>
        </thead>
        <tbody>
			  @foreach ($itens as $item)
          <tr>
            <td>
              @if ($item->status == 1)  
                <span class="label label-success" style="font-size: 14px;">Ativo</span>
              @else  
                <span class="label label-danger" style="font-size: 14px;">Inativo</span>
              @endif  
            </td>
            <td>{{ $item->id }}</td>

            @if ($route == 'usuario')
              <td>{{ $item->name }}</td>
            @else  
              <td>{{ $item->nome }}</td>
            @endif
            
            @if ($route == 'servico')
              <td>{{ "R$ " . $item->valor }}</td>
            @elseif ($route == 'modelo')
              <td>{{ $item->marca->nome }}</td>
            @endif  
            <td>
                <div class="btn-group">
                  <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                    <i class="fa fa-fw fa-gear"></i>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-right">
                      <li><a href="{{ route($route.'.edit', $item->id) }}"><i class="fa fa-edit"></i> Editar</a></li>
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
