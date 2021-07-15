function deletar(id){

    bootbox.confirm({
      message: "Tem certeza que deseja deletar ?",
      callback: function(result){

            if (result == true){
                $('#form'+id).submit();
            }
        }
    });
}

function baixamanual(id){

    bootbox.confirm({
      message: "Tem certeza que deseja dar baixa no pagamento ?",
      callback: function(result){

            if (result == true){
                $('#form-baixa'+id).submit();
            }
        }
    });
}
