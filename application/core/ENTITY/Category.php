<?php

namespace ENTITY;

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Category Entity
 *
 * @filename   Category.php
 * @access     public
 * @author     dev.khoailang <dev.khoailang@gmail.com>
 * @copyright  2015 dev.khoailang
 * @version    1.0
 */

defined('BASEPATH') or exit('You are not alone');

/**
 * Category
 */
class Category extends Entity
{
    const TYPE_FOOD  = 'food';
    const TYPE_DRINK = 'drink';
    const TYPE_CAKE  = 'cake';

    private $name;
    private $image;
    private $desc;
    private $type;
    private $timestamp;
    private $parent;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setImage($imageUrl)
    {
        $this->image = $imageUrl;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setDesc($desc)
    {
        $this->desc = $desc;
    }

    public function getDesc()
    {
        return $this->desc;
    }

    public function setType($type)
    {

        switch ($type) {
            case self::TYPE_CAKE:
                $this->type = self::TYPE_CAKE;
                break;

            case self::TYPE_DRINK:
                $this->type = self::TYPE_DRINK;
                break;

            case self::TYPE_FOOD:
                $this->type = self::TYPE_FOOD;
                break;

            default:
                $this->type = self::TYPE_FOOD;
                break;
        }

    }

    public function getType()
    {
        return $this->type;
    }

    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function setParent(Category $parent)
    {
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }

}
