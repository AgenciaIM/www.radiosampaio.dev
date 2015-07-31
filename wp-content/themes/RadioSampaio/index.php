<?php get_header(); ?>
<div class="container-fluid">
	<div class="container" style="margin-top:50px;min-height:150px;height:auto;position:relative">
    <div class="row">
    	<img class="bolha" src="<?php echo get_bloginfo('template_url'); ?>/img/balao-destaque.png" />
    	<div id="Slide" class="col-lg-5 no-padding">
           <!-- Swiper -->
            <div class="swiper-container" style="margin-top:30px">
                <div class="swiper-wrapper">					  
						  
							<?php query_posts('posts_per_page=7'); if (have_posts()) : while (have_posts()) : the_post(); ?>
							
							<?php
							if ( has_post_thumbnail() ) {
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail-slider' );
								$img = $image[0];
							} else {
								$img = pega_imagem_post();
							} ?>
							
                                                      <div class="swiper-slide img-responsive" style="background:url('<?php echo $img; ?>'); background-position:center top; background-size:cover;"> 
                           

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
        <div class="col-lg-5 news full-container">
        	<div class="col-lg-2">
            	<img class="bolha-jornalismo" src="<?php echo get_bloginfo('template_url'); ?>/img/bolha-vazia.png" />
            </div>
            <div class="col-lg-10 jornalismo">Jornalismo</div>
            <!-- LISTAGEM NEWS -->
            
            <!--<div class="col-lg-3 miniatura-news" style="background:url('http://vanimg.s3.amazonaws.com/13-jquery-sliders-7.jpg'); background-position:center center;background-size:cover;">

            </div>-->
            
				<?php query_posts('showposts=3'); if (have_posts()) : while (have_posts()) : the_post(); ?>          
							<div class="col-lg-4">
                                                        <?php
                                                            if ( has_post_thumbnail() ) {
                                                                the_post_thumbnail( 'thumbnail-jornalismo', array( 'class'  => 'img-responsive' ) );
                                                            } 
                                                        ?>

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
    <!-- blog -->
    <div class="row">
	    <div style="margin-bottom:40px; padding-top:20px; border-top: 1px dashed #000000">
    	       <img style="margin-left:-15px;left:50%;position:relative" src="<?php echo get_bloginfo('template_url'); ?>/img/blog.png" />
            </div>

    <!-- CAROSEL -->
            <div id="myCarousel1" class="carousel slide">
                <!-- Carousel items -->
                <div class="carousel-inner">
                             <?php                                    
                               $authors = get_users('role=author');                           
                               if(isset($authors) && !empty($authors)){   
                                 $i=0; // counter                       
                                 foreach($authors as $author) {   

                                 if($i%3==0) { 
					if($i == 0 ){
                                           $active = 'active';
                                        }else{
                                         $active = '';
                                        }
					?>
                                 <div class="item <?php echo $active; ?>">
                                    <div class="row">
                                  <?php } 
                     
                     
                                 $posts = get_posts(array('author'=>$author->ID, 'posts_per_page'   => 1));
                                 if(isset($posts) && !empty($posts)) {                
                                 foreach($posts as $post){             
                                 $p = get_post( $post->ID );             
                                 setup_postdata( $p );                                 
                             ?> 
                            <!-- LOOP DOS BLOGS -->
                            
                                           
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 full-container">
		                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-3">                                                                        
		                      <a id="bloguista" class="btn bloguista" href="#" data-content="<?php the_author_meta('description'); ?>" data-placement="top" data-title="<?php echo esc_html( $author->display_name )?>" data-trigger="hover">							            
                                       <?php echo get_avatar($author->ID, '100'); ?>
			               </a>
		                    </div>
			            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-9 blog-conteudo">
			                    <h1><?php echo $post->post_title; ?></h1>
			                       <a href="<?php the_permalink() ?>"><?php the_excerpt_im(100); ?></a>
			                </div>
		          
                            </div>
                            <!-- /FIM DO LOOP -->

  <?php 
			}
		      }
                        $i++;
                        if($i%3==0) { ?>
                                 </div>
                        <!--/row -->
                    </div>
                    <!--/item -->    
                        <?php }
 
		   }	
             
		if($i%3!=0) { ?>
		</div>
                        <!--/row teste -->
                    </div>
                    <!--/item teste --> 
		<?php } 			

			 
		}
	    ?>

            

                </div>
                <!-- /carousel-inner --> 

               <a class="left carousel-blog" href="#myCarousel1" data-slide="prev">‹</a>
               <a class="right carousel-blog glyphicon glyphicon-menu-right" href="#myCarousel1" data-slide="next">></a>

            </div>
            <!--/myCarousel -->
   
         </div>    
      </div>
