<?php 
/*
Plugin Name: Fern Products
Description: plugin for a custom post type
Author: Ferran Nicolls
License: GPLv3
Version: 0.1
Plugin URI:
Author URI: ferrannicolls.com
*/

function fern_products_cpt(){
	register_post_type( 'product', array(
  		'public' 	  => true,
  		'has_archive' => true,
  		'label'		  => 'Products',
  		'menu_icon'   => 'dashicons-cart',
  		'menu_position' => 5,
  		'rewrite' 	  => array( 'slug' => 'shop' ),
  		'supports' 	  => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'revisions' ),
  		'labels'	 		=> array(
  			'name' 	  		=> 'Products',
  			'singular_name' => 'Product',
  			'add_new_item'	=> 'Add New Product',
  			'edit_item' 	=> 'Edit Product',
  			'view_item' 	=> 'View Product',
  			'not_found' 	=> 'No Products Found',
  			),
		) );

  register_taxonomy( 'brand', 'product', array( 
      'hierarchical'  => true, //checkbox interface like categories
      'show_admin_column' => true,
      'label'         => 'Brands',
      'labels'        => array(
        'add_new_item'  => 'Add New Brand',
        'search_items'  => 'Search Brands',
        'not_found'     => 'No brands found',
        'edit_item'     => 'Edit brand', 
        ),
   ) );

//non hierarchical like tags
  register_taxonomy( 'feature', 'product', array( 
      'show_admin_column' => true,
      'label'         => 'Features',
      'labels'        => array(
        'add_new_item'  => 'Add New Feature',
        'search_items'  => 'Search Features',
        'not_found'     => 'No features found',
        'popular_items' => 'Popular Features',
        'edit_item'     => 'Edit feature',
        ),
   ) );


}
add_action( 'init', 'fern_products_cpt' );

/**
 * automatically flush permalinks when plugin is activated
 */
register_activation_hook( __FILE__ , 'fern_products_flush' );
function fern_products_flush(){
  fern_products_cpt();
  flush_rewrite_rules(); 
}