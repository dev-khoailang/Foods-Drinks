<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Authorization Controller
 *
 * @filename   AUTH_Controller.php
 * @access     public
 * @author     dev.khoailang <dev.khoailang@gmail.com>
 * @copyright  2015 dev.khoailang
 * @version    1.0
 */

defined('BASEPATH') or exit('You are not alone');

/**
 * Authorization Controller
 */
class AUTH_Controller extends \CMS\MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->auth->checkPermission();
    }
}
