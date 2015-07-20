<?php
/**
 * Created by PhpStorm.
 * User: interactive monkey
 * Date: 26/06/2015
 * Time: 11:06
 */



/////////////////////////////////////////////////////////////
add_action( 'add_meta_boxes', 'banner_add_meta_box' );

function banner_add_meta_box() {
    add_meta_box(
        'banner_metaboxid', // $id
        'CONFIGURAÇAO', // $titulo
        'banner_inner_meta_box', // $callback
        'banner', // $page
        'normal', // $context
        'high' // $priority
    );
}




// Field Array
$prefix = 'custom_';
$custom_meta_fields = array(
    array(
        'label'	=> 'NOME DO ANUNCIANTE',
        'desc'	=> 'Insira o nome da empresa do Anunciante',
        'id'	=> '_titulo_banner',
        'type'	=> 'text'
    ),
    array(
        'label'	=> 'LINK DO ANUNCIANTE',
        'desc'	=> 'Insira sempre na frente do link o protocolo "http://"',
        'id'	=> '_url_banner',
        'type'	=> 'text'
    ),
    array(
        'label'	=> 'BANNER',
        'desc'	=> 'Botão pra inserir o Banner.',
        'id'	=> '_imagem_banner',
        'type'	=> 'image'
    ),
);

// scripts e estilos de enfileiramento, mas apenas se is_admin
if(is_admin()) {
    wp_enqueue_script('custom-js', get_template_directory_uri().'/js/custom-js.js');
    wp_enqueue_style('jquery-ui-custom', get_template_directory_uri().'/css/jquery-ui-custom.css');
}




// The Callback (o retorno de chamada)
function banner_inner_meta_box() {
    global $custom_meta_fields, $banner;
    // Use nonce para verificação
    echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
    /*
       function banner_inner_meta_box( $banner ) {
           ?>
           <p>
               <label for="url">URL:</label>
               <br />
               <input type="url" name="url_banner" value="<?php echo get_post_meta( $banner->ID, '_url_banner', true ); ?>" />
           </p>
       <?php
       }
    */


    // Comece a tabela de campo e loop
    echo '<table class="form-table">';
    foreach ($custom_meta_fields as $field) {
        // obter o valor deste campo se ele existir para este post
        $meta = get_post_meta($banner->ID, $field['id'], true);
        // começar uma linha da tabela com
        echo '<pre>';
        print_r($meta);
        echo '</pre>';

        echo '<tr>
				<th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
				<td>';
        switch($field['type']) {
            // text
            case 'text':
                echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="40" />
								<br /><span class="description">'.$field['desc'].'</span>';
                break;

            // text
            case 'text':
                echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="50" />
								<br /><span class="description">'.$field['desc'].'</span>';
                break;

            // image
            case 'image':
                $image = get_template_directory_uri().'/img/image.png';
                echo '<span class="custom_default_image" style="display:none">'.$image.'</span>';
                if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium');	$image = $image[0]; }
                echo	'<input name="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$meta.'" />
									<img src="'.$image.'" class="custom_preview_image" alt="" /><br />
										<input class="custom_upload_image_button button" type="button" value="Baixar Imagem" />
										<small>&nbsp;<a href="#" class="custom_clear_image_button">Remove Imagem</a></small>
										<br clear="all" /><span class="description">'.$field['desc'].'</span>';
                break;

        } //end switch
        echo '</td></tr>';
    } // end foreach
    echo '</table>'; // end table
}


// Save the Data
function save_custom_meta($banner_id) {
    global $custom_meta_fields;

    // verify nonce
    if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
        return $banner_id;
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $banner_id;
    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $banner_id))
            return $banner_id;
    } elseif (!current_user_can('edit_post', $banner_id)) {
        return $banner_id;
    }

    // loop through fields and save the data
    foreach ($custom_meta_fields as $field) {
        $new = $_POST[$field['id']];
        if ($new && $new != $old) {
            update_post_meta($banner_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($banner_id, $field['id'], $old);
        }
    } // enf foreach

}
add_action('save_post', 'save_custom_meta');