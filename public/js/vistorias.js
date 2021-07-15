var URL = 'https://agilvistoriasthe.com.br/';

function carrega_modelos(id, modelo = null){

	$('#modelo_id').empty();

	$.post({ method: 'POST', url: URL+'carros', data: {id: id, _token: $("[name='_token']").val()},

		success: function(data){

			if (data.modelos != false){

				for (var i = 0; i < data.modelos.length; i++){

					var option = $('<option />', {value: data.modelos[i].id}).text(data.modelos[i].nome);

					$('#modelo_id').append(option);

					if (data.modelos[i].nome == modelo)
						option.attr('selected', true);
				}
				
				$('#modelo_id').selectpicker('refresh');
			}
		}
	});
}

$(function(){

	var dateToday = new Date(); 

	$("#datepicker").mask('99/99/9999').datepicker({
		minDate: dateToday,
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
		buttonImageOnly: true,
		onSelect: function(dateText) {

			if ($("#cidade_id").val() == ""){
				bootbox.alert('A Cidade é obrigatória');
			}
			else{

				var date = $(this).datepicker('getDate');
				var dia = $.datepicker.formatDate('DD', date)

				$("#hora").empty();

				$.post({ url: URL+'horarios', data: {cidade: $("#cidade_id").val(), data: dateText, dia: dia, _token: $("[name='_token']").val()},

					success: function(data){

						$.each(data.horas , function(idx, val){

							var option = $("<option />", {value: idx}).text(val);
							$("#hora").append(option);
						});

						$('#hora').selectpicker('refresh');
					}
				});
			}	
		 }
	});

	$('#hora').mask('99:99');
	$('#cpf').mask('999.999.999-99');
	$('#cnpj').mask('99.999.999/9999-99');
    $('#telefone').mask('(99)99999-9999');

	$("#site-button").click(function(){
		
		$(this).prop('disabled', true).text('Aguarde ...');

		$("#site-form").ajaxSubmit({ dataType: 'json', url: '', type: 'post', data: {_token: $("[name='_token']").val()},

			success: function(e){
				
				bootbox.alert(e.m);
				$("#site-button").prop('disabled', false).text('Agendar');

				if (e.e == false){
					
					$('#site-form input').val(""); 
					$('#servico_id').val("").selectpicker('refresh'); 
					$('#cidade_id').val("").selectpicker('refresh'); 
					$("#hora").empty().selectpicker('refresh');
					$("#marca_id").val("").selectpicker('refresh'); 
					$("#modelo_id").empty().selectpicker('refresh');
					$("#pagamento").val("").selectpicker('refresh'); 
				}
			}
		});
	});
});