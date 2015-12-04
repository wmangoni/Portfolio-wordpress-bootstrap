
<?php
/**
 * Load site scripts.
 *
 * @since  1.0.0
 *
 * @return void
 */
function wpgulp_enqueue_scripts() {
	// jQuery.
	wp_enqueue_script( 'jquery' );
	// Theme scripts.
	wp_enqueue_script( 'wpgulp-main-min', get_template_directory_uri() . '/assets/js/libs.js', array(), null, true );

	if (is_page( 'home' )){

		wp_enqueue_script( 'script_home', get_template_directory_uri() . '/assets/js/home.js', array(), null, true );
	}
	
	if (is_page( 'videos-e-downloads' )){

		//wp_enqueue_script( 'script_home', get_template_directory_uri() . '/assets/js/base.js', array(), null, true );
	}
}
add_action( 'wp_enqueue_scripts', 'wpgulp_enqueue_scripts', 2 );
/**
 * Custom stylesheet URI.
 *
 * @since  1.0.0
 *
 * @param  string $uri Default URI.
 * @param  string $dir Stylesheet directory URI.
 *
 * @return string      New URI.
 */
function wpgulp_stylesheet_uri( $uri, $dir ) {
	return $dir . '/assets/stylesheets/styles.css';
}
add_filter( 'stylesheet_uri', 'wpgulp_stylesheet_uri', 10, 2 );
?>
<?php



// REMOVER MENSAGEM DE ATUALIZAÇÃO DO WORDPRESS
add_filter('pre_site_transient_update_core', create_function('$a', "return null;"));

// INCLUINDO ARQUIVOS DE CONSTANTS DO TEMA
require_once "inc/constants.php";

function my_function_admin_bar() {
	return false;
}

add_filter("show_admin_bar", "my_function_admin_bar");

function theme_setup() {
	load_theme_textdomain('theme', get_template_directory() . '/languages');
	add_theme_support('automatic-feed-links');
	add_theme_support('html5', array('search-form', 'comment-form', 'comment-list'));
	add_theme_support('post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video',
		));
	add_theme_support('post-thumbnails');
	register_nav_menus(
		array(
			'primary' => __('Navigation Menu Header', 'theme'),
			)
		);
	add_theme_support('post-thumbnails');
	add_filter('use_default_gallery_style', '__return_false');
}

add_action('after_setup_theme', 'theme_setup');

// ADICIONANDO CLASSE FIRST E LAST NOS MENUS DO SITE
function add_first_and_last($output) {
	if (strpos($output, 'menu-item')) {
		$output = preg_replace('/class="menu-item/', 'class="first-menu-item menu-item', $output, 1);
		$output = substr_replace($output, 'class="last-menu-item menu-item', strripos($output, 'class="menu-item'), strlen('class="menu-item'));
	} else {
		$output = preg_replace('/<li class="/', '<li class="first-page-item ', $output, 1);
		$output = substr_replace($output, '<li class="last-page-item ', strripos($output, '<li class="'), strlen('<li class="'));
	}

	return $output;
}

add_filter('wp_nav_menu', 'add_first_and_last');
add_filter('wp_page_menu', 'add_first_and_last');

// HABILITA UPLOAD DO LOGO

$defaults = array(
	'default-image' => '',
	'random-default' => false,
	'width' => 0,
	'height' => 0,
	'flex-height' => false,
	'flex-width' => false,
	'default-text-color' => '',
	'header-text' => false,
	'uploads' => true,
	'wp-head-callback' => '',
	'admin-head-callback' => '',
	'admin-preview-callback' => '',
	);

add_theme_support('custom-header', $defaults);

/* IMPLEMENTAÇÃO DO ATRIBUTO DATA-SRC PARA REFERENCIAR O CAMINHO AOS CODIGOS JQUERY */

add_filter('template_include', 'start_buffer_capture', 1);
function loadScriptsTemplate(){

	if (is_page_template('template-home.php')){

		wp_enqueue_script( 'script_home', get_template_directory_uri() . '/assets/js/home.js', array(), null, true );
	}
}
add_action('wp_enqueue_script','loadScriptsTemplate');

function start_buffer_capture($template) {
	ob_start('end_buffer_capture');
	return $template;
}

