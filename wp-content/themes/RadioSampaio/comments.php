<?php
// Do not delete these lines
    if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die ('Por favor não digite esta URL diretamente. Obrigado!');
 
    if ( post_password_required() ) { ?>
        <p class="nocomments">Este artigo está protegido por senha. Insira-a para ver os comentários.</p>
    <?php
        return;
    }
?>
 
 <h3><?php comments_number('0 Comentários', '1 Comentário', '% Comentários' );?></h3>
     <?php if ( have_comments() ) : ?>
         <ol class="commentlist">
        	<?php wp_list_comments('avatar_size=40&type=comment'); ?>
    	</ol>
 
        <?php if ($wp_query->max_num_pages > 1) : ?>
        <div class="pagination">
        	<ul>
          	  <li class="older"><?php previous_comments_link('Anteriores'); ?></li>
            	  <li class="newer"><?php next_comments_link('Novos'); ?></li>
       		</ul>
    	</div>
    <?php endif; ?>
 
    <?php endif; ?>
 
    <?php if ( comments_open() ) : ?>
 
    <div id="respond">
            <h3>Deixe o seu comentário!</h3>
 
            <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">            
                <?php if ( $user_ID ) : ?>
 
                <p>Autentificado como <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(); ?>" title="Sair desta conta">Sair desta conta <i class="glyphicon glyphicon-remove-sign"></i></a></p>
 
                <?php else : ?>
                    <label class="coment-tit" for="author">Nome:</label>
                    <input class="coment-input" type="text" name="author" id="author" value="<?php echo $comment_author; ?>" />
                    <label class="coment-tit" for="email">Email:</label>
                    <input class="coment-input" type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" />

                <?php endif; ?> 
                    <label for="comment">Mensagem:</label>
                    <textarea name="comment" class="coment-textarea" id="comment" rows="" cols=""></textarea>
                    <input type="submit" class="form-button" value="Comentar" />
                <?php comment_id_fields(); ?>
                <?php do_action('comment_form', $post->ID); ?>
            
        </form>
        <p class="cancel"><?php cancel_comment_reply_link('Cancelar Resposta'); ?></p>
        </div>
     <?php else : ?>
        <h3>Os comentários estão fechados.</h3>	<?php endif; ?>