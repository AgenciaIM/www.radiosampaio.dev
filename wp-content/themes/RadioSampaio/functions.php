<?php


/* REMOVER VERSÃO DO BOX AGORA */
function my_admin_head() {
  $screen = get_current_screen();
  if(is_admin() && ($screen->id == 'dashboard')){
    echo '<style>.versions p, span#wp-version-message { display: none; } </style>';
  }
}

add_action('admin_head', 'my_admin_head');


/* REMOVER VERSÃO DO RODAPÉ */
function change_footer_version() {
  return 'Versão 1.0.0';
}
add_filter( 'update_footer', 'change_footer_version', 9999 );


/* MUDAR O TEXTO DO RODAPÉ DO PAINEL DE ADMIN */
function remove_footer_admin () {
  echo '© <a href="http://www.interactivemonkey.com.br/">Interactive MOnkey</a> - Desenvolvimento inteligente com padrões web e design';
}

add_filter('admin_footer_text', 'remove_footer_admin');


/* REMOVER ITEMS DA BARRA DE ADMIN */

function wps_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('about');
    $wp_admin_bar->remove_menu('wporg');
    $wp_admin_bar->remove_menu('documentation');
    $wp_admin_bar->remove_menu('support-forums');
    $wp_admin_bar->remove_menu('feedback');
}

add_action( 'wp_before_admin_bar_render', 'wps_admin_bar' );

/* REMOVENDO MENSAGEM DE ATUALIZAÇÃO */
add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );

/* WIDGET */
   add_theme_support( 'post-thumbnails' );

// Verificar widgets nas áreas de widgets
/* thumbnail */
function monkey_remove_default_image_sizes( $sizes) {
    unset( $sizes['thumbnail']);
    unset( $sizes['medium']);
    unset( $sizes['large']);    
    return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'monkey_remove_default_image_sizes');

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );       
	set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions
}
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'thumbnail', 150, 150, true ); //(cropped)
}

//////////////////////////////////
/// Definir a qualidade de imagens JPG
//////////////////////////////////

add_filter( 'jpeg_quality', 'wp_jpeg_quality' ); 
function wp_jpeg_quality() {
         return 80;
}

// Custom WordPress Login Logo
function my_login_logo() { ?>
<style type="text/css">
   body {
	   background:#Fee300
	}
	body.login div#login h1 a { 
		background: url(<?php echo get_bloginfo('template_directory'); ?>/img/login.png) no-repeat;
		width:100%;		
		height:107px;
	}
	body.login div#login form#loginform { 
		background:#CC0000;		border-radius:20px;
		-webkt-border-radius:20px;
		-moz-border-radius:20px;
		-ms-border-radius:20px;
		-o-border-radius:20px;
	}
	body.login div#login form#loginform p label {color:#ffffff}

	body.login div#login form#loginform input#user_login,
	body.login div#login form#loginform input#user_pass {color:#999999}	
	body.login div#login p#nav a,
	body.login div#login p#backtoblog a {color:#CC0000}


 </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
    return get_bloginfo( 'url' );
}

add_filter( 'login_headerurl', 'my_login_logo_url' );
 
function my_login_logo_url_title() {
    return 'Rádio Sampaio 92,5 FM & 870 AM';
}

add_filter( 'login_headertitle', 'my_login_logo_url_title' );


///////////////////////////
/// Limita o título dos posts na quantidade de caracteres desejado  //
//////////////////////////////
function title_limite($maximo) {
	$title = get_the_title();
	if ( strlen($title) > $maximo ) {
		$continua = '...';
	} else {
		$continua = '';
	}

$title = mb_substr( $title, 0, $maximo, 'UTF-8' );
	echo $title.$continua;
}

// para chamar a função use title_limite(20);

/*  PEGA IMAGEM POST*/
function pega_imagem_post() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		$first_img = $matches [1] [0];
		if(empty($first_img)){ //Defines a default image
			$first_img = "http://www.radiosampaio.com.br/wp-content/themes/radiosampaio/img/sem_foto.gif";
		}
	return $first_img;
}

////////////////////////////////////
/// Recuperando Audio da Postagem ////
///////////////////////////////////


function pega_audio_post() {
	global $post, $posts;
	$first_audio = '';
	ob_start();
	ob_end_clean();
		$output = preg_match('/http:\/\/[\w.\/-]++(?<=\.mp3)/', $post->post_content, $matches);
		$first_audio = $matches[0];
		$subst = "<a href='".$first_audio."' class='wpaudio'>".the_title()."</a>";	
		$first_audio = substr_replace($first_audio, $subst , 0);
	return $first_audio;
}

