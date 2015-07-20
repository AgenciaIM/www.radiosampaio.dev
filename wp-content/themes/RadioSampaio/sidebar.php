          <div class="row" style="margin-top:95px">
             <?php if ( is_sidebar_active('primary_widget_area') ) : ?>
               
                         <?php dynamic_sidebar('primary_widget_area'); ?>
                  
             <?php endif; ?>  
 
             <?php if ( is_sidebar_active('secondary_widget_area') ) : ?>
                 
                         <?php dynamic_sidebar('secondary_widget_area'); ?>
                  
                
             <?php endif; ?>

           
            <!-- Side Widget Well -->
            <div class="well">
                <h4>Titulo aqui</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
            </div>
         </div>
  