<?php
if (strcmp(basename($_SERVER['SCRIPT_NAME']), basename(__FILE__)) === 0){
	die();
}
function redirect($url){
	if(empty($url)){
		$url = '';
	} 
	_e( '<meta http-equiv="refresh" content="0,URL=?page=mtp-polls/mtp-polls-admin.php'.$url.'">');
	die();
}
function inserir_enquete(){
	global $wpdb;
	
	if(isset($_GET['action']) and $_GET['action'] == 'inserir'){
		if(isset($_POST['submit_form'])){
			$pergunta = mysql_real_escape_string($_POST['Pergunta']);
			$opcoes = $_POST['opcao'];
		
			if(!empty($pergunta)){
				$data = date('d/m/Y');
				$dados = array('pergunta'=>''.$pergunta.'','data'=>$data);
				$formato = array('%s','%s');


				$insertPergunta = $wpdb->query("INSERT INTO ".$wpdb->prefix."enquete_ask (pergunta, data) VALUES ('$pergunta','$data')");
				$idAsk = $wpdb->insert_id;
				
				if($insertPergunta){
					foreach($opcoes as $valor){
						$valorOption = mysql_real_escape_string($valor);
						$contaOpcao = 0;
						if(!empty($valorOption)){
							$insertOpcoes = $wpdb->insert($wpdb->prefix.'enquete_option', array('option'=>$valorOption,'idAsk'=>$idAsk),array('%s','%d'));
							$contaOpcao++;
						}
					}
					redirect('&retorno=ok');
				}
			} else {
				redirect('&action=inserir&retorno=ErroSuaPerguntaNaoeValida');
			}
		}
		
		/* FORMULARIO DE INSERÇÂO */
		_e( '<div class="panel panel-primary">');
			_e( '<div class="panel-heading">
					<h3 class="panel-title">Inserir Enquete</h3>
				  </div>');
				 _e( '<div class="panel-body">');
						 _e( '<div class="col-lg-11">
									<h3>Pergunta:</h3>
										<input type="text" class="form-control" aria-describedby="sizing-addon1" name="Pergunta" />
								</div>');
						 _e( '<div class="col-lg-8">
									<h4>Opção</h4>
									<div class="input_campos">
										<button class="btn btn-success btn-xs add_campo" style="margin:10px 0">Mais opções</button>
										<div><input type="text" class="form-control" aria-describedby="sizing-addon1" name="opcao[]"></div>
									</div>	 
								</div>');
				 _e( '</div>');
				 _e( '<div class="panel-footer">
							<input id="btnForm" name="submit_form" type="submit" class="btn btn-success" value="Inserir"/>
					   </div>');
		 _e( '</div>');
	}
}
function edicao_enquete($idEnquete){
	global $wpdb;
	$enqueteID = (int) $idEnquete;
	
	if(isset($_GET['action']) and $_GET['action'] == 'editar'){
		_e( '<div class="panel panel-primary">');
			_e( '<div class="panel-heading">
            		<h3 class="panel-title">Painel de Edição</h3>
                  </div>');
					
					$enqueteExiste = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."enquete_ask WHERE id=$enqueteID");
											 
						 if(count($enqueteExiste) == 1){
							 $dadosOption = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."enquete_option WHERE idAsk=$enqueteID ORDER BY idOption ASC");
							 _e( '<div class="panel-body">');
							 _e( '<div class="col-lg-11">
							 	<h3>Pergunta:</h3>
							 	<input type="hidden" name="perguntaHidden" value="'.$enqueteID.'" />
							 	<input type="text" class="form-control" aria-describedby="sizing-addon1" name="novaPergunta" value="'.stripslashes($enqueteExiste->pergunta).'" />
							 </div>');
							 $op = 1;
							 foreach( $dadosOption as $dadoOption ) { 
							 	_e( '<div class="col-lg-8">
										<h4>Opção '.$op.':</h4>	 
										<input type="hidden" name="opcaoHidden[]" value="'.$dadoOption->idOption.'" />
									 	<input type="text" class="form-control" aria-describedby="sizing-addon1" name="opcao[]" value="'.stripslashes($dadoOption->option).'" />
									 </div>');
								$op++;
							 }
							 _e( '</div>');
						 }
						 _e( '<div class="panel-footer">
                            	<input id="btnForm" name="submit" type="submit" class="btn btn-success" value="Editar"/>
                        		</div>');
						 _e( '</div>');
					 }
}
function editar_enquete(){	
	global $wpdb;
	if(isset($_POST['submit']) and !empty($_POST['submit'])){    
		$idEnquete = (int) $_POST['perguntaHidden'];
		if(!empty($idEnquete)){
			$novaPergunta = strip_tags(mysql_real_escape_string(htmlspecialchars($_POST['novaPergunta'])));
			$upPergunta = $wpdb->query("UPDATE ".$wpdb->prefix."enquete_ask SET `pergunta`='$novaPergunta' WHERE `id`='$idEnquete'");
		}
		$idOption  = $_POST['opcaoHidden'];
		$opcao 	  = $_POST['opcao'];
		
		$arr = array_combine($idOption, $opcao);
		
		foreach( $arr as $idOpt => $opcao ){
			$opcao = mysql_real_escape_string(htmlspecialchars($opcao));
			$upOpcoes = $wpdb->query("UPDATE ".$wpdb->prefix."enquete_option SET `option`='$opcao' WHERE `idAsk`=$idEnquete AND `idOption`=$idOpt");
		}
		redirect('&retorno=ok');
		die();
	}
}
function deletar_enquete(){
	global $wpdb;
	
	$enqueteID = (int) $_GET['enquete'];
	$delExiste = $wpdb->get_var("SELECT COUNT(*) FROM ".$wpdb->prefix."enquete_ask WHERE `id`=$enqueteID");
	if($delExiste == 1){
		$delOption = $wpdb->query("DELETE FROM ".$wpdb->prefix."enquete_option WHERE `idAsk`=$enqueteID");
		$delAsk = $wpdb->query("DELETE FROM ".$wpdb->prefix."enquete_ask WHERE `id`=$enqueteID");
		if($delAsk){
			redirect('&retorno=EnqueteDeletada');
			die();
		}
	} else {
		redirect('&retorno=EstaEnqueteNaoExiste');
		die();
	}
}
function ativar_desativar_enquete($situacao,$idEnquete){
	global $wpdb;
	
	$enqueteID = (int)$idEnquete;
	
	if($situacao == 'ativar'){
		$ativar_desativar = 1;
	} else if($situacao == 'desativar'){
		$ativar_desativar = 0;
	} else {
		$ativar_desativar = 0;
	}
	$enqueteExiste = $wpdb->get_var("SELECT COUNT(*) FROM ".$wpdb->prefix."enquete_ask WHERE `id`=$enqueteID");
	if($enqueteExiste == 1){
		$ativaEnquete = $wpdb->query("UPDATE ".$wpdb->prefix."enquete_ask SET `ativo`=$ativar_desativar WHERE `id`=$enqueteID");
		if($ativaEnquete){
			redirect('&retorno=ok');
			die();
		} else {
			redirect('&retorno=erro');
			die();
		}
	}
}