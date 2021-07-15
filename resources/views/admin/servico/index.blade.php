@extends('admin.layout.site')

@section('content')

    <h2><i class="fa fa-fw fa-cog"></i> Serviços </h2>

    @if ($errors->any())
      <div class="alert alert-success">
          <ul style="margin-bottom: 0px;">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Listagem de Serviços</h3>
            <a class="btn btn-primary pull-right" href="{{ route('servico.create') }}">Adicionar</a>
        </div>
        <div class="box-body">
            @if ($servicos->count() > 0)
              @include('admin.layout.table', ['route' => 'servico', 'itens' => $servicos])
            @else
              <div class="alert alert-info">O Sistema não possui serviços cadastradas.</div>
            @endif
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('js/bootbox.min.js') }}"></script>
    <script src="{{ asset('js/deletar.js') }}"></script>
@endsection