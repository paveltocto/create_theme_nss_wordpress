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


    /**
     *  Esta función agrega el meta box de extender el titulo del post
     */
    public function nss_add_meta_box()
    {
        add_meta_box(
            'nss-extend-title-post',
            'Extensión del Título',
            array($this, 'nss_show_extend_title_meta_box')
        );
    }

    /**
     * Esta función es el callback que se utiliza para mostrar el meta box.
     * @param $post
     */
    public function nss_show_extend_title_meta_box($post)
    {
        $post_id = $post->ID;
        $val = get_post_meta($post_id, KEY_META_BOX_TITLE, true);

        $html = '<label for="txt-extend-title-post">New Title:</label>';
        $html .= '<input name="txt-extend-title-post" type="text" value="' . esc_attr($val) . '" />';

        echo $html;
    }

    /**
     * Esta función guardara el valor del meta box del post
     *
     * @param int $post_id el identificador del post que se va a guardar.
     */
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