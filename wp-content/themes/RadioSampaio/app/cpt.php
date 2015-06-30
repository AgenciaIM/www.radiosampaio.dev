<?php
///////////////////////////////////////
// Registrar Custom Post Type banner //
//////////////////////////////////////


/**
 * Adicionamos uma acção no inicio do carregamento do WordPress
 * através da função add_action( 'init' )
 */
add_action( 'init', 'create_post_type_banner' );

/**
 * Esta é a função que é chamada pelo add_action()
 */
function create_post_type_banner() {
    /**
     * Labels customizados para o tipo de post
     *
     */
    $labels = array(
        'name' => _x('Banners', 'post type general name'),
        'singular_name' => _x('Banner', 'post type singular name'),
        'add_new' => _x('Adicionar Novo', 'banner'),
        'add_new_item' => __('Adicionar Novo Banner'),
        'edit_item' => __('Editar Banner'),
        'new_item' => __('Novo Banner'),
        'all_items' => __('Todos os Banner'),
        'view_item' => __('Ver Banner'),
        'search_items' => __('Pesquisar Banner'),
        'not_found' =>  __('Banners não encontrado'),
        'not_found_in_trash' => __('Sem banners no lixo'),
        'parent_item_colon' => '',
        'menu_name' => 'Banners'
    );

    /**
     * Registamos o tipo de post film através desta função
     * passando-lhe os labels e parâmetros de controlo.
     */
    register_post_type( 'banner', array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,

            'show_in_menu' => true,
            'has_archive' => 'banners',
            'rewrite' => array(
                'slug' => 'banners',
                'with_front' => false,
            ),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 5,
            'menu_icon'           => 'dashicons-megaphone',
            'supports' => array('title', 'thumbnail')
        )
    );

    /**
     * Registamos a categoria de filmes para o tipo de post film
     */
    register_taxonomy( 'banner_category', array( 'banner' ), array(
            'hierarchical' => true,
            'label' => __( 'Categoria Banner' ),
            'labels' => array( // Labels customizadas
                'name' => _x( 'Categorias', 'taxonomy general name' ),
                'singular_name' => _x( 'Categoria', 'taxonomy singular name' ),
                'search_items' =>  __( 'Pesquisar Categoria' ),
                'all_items' => __( 'Todas as categorias' ),
                'parent_item' => __( 'Categoria Pai' ),
                'parent_item_colon' => __( 'Categoria Pai:' ),
                'edit_item' => __( 'Editar Categoriay' ),
                'update_item' => __( 'Update Categoria' ),
                'add_new_item' => __( 'Adicionar Nova Categoria' ),
                'new_item_name' => __( 'Nome da nova categoria' ),
                'menu_name' => __( 'Categoria' ),
            ),
            'show_ui' => true,
            'show_in_tag_cloud' => true,
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'banners/categoria',
                'with_front' => false,
            ),
        )
    );

    /**
     * Esta função associa tipos de categorias com tipos de posts.
     * Aqui associamos as tags ao tipo de post film.
     */
    register_taxonomy_for_object_type( 'tags', 'banner' );

}

// filtro de pesquisa de categoria
add_action( 'restrict_manage_posts', 'film_retrict_categories' );

function film_retrict_categories() {
    // Acesso às variáveis do tipo de post atual e o array do pedido
    global $typenow, $wp_query;

    // Se o tipo de post for diferente de film não faz nada
    if ( $typenow != 'banner' )
        return false;

    // Imprime uma select box com todos os termos da taxonomia film_category
    wp_dropdown_categories(array(
            'show_option_all' =>  'Mostrar tudo',
            'taxonomy'        =>  'banner_category',
            'name'            =>  'banner_category',
            'orderby'         =>  'name',
            'selected'        =>  $wp_query->query['term'],
            'hierarchical'    =>  true,
            'depth'           =>  3,
            'show_count'      =>  true,
            'hide_empty'      =>  true,
        )
    );
}



// add_action( 'admin_init', 'banner_add_caps');
/*
function banner_add_caps(){

    $admin_role = get_role( 'administrator' );
    $caps = array(
        'edit_produto',
        'edit_produtos',
        'edit_others_produtos',
        'publish_produtos',
        'read_produto',
        'read_private_produtos',
        'delete_produto'
    );

    foreach( $caps as $cap ){
        if( ! $admin_role->has_cap($cap) )
            $admin_role->add_cap( $cap );
    }
}
*/
function banner_activation() {
    // adiciono as novas capacidades
    banner_add_caps();

    // recarrego as regras de rewrite do WordPress
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'banner_activation' );


////////////////////////////
///////// META BOX /////////
////////////////////////////
add_action( 'add_meta_boxes', 'banner_add_meta_box' );

function banner_add_meta_box() {
    add_meta_box(
        'banner_metaboxid',
        'CONFIGURAÇÃO',
        'banner_inner_meta_box',
        'banner'
    );
}

