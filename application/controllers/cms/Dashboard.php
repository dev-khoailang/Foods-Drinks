<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Dashboard
 *
 * @filename   Dashboard.php
 * @access     public
 * @author     dev.khoailang <dev.khoailang@gmail.com>
 * @copyright  2015 dev.khoailang
 * @version    1.0
 */

defined('BASEPATH') or exit('You are not alone');

/**
 * Dashboard
 */
class Dashboard extends CMS\MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->auth->checkPermissions();
    }

    public function index()
    {
        self::__loadHeader();
        self::__loadNavbar('dashboard');
        $this->body = $this->load->view('dashboard_view', '', true);
        self::__loadView();
    }
}
