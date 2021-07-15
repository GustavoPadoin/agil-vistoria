@extends('admin.layout.site')

@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>.ui-datepicker-trigger{ width: 28px; height: 32px; }</style>
@endsection

@section('content')

    <h2><i class="fa fa-fw fa-check-square-o"></i> Vistorias </h2>

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
            <h3 class="box-title">Filtros</h3>
        </div>
        <div class="box-body">
            @include('admin.layout.filtro')
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Listagem de Vistorias</h3>
            <a href="{{ route('vistoria.create') }}" class="btn btn-primary pull-right">Adicionar</a>
        </div>
        <div class="box-body">
            @if ($vistorias->count() > 0)
              @include('admin.layout.datatable', ['route' => 'vistoria', 'itens' => $vistorias])
            @else
              <div class="alert alert-info">O Sistema não possui vistorias cadastradas.</div>
            @endif
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('js/bootbox.min.js') }}"></script>
    <script src="{{ asset('js/deletar.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function(){
            $("#data_ini").mask('99/99/9999').datepicker({
                dateFormat: 'dd/mm/yy',
                dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
                dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
                nextText: 'Próximo',
                prevText: 'Anterior',
                showOn: "button",
                buttonImage: "http://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
                buttonImageOnly: true
            });
            $("#data_fin").mask('99/99/9999').datepicker({
                dateFormat: 'dd/mm/yy',
                dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
                dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
                nextText: 'Próximo',
                prevText: 'Anterior',
                showOn: "button",
                buttonImage: "http://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
                buttonImageOnly: true
            });
    });
    </script>
@endsection