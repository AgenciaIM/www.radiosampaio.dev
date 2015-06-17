<?php
/*
* Plugin Name: Multiple Polls
* Version: 1.0
* Plugin URI: http://interactivemonkey.com.br/wp-plugin/mtp-polls
* Author: Agência Interactive Monkey
* Author URI: http://interactivemonkey.com.br/
* Description: Sistema de gerenciamento de enquete super simples e fácil de utilizar.
* License: GPLv2
*/
/*
*      Copyright 2015 Agência Interactive MOnkey <interactivemonkey@hotmail.com>
*
*      This program is free software; you can redistribute it and/or modify
*      it under the terms of the GNU General Public License as published by
*      the Free Software Foundation; either version 3 of the License, or
*      (at your option) any later version.
*
*      This program is distributed in the hope that it will be useful,
*      but WITHOUT ANY WARRANTY; without even the implied warranty of
*      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*      GNU General Public License for more details.
*
*      You should have received a copy of the GNU General Public License
*      along with this program; if not, write to the Free Software
*      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
*      MA 02110-1301, USA.
*/
if (strcmp(basename($_SERVER['SCRIPT_NAME']), basename(__FILE__)) === 0){
	die();
}
register_activation_hook(__FILE__,'criar_tabelas');
function criar_tabelas(){
	global $wpdb;
	$data = date('d/m/Y');
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	
	$tbl_ask 	= $wpdb->prefix.'enquete_ask';
	$tbl_option = $wpdb->prefix.'enquete_option';
	
	$verifica_ask = $wpdb->get_var("SHOW TABLES LIKE '$tbl_ask'");
	$ask_existe = count($verifica_ask);
	
	$verifica_option = $wpdb->get_var("SHOW TABLES LIKE '$tbl_option'");
	$option_existe = count($verifica_option);
	
	if($ask_existe < 1){
		$create_ask = "CREATE TABLE IF NOT EXISTS $tbl_ask (
							`id` int(5) NOT NULL AUTO_INCREMENT,
							`pergunta` text NOT NULL,
							`data` varchar(20) NOT NULL,
							`ativo` int(1) NOT NULL DEFAULT '1',
							PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;";
		
		$insert_ask = "INSERT INTO $tbl_ask (id, pergunta, data, ativo) VALUES (1, 'O que você achou deste site?', '$data', 1);";
		
		dbDelta($create_ask);
		dbDelta($insert_ask);
	}
	if($option_existe < 1){
	  	$create_option = "CREATE TABLE IF NOT EXISTS $tbl_option (
						  `idOption` int(4) NOT NULL AUTO_INCREMENT,
						  `option` text NOT NULL,
						  `idAsk` int(4) NOT NULL,
						  `votos` int(11) NOT NULL DEFAULT '0',
						  PRIMARY KEY (`idOption`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4";
						
		$insert_option = "INSERT INTO $tbl_option (`idOption`, `option`, `idAsk`, `votos`) VALUES (1, 'Otimo', 1, 132), (2, 'Bom', 1, 90), (3, 'Pode melhorar', 1, 1);";
		
		dbDelta($create_option);
		dbDelta($insert_option);
	}
}
add_filter('init', 'criar_tabelas');

function enquete_scripts_load() {
    wp_register_script( 'Cookie', plugins_url( '/js/jcookie.js', __FILE__ ), array( 'jquery' ) );
    wp_enqueue_script( 'Cookie' );
	
	wp_register_script('vote_ajax', plugins_url( '/js/javascript.js', __FILE__ ), array( 'jquery' ) );
   wp_enqueue_script( 'vote_ajax' );
	wp_localize_script('vote_ajax', 'myAjax', array( 'ajaxurl' => admin_url('admin-ajax.php') ) );
	
	wp_register_style( 'enquete_css', plugins_url( 'mtp-polls/css/style.css' , dirname(__FILE__) ) );
   wp_enqueue_style( 'enquete_css' );
}
add_action( 'wp_enqueue_scripts', 'enquete_scripts_load' );
function mtp_polls_admin_style() {
        wp_register_style( 'custom_wp_admin_css', plugins_url( 'mtp-polls/css/bootstrap.css' , dirname(__FILE__) ) );
        wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'mtp_polls_admin_style' );
function mtp_polls_gera_menu() {
 	add_menu_page( 'MTP Polls', 'MTP Polls', 'manage_options', 'mtp-polls/mtp-polls-admin.php', '', plugins_url('mtp-polls/icon.png' ), 67 );
}
add_action('admin_menu', 'mtp_polls_gera_menu');
function admin_js(){ 
	echo '
		<script type="text/javascript">
			jQuery(document).ready(function() {
				var max_fields      = 10; 
				var wrapper         = jQuery(".input_campos");
				var add_button      = jQuery(".add_campo"); 
							
				var x = 1; 
				jQuery(add_button).click(function(e){ 
					e.preventDefault();
					if(x < max_fields){ 
					x++; 
					jQuery(wrapper).append("<div><input style=\"margin-top:10px;\" type=\"text\" class=\"form-control\" aria-describedby=\"sizing-addon1\" name=\"opcao[]\"></div>");
					}
				});
			});
		</script>';
}
add_action('admin_head', 'admin_js', 20);
include('enquete.php');