</div>

<!--  BARRA DO MEIO  EVENTOS -->
<div class="container-fluid full-container">
    <div class="container" style="margin-top:10px; margin-bottom: 40px; padding-top:20px; border-top: 1px dashed #000000">
        <img style="margin-left:-15px;left:50%;position:relative" src="<?php echo get_bloginfo('template_url'); ?>/img/eventos.png" />
    </div>
</div>
<div class="container-fluid full-container barra-meio">
   
        <!--BARRA LETT-->
    	<div class="col-lg-6" style="padding:20px 0;">
               
		<div class="col-lg-12 evento-principal full-container"> 
                <div class="col-md-9 pull-right">         	
                <img class="img-responsive" src="<?php echo get_bloginfo('template_url'); ?>/img/evento-p.jpg" />
               <!-- <a href="#" class="plus"><i class="glyphicon glyphicon-search">&nbsp;</i></a> -->
               <div class="funto-texto" style="color:#fff"> 
                   <p class="color:#fff;">lorem ipsum loerem impsiy uy u yuyuuu</p>
               </div>  
               </div>        
            </div> 
        </div>
        <!--BARRA LEFT-->
      
        <!--BARRA RIGHT-->
        
        <div class="col-lg-6 barra-right" style="background:url(<?php echo get_bloginfo('template_url'); ?>/img/bg-eventos-3.png) <?php if (isset($_GET['tema']) and $_GET['tema'] == 'azul'){ echo '#17066A;';} else { echo '#333';} ?>;background-size:cover;background-position:center center">
        
			<!-- ###########################################################################################3333333 -->
				<div class="grid-evento col-md-10" style="padding-top:20px; margin-left:-3%;">
                                
					
					<?php query_posts('posts_per_page=4'); if (have_posts()) : while (have_posts()) : the_post(); ?>
							
							<?php
							if ( has_post_thumbnail() ) {
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail-eventos' );
								$img = $image[0];
							} else {
								$img = pega_imagem_post();
							} ?>
								<div class="col-md-6">
                                                                  <a href="#" class="thumbnail-eventos">
										<img class="img-responsive" src="<?php echo $img ?>" alt="Generic placeholder thumbnail" />
                                                         <div class="funto-texto2" style="color:#fff">        
                                                         <p style="font-size:12px;" class="color:#fff;">lorem ipsum loerem impsiy uy u yuyuuu</p>
                                                         </div>                  
                                        
									
									</a>
                                                                </div>
                                                             
					  <?php endwhile; endif; ?>
				
				</div>
			<!-- #################################################################################### -->
        	
        </div>

    	<!--BARRA RIGHT-->
        
</div>

