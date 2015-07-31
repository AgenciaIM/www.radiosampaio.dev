<?php session_start(); ?>
<?php global $DIR; $DIR = "http://www.radiosampaiofm.com.br/wp-content/themes/SaoDomingos"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
  <meta name="keywords" content="Rádio Sampaio 92,5 FM & 870 AM">
  <meta name="description" content="Rádio Sampaio 92,5 FM & 870 AM">
  <meta name="author" content="Agência Interactive MOnkey">
  <meta name="robots" content="index,follow">
    <title>Rádio Sampaio 92,5 FM & 870 AM </title>
    
    <link rel="icon" href="<?php echo get_bloginfo('template_url'); ?>/img/icon.png" type="image/x-icon">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_url'); ?>/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_url'); ?>/css/swiper.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_url'); ?>/style.css" />  
    <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_url'); ?>/css/style-metro.css" />
		
	
		
    <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>
	 <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/masonry.min.js"></script>
	 <script>
		$(document).ready( function() {
			$('.bloguista').popover({ trigger: "hover" });
			
			$('#pedidoMusical a').click(function (e) {
				e.preventDefault()
				$(this).tab('show')
			});
			
			var $container = $('.grid-evento');
			$container.imagesLoaded( function(){
			  $container.masonry({
				 itemSelector : '.grid-item',
				 columnWidth: 125
			  });
			});
		});
	 </script>
    <?php wp_head();?>
</head>

<body>
<!-- BARRA TOPO -->
<div class="container-fluid">
   <div class="container barra-topo"> 
	<div class="col-lg-12 col-md-12">
        <div class="col-lg-1"><h4 style="color:#DA251C; line-height: 5px;">Ao vivo </h4> </div>
       <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">  
        <!-- player topo -->
            <!-- <script type='text/javascript' src='http://www.radiosampaio.dev/wp-content/themes/RadioSampaio/radio/jwplayer.js'></script> -->
                        <script type='text/javascript' src='http://900464851.r.cdn77.net/jwplayer/510/jwplayer.js'></script>

                        <div id='mediaplayer'></div>

 <script type="text/javascript">
  jwplayer('mediaplayer').setup({
    'id': 'playerID',
    'width': '250',
    'height': '24',
    'rtmp.tunneling': 'false',
 'plugins': {
       'viral-2': {
           'onpause': "false",
           'allowmenu': "false",
           'functions': "link"
       }
    },
    'autostart': 'true',
    'controlbar': 'bottom',
     'provider': 'rtmp',
    'streamer': 'rtmp://wz6.dnip.com.br:1935/sampaiofmhd',
    'file': 'sampaiofmhd.stream',
    'modes': [
        {type: 'flash', src: 'http://900464851.r.cdn77.net/jwplayer/510/player.swf'},
    {type: 'html5', config:
        {
        'file': "http://wz6.dnip.com.br/sampaiofmhd/sampaiofmhd.stream/playlist.m3u8",
        provider: 'video'
        }
    }
    ]
  });
</script>
       <!-- /fim topo -->
        </div>
        <!-- dia e mes -->
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-right">

           <?php 
       		setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.iso-8859-1', 'portuguese' ); 
       		date_default_timezone_set( 'America/Sao_Paulo' );
       		echo ucfirst(strftime("%A, %d de %B de %Y", strtotime('today') )); 
			?>

       </div> <!-- /dia e mes -->
	</div>	  
   </div>
</div>
<!-- FIM DA BARRA TOPO -->

<!-- BARRA HEADER -->
<div class="container-fluid full-container" style="background:<?php if (isset($_GET['tema']) and $_GET['tema'] == 'azul'){ echo '#17066A;';} else { echo '#333';} ?>">
   <div class="container barra-header">
	<div class="col-lg-12 col-md-12">
   		<!-- SEARCH-->
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!-- LOGO -->
        	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="row">
		        <img class="img-responsive" src="<?php echo get_bloginfo('template_url'); ?>/img/logo.png"/>
                    </div>
             </div>
                <!-- TITULO -->
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
            	  <h1 style="font-size:68px">Rádio Sampaio</h1> 
                </div>
             <!-- LOGO 2 -->
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
              <div class="row">
                 <img class="img-responsive center-block" src="<?php echo get_bloginfo('template_url'); ?>/img/radio-am.png"/>        
                 <a class="center-block text-center" style="color:#FFFFFF !important; font-size:12px;" href="http://www.dnip.com.br/link/sampaioam.wmx" >[Clique e escute]</a>      
              </div>   
            </div>

            </div> <!-- / fim da linha das logos e player -->
          
        
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
                            <input type="text" class="form-control input-md" placeholder="Buscar" />
                            <span class="input-group-btn">
                                <button class="btn btn-warning btn-lg src" type="button">
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