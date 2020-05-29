<?php

function register_my_menus() {
  register_nav_menus(
    array(
      'menutop' => __( 'Menú superior' ), 
      'menuredes' => __( 'Menú redes' ),
      'menucierre' => __( 'Menu cierre' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

// WIDGETS

if(function_exists('register_sidebar')) {
    register_sidebar(array(
        'name'          => 'Sidebar general',
        'id'            => 'general',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
}

if ( function_exists( 'add_theme_support' ) ) { 
  add_theme_support( 'post-thumbnails' ); }

//Widgets pie
if(function_exists('register_sidebar')) {
  register_sidebar(array(
      'name'          => 'Pie',
      'id'            => 'pie',
      'before_widget' => '<div id="%1$s" class="pie__item %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h3 class="pie__titulos">',
      'after_title'   => '</h3>'
  ));
}
//EXTRACTO
function custom_excerpt_length( $length ) {
	  return 15;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function new_excerpt_more( $more ) {
	return ' ...';
}
add_filter('excerpt_more', 'new_excerpt_more');


// FORMULARIO DE ACCESO A COMENTARIOS
function campos_formulario( $fields) {
	
  //Variables necesarias básicas como que el email es obligatorio
  $commenter = wp_get_current_commenter();
  $req = get_option( 'require_name_email' );
  $aria_req = ( $req ? " aria-required='true'" : '' );
    
  // campos por defecto del formulario que vamos a introducir con nuestros cambios
  $fields =  array(
    
  //NOMBRE
  'author' =>
  '<input id="author" placeholder="nombre" class="comentarios__nombre" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
  '" size="30"' . $aria_req . ' />',
  // EMAIL
  'email' =>
  '<input id="email" placeholder="email" class="comentarios__email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />',
  //URL
  'url' =>
  '<input id="url" placeholder="web" class="comentarios__web" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
  '" size="30" />',
  ); 
    
  return $fields;
  }
  add_filter('comment_form_default_fields', 'campos_formulario');
  

?>