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