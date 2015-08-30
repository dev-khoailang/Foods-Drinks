<?php

namespace ENTITY;

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Entity
 *
 * @filename   Entity.php
 * @access     public
 * @author     dev.khoailang <dev.khoailang@gmail.com>
 * @copyright  2015 dev.khoailang
 * @version    1.0
 */

defined('BASEPATH') or exit('You are not alone');

/**
 * Entity
 */
class Entity
{
    /** @var int, autoinrement Id */
    protected $id;

    /**
     * set Id
     *
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * get Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
