@extends('admin.layout.site')

@section('content')

    <h2><i class="fa fa-fw fa-building"></i> Cidades </h2>

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
            <h3 class="box-title">Listagem de Cidades</h3>
            <a class="btn btn-primary pull-right" href="{{ route('cidade.create') }}">Adicionar</a>
        </div>
        <div class="box-body">
            @if ($cidades->count() > 0)
              @include('admin.layout.table', ['route' => 'cidade', 'itens' => $cidades])
            @else
              <div class="alert alert-info">O Sistema não possui cidades cadastradas.</div>
            @endif
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('js/bootbox.min.js') }}"></script>
    <script src="{{ asset('js/deletar.js') }}"></script>
@endsection