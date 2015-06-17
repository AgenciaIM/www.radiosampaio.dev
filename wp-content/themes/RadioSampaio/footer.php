<?php wp_footer(); ?>
<div class="container-fluid full-container footer" style="background:<?php if (isset($_GET['tema']) and $_GET['tema'] == 'azul'){ echo '#17066A;';} else { echo '#333';} ?>">
	<div class="container">
    <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
    	<div class="col-lg-12">
        	<h1>Rádio Sampaio</h1>
            <h6>&copy;Copyright - <?php echo date('Y') ?> - Rádio Sampaio. Todos os direitos reservados.</h6>
            <h6>Rua José e Maria Passos, nº 25 - Centro - Palmeira dos Índios - AL.</h6>
        </div>
    </div>
   </div> 
</div>   
<div class="container-fluid full-container AgenciaInteractiveMonkey">
	<div class="container">
    	<div class="col-lg-12">
            <h6><a href="http://www.interactivemonkey.com.br" target="_blank">Desenvolvido por Agência Interactive MOnkey</a></h6>
        </div>
    </div>
</div>   

	<!-- Swiper JS -->
    <script src="<?php echo get_bloginfo('template_url'); ?>/js/swiper.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
		loop: true
    });
    </script> 
	 <script type="text/javascript">
			
			var colour = [
				"rgb(142, 68, 173)",
				"rgb(243, 156, 18)",
				"rgb(211, 84, 0)",
				"rgb(0, 106, 63)",
				"rgb(41, 128, 185)",
				"rgb(192, 57, 43)",
				"rgb(135, 0, 0)",
				"rgb(39, 174, 96)"
			];
			
			$(".free-wall .item").each(function() {
				var backgroundColor = colour[colour.length * Math.random() << 0];
				$(this).css({
					backgroundColor: backgroundColor
				});
			});

			$(function() {
				var wall = new Freewall("#freewall");
				wall.reset({
					selector: '.level1',
					cellW: 320,
					cellH: 160,
					fixSize: 0,
					gutterX: 20,
					gutterY: 10,
					onResize: function() {
						wall.fitZone();
					}
				});
				wall.fitZone();
				$(window).trigger("resize");
			});

		</script>
</body>
</html>