# Creación de Tema Editorial en wordpress 

## Instalación del tema
Descargamos el directorio **northsouth** y pegamos dentro de la carpeta **wp-content/themes** y activamos el nuevo tema.

 - La plantilla que se llego utilizar para la creación de este tema se encuentra [aquí](https://html5up.net/editorial)
 - Jerarquía de plantillas en Wordpress [aqui](https://codex.wordpress.org/images/1/18/Template_Hierarchy.png)
 - Creación de temas [aquí](https://codex.wordpress.org/Theme_Development)
 - Creacion de plugins [aqui](https://developer.wordpress.org/plugins/intro/)
 - Creacion de widget [aqui](https://developer.wordpress.org/themes/functionality/widgets/) 
 - Wordpress Cheat sheet [aquí](https://drive.google.com/open?id=1sSqSSTh1jF5Yur0vnGKWDjamh7QkU1hF)
 
## Tarea

 1. Crear un plugin donde mostraremos un random de un post destacado, para eso se tendra que agregar un checkbox dentro del admin de cada post donde activaremos si el post es o no un destacado    
 2. Crear un widget donde mostraremos los ultimos 5 post mas recientes, el cual se debe mostrar el titulo y la imagen principal de cada post, ese widget los mostraremos en el **Sidebar** .

# Creacion de plugins
Para crear un plugin solo debemos crear un directorio dentro de `wp-content/plugins` y añadir un  archivo con el código fuente.


      <?php
        /*
        Plugin Name:  WordPress.org Plugin
        Plugin URI:   https://developer.wordpress.org/plugins/the-basics/
        Description:  Basic WordPress Plugin Header Comment
        Version:      20160911
        Author:       WordPress.org
        Author URI:   https://developer.wordpress.org/
        License:      GPL2
        License URI:  https://www.gnu.org/licenses/gpl-2.0.html
        Text Domain:  wporg
        Domain Path:  /languages
        */

Ahora vamos a crear un  plugin de ejemplo, que básicamente nos permitirá modificar el title de cada post que se encuentra en `wp-content/plugins/NSSChangeTitlePost` donde crearemos este archivo `change_title_post.php`

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
Ahora en el siguiente archivo `public/AddTitlePost.php` , haremos la  lógica de modificar el titulo de cada post para eso utilizaremos el [hook de the_title](https://codex.wordpress.org/Plugin_API/Filter_Reference/the_title) 

    <?php
    
    class AddTitlePost
    {
        public function __construct()
        {
            //Llama al filter para modificar el titulo del post
            add_filter('the_title', array($this, 'nss_change_title'), 10, 2);
        }
    
        public function nss_change_title($title, $id)
        {
            $text = get_post_meta($id, KEY_META_BOX_TITLE, true);
            if (!empty($text)) {
                $title = $title . ' ' . $text;
            }
            return $title;
        }
    }
    
    return new AddTitlePost();

Ahora en el siguiente archivo `wp-content/plugins/NSSChangeTitlePost/admin/MetaBoxTitle.php`, realizar el registro de los meta box del title de cada post, para esto se utilizara los hooks de [add_meta_boxes](https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes) y [save_post](https://developer.wordpress.org/reference/hooks/save_post/)

    <?php
    
    class MetaBoxTitle
    {
    
        public function __construct()
        {
        // Llama a la accion para agregar el meta box del post
        add_action('add_meta_boxes_post', array($this, 'nss_add_meta_box'));

        // Llama a la accion de registrar el post
        add_action('save_post', array($this, 'nss_save_extend_title'));
        }
        public function nss_add_meta_box()
        {
            add_meta_box(
                'nss-extend-title-post',
                'Extensión del Título',
                array($this, 'nss_show_extend_title_meta_box')
            );
        }
        public function nss_show_extend_title_meta_box($post)
        {
            $post_id = $post->ID;
            $val = get_post_meta($post_id, KEY_META_BOX_TITLE, true);
    
            $html = '<label for="txt-extend-title-post">New Title:</label>';
            $html .= '<input name="txt-extend-title-post" type="text" value="' . esc_attr($val) . '" />';
            echo $html;
        }
        public function nss_save_extend_title($post_id)
        {
            // Si se está guardando de forma automática, no hacemos nada.
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
                return;
            }
            // Si nuestro campo de texto no está disponible, no hacemos nada.
            if (!isset($_REQUEST['txt-extend-title-post'])) {
                return;
            }
            // Ahora sí, obtenermos el valor del input text y limpiarlo por seguridad.
            $texto = trim(sanitize_text_field($_REQUEST['txt-extend-title-post']));
    
            // Guardar el campo personalizado del post
            update_post_meta($post_id, KEY_META_BOX_TITLE, $texto);
        }
    
    }
    
    return new MetaBoxTitle();

## Crear Widgets

Para crear un widget debemos de extender de la clase [WP_Widget](https://developer.wordpress.org/reference/classes/wp_widget/), para eso crearemos una clase `wp-content/themes/northsouth/Favorite_Post_Widget.php`, donde dicha clase tendra la siguiente estructura 

    <?php
    
    class Favorite_Post_Widget extends WP_Widget {
    
        public function __construct() {
            $widget_ops = array(
                'classname' => 'favorite_post_widget',
                'description' => 'A plugin for Kinsta blog readers',
            );
            parent::__construct( 'favorite_post_widget', 'Favorite Post Widget', $widget_ops );
        }
        
        //Muestra el contenido del widget en el frontend
        public function widget( $args, $instance ) {
        }
        
        //Muestra las opciones del formulario en el admin
        public function form( $instance ) {
        }
        
        //Procesamiento de las opciones del widget para guardar
        public function update( $new_instance, $old_instance ) {
        }
    }

Después de la creación de la clase llamaremos al action **widgets_init**, el cual llamara a la funcion **register_widget**

    add_action( 'widgets_init', function(){
        register_widget( 'Favorite_Post_Widget' );
    });
Por ultimo solo incluiremos el archivo del widget dentro del archivo `functions.php`

    if (!class_exists('Favorite_Post_Widget')) {
        require_once(__DIR__ . '/Favorite_Post_Widget.php');
    }