// scripts e estilos de enfileiramento, mas apenas se is_admin
if(is_admin()) {
   // wp_enqueue_script('custom-js', get_template_directory_uri().'../js/custom-js.js');
   // wp_enqueue_style('jquery-ui-custom', get_template_directory_uri().'../css/jquery-ui-custom.css');
}


function banner_inner_meta_box( $banner ) {
    wp_nonce_field( basename(__FILE__), 'banner_meta_nonce' );
    $id = get_post_meta($banner->ID, '_image_banner', true);
    $image = wp_get_attachment_image_src($id, 'full-size');

    $image_src = '';

    $image_id = get_post_meta( $banner->ID, '_image_id', true );
    $image_src = wp_get_attachment_url( $image_id );


    ?>
    <table class="form-table">
        <p>
            <label for="realizador">NOME DO ANUNCIANTE</label>
            <br />
            <input type="text" name="nome_banner" value="<?php echo get_post_meta( $banner->ID, '_nome_banner', true ); ?>" />
        </p>

        <p>
            <label for="realizador">LINK DO ANUNCIANTE</label>
            <br />
            <input type="text" name="url_banner" value="<?php echo get_post_meta( $banner->ID, '_url_banner', true ); ?>" />
        </p>


        <img id="book_image" src="<?php echo $image_src ?>" style="max-width:100%;" />
        <input type="hidden" name="upload_image_id" id="upload_image_id" value="<?php echo $image_id; ?>" />
        <p>
            <a title="<?php esc_attr_e( 'Set book image' ) ?>" href="#" id="set-book-image"><?php _e( 'Set book image' ) ?></a>
            <a title="<?php esc_attr_e( 'Remove book image' ) ?>" href="#" id="remove-book-image" style="<?php echo ( ! $image_id ? 'display:none;' : '' ); ?>"><?php _e( 'Remove book image' ) ?></a>
        </p>


    </table>



    <script type="text/javascript">
        jQuery(document).ready(function($) {

            // save the send_to_editor handler function
            window.send_to_editor_default = window.send_to_editor;

            $('#set-book-image').click(function(){

                // replace the default send_to_editor handler function with our own
                window.send_to_editor = window.attach_image;
                tb_show('', 'media-upload.php?post_id=<?php echo $post->ID ?>&amp;type=image&amp;TB_iframe=true');

                return false;
            });

            $('#remove-book-image').click(function() {

                $('#upload_image_id').val('');
                $('img').attr('src', '');
                $(this).hide();

                return false;
            });

            // handler function which is invoked after the user selects an image from the gallery popup.
            // this function displays the image and sets the id so it can be persisted to the post meta
            window.attach_image = function(html) {

                // turn the returned image html into a hidden image element so we can easily pull the relevant attributes we need
                $('body').append('<div id="temp_image">' + html + '</div>');

                var img = $('#temp_image').find('img');

                imgurl   = img.attr('src');
                imgclass = img.attr('class');
                imgid    = parseInt(imgclass.replace(/\D/g, ''), 10);

                $('#upload_image_id').val(imgid);
                $('#remove-book-image').show();

                $('img#book_image').attr('src', imgurl);
                try{tb_remove();}catch(e){};
                $('#temp_image').remove();

                // restore the send_to_editor handler function
                window.send_to_editor = window.send_to_editor_default;

            }

        });
    </script>


<?php
}

add_action( 'save_post', 'banner_save_post', 10, 2 );

function banner_save_post( $banner_id, $banner ) {

    // Verificar se os dados foram enviados, neste caso se a metabox existe, garantindo-nos que estamos a guardar valores da página de filmes.
    if ( ! $_POST['nome_banner'] ) return;

    // Fazer a saneação dos inputs e guardá-los
    update_post_meta( $banner_id, '_nome_banner', strip_tags( $_POST['nome_banner'] ) );
    update_post_meta( $banner_id, '_url_banner', strip_tags( $_POST['url_banner'] ) );
    update_post_meta( $banner_id, '_image_id', $_POST['upload_image_id'] );

    return true;
}


