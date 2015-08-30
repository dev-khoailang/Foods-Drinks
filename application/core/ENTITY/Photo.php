<?php

namespace ENTITY;

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Photo Entity
 *
 * @filename   Photo.php
 * @access     public
 * @author     dev.khoailang <dev.khoailang@gmail.com>
 * @copyright  2015 dev.khoailang
 * @version    1.0
 */

defined('BASEPATH') or exit('You are not alone');

/**
 * Photo
 */
class Photo extends Entity
{
    private $url;
    private $thumb;

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setThumb($thumb)
    {
        $this->thumb = $thumb;
    }

    public function getThumb()
    {
        return $this->thumb;
    }
}
