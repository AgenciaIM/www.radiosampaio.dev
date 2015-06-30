<?php get_header(); ?>

<div class="container-fluid">
	<div class="container" style="margin-top:50px;min-height:150px;height:auto;position:relative">
    <div class="col-lg-10 col-lg-offset-1">
    	<img class="bolha" src="<?php echo get_bloginfo('template_url'); ?>/img/bolha.png" />
    	<div id="Slide" class="col-lg-6 no-padding">
           <!-- Swiper -->
            <div class="swiper-container">
                <div class="swiper-wrapper">					  
						  
							<?php query_posts('posts_per_page=7'); if (have_posts()) : while (have_posts()) : the_post(); ?>
							
							<?php
							if ( has_post_thumbnail() ) {
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
								$img = $image[0];
							} else {
								$img = pega_imagem_post();
							} ?>
							
							<div class="swiper-slide" style="background:url('<?php echo $img ?>');background-size:cover;background-position:center center;">
                    	<div class="swiper-detail">
                        	<h1><a href="<?php the_permalink() ?>"><?php title_limite(100); ?></a></h1>
                        	<p><a href="#<?php the_permalink(); ?>"><?php the_excerpt_im(47); ?></a></p>
                        </div>
                    </div>
						  
							<?php endwhile; endif; ?>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Add Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
        <div class="col-lg-4 news full-container">
        	<div class="col-lg-2">
            	<img class="bolha-jornalismo" src="<?php echo get_bloginfo('template_url'); ?>/img/bolha-vazia.png" />
            </div>
            <div class="col-lg-10 jornalismo">Jornalismo</div>
            <!-- LISTAGEM NEWS -->
            
            <!--<div class="col-lg-3 miniatura-news" style="background:url('http://vanimg.s3.amazonaws.com/13-jquery-sliders-7.jpg'); background-position:center center;background-size:cover;">

            </div>-->
            
				<?php query_posts('posts_per_page=3'); if (have_posts()) : while (have_posts()) : the_post(); ?>
							
							<?php
							if ( has_post_thumbnail() ) {
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
								$img = $image[0];
							} else {
								$img = pega_imagem_post();
							} ?>
							<div class="col-lg-3 miniatura-news" style="background:url('<?php echo $img ?>'); background-position:center center;background-size:cover;">

							</div>
							<div class="col-lg-8">
								<h2><?php title_limite(30) ?></h2>
								<a href="<?php the_permalink()?>" class="mini-a"><?php the_excerpt_im(65); ?></a>
							</div>
						  
						   <div class="col-lg-12 espacamento">&nbsp;</div>
							<?php endwhile; endif; ?>
        </div>   
			
			<div class="col-lg-2 col-md-2 full-container">
				<img class="img-resposive" src="<?php echo get_bloginfo('template_url'); ?>/img/promocoes.jpg" style="width:100%" />
			</div>
        <!-- LISTAGEM NEWS -->
	</div><!-- container -->
  </div>  
</div><!-- container-fluid -->

<div class="container-fluid blogs">
	<div class="container">
    <div class="col-lg-10 col-lg-offset-1">
	    <div class="col-lg-12" style="margin-bottom:40px;">
    	    <img style="margin-left:-15px;left:50%;position:relative" src="<?php echo get_bloginfo('template_url'); ?>/img/blog.png" />
        </div>
      
		<?php
					$authors = get_users('role=author');
						if(isset($authors) && !empty($authors)){
							 foreach($authors as $author) {
								  $posts = get_posts(array('author'=>$author->ID, 'posts_per_page'   => 1));
								  if(isset($posts) && !empty($posts)) { 
										foreach($posts as $post){
											$p = get_post( $post->ID );
											setup_postdata( $p );
											?>
										  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 full-container">
												<div class="col-lg-4 col-md-4 col-sm-4 col-xs-3">
													<a id="bloguista" class="btn bloguista" href="#" data-content="<?php the_author_meta('description'); ?>" data-placement="top" data-title="<?php echo esc_html( $author->display_name )?>" data-trigger="hover">
														<?php echo userphoto($author->ID) ; ?>
													</a>
												</div>
												<div class="col-lg-8 col-md-8 col-sm-8 col-xs-9 blog-conteudo">
													<h1><?php echo $post->post_title; ?></h1>
													<a href="<?php the_permalink() ?>"><?php the_excerpt_im(100); ?></a>
												</div>
											</div>
										<?php 
										}
								  }
							 }							 
						}
					?>
        </div>    
	</div>