function end_buffer_capture($buffer) {
	$url = $_SERVER['PHP_SELF'];
	$uri = str_replace("index.php", "", $_SERVER['PHP_SELF']);

	return str_replace('<body', '<body data-src="' . 'http://' . $_SERVER['HTTP_HOST'] . $uri . '"', $buffer);
}

/* FINAL DO ATRIBUTO */

// FILTRO PARA TITULO 

function theme_wp_title($title, $sep) {
	global $paged, $page;

	if (is_feed())
		return $title;

	$title .= get_bloginfo('name');

	$site_description = get_bloginfo('description', 'display');
	if ($site_description && ( is_home() || is_front_page() ))
		$title = "$title $sep $site_description";

	if ($paged >= 2 || $page >= 2)
		$title = "$title $sep " . sprintf(__('Page %s', 'theme'), max($paged, $page));

	return $title;
}

add_filter('wp_title', 'theme_wp_title', 10, 2);

//LIMITAR OS CARACTERES DO THE_EXCERPT() NO WORDPRESS
function excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);

	if (count($excerpt) >= $limit) {
		array_pop($excerpt);
		$excerpt = implode(" ", $excerpt) . '...';
	} else {
		$excerpt = implode(" ", $excerpt);
	}

	$excerpt = preg_replace('`[[^]]*]`', '', $excerpt);
	return $excerpt;
}

// ADICIONANDO CLASS IMG-RESPONSIVE NAS IMAGENS "UPADAS" AO SITE VIA POST MEDIA
function give_linked_images_class($html, $id, $caption, $title, $align, $url, $size, $alt = '') {
	$classes = 'img-responsive';

	if (preg_match('/<img.*? class=".*?">/', $html)) {
		$html = preg_replace('/(<img.*? class=".*?)(".*?>)/', '$1 ' . $classes . '$2', $html);
	} else {
		$html = preg_replace('/(<img.*?)>/', '$1 class="' . $classes . '" >', $html);
	}
	return $html;
}

add_filter('image_send_to_editor', 'give_linked_images_class', 10, 8);

add_filter('body_class', 'post_name_in_body_class');

function post_name_in_body_class() {
	$classes[] = str_replace('.php', '',basename(get_page_template()));
	if (is_singular()) {
		global $post;
		$classes[] = $post->post_type;
	}
	if (is_search()) {
		$classes[] = 'search-result';
	}
	return $classes;
}

function the_slug($echo = true) {
	$slug = basename(get_permalink());
	do_action('before_slug', $slug);
	$slug = apply_filters('slug_filter', $slug);
	if ($echo)
		echo $slug;
	do_action('after_slug', $slug);
	return $slug;
}


/***************************************************************************
**																		  **		
** DISABLE SINGLE PAGES 												  **
**																		  **
** Desativa o single para os post types especificados no array 	  		  **
** 																		  **			
**																		  **	 
***************************************************************************/

/*add_action( 'template_redirect', 'disableSinglePage' );

function disableSinglePage() {
	$queried_post_type = get_query_var('post_type');
	$post_types = array('wp-depoimentos');
  	
  	if ( is_single() && in_array($queried_post_type, $post_types)) {
    	wp_redirect( home_url(), 301 );
    	exit;
  	}
  }*/


  function the_title_trim($title) {
  	$pattern[0] = '/Protegido:/';
  	$pattern[1] = '/Privado:/';
  $replacement[0] = ''; // Enter some text to put in place of Protected:
  $replacement[1] = ''; // Enter some text to put in place of Private:

  return preg_replace($pattern, $replacement, $title);
}

add_filter('the_title', 'the_title_trim');

/***************************************************************************
 **                                                                       **   
 ** MINIATURAS DE IMAGENS                                                 **
 **                                                                       **
 ** Inicializa valores padrão para tamanhos de imagens                    ** 
 **                                                                       **
 ***************************************************************************/
add_image_size('icones_porque_participar', 137, 137, true);
add_image_size('icones_conference', 160, 160, true);
add_image_size('icones_expo', 160, 160, true);
add_image_size('ilustracao', 588, 540, true);
add_image_size('icone_logo_rodape', 220, 49, true);
add_image_size('patrocinadores_logo', 230, 230, true);
add_image_size('palestrantes_logo', 229, 229, true);
add_image_size('thumb_images', 180, 180, true);
add_image_size('filtros_categoria', 269, 68, true);

