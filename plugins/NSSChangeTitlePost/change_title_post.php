<?php
/**
 * Plugin Name: Change Title Post
 * Description: Este plugin permite modificar el titulo de cada entrada
 * Version: 1.0.0
 * Author: Pavel Tocto
 * Text Domain: wp-change-title-post
 */

//Previene el acceso directo al archivo
if ( ! defined( 'ABSPATH' ) ) exit;

const KEY_META_BOX_TITLE = '_nss_extend_title_post';

if ( is_admin() ) {
    require_once( 'admin/MetaBoxTitle.php' );
} else {
    require_once( 'public/AddTitlePost.php' );
}