@extends('admin.layout.site')

@section('content')

    <h2><i class="fa fa-fw fa-check-square-o"></i> Vistorias </h2>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Vistoria: {{ $vistoria->id }}</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped" style="font-size: 16px;">
                    <tr>
                        <td width="150"><strong>Data/Hora</strong></td>
                        <td>{{ $vistoria->data . ' - ' . $vistoria->hora }}</td>
                    </tr>        
                    <tr>
                        <td><strong>Veículo</strong></td>
                        <td>{{ 'Marca: ' . $vistoria->modelo->marca->nome . ' - Modelo: ' .$vistoria->modelo->nome . ' - Placa: ' .  $vistoria->placa }}</td>
                    </tr>
                    @if (!is_null($vistoria->outro))
                        <tr>
                            <td><strong>Outro</strong></td>
                            <td>{{ $vistoria->outro }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td><strong>Pagamento</strong></td>
                        <td>@if ($vistoria->pagamento == 1) ONLINE @else BALCÃO @endif</td>
                    </tr>
                    <tr>
                        <td><strong>Serviço</strong></td>
                        <td>{{ $vistoria->servico->nome . ' - R$ ' . $vistoria->servico->valor }}</td>
                    </tr>
                    <tr>
                        <td><strong>Cidade</strong></td>
                        <td>{{ $vistoria->cidade->nome }}</td>
                    </tr>
                    <tr>
                        <td><strong>Data Cadastro</strong></td>
                        <td>{{ $vistoria->created_at }}</td>
                    </tr> 
                    <tr>
                        <td><strong>Cliente</strong></td>
                        <td>{{ $vistoria->cliente->nome }}</td>
                    </tr>
                    @if (!is_null($vistoria->cliente->cpf))
                        <tr>
                            <td><strong>CPF</strong></td>
                            <td>{{ $vistoria->cliente->cpf }}</td>
                        </tr>
                    @endif
                    @if (!is_null($vistoria->cliente->cnpj))
                        <tr>
                            <td><strong>CNPJ</strong></td>
                            <td>{{ $vistoria->cliente->cnpj }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td><strong>Telefone</strong></td>
                        <td>{{ $vistoria->cliente->telefone }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email</strong></td>
                        <td>{{ $vistoria->cliente->email }}</td>
                    </tr>
                    @if (!is_null($vistoria->user_id))
                        <tr>
                            <td><strong>Usuario</strong></td>
                            <td>{{ $vistoria->user->name }}</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>

@endsection

