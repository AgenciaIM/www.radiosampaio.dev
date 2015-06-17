<?php get_header();?>

<div class="container-fluid">
    <div class="container">
    	 <div class="row">
	         <div class="pull-left col-lg-8 destaques">
				<img src="<?php echo $DIR ?>/img/icon.png" alt="icon" style="margin-top:-15px;"> Contato
         	</div>
         </div>
         <div class="row">         
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
             	<div class="col-lg-6 col-md-6 col-sm-6 col-sx-12" style="margin-top:40px">
                	<?php echo do_shortcode('[contact-form-7 id="67" title="Formulário de contato 1"]'); ?>
                
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-sx-12">
                <h2>Encontre-nos</h2>
               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3933.9260264332015!2d-35.760414!3d-9.601654!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x70148bfda589175%3A0x3ae66144c3bd8fa3!2zUnVhIFPDo28gTHXDrXMsIDE2NCAtIFBldHLDs3BvbGlz!5e0!3m2!1spt-BR!2sbr!4v1403040313995" width="100%" height="460" frameborder="0" style="border:0"></iframe>
                </div>
            </div> <!-- col-lg-12 -->
		 </div>
    </div> <!-- container -->
</div> <!-- container-fluid -->

<?php get_footer();?>