add_filter( 'post_updated_messages', 'banner_updated_messages' );
function banner_updated_messages( $messages ) {
    global $post, $post_ID;

    $messages['banner'] = array(
        1 => sprintf( 'O Banner foi atualizado. <a href="%s">Ver Banner</a>', esc_url( get_permalink($post_ID) ) ),
        2 => 'Campo customizado atualizado',
        3 => 'Campo customizado apagado',
        4 => 'Banner atualizado',
        5 => isset( $_GET['revision'] ) ? sprintf( 'Banner atualizado para a revisão %s', wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( 'Banner publicado. <a href="%s">Ver Banner</a>', esc_url( get_permalink($post_ID) ) ),
        7 => 'Banner guardado.',
        8 => sprintf( 'Banner guardado. <a target="_blank" href="%s">Prever Banner</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( 'Banner agendado para: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Prever Banner</a>', date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID))),
        10 => sprintf( 'Rascunho do Banner guardado. <a target="_blank" href="%s">Prever Banner</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );

    return $messages;
}

add_action( 'contextual_help', 'banner_help_text', 10, 3 );

function banner_help_text( $contextual_help, $screen_id, $screen ) {
    if ( 'banner' == $screen->id ) {
        $contextual_help = file_get_contents( 'banner_help_text.html', true );
    } elseif ( 'edit-banner' == $screen->id ) {
        $contextual_help = file_get_contents( 'edit-banner_help_text.html', true );
    }
    return $contextual_help;
}

// COLUNAS DA PAGINA DE LISTAGEM AONDE FICAM OS NOMES //

add_filter( 'manage_edit-banner_columns', 'banner_manage_edit_columns' );
function banner_manage_edit_columns( $columns ) {

    $banner_columns = array(
        "cb" => $columns["cb"],
        "title" => $columns["title"],
        "nome_banner" => 'Anunciante',
        "url_banner" => 'Link',
        "banner_category" => 'Categoria',
        "upload_image_id" => 'Banner',
        "date" => $columns["date"],
    );
    return $banner_columns;

}


add_action( "manage_posts_custom_column", 'banner_manage_columns', 10, 2);
function banner_manage_columns( $column, $post_id ) {
    global $post;
    $image_id = get_post_meta( $post->ID, '_image_id', true );
    $image_src = wp_get_attachment_url( $image_id );
    switch ($column) {
        case "nome_banner":
            echo get_post_meta( $post->ID, '_nome_banner', true );
            break;

        case "url_banner":
            echo get_post_meta( $post->ID, '_url_banner', true );
            break;

        case "banner_category":
            /* Get the genres for the post. */
            $terms = get_the_terms( $post_id, 'banner_category' );

            /* If terms were found. */
            if ( !empty( $terms ) ) {

                $out = array();

                /* Loop through each term, linking to the 'edit posts' page for the specific term. */
                foreach ( $terms as $term ) {
                    $out[] = sprintf( '<a href="%s">%s</a>',
                        esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'banner_category' => $term->slug ), 'edit.php' ) ),
                        esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'banner_category', 'display' ) )
                    );
                }

                /* Join the terms, separating them with a comma. */
                echo join( ', ', $out );
            }

            /* If no terms were found, output a default message. */
            else {
                _e( 'Sem categoria' );
            }

            break;

        case "upload_image_id": ?>
            <img style="width:100px; heigth:auto;" src="<?php echo $image_src ?>" >
          <?php  break;

    }
}

// Definindo que colunas devem ter a capacidade de sortear
/*
add_filter( 'manage_edit-banner_sortable_columns', 'manage_banner_sortable_columns' );
function manage_banner_sortable_columns( $columns ) {
    $columns['nome_banner'] = 'nome';
    $columns['url_banner'] = 'url';
    return $columns;
}
*/
// Aqui lemos as variáveis que estão no URL e fazemos buscas como quisermos
/*
add_filter( 'request', 'banner_request' );
function banner_request( $vars ) {
    // Procuramos saber se o URL pede para sortear uma das colunas
    if ( isset( $vars['orderby'] ) ) {

        // Sorteamos por coluna
        switch ( $vars['orderby'] ) {

            case 'nome' :
                $vars = array_merge( $vars, array(
                    'meta_key' => '_nome_banner',
                    'orderby' => 'meta_value'
                ) );
                break;

            case 'url' :
                $vars = array_merge( $vars, array(
                    'meta_key' => '_url_banner',
                    'orderby' => 'meta_value'
                ) );
                break;
        }
    }
    return $vars;
}

add_filter( 'bulk_actions-edit-banner', 'banner_bulk_actions', 10, 1 );
function banner_bulk_actions( $actions ){
    unset( $actions['edit'] );
    return $actions;
}
*/

add_filter( 'views_edit-banner', 'banner_views', 10, 1 );
function banner_views( $views ){
// Pré-lançamento
    $class = ( isset( $_REQUEST['meta_value'] ) && $_REQUEST['meta_value'] == 'pre' ) ? 'current' : '';
    $preqp = query_posts('post_type=banner&meta_key=_estado_banner&meta_value=pre');
    $pre_cnt = count($preqp);
    $views['pre'] = 'pre ('.$pre_cnt.')';
    $estreiasqp = query_posts('post_type=film&meta_key=_estado_banner&meta_value=estreias');
    $estreias_cnt = count($estreiasqp);
// Estreias
    $class = ( isset( $_REQUEST['meta_value'] ) && $_REQUEST['meta_value'] == 'estreias' ) ? 'current' : '';
    $views['estreias'] = 'estreias ('.$estreias_cnt.')';
    isset($_REQUEST['meta_value'])? query_posts('post_type=banner&meta_key=_estado_banner&meta_value='.$_REQUEST['meta_value']): query_posts('post_type=banner');
    return $views;
}

?>