////////////////////////////////////
/// Recuperando Miniatura do Vídeo ////
///////////////////////////////////



function video_id(){			  
	$content = get_the_content();			
	
	$COM    = "youtube.com/watch?v=";
	$BR     = "youtube.com.br/watch?v=";
	$BE     = "youtu.be/";

	$stringCOM = strstr($content,$COM);
	$stringBR = strstr($content,$BR);
	$stringBE = strstr($content,$BE);

	if($stringCOM == true){
		$ID = substr($stringCOM,20,11);	
	}else if($stringBR == true){
		$ID = substr($stringBR,23,11);	
	} else if($stringBE == true){
		$ID = substr($stringBE,9,11);
	} else {
		$ID = "On8L9KQDx6I";	
	}
	echo $ID;
}



// force one-column dashboard
function shapeSpace_screen_layout_columns($columns) {
	$columns['dashboard'] = 1;
	return $columns;
}

add_filter('screen_layout_columns', 'shapeSpace_screen_layout_columns');

function shapeSpace_screen_layout_dashboard() { return 1; }
add_filter('get_user_option_screen_layout_dashboard', 'shapeSpace_screen_layout_dashboard');



// Novidades Interactive MOnkey

add_action('wp_dashboard_setup', 'interactivemonkey_news_dashboard_widgets');

function interactivemonkey_news_dashboard_widgets() {
    global $wp_meta_boxes;

    wp_add_dashboard_widget('custom_news_widget', 'Novidades | Interactive MOnkey', 'interactivemonkey_news_dashboard_help');
}

function interactivemonkey_news_dashboard_help() {
   echo 'Novidade';
}



// Listagem de Vídeo Tutoriais - Youtube

add_action('wp_dashboard_setup', 'interactivemonkey_custom_dashboard_widgets');

function interactivemonkey_custom_dashboard_widgets() {
    global $wp_meta_boxes;

    wp_add_dashboard_widget('custom_tutorial_widget', 'Vídeo Tutoriais | Suporte Interactive MOnkey', 'interactivemonkey_custom_dashboard_help');
}

function interactivemonkey_custom_dashboard_help() {
   tutorial_plugin();
}


function tutorial_plugin(){	// Seu usuário do YouTube
	$usuario = 'agenciaim';
	//$usuario = 'videosimprovaveis';
	
	// URL Somente da Playlist
	//$youTube_UserFeedURL = 'http://gdata.youtube.com/feeds/api/playlists/PL960C1BEF3CE332CA/?v=2&feature=plcp';
	
	// URL Todos os Vídeos
	$youTube_UserFeedURL = 'http://gdata.youtube.com/feeds/base/users/%s/uploads?orderby=updated&v=2';
	
	// Usa cURL para pegar o XML do feed
	$cURL = curl_init(sprintf($youTube_UserFeedURL, $usuario));
	curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($cURL, CURLOPT_FOLLOWLOCATION, true);
	$resultado = curl_exec($cURL);

	curl_close($cURL);
		// Inicia o parseamento do XML com o SimpleXML
	$xml = new SimpleXMLElement($resultado);
	
	$videos = array();
	
	// Passa por todos vídeos no RSS
	foreach ($xml->entry AS $video) {
	$url = (string)$video->link['href'];
	
	// Quebra a URL do vídeo para pegar o ID
	parse_str(parse_url($url, PHP_URL_QUERY), $params);
	$id = $params['v'];
	

	// Monta um array com os dados do vídeo
	$videos[] = array(
	'id' => $id,	'titulo' => (string)$video->title,

	'thumbnail' => 'http://i' . rand(1, 4) .'.ytimg.com/vi/'. $id .'/hqdefault.jpg',
	'url' => $url
	);
	}
	
	echo '<ul>';
				foreach ($videos AS $video) { ?>
						
					<li style="width:340px !important; float:left;margin-right:15px;">  
                      <h2 style="font-size:17px"><?php echo $video["titulo"] ?> <a href="<?php echo $video['url'] ?>" title="<?php echo $video["titulo"] ?>"><i class="glyphicon glyphicon-share"></i></a></h2>
                    <iframe width="340" height="260" src="//www.youtube.com/embed/<?php echo $video['id'] ?>" frameborder="0" allowfullscreen></iframe>                    
						<!--<img src="<?php //echo $video["thumbnail"] ?>" alt="<?php //echo $video["titulo"] ?>" width="150" /></a>-->					</li>
									<?php } 	echo '<div style="clear:both"></div></ul>';}
?>