// Add the posts and pages columns filter. They can both use the same function.
add_filter('manage_posts_columns', 'tcb_add_post_thumbnail_column', 1);

// Add the column
function tcb_add_post_thumbnail_column( $cols ){
	$colsstart = array_slice( $cols, 0, 1, true );
	$colsend   = array_slice( $cols, 1, null, true );

	$colls = array_merge(
		$colsstart,
		array( 'tcb_post_thumb' => __('Logotipo') ),
		$colsend
		);

	return $colls;
}

// Hook into the posts an pages column managing. Sharing function callback again.
add_action('manage_posts_custom_column', 'tcb_display_post_thumbnail_column', 5, 2);

// Grab featured-thumbnail size post thumbnail and display it.
function tcb_display_post_thumbnail_column($col, $id){
	switch($col){
		case 'tcb_post_thumb':
		if( function_exists('the_post_thumbnail') )
			echo the_post_thumbnail( array(80, 80) );
		else
			echo 'Not supported in theme';
		break;
	}
}

/** ************************************************************************
 **                                                                       **   
 ** FUNÇÃO PARA REMOVER POST DO PAINEL									  **
 **                                                                       **
 ***************************************************************************/


function settings_menu() {
	if (current_user_can('edit_themes')) {
		global $menu;

		$restricted = array(
			__('Posts'),
			__('Comentários'),
			__('Aparência'),
			__('Ferramentas'),
		);

		end($menu);

		while (prev($menu)) {
			$value = explode(' ', $menu[key($menu)][0]);
			if (in_array($value[0] != NULL ? $value[0] : "", $restricted)) {
				unset($menu[key($menu)]);
			}	
		}

	} else {
		return false;
	}
}
add_action('admin_menu', 'settings_menu');


/** ************************************************************************
 **                                                                       **   
 ** EDIÇÃO DOS TEXTOS DO MENU NO ADMIN                                    **
 **                                                                       **
 ** Realiza a alteração dos textos utilizados nos menus do painel         **
 ** administrativo do Wordpress.										  **
 **                                                                       **
 ***************************************************************************/

add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );

function my_search_form($form) {
$form = '<form method="get" id="searchform" action="' . get_option('home') . '/" >
<div><label for="s">' . __('Search for:') . '</label>
<input type="text" value="' . attribute_escape(apply_filters('the_search_query', get_search_query())) . '" name="s" id="s" placeholder="BUSCA"/>
<input type="submit" id="searchsubmit" value="'.attribute_escape(__('Search')).'" />
</div>
</form>';
return $form;
}

function change_post_menu_label() {
	global $menu;
	global $submenu;

	$menu[5][0] = 'Posts';
	$menu[5][4] = 'open-if-no-js menu-top';
	$submenu['edit.php'][5][0] = 'Posts';
	$submenu['edit.php'][10][0] = 'Adicionar';
	echo '';
}

function change_post_object_label() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'Posts';
}



remove_action('wp_head', 'wp_print_scripts');
remove_action('wp_head', 'wp_print_head_scripts', 9);
remove_action('wp_head', 'wp_enqueue_scripts', 1);
add_action('wp_footer', 'wp_print_scripts', 5);
add_action('wp_footer', 'wp_enqueue_scripts', 5);
add_action('wp_footer', 'wp_print_head_scripts', 5);


