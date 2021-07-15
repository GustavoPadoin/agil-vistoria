<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
		<div style="width: 100%;">
			<div style="width: 700px;background: #f7f7f7;">
				<div style="width: 100%; height: 80px; background: #ee3131; text-align: center;">
					<img src="{{ asset('img/logo.png') }}" width="100" style="display: inline-block; margin-top: 10px;"/>
				</div>
				<div style="padding: 20px 40px;">
					<h2>
						Cliente: {{ $vistoria->cliente->nome }}<br/> 
						@if (!is_null($vistoria->cliente->cpf))
							CPF: {{ $vistoria->cliente->cpf }}<br/>
						@endif
						@if (!is_null($vistoria->cliente->cnpj))
							CNPJ: {{ $vistoria->cliente->cnpj }}<br/>
						@endif
						Telefone: {{ $vistoria->cliente->telefone }}
						<br/> Seu agendamento foi confirmado em nosso sistema. 
					</h2><br/>
					<div style="font-size: 16px;">
						<p>Obrigado por realizar o agendamento !!!</p>
						<p>Pedimos que compareça na Data: <strong>{{ $vistoria->data }}</strong> e Hora: <strong>{{ $vistoria->hora }}</strong> marcadas.</p>
						<p>Não se esqueça de portar a CNH e Documento do Veículo.</p> 
						<p>Serviço a ser realizado: <strong>{{ $vistoria->servico->nome }}</strong>, no valor de: <strong>{{ "R$ " . $vistoria->servico->valor }}</strong>.</p> 
						<p>Veiculo: 
						@if (!is_null($vistoria->modelo_id))
							<strong>{{ $vistoria->modelo->nome . "/" . $vistoria->modelo->marca->nome }}</strong>, 
						@endif
						@if (!is_null($vistoria->outro))
							<strong>{{ $vistoria->outro }}</strong>,
						@endif
						Placa: <strong>{{ $vistoria->placa }}</strong>.</p> 
						<p>Cidade de: <strong>{{ $vistoria->cidade->nome }}</strong></p>
					</div><br/>
				</div>
			</div>
		</div>
    </body>
</html>