<?php

namespace CMS;

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * MY CMS Model
 *
 * @filename   MY_Model.php
 * @access     public
 * @author     dev.khoailang <dev.khoailang@gmail.com>
 * @copyright  2015 dev.khoailang
 * @version    1.0
 */

defined('BASEPATH') or exit('You are not alone');

/**
 * MY_CMSModel
 */
class MY_Model extends \CI_Model
{
    protected $keyCahe;
    protected $cacheExpired = 900;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * [getRecord description]
     *
     * @param  Object  $query
     * @param  boolean $fisrt_row
     * @param  boolean $cache
     *
     * @return []
     */
    protected function getRecord($query, $fisrt_row = false, $cache = false)
    {

        if ($query->num_rows() <= 0) {
            return false;
        }

        if ($fisrt_row) {
            $record = $query->first_row();
        } else {
            $record = $query->result();
        }

        if ($cache) {
            $this->cache->add($this->keyCahe, $record, $this->cacheExpired);
        }

        return $record;
    }

}