/*if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_beneficios',
		'title' => 'Benefícios',
		'fields' => array (
			array (
				'key' => 'field_56546ffb15b9f',
				'label' => 'Banner',
				'name' => 'banner',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_5654702115ba0',
						'label' => 'Imagem Banner',
						'name' => 'imagem_banner',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'large',
						'library' => 'all',
					),
					array (
						'key' => 'field_5654703015ba1',
						'label' => 'Título',
						'name' => 'titulo',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_5654703f15ba2',
						'label' => 'Descrição',
						'name' => 'descricao',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Adicionar',
			),
			array (
				'key' => 'field_5654705666e7d',
				'label' => 'Conteúdo Banefícios',
				'name' => 'conteudo_baneficios',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_5654708066e7e',
						'label' => 'O que é - descrição',
						'name' => 'o_que_e',
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => '',
						'formatting' => 'br',
					),
					array (
						'key' => 'field_565470ca66e7f',
						'label' => 'Tecnologia - descrição',
						'name' => 'tecnologia',
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => '',
						'formatting' => 'br',
					),
					array (
						'key' => 'field_565470de66e80',
						'label' => 'Aplicações - descrição',
						'name' => 'aplicacoes',
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => '',
						'formatting' => 'br',
					),
					array (
						'key' => 'field_5654712566e81',
						'label' => 'Lista Benefícios',
						'name' => 'lista_beneficios',
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => '',
						'formatting' => 'html',
					),
					array (
						'key' => 'field_5654715d66e82',
						'label' => 'Vantagens - descrição',
						'name' => 'vantagens',
						'type' => 'repeater',
						'column_width' => '',
						'sub_fields' => array (
							array (
								'key' => 'field_565485164caa7',
								'label' => 'Texto',
								'name' => 'texto',
								'type' => 'textarea',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'maxlength' => '',
								'rows' => '',
								'formatting' => 'br',
							),
							array (
								'key' => 'field_565485214caa8',
								'label' => 'Lista',
								'name' => 'lista',
								'type' => 'textarea',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'maxlength' => '',
								'rows' => '',
								'formatting' => 'html',
							),
						),
						'row_min' => '',
						'row_limit' => '',
						'layout' => 'table',
						'button_label' => 'Add Row',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Adicionar',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-beneficios.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_parcerias',
		'title' => 'Parcerias',
		'fields' => array (
			array (
				'key' => 'field_5654482231e75',
				'label' => 'Banner',
				'name' => 'banner',
				'type' => 'repeater',
				'required' => 1,
				'sub_fields' => array (
					array (
						'key' => 'field_565448b49d14a',
						'label' => 'Imagem Banner',
						'name' => 'imagem_banner',
						'type' => 'image',
						'required' => 1,
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_56546996fcc01',
						'label' => 'Título',
						'name' => 'titulo',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_565448c29d14b',
						'label' => 'Descrição',
						'name' => 'descricao',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Adicionar',
			),
			array (
				'key' => 'field_56546e0108fad',
				'label' => 'Descrição da Página',
				'name' => 'descricao_da_pagina',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_565448d6e8e13',
				'label' => 'Parceiros',
				'name' => 'parceiros',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_565448f2e8e14',
						'label' => 'Logo',
						'name' => 'logo',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'medium',
						'library' => 'all',
					),
					array (
						'key' => 'field_56544915e8e15',
						'label' => 'Description',
						'name' => 'description',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_5654493fe8e16',
						'label' => 'Links',
						'name' => 'links',
						'type' => 'repeater',
						'column_width' => '',
						'sub_fields' => array (
							array (
								'key' => 'field_56547ebf2085f',
								'label' => 'Link',
								'name' => 'link',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'none',
								'maxlength' => '',
							),
							array (
								'key' => 'field_56547ecd20860',
								'label' => 'Site',
								'name' => 'site',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'none',
								'maxlength' => '',
							),
						),
						'row_min' => '',
						'row_limit' => '',
						'layout' => 'row',
						'button_label' => 'Adicionar',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Adicionar',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-parcerias.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_rio-2016',
		'title' => 'Rio 2016',
		'fields' => array (
			array (
				'key' => 'field_56547a43df671',
				'label' => 'Banner',
				'name' => 'banner',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_56547a57df672',
						'label' => 'Imagem Banner',
						'name' => 'imagem_banner',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'full',
						'library' => 'all',
					),
					array (
						'key' => 'field_56547a67df673',
						'label' => 'Título',
						'name' => 'titulo',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_56547a70df674',
						'label' => 'Descrição',
						'name' => 'descricao',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Adicionar',
			),
			array (
				'key' => 'field_56547a86cd346',
				'label' => 'Conteúdo',
				'name' => 'conteudo',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_56547a99cd347',
						'label' => 'Description',
						'name' => 'description',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
					array (
						'key' => 'field_56547aa8cd348',
						'label' => 'Texto 1',
						'name' => 'texto_1',
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => '',
						'formatting' => 'br',
					),
					array (
						'key' => 'field_56547abbcd349',
						'label' => 'Texto 2',
						'name' => 'texto_2',
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => '',
						'formatting' => 'br',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Adicionar',
			),
			array (
				'key' => 'field_56547d644ec84',
				'label' => 'Links',
				'name' => 'links',
				'type' => 'repeater',
				'instructions' => 'Informe um texto e um link para exibir ao final do texto 2',
				'sub_fields' => array (
					array (
						'key' => 'field_56547d8f4ec85',
						'label' => 'Site',
						'name' => 'site',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
					array (
						'key' => 'field_56547d9a4ec86',
						'label' => 'Link',
						'name' => 'link',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Adicionar',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-programa.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_blocos-de-conteudo-home',
		'title' => 'Blocos de Conteúdo Home',
		'fields' => array (
			array (
				'key' => 'field_56530a4644973',
				'label' => 'Itens do Banner',
				'name' => 'itens_banner',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_56530bd383fe0',
						'label' => 'Título',
						'name' => 'titulo',
						'type' => 'text',
						'instructions' => 'Título que aparecerá no banner',
						'required' => 1,
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => 100,
					),
					array (
						'key' => 'field_56530c0583fe1',
						'label' => 'Descrição',
						'name' => 'descricao',
						'type' => 'text',
						'instructions' => 'Descrição que aparecerá logo abaixo do título do banner',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => 255,
					),
					array (
						'key' => 'field_56530ca3026e5',
						'label' => 'Imagem',
						'name' => 'imagem',
						'type' => 'image',
						'instructions' => 'Imagem do Banner',
						'required' => 1,
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'full',
						'library' => 'all',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Adicionar',
			),
			array (
				'key' => 'field_56530229d6232',
				'label' => 'Itens de Conteúdo',
				'name' => 'itens_de_conteudo',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_5653027cd6233',
						'label' => 'Título',
						'name' => 'titulo',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_56530291d6234',
						'label' => 'Descrição',
						'name' => 'descricao',
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => 255,
						'rows' => '',
						'formatting' => 'br',
					),
					array (
						'key' => 'field_565302b1d6235',
						'label' => 'Link de saiba mais',
						'name' => 'link_de_saiba_mais',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
					array (
						'key' => 'field_565302c6d6236',
						'label' => 'Imagem',
						'name' => 'imagem',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
				),
				'row_min' => '',
				'row_limit' => 3,
				'layout' => 'row',
				'button_label' => 'Adicionar',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-home.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 1,
	));
	register_field_group(array (
		'id' => 'acf_videos-e-downloads',
		'title' => 'Vídeos e Downloads',
		'fields' => array (
			array (
				'key' => 'field_56548a84a1e02',
				'label' => 'Banner',
				'name' => 'banner',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_56548a9da1e03',
						'label' => 'Imagem Banner',
						'name' => 'imagem_banner',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'full',
						'library' => 'all',
					),
					array (
						'key' => 'field_56548abba1e04',
						'label' => 'Título',
						'name' => 'titulo',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_56548b3ca1e05',
						'label' => 'Descrição',
						'name' => 'descrição',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Adicionar',
			),
			array (
				'key' => 'field_56548b514080c',
				'label' => 'Subtítulo - Vídeos',
				'name' => 'subtitle_videos',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_56548b6f4080d',
				'label' => 'Videos',
				'name' => 'videos',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_56548b824080e',
						'label' => 'Link',
						'name' => 'link',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
					array (
						'key' => 'field_56548b8b4080f',
						'label' => 'Description',
						'name' => 'description',
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => '',
						'formatting' => 'br',
					),
					array (
						'key' => 'field_56548ba440810',
						'label' => 'Imagem do Video',
						'name' => 'imagem-video',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'medium',
						'library' => 'all',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Adicionar',
			),
			array (
				'key' => 'field_56548c0fe8ea4',
				'label' => 'Subtítulo - Downloads',
				'name' => 'subtitle_downloads',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_56548c3c51795',
				'label' => 'Downloads',
				'name' => 'downloads',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_56548c5551796',
						'label' => 'Texto',
						'name' => 'texto',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => 255,
					),
					array (
						'key' => 'field_56548c6f51797',
						'label' => 'Pdf',
						'name' => 'pdf',
						'type' => 'file',
						'column_width' => '',
						'save_format' => 'object',
						'library' => 'all',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Adicionar',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-videos.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 5,
	));
}*/




?>

