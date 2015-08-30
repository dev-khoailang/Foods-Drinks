<?php

namespace API;

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * MY Model
 *
 * @filename   MY_model.php
 * @access     public
 * @author     dev.khoailang <dev.khoailang@gmail.com>
 * @copyright  2015 dev.khoailang
 * @version    1.0
 */

defined('BASEPATH') or exit('You are not alone');

/**
 * MY_Model
 */
class MY_Model extends \CI_Model
{
    protected $keyCache;
    protected $expiredCache = 900;

    public function __construct()
    {
        parent::__construct();
    }

    protected function returnRecords($query, $firstRow = false, $cache = false)
    {

        if ($query->num_rows() > 0) {
            $result = $firstRow ? $query->first_rows() : $query->result();

            if ($cache and $this->keyCache) {
                $this->cache->add($this->keyCache, $result, $this->expiredCache);
            }

            return $result;
        }

        return false;
    }

}