<div class="container-fluid barra-pedidos">
	<div class="container" style="border-bottom:3px dotted #999;padding-bottom:50px;">
          <div class="row">
  
	  <div class="col-lg-4">	    
            <div class="col-lg-2">
                <img class="bolha-pedido" src="<?php echo get_bloginfo('template_url'); ?>/img/bolha-vazia.png" />
            </div>
            <div class="col-lg-11 pedido col-md-offset-1">Pedidos Musicais</div>
            <ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#pedidos" aria-controls="pedidos" role="tab" data-toggle="tab">Pedidos</a></li>
					<li role="presentation"><a href="#facaPedidos" aria-controls="facaPedidos" role="tab" data-toggle="tab">Faça seu pedido</a></li>
			  </ul>
				
				
				<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade in active" id="pedidos"

                 <?php    

                    $args = array (
	                                      'pagename'  => 'pedidos-musicais',
                                              );
                                              // The Query
                                              $query = new WP_Query( $args );
                                              // O Loop
                                              while ( $query->have_posts() ) : $query->the_post();

                      
                    $comments = get_comments( array(
                    'post_id' => get_the_ID(),
                    'status' => 'approve',
                 ) );
                    if ( !empty( $comments ) )
                {
                   
                    wp_list_comments( array(
                   'callback' => 'listarpedidos',
                   'type'     => 'comment',
               ), $comments );
                  
              }
endwhile; wp_reset_query();
                                              
                                   ?>

					</div>
					<div role="tabpanel" class="tab-pane fade" id="facaPedidos" style="padding-top:10px;">
                                             
                                             <?php 
                                              $args = array (
	                                      'pagename'  => 'pedidos-musicais',
                                              );
                                              // The Query
                                              $query = new WP_Query( $args );
                                              // O Loop
                                              while ( $query->have_posts() ) : $query->the_post();
                                             /* $withcomments = "1";
                                             comments_template('/pedidos-comments.php'); */
                                             comment_form(array( 'comment_notes_after' => '', 'title_reply'=>'Pedidos Musicais' )); 
                                              endwhile; wp_reset_query(); ?>                                        
                                        </div>
			  </div>      
            
    	</div>
        
        <div class="col-lg-3 enquete no-padding">
             <div class="col-lg-2">
                <img class="bolha-pedido-cinza" src="<?php echo get_bloginfo('template_url'); ?>/img/bolha-vazia-cinza.png" />
            </div>
	     <div class="col-lg-12 pedido-cinza no-padding">Enquete</div>
                <?php if (function_exists('vote_poll') && !in_pollarchive()): ?>
                        <ul>
                            <li><?php get_poll(1);?></li>
                        </ul>  
                 <?php endif; ?>

        	   <?php /* if (function_exists('enquetez_im')){
							enquetez_im(2);
			} */ ?>
        </div>
        
        <div class="col-lg-5">
                <div class="col-lg-6"><img class="img-responsive pub" src="<?php echo get_bloginfo('template_url'); ?>/img/pub.jpg" /> </div>
               <div class="col-lg-6"><img class="img-responsive pub" src="<?php echo get_bloginfo('template_url'); ?>/img/pub.jpg" /> </div>
               <div class="col-lg-6"><img class="img-responsive pub" src="<?php echo get_bloginfo('template_url'); ?>/img/pub.jpg" /> </div>
               <div class="col-lg-6"><img class="img-responsive pub" src="<?php echo get_bloginfo('template_url'); ?>/img/pub.jpg" /> </div>
               <div class="col-lg-6"><img class="img-responsive pub" src="<?php echo get_bloginfo('template_url'); ?>/img/pub.jpg" /> </div>
               <div class="col-lg-6"><img class="img-responsive pub" src="<?php echo get_bloginfo('template_url'); ?>/img/pub.jpg" /> </div>
              <div class="col-lg-6"><img class="img-responsive pub" src="<?php echo get_bloginfo('template_url'); ?>/img/pub.jpg" /> </div>
              <div class="col-lg-6"><img class="img-responsive pub" src="<?php echo get_bloginfo('template_url'); ?>/img/pub.jpg" /> </div>
              <div class="col-lg-6"><img class="img-responsive pub" src="<?php echo get_bloginfo('template_url'); ?>/img/pub.jpg" /> </div>
              <div class="col-lg-6"><img class="img-responsive pub" src="<?php echo get_bloginfo('template_url'); ?>/img/pub.jpg" /> </div>
        </div>
    </div>
   </div> 
</div>

<div class="container-fluid barra-social">
	<div class="container">
    <div class="col-lg-12 col-md-12 col-sm-10 col-xs-12">
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
