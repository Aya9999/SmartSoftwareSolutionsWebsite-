<?php

/*

Plugin Name: Great Carrousel
Plugin URI: 
Version: 1.05
Description: Create great carrousel :)
Author: Manu225
Author URI: 
Network: false
Text Domain: great-carousel
Domain Path: 

*/



register_activation_hook( __FILE__, 'great_caroussel_install' );

register_uninstall_hook(__FILE__, 'great_caroussel_desinstall');

function great_caroussel_install() {

	global $wpdb;

	$great_caroussel_table = $wpdb->prefix . "great_caroussels";

	$great_caroussel_contents_table = $wpdb->prefix . "great_caroussels_contents";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

	$sql = "

        CREATE TABLE `".$great_caroussel_table."` (

          id int(11) NOT NULL AUTO_INCREMENT,          

          name varchar(50) NOT NULL,

          PRIMARY KEY  (id)

        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

    ";


    dbDelta($sql);


    $sql = "

        CREATE TABLE `".$great_caroussel_contents_table."` (

          id int(11) NOT NULL AUTO_INCREMENT,          

          content varchar(500) NOT NULL,

          `order` int(11) NOT NULL,

          id_caroussel int(11),

          PRIMARY KEY  (id)

        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

    ";    

    dbDelta($sql);

}



function great_caroussel_desinstall() {


	global $wpdb;

	$great_caroussel_table = $wpdb->prefix . "great_caroussels";

	$great_caroussel_contents_table = $wpdb->prefix . "great_caroussels_contents";


	//suppression des tables

	$sql = "DROP TABLE ".$great_caroussel_table.";";

	$wpdb->query($sql);

    $sql = "DROP TABLE ".$great_caroussel_contents_table.";";   

	$wpdb->query($sql);

}



add_action( 'admin_menu', 'register_great_caroussel_menu' );


function register_great_caroussel_menu() {

	add_menu_page('Great Carousel', 'Great Carousel', 'edit_pages', 'great_caroussels', 'great_caroussels', plugins_url( 'images/icon.png', __FILE__ ), 32);

}


add_action('admin_print_styles', 'great_caroussel_css' );

function great_caroussel_css() {

    wp_enqueue_style( 'GreatCarousselStylesheet', plugins_url('css/admin.css', __FILE__) );

}

function great_caroussels() {

	if (is_admin()) {

		global $wpdb;
		$great_caroussel_table = $wpdb->prefix . "great_caroussels";
		$great_caroussel_contents_table = $wpdb->prefix . "great_caroussels_contents";

		if(is_numeric($_GET['id']))
		{
			//on récupère toutes les caroussels
			$caroussel = $wpdb->get_row("SELECT * FROM ".$great_caroussel_table." WHERE id=".$_GET['id']);
			$contents = $wpdb->get_results("SELECT * FROM ".$great_caroussel_contents_table." WHERE id_caroussel = ".$_GET['id']." ORDER BY `order` ASC", OBJECT);
			include(plugin_dir_path( __FILE__ ) . 'views/caroussel.php');

		}
		else
		{
			if(sizeof($_POST) > 0)
			{
				if(empty($_POST['name']))

					echo '<h2>You must enter a name for your caroussel !</h2>';

				else if(!is_numeric($_POST['id']))
				{
					check_admin_referer( 'new_gc' );
					$query = $wpdb->prepare( "INSERT INTO ".$great_caroussel_table." (`name`) VALUES (%s)", stripslashes_deep($_POST['name']));
					$wpdb->query($query);
				}
				else //mise à jour d'un caroussel
				{
					check_admin_referer( 'update_gc_'.$_POST['id'] );
					$query = $wpdb->prepare( "UPDATE ".$great_caroussel_table." SET `name` = %s WHERE id = %d",
					stripslashes_deep($_POST['name']), $_POST['id'] );
					$wpdb->query($query);
				}

			}			

			//on récupère toutes les caroussels
			$caroussels = $wpdb->get_results("SELECT * FROM ".$great_caroussel_table);
			include(plugin_dir_path( __FILE__ ) . 'views/caroussels.php');

		}

	}

}


//Ajax : suppression d'un flipping card
add_action( 'wp_ajax_remove_gc', 'remove_gc_callback' );

function remove_gc_callback() {

	check_ajax_referer( 'remove_gc' );

	if (is_admin()) {

		global $wpdb; // this is how you get access to the database
		$great_caroussel_table = $wpdb->prefix . "great_caroussels";
		$great_caroussel_contents_table = $wpdb->prefix . "great_caroussels_contents";

		if(is_numeric($_POST['id']))
		{
			//supprime toutes les contenus
			$query = $wpdb->prepare( 

				"DELETE FROM ".$great_caroussel_contents_table."

				 WHERE id_caroussel=%d", $_POST['id']

			);

			$res = $wpdb->query( $query	);

			//supprime le caroussel
			$query = $wpdb->prepare( 
				"DELETE FROM ".$great_caroussel_table."
				 WHERE id=%d", $_POST['id']
			);

			$res = $wpdb->query( $query	);

		}

		wp_die();

	}

}

//Ajax : ajout du contenu
add_action( 'wp_ajax_gc_add_content', 'gc_add_content' );

function gc_add_content() {

	check_admin_referer( 'new_content_gc' );

	if (is_admin()) {

		global $wpdb;

		$great_caroussel_contents_table = $wpdb->prefix . "great_caroussels_contents";

		if(is_numeric($_POST['id']) && !empty($_POST['content']))
		{
			$max_order = $wpdb->get_row( $wpdb->prepare( "SELECT MAX(`order`) as max_order FROM ".$great_caroussel_contents_table." WHERE id_caroussel = %d", $_POST['id'] ));

			if($max_order)

				$max_order = ($max_order->max_order+1);

			else

				$max_order = 1;

			$query = $wpdb->prepare( "INSERT INTO ".$great_caroussel_contents_table." (`content`, `order`, `id_caroussel`) VALUES (%s, %d, %d)", stripslashes_deep($_POST['content']), $max_order, $_POST['id'] );

			$res = $wpdb->query( $query	);
		}

		wp_die($wpdb->insert_id);

	}

}


//Ajax : update du contenu
add_action( 'wp_ajax_gc_save_content', 'gc_save_content');

function gc_save_content() {

	check_admin_referer( 'update_content_gc_'.$_POST['id'] );

	if (is_admin())
	{
		if(is_numeric($_POST['id']) && !empty($_POST['content']))
		{
			global $wpdb;

			$great_caroussel_contents_table = $wpdb->prefix . "great_caroussels_contents";

			$query = $wpdb->prepare( "UPDATE ".$great_caroussel_contents_table." SET `content` = %s WHERE id = %d",

			stripslashes_deep($_POST['content']), $_POST['id'] );

			$res = $wpdb->query( $query	);

		}

	}

}


//Ajax : suppression d'un contenu

add_action( 'wp_ajax_gc_remove_content', 'gc_remove_content' );

function gc_remove_content() {


	check_ajax_referer( 'remove_content_gc' );

	if (is_admin()) {

		global $wpdb;

		$great_caroussel_contents_table = $wpdb->prefix . "great_caroussels_contents";

		if(is_numeric($_POST['id']))
		{
			//on trouve l'ordre du contenu à supprimer
			$query = $wpdb->prepare( 

				"SELECT `order`, id_caroussel FROM ".$great_caroussel_contents_table."
				 WHERE id=%d", $_POST['id']

			);

			$content = $wpdb->get_row( $query );

			if($content)
			{
				//on supprime le contenu
				$query = $wpdb->prepare( 

					"DELETE FROM ".$great_caroussel_contents_table."
					 WHERE id=%d", $_POST['id']

				);

				$res = $wpdb->query( 
					$query
				);

				//on redifini les ordres des autres contents
				$query = $wpdb->prepare( 

					"UPDATE ".$great_caroussel_contents_table."
					 SET `order` = `order` - 1
					 WHERE id_caroussel=%d
					 AND `order` >= %d", $content->id_caroussel, $content->order

				);

				$res = $wpdb->query( 
					$query
				);

			}

		}

		wp_die(); // this is required to terminate immediately and return a proper response

	}

}



//Ajax : changement de position d'une image
add_action( 'wp_ajax_gc_order_content', 'gc_order_content' );

function gc_order_content() {

	check_ajax_referer( 'order_content_gc' );

	if (is_admin()) {

		global $wpdb;

		$great_caroussel_contents_table = $wpdb->prefix . "great_caroussels_contents";

		if(is_numeric($_POST['id']) && is_numeric($_POST['order']))
		{
			$content = $wpdb->get_row( $wpdb->prepare( "SELECT id_caroussel, `order` FROM ".$great_caroussel_contents_table." WHERE id = %d", $_POST['id'] ));

			if($_POST['order'] > $content->order)

				$wpdb->query( $wpdb->prepare( "UPDATE ".$great_caroussel_contents_table." SET `order` = `order` - 1 WHERE id_caroussel = %d AND `order` <= %d AND `order` > %d", $content->id_card, $_POST['order'], $content->order ));

			else

				$wpdb->query( $wpdb->prepare( "UPDATE ".$great_caroussel_contents_table." SET `order` = `order` + 1 WHERE id_caroussel = %d AND `order` >= %d AND `order` < %d", $content->id_card, $_POST['order'], $content->order ));

			$wpdb->query( $wpdb->prepare( "UPDATE ".$great_caroussel_contents_table." SET `order` = %d WHERE id = %d", $_POST['order'], $_POST['id'] ));			

		}

		wp_die();

	}

}



function display_great_caroussel($atts) {

        if(is_numeric($atts['id']))
        {	

        	global $wpdb;
			$great_caroussel_table = $wpdb->prefix . "great_caroussels";
			$great_caroussel_contents_table = $wpdb->prefix . "great_caroussels_contents";

			$caroussel = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM ".$great_caroussel_table." WHERE id = %d", $atts['id'] ));

			if($caroussel)
			{
				$contents = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$great_caroussel_contents_table." WHERE id_caroussel = %d ORDER BY `order` ASC", $atts['id'] ));

				wp_enqueue_script( 'jquery');
				wp_enqueue_script( 'GreatCarousselFrontJS', plugins_url( 'js/front.js', __FILE__ ));
				wp_enqueue_style( 'GreatCarousselFrontStylesheet', plugins_url('css/front.css', __FILE__) );

				ob_start();
				include( plugin_dir_path( __FILE__ ) . 'views/tpl.php' );
				return ob_get_clean();
			}
			else
				return 'Carrousel with ID '.$atts['id'].' doesn\'t exists!';

		}



}

add_shortcode('great-caroussel', 'display_great_caroussel');