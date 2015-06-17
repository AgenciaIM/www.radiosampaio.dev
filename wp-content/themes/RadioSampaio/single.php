<?php get_header();?>
<div class="container-fluid">
    <div class="container single">
    	<div class="col-lg-7">
        	<div class="col-lg-12">
                <h1>Ao contrário do que se acredita, Lorem I?</h1>
                <p>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.</p>
             </div>
             
             <div class="col-lg-7" style="position:relative">
			    <?php if (have_posts()): while (have_posts()) : the_post(); ?>                               
		         	<?php comments_template(); ?>              
               	<?php endwhile; else: ?> 
                <?php endif; ?> 
             </div>   
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