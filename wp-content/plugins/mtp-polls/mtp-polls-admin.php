<?php
if (strcmp(basename($_SERVER['SCRIPT_NAME']), basename(__FILE__)) === 0){
	die();
}
include('functions.php');

if(isset($_GET['action']) and !empty($_GET['action'])){
	$acao = $_GET['action'];
												
	if(isset($_GET['enquete']) and !empty($_GET['enquete'])){
		$idEnquete = (int)$_GET['enquete'];
	} else {
		$idEnquete = (int) 0;
	}
	
	if($acao == 'ativar'){
		ativar_desativar_enquete('ativar',$idEnquete);
	} else if($acao == 'desativar'){
		ativar_desativar_enquete('desativar',$idEnquete);
	} else if($acao == 'deletar'){
		deletar_enquete();
	}
}
editar_enquete();
?>
    <div class="wrap">
      <div class="container-fluid">
      	<div class="row">
        	<div class="col-lg-11" style="margin:0;padding:0">
	      		<h1 style="padding:20px 0px 20px 20px;margin:20px 0;background:#337ab7;border-radius:10px;color:#fff">EnqueteZIM - Painel Administrativo.</h1>
          	</div>
        </div>  
          <div class="row">
                <div class="col-lg-11" style="margin:0;padding:0">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Enquetes Cadastradas 
                                <a href="?page=mtp-polls/mtp-polls-admin.php&action=inserir" class="btn btn-xs" style="background:#fff;color:#0066CC;margin-left:30px;">
                                	<i class="glyphicon glyphicon-plus-sign"></i>Inserir enquete
                                 </a>
                            </h3>
                        </div>
                                    
                        <table class="table table-hover table-responsive">
                        	<thead>
                             	<tr>
                                	<th>ID</th>
                                    <th>Pergunta</th>
                                    <th>Opções</th>
                                    <th>Mais votada</th>
                                    <th>Data</th>
                                    <th>Ações</th>
                                 </tr>
                             </thead>
                                        
                             <tbody>
											<?php $Enquetes = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."enquete_ask ORDER BY id DESC");
																						
											if(count($Enquetes) > 0){
												foreach( $Enquetes as $Enquete ) { 
												$Opcoes = $wpdb->get_var("SELECT COUNT(*) FROM ".$wpdb->prefix."enquete_option WHERE idAsk=".$Enquete->id."");
												$MaisVotada = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."enquete_option WHERE idAsk=".$Enquete->id." ORDER BY votos DESC LIMIT 1 ");
												?>
												<tr>
													<td><?php _e($Enquete->id) ?></td>
													<td><?php _e(stripslashes($Enquete->pergunta) ) ?></td>
													<td><?php _e($Opcoes) ?></td>
													<td><?php _e(stripslashes($MaisVotada->option)) ?><span class="label label-success" style="margin-left:10px;"><?php _e($MaisVotada->votos) ?> voto(s)</span></td>
													<td><?php _e($Enquete->data) ?></td>
													<td>
														<a href="?page=mtp-polls/mtp-polls-admin.php&action=editar&enquete=<?php _e($Enquete->id); ?>"><i class="glyphicon glyphicon-edit"></i></a>
													<?php
														if($Enquete->ativo == 0){
															$icon = 'close';
															$eye  = 'ativar';
														} else {
															$icon = 'open';	
															$eye  = 'desativar';
														} ?>
														
														<a href="?page=mtp-polls/mtp-polls-admin.php&action=<?php _e($eye) ?>&enquete=<?php _e($Enquete->id) ?>">
															<i class="glyphicon glyphicon glyphicon-eye-<?php _e($icon) ?>"></i>
														</a>
														<a href="?page=mtp-polls/mtp-polls-admin.php&action=deletar&enquete=<?php _e($Enquete->id) ?>">
															<i class="glyphicon glyphicon-remove-circle"></i>
														</a>
													</td>
												</tr>	
												<?php }
											} else {
												echo '
												<tr>
													<th>#</th>
													<th>--</th>
													<th>--</th>
													<th>--</th>
													<th>--</th>
													<th>--</th>
												 </tr>
												'; }?>
                                </tbody>
                        </table>   
                                        
                    </div> <!--PANEL-->
                 </div> <!--COL-LG-11-->
           	</div> <!--ROW-->
                 
           	<div class="row">
                             <div class="col-lg-7" style="margin:0;padding:0">   
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Enquete Atual</h3>
                                    </div>
                                    
                                    <table class="table table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Pergunta</th>
                                                <th>Opções</th>
                                                <th>Votos</th>
                                                <th>Data</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $EnquetesAtual = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."enquete_ask WHERE `ativo`=1 ORDER BY id DESC LIMIT 1");
                                            if(count($EnquetesAtual) != 0){
                                            foreach( $EnquetesAtual as $EnqueteAtual ) { 
                                            	$OpcoesAtual = $wpdb->get_var("SELECT COUNT(*) FROM ".$wpdb->prefix."enquete_option WHERE idAsk=".$EnqueteAtual->id."");
                                           	 	$MaisVotadaAtual = $wpdb->get_row("SELECT SUM(votos) AS soma FROM ".$wpdb->prefix."enquete_option WHERE idAsk=".$EnqueteAtual->id."");
												$tamanho = strlen($EnqueteAtual->pergunta);
												if($tamanho > 50){
													$NomeEnqueteAtual = stripslashes(substr($EnqueteAtual->pergunta,0,45).'...');
												} else {
													$NomeEnqueteAtual = stripslashes($EnqueteAtual->pergunta);
												}?>
												 <tr>
                                                <td><?php _e($EnqueteAtual->id) ?></td>
                                                <td><?php _e($NomeEnqueteAtual) ?></td>
                                                <td><?php _e($OpcoesAtual)?></td>
                                                <td><?php _e($MaisVotadaAtual->soma) ?></td>
                                                <td><?php _e($EnqueteAtual->data) ?></td>
                                                <td>
                                                    <a href="?page=mtp-polls/mtp-polls-admin.php&action=editar&enquete=<?php _e($EnqueteAtual->id) ?>">
                                                    	<i class="glyphicon glyphicon-edit"></i>
                                                    </a>
																	 <?php
																	$icon = 'open';
																	$eye  = 'desativar';
														
                                                    if($EnqueteAtual->ativo == 0){
                                                        $icon = 'close';
																			$eye  = 'ativar';
                                                    } ?>
                                                    <a href="?page=mtp-polls/mtp-polls-admin.php&action=<?php _e($eye) ?>&enquete=<?php _e($EnqueteAtual->id) ?>">
                                                    	<i class="glyphicon glyphicon glyphicon-eye-<?php _e($icon) ?>"></i>
                                                    </a>
                                                    <a href="?page=mtp-polls/mtp-polls-admin.php&action=deletar&enquete=<?php _e($EnqueteAtual->id) ?>">
                                                    	<i class="glyphicon glyphicon-remove-circle"></i>
                                                    </a>
                                                </td>
                                            </tr>
														  <?php } 
											} else { 											
													echo '<tr>
														<td>#</td>
														<td>--</td>
														<td>--</td>
														<td>--</td>
														<td>--</td>
														<td>--</td>
													</tr>';
													} ?>
                                       </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-12" style="margin:0;padding:0">
                                     <form action="" method="post">                      
                                        <?php  
                                        if(isset($_GET['action']) and !empty($_GET['action'])){
                                            $acao = $_GET['action'];
                                            if($acao == 'inserir'){
                                                inserir_enquete();  
                                            } else if($acao == 'editar'){
                                                edicao_enquete($idEnquete);
                                            } 
                                        }
                                        ?>
                                         </form>
                                 </div>   <!--COL-LG-7-->   
                             </div> <!--COL-LG-8--> 
                             <div class="col-lg-4">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Contribua</h3>
                                    </div>
                                    <div class="panel-body">
                                    <!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
                                        <form action="https://pagseguro.uol.com.br/checkout/v2/donation.html" method="post" target="_blank">
                                        <!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
                                        <input type="hidden" name="currency" value="BRL" />
                                        <input type="hidden" name="receiverEmail" value="flavioferreir@hotmail.com" />
                                        <input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/doacoes/209x48-doar-azul-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" style="width:100%;padding:0" />
                                        </form>
                                        <!-- FINAL FORMULARIO BOTAO PAGSEGURO -->
                                    <p style="text-align:justify;font-size:12px">
                             <b>EnqueteZIM</b> foi desenvolvido pela <a href="http://www.interactivemonkey.com.br" target="_blank">Agencia Interactive MOnkey</a>
                             com o intuito de proporcionar um plugin leve que utilize poucos recursos do servidor e de seu site. Em poucas linhas nos reunimos elementos de um grande plugin. Para quem tem um pouco de conhecimento tecnico, nao sera difícil alterar a sua estrutura e deixá-lo com a sua cara. Confira o que este plugin tem de melhor e contribua para que este sonho continue crescendo. Obrigado!
                                    </p>
                                    <p><i>Para chamar o plugin use:</i> <br /><b>&lt;?php if (function_exists('enquetez_im')){
				enquetez_im($ID);
			} ?&gt;</b></p>
                                    </div>
                                </div>    
                             </div>  <!-- COL-LG-4--> 
                         </div> <!--ROW-->
						<div class="row" style="margin:0;padding:0">                     
              	</div> <!-- ROW >> COL-LG-7-->
 		</div> <!--CONTAINER-->  
	</div>  <!--WRAP-->