<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * MY Loader
 *
 * @filename   MY_Loader.php
 * @access     public
 * @author     dev.khoailang <dev.khoailang@gmail.com>
 * @copyright  2015 dev.khoailang
 * @version    1.0
 */

defined('BASEPATH') or exit('You are not alone');

/**
 * MY_Loader
 */
class MY_Loader extends CI_Loader
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * load view
     *
     * @param  string  $view
     * @param  array   $vars
     * @param  boolean $return
     *
     */
    public function view($view, $vars = [], $return = false)
    {
        $CI      = &get_instance();
        $tmp     = $CI->config->item('template');
        $tmpDesc = $CI->config->item($tmp . '_tmp');

        return $this->_ci_load([
            '_ci_view'   => $tmpDesc['view'] . DIRECTORY_SEPARATOR . $view,
            '_ci_vars'   => $this->_ci_object_to_array($vars),
            '_ci_return' => $return,
        ]);
    }
}
