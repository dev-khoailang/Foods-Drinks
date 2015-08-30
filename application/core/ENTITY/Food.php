<?php

namespace ENTITY;

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Food Entity
 *
 * @filename   Food.php
 * @access     public
 * @author     dev.khoailang <dev.khoailang@gmail.com>
 * @copyright  2015 dev.khoailang
 * @version    1.0
 */

defined('BASEPATH') or exit('You are not alone');

/**
 * Food
 */
class Food extends Entity
{
    private $name;
    private $slug;
    private $desc;
    private $materials;
    private $cooking;
    private $video;
    private $totalFavourite;
    private $timestamp;

    private $photos     = [];
    private $categories = [];

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setDesc($desc)
    {
        $this->desc = $desc;
    }

    public function getDesc()
    {
        return $this->desc;
    }

    public function setMaterials($materials)
    {
        $this->materials = $materials;
    }

    public function getMaterials()
    {
        return $this->materials;
    }

    public function setCooking($cooking)
    {
        return $this->cooking;
    }

    public function setVideo($video)
    {
        $this->video = $video;
    }

    public function getVideo()
    {
        return $this->video;
    }

    public function setTotalFavourite($totalFavourite)
    {
        $this->totalFavourite = $totalFavourite;
    }

    public function getTotalFavourite()
    {
        return $this->totalFavourite;
    }

    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function setPhoto(Photo $photo)
    {
        $this->photos[] = $photo;
    }

    public function getPhoto()
    {
        return $this->photos;
    }

    public function setCategory(Category $category)
    {
        $this->categories[] = $category;
    }

    public function getCategory()
    {
        return $this->categories;
    }

}
