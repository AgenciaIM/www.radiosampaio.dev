jQuery(document).ready(function($) {
	$('#Painel #btnVotar').click(function(){
		var cookie = $.cookie("enqueteZIM");
		if (cookie == null){
			idOption = $('input[type="radio"]:checked').val();
			idAsk = $('input[type="radio"]:checked').attr('id');
			
			$.ajax({
				type: 'POST',
				url: myAjax.ajaxurl,
				dataType : 'html',
				data: { action: 'inserir_voto_enquete',  idOption : idOption, idAsk : idAsk  },
				success: function(data, textStatus, XMLHttpRequest){
				  if(data == 0){
					 location.reload(1);
					 $('#retornoEnquete-'+idAsk).attr('value','Voto cadastrado com Suceso!');
					 $('#retornoEnquete-'+idAsk).attr('class','retornoEnquete btn btn-sm btn-success pull-right').css({'display':'table','font-size':12+'px'});
				  }	else if( data == 1) {
					 $('#retornoEnquete-'+idAsk).attr('value','Erro interno, desculpe o transtorno!').css({'display':'table'});
					 $('#retornoEnquete-'+idAsk).attr('class','retornoEnquete btn btn-sm btn-warning pull-right');
				  } else if( data == 2) {
					 $('#retornoEnquete-'+idAsk).attr('value','Acao desconhecida, desculpe o transtorno!').css({'display':'table'});
					 $('#retornoEnquete-'+idAsk).attr('class','retornoEnquete btn btn-sm btn-danger pull-right');
				  } else if( data == 3) {
					 $('#retornoEnquete-'+idAsk).attr('value','Voce ja votou. Aguarde...!').css({'display':'table'});
					 $('#retornoEnquete-'+idAsk).attr('class','retornoEnquete btn btn-sm btn-danger pull-right');
				  }
				},
				error: function(MLHttpRequest, textStatus, errorThrown){
				  alert(data);
				}
		  	});
		} else { }
	});
	return false;
});