</div>

<div class="container-fluid full-container barra-meio">
		<!--BARRA LETT-->
        
    	<div class="col-lg-6" style="padding:20px;">
			<div class="col-lg-12 evento-principal full-container">        	
                <img class="img-responsive pull-right" src="<?php echo get_bloginfo('template_url'); ?>/img/evento-p.jpg" />
                <a href="#" class="plus"><i class="glyphicon glyphicon-search">&nbsp;</i></a>            
            </div>    
        </div>
        <!--BARRA LEFT-->
        
        <!--BARRA RIGHT-->
        <div class="col-lg-6 barra-right" style="background:url(<?php echo get_bloginfo('template_url'); ?>/img/bg-eventos-2.png) <?php if (isset($_GET['tema']) and $_GET['tema'] == 'azul'){ echo '#17066A;';} else { echo '#333';} ?>;background-size:cover;background-position:center center">
        
			<!--###########################################################################################3333333-->
				<div class="grid-evento">
					<ul class="list-group">
					<?php query_posts('posts_per_page=20'); if (have_posts()) : while (have_posts()) : the_post(); ?>
							
							<?php
							if ( has_post_thumbnail() ) {
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
								$img = $image[0];
							} else {
								$img = pega_imagem_post();
							} ?>
								<li class="grid-item list-group-item">
									<a href="#">
										<img src="<?php echo $img ?>"/>
										<div class="oculta">Lorem ipsum do texto do evento como data e hora e nome do evento</div>
									</a>
								</li>
					  <?php endwhile; endif; ?>
					</ul>
				</div>
		  
			<!--####################################################################################-->
        	
        </div>
    	<!--BARRA RIGHT-->
</div>

