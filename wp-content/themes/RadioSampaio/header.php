<?php global $DIR; $DIR = "http://www.radiosampaio.dev/wp-content/themes/RadioSampaio"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
  <meta name="keywords" content="Rádio Sampaio 92,5 FM & 870 AM">
  <meta name="description" content="Rádio Sampaio 92,5 FM & 870 AM">
  <meta name="author" content="Agência Interactive MOnkey">
  <meta name="robots" content="index,follow">
    <title>Rádio Sampaio 92,5 FM & 870 AM</title>
    
    <link rel="icon" href="<?php echo $DIR; ?>/img/icon.png" type="image/x-icon">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="<?php echo $DIR; ?>/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $DIR; ?>/css/swiper.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $DIR; ?>/style.css" />  
    <link rel="stylesheet" type="text/css" href="<?php echo $DIR; ?>/css/style-metro.css" />
		
	
		
    <script type="text/javascript" src="<?php echo $DIR; ?>/js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="<?php echo $DIR; ?>/js/modernizr.custom.28468.js"></script>
	 <script type="text/javascript" src="<?php echo $DIR; ?>/js/freewall.js"></script>
    <?php wp_head();?>
</head>

<body>
<!-- BARRA TOPO -->
<div class="container-fluid">
   <div class="container barra-topo"> 
	<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
       <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<?php 
       		setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.iso-8859-1', 'portuguese' ); 
       		date_default_timezone_set( 'America/Sao_Paulo' );
       		echo ucfirst(strftime("%A, %d de %B de %Y", strtotime('today') )); 
			?>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">Player Rádio</div>
	</div>	  
   </div>
</div>
<!-- FIM DA BARRA TOPO -->

<!-- BARRA HEADER -->
<div class="container-fluid full-container" style="background:<?php if (isset($_GET['tema']) and $_GET['tema'] == 'azul'){ echo '#17066A;';} else { echo '#333';} ?>">
   <div class="container barra-header">
	<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 ">
   		<!-- SEARCH-->
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<img class="img-responsive" src="<?php echo get_bloginfo('template_url'); ?>/img/logo.png"/>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            	<h1>Rádio Sampaio</h1>
            </div>
        </div>
        <!-- LOGO -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 player">
        	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            dasd
            </div>
            
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-right">
            dasda
            </div>
        </div>
        
        <!-- MENU NAVEGACAO-->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 menu">
        	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 full-container">
                <nav class="navbar navbar-default full-container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                    </div>
                
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse full-container" id="bs-example-navbar-collapse-1">
                      <ul class="nav navbar-nav">
                        <li><a href="#">Home</a></li>
                        <li><a href="http://localhost/wordpress/quem-somos">Quem Somos</a></li>
                        <li><a href="#">Programação</a></li>
                        <li><a href="#">Notícias</a></li>
                        <li><a href="#">Comercial</a></li>
                        <li><a href="#">Fale Conosco</a></li>
                      </ul>
    
                    </div><!-- /.navbar-collapse -->
                </nav>
             </div>
             
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 full-container">
                    <div class="search">
                        <div class="input-group col-lg-10 col-md-10 col-sm-10 col-xs-12 pull-right">
                            <input type="text" class="form-control input-lg" placeholder="Buscar" />
                            <span class="input-group-btn">
                                <button class="btn btn-warning btn-lg" type="button">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- SEARCH-->
                
                   
        </div>
        <!-- MENU NAVEGACAO -->
        
     </div>   
   </div>
</div>
<!-- FIM DA BARRA HEADER -->