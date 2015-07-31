<?php /* Template Name: Pedidos */ ?>
<?php get_header();?>
<div class="container">
    <div class="row single">
    	<div class="col-lg-7">        	
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
               <h1 style="padding-bottom:20px;"><?php the_title();?></h1>
                         teste
               <p><?php the_content();?></p>
             <?php comments_template('/pedidos-comments.php'); ?>
            <?php endwhile; else : ?>
	        <p><?php _e( 'Desculpe, nenhum texto escrito nessa pagina.' ); ?></p>
            <?php endif; ?>
        </div>
       
        <div class="col-lg-5 sidebar-jornalismo">
	    <div class="col-lg-2">
            	<img class="bolha-jornalismo" src="<?php echo get_bloginfo('template_url'); ?>/img/bolha-vazia.png" />
            </div>
            <div class="col-lg-10 jornalismo">Jornalismo</div>
            <!-- LISTAGEM NEWS -->
            <div class="col-lg-1">&nbsp;</div>
            <div class="col-lg-3 miniatura-news" style="background:url('http://vanimg.s3.amazonaws.com/13-jquery-sliders-7.jpg'); 
            background-position:center center;background-size:cover;">

            </div>
            <div class="col-lg-8">
            	<h2>Notícia de 1 Noticia de 1</h2>
            	<a href="#">Detalhe da Notícia d Detalhe da Notícia d Det da Notícia dtalhe datícia...</a>
            </div>
            
            <div class="col-lg-12 espacamento">&nbsp;</div>
            
            <div class="col-lg-1">&nbsp;</div>            
            <div class="col-lg-3 miniatura-news" style="background:url('http://vanimg.s3.amazonaws.com/13-jquery-sliders-7.jpg'); 
            background-position:center center;background-size:cover;">

            </div>
            <div class="col-lg-8">
            	<h2>Notícia de 1 Noticia de 1</h2>
            	<a href="#">Detalhe da Notícia d Detalhe da Notícia d Det da Notícia dtalhe datícia...</a>
            </div>
            
            <div class="col-lg-12 espacamento">&nbsp;</div>
            
            <div class="col-lg-1">&nbsp;</div>                        
            <div class="col-lg-3 miniatura-news" style="background:url('http://vanimg.s3.amazonaws.com/13-jquery-sliders-7.jpg'); 
            background-position:center center;background-size:cover;">

            </div>
            <div class="col-lg-8">
            	<h2>Notícia de 1 Noticia de 1</h2>
            	<a href="#">Detalhe da Notícia d Detalhe da Notícia d Det da Notícia dtalhe datícia...</a>
            </div>
            
            <div class="col-lg-12 espacamento">&nbsp;</div>
            
            <div class="col-lg-1">&nbsp;</div>                        
            <div class="col-lg-3 miniatura-news" style="background:url('http://vanimg.s3.amazonaws.com/13-jquery-sliders-7.jpg'); 
            background-position:center center;background-size:cover;">

            </div>
            <div class="col-lg-8">
            	<h2>Notícia de 1 Noticia de 1</h2>
            	<a href="#">Detalhe da Notícia d Detalhe da Notícia d Det da Notícia dtalhe datícia...</a>
            </div>
	</div>
    </div>
    
    
</div> <!-- container-fluid -->
<?php get_footer();?>