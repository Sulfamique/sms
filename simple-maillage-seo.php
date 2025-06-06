<?php
/*
Plugin Name: Simple Maillage SEO
Plugin URI: https://x.com/Sulfamique
Description: Plugin SEO pour un maillage interne automatique et simple.
Version: 1.0
Author: Sulfamique
Author URI: https://github.com/Sulfamique/
License: L1
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Quitter si accès direct
}

// Le plugin repose sur l'extension PHP DOM pour manipuler le HTML
if ( ! extension_loaded( 'dom' ) ) {
    add_action( 'admin_notices', function() {
        echo '<div class="notice notice-error"><p>';
        esc_html_e( "Simple Maillage SEO requiert l'extension PHP DOM.", 'simple-maillage-seo' );
        echo '</p></div>';
    } );
    return;
}

// Définir les constantes du plugin
define( 'SMS_PLUGIN_FILE', __FILE__ );
define( 'SMS_PLUGIN_DIR', plugin_dir_path( SMS_PLUGIN_FILE ) );
define( 'SMS_PLUGIN_URL', plugin_dir_url( SMS_PLUGIN_FILE ) );

// Inclure la classe principale
require_once SMS_PLUGIN_DIR . 'includes/class-simple-maillage-seo.php';

// Initialiser le plugin
SimpleMaillageSEO::init();