<div class="container-fluid barra-pedidos">
	<div class="container" style="border-bottom:3px dotted #999;padding-bottom:50px;">
    <div class="col-lg-10 col-lg-offset-1">
		<div class="col-lg-4">	    
            <div class="col-lg-2">
                <img class="bolha-pedido" src="<?php echo get_bloginfo('template_url'); ?>/img/bolha-vazia.png" />
            </div>
            <div class="col-lg-10 pedido">Pedidos Musicais</div>
            <ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#pedidos" aria-controls="pedidos" role="tab" data-toggle="tab">Pedidos</a></li>
					<li role="presentation"><a href="#facaPedidos" aria-controls="facaPedidos" role="tab" data-toggle="tab">Faça seu pedido</a></li>
			  </ul>
				
				
				<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade in active" id="pedidos">
						<div class="col-lg-4 foto-pedido-musical img-circle" style="background:url('http://vanimg.s3.amazonaws.com/13-jquery-sliders-7.jpg');
																	background-position:center center;background-size:cover;">

						</div>
						<div class="col-lg-8" style="padding-right:0;">
							<h5>Fulano de Tal e Tal</h5>
							<p>Olá Querido Locutor Gostaria de Pedir a música de Tal cantor e oferecer pra toda a minha família. Obrigado.</p>
						</div>
						
						<div class="col-lg-4 foto-pedido-musical img-circle" style="background:url('http://vanimg.s3.amazonaws.com/13-jquery-sliders-7.jpg');
																	background-position:center center;background-size:cover;">

						</div>
						<div class="col-lg-8" style="padding-right:0;">
							<h5>Fulano de Tal e Tal</h5>
							<p>Olá Querido Locutor Gostaria de Pedir a música de Tal cantor e oferecer pra toda a minha família. Obrigado.</p>
						</div>
						
						<div class="col-lg-4 foto-pedido-musical img-circle" style="background:url('http://vanimg.s3.amazonaws.com/13-jquery-sliders-7.jpg');
																	background-position:center center;background-size:cover;">

						</div>
						<div class="col-lg-8" style="padding-right:0;">
							<h5>Fulano de Tal e Tal</h5>
							<p>Olá Querido Locutor Gostaria de Pedir a música de Tal cantor e oferecer pra toda a minha família. Obrigado.</p>
						</div>
						
						<div class="col-lg-4 foto-pedido-musical img-circle" style="background:url('http://vanimg.s3.amazonaws.com/13-jquery-sliders-7.jpg');
																	background-position:center center;background-size:cover;">

						</div>
						<div class="col-lg-8" style="padding-right:0;">
							<h5>Fulano de Tal e Tal</h5>
							<p>Olá Querido Locutor Gostaria de Pedir a música de Tal cantor e oferecer pra toda a minha família. Obrigado.</p>
						</div>
						
						<div class="col-lg-4 foto-pedido-musical img-circle" style="background:url('http://vanimg.s3.amazonaws.com/13-jquery-sliders-7.jpg');
																	background-position:center center;background-size:cover;">

						</div>
						<div class="col-lg-8" style="padding-right:0;">
							<h5>Fulano de Tal e Tal</h5>
							<p>Olá Querido Locutor Gostaria de Pedir a música de Tal cantor e oferecer pra toda a minha família. Obrigado.</p>
						</div>
					
					
					</div>
					<div role="tabpanel" class="tab-pane fade" id="facaPedidos">Inserir Formulário de Pedido Musical</div>
			  </div>
				
            
            
    	</div>
        
        <div class="col-lg-4">	  
        	<?php if (function_exists('enquetez_im')){
							enquetez_im(2);
			} ?>
        </div>
        
        <div class="col-lg-4">	  
        	 <img class="img-responsive pub" src="<?php echo get_bloginfo('template_url'); ?>/img/pub.jpg" />
        	 <img class="img-responsive pub" src="<?php echo get_bloginfo('template_url'); ?>/img/pub.jpg" />
             <img class="img-responsive pub" src="<?php echo get_bloginfo('template_url'); ?>/img/pub.jpg" />
             <img class="img-responsive pub" src="<?php echo get_bloginfo('template_url'); ?>/img/pub.jpg" />
             <img class="img-responsive pub" src="<?php echo get_bloginfo('template_url'); ?>/img/pub.jpg" />
        </div>
    </div>
   </div> 
</div>


<div class="container-fluid barra-social">
	<div class="container">
    <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-xs-12">
		<div class="col-lg-5 col-lg-offset-4 col-md-7 col-md-offset-3 col-sm-8 col-sm-offset-4 col-xs-12" style="text-align:center;padding-top:30px;font-size:18px;">	 
        	PARTICIPE DAS NOSSAS REDES SOCIAIS
    	</div>
        <div class="col-lg-5 col-lg-offset-4 col-md-7 col-md-offset-3 col-sm-8 col-sm-offset-4 col-xs-12" style="padding-top:30px;text-align:center">
        	<a href="#"><img class="" src="<?php echo get_bloginfo('template_url'); ?>/img/facebook.png" /></a>
        	<a href="#"><img class="" src="<?php echo get_bloginfo('template_url'); ?>/img/twitter.png" /></a>
            <a href="#"><img class="" src="<?php echo get_bloginfo('template_url'); ?>/img/instagram.png" /></a>
            <a href="#"><img class="" src="<?php echo get_bloginfo('template_url'); ?>/img/google.png" /></a>
            <a href="#"><img class="" src="<?php echo get_bloginfo('template_url'); ?>/img/youtube.png" /></a>
            <a href="#"><img class="" src="<?php echo get_bloginfo('template_url'); ?>/img/rss.png" /></a>
        </div>
    </div>
   </div> 
</div>

<div class="clearfix">&nbsp;</div>
<?php get_footer(); ?>
