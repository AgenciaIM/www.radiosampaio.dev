<?php
if (strcmp(basename($_SERVER['SCRIPT_NAME']), basename(__FILE__)) === 0){
	die();
}
function inserir_voto_enquete() {
	global $wpdb;
	
	$idOption 	= strip_tags((int)$_POST['idOption']);
	$idAsk 		= strip_tags((int)$_POST['idAsk']);
		
	if (isset($_COOKIE['enqueteZIM']) and ( $_COOKIE['enqueteZIM-ask'] == $idAsk or $_COOKIE['enqueteZIM-option'] == $idOption) ){
		_e('3'); //Erro de Cookie
	} else {
		setcookie('enqueteZIM',$_SERVER['REMOTE_ADDR'],time()+60);
		setcookie('enqueteZIM-ask',$idAsk,time()+60);
		setcookie('enqueteZIM-option',$idOption,time()+60);
				
		if (!empty($idOption) and !empty($idAsk) ) {
			$idOption 	= strip_tags((int)$_POST['idOption']);
			$idAsk 		= strip_tags((int)$_POST['idAsk']);
				
			$verificaExiste = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."enquete_option WHERE idOption=$idOption AND idAsk='$idAsk'");
			
			if(count($verificaExiste) == 1){
				$Up = mysql_query("UPDATE ".$wpdb->prefix."enquete_option SET votos=votos+1 WHERE idOption='$idOption' AND idAsk='$idAsk'");
				if( $Up === true ){
					_e('0'); // Sem Erros, insere voto
				} else {
					_e('1'); // Erro não pôde atualizar
				}
			} else {
				_e('2'); // Erro Opção não existe
			}
		} 
	}
	wp_die();
	die();
}
add_action( 'wp_ajax_inserir_voto_enquete', 'inserir_voto_enquete' );
add_action( 'wp_ajax_nopriv_inserir_voto_enquete', 'inserir_voto_enquete' );
/*////////////////////////////////////////////////////////////////////////*/
############################################################################
/*////////////////////////////////////////////////////////////////////////*/
function enquetez_im($idEnquete = ''){ 
	global $wpdb;
	
	$idEnquete = (int) $idEnquete;
	
	if(!empty($idEnquete)){
		$where = "AND id=$idEnquete";
	} else {
		$where = '';
	}
	
	$sqlPergunta = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."enquete_ask WHERE ativo = 1 $where ORDER BY id DESC LIMIT 1");	
	
		if (count($sqlPergunta) > 0)	{	
			_e("<div class='panel panel-default' id='Painel'>");
			$idPergunta = $sqlPergunta->id;
			$pergunta 	= stripslashes($sqlPergunta->pergunta);
			
				_e("<div class='panel-heading'><h3>$pergunta</h3></div>");
				
				$sqlResposta 	= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."enquete_option WHERE idAsk='$idPergunta' ORDER BY idOption ASC");
				$sqlRespostaSoma = $wpdb->get_var("SELECT SUM(votos) AS somaVotos FROM ".$wpdb->prefix."enquete_option WHERE idAsk='$idPergunta'");

				$total = $sqlRespostaSoma;
				//if($total == 0){
				//	$total = 1;
				//}
				_e("<ul class='list-group'>");
				if(count($sqlResposta) > 0){
					foreach( $sqlResposta as $results ) {
						$idResposta = $results->idOption;
						$Option 		= stripslashes($results->option);
						$idAsk		= $results->idAsk;
						$votos		= $results->votos;
						
						if($votos > 0){
							$porcentagem = round( ($votos*100) / $total );
							$barra = " <div class='barra' style='width:".$porcentagem."%';>
												<span class='pull-right porcentagem'>".$porcentagem."%</span>
										  </div>";
						} else {
							$barra = "";
						}
						_e("<li class='list-group-item'>");
						_e("<div class='col-lg-12 opcao'>
							<input type='radio' name='opcao' id='$idAsk' value='$idResposta'/>$Option<span class='badge pull-right'>$votos</span>
							</div>
							".$barra."
							");
						_e('</li>');
					}
				}	
				_e("</ul>");
				_e("");
				_e("<input class='btn btn-sm btn-warning' type='submit' name='enviar' value='Votar' id='btnVotar' />
		  			<input type='button' value='' class='retornoEnquete' id='retornoEnquete-$idAsk'>
				</div>");
		} else {
			_e("<div class='panel panel-default'>");
				_e("<div class='panel-heading'><h3>Nunhuma enquete Cadastrada...</h3></div>");
				_e("<div class='panel-body'>Nenhuma Enquete cadastrada...</div>");
			_e('</div>');
		}
}