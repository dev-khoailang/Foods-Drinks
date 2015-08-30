<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Authorized library
 *
 * @filename   Auth.php
 * @access     public
 * @author     dev.khoailang <dev.khoailang@gmail.com>
 * @copyright  2015 dev.khoailang
 * @version    1.0
 */

defined('BASEPATH') or exit('You are not alone');

class Auth
{
    private $authObj = [];
    private $ignores = ['login', 'crontabs'];
    private $backUrl;
    /*
     * construct
     */

    public function Auth()
    {
        $CI = &get_instance();
        $CI->load->model('admin_model');

        $this->backUrl = uri_string();

        if (!isAdminLogedIn()) {
            redirect('cms/login?backUrl=' . $this->backUrl);
        }

        $admin = $CI->admin_model->getAdminById(admin()->id);

        if (!$admin) {
            redirect('cms/login?backUrl=' . $this->backUrl);
        }

        if (admin()->isRoot) {
            return $this->authObj;
        }

        $permissions   = admin()->permissions;
        $this->authObj = unserialize($permissions);
    }

    /*
     * check quyền của admin
     */

    public function checkPermissions($requireROOT = false)
    {
        $CI = &get_instance();
        //is root

        if (admin()->isRoot) {
            return true;
        }

        if ($requireROOT && !admin()->isRoot) {
            show_error(lang('permission_denined'), 403);
        }

        /** @var strint current controller */
        $curCont = $CI->uri->segment(2);
        /** @var string current function */
        $curFunc   = $CI->uri->segment(3);
        $curFunc   = $curFunc ?: 'index';
        $curAccess = strtolower($curCont . '/' . $curFunc);

        //full access controller

        if (in_array($curCont, $this->authObj)) {
            return true;
        }

        //can access

        if (in_array($curAccess, $this->authObj)) {
            return true;
        }

        //no permission
        show_error(lang('permission_denined'), 403);
    }

    /*
     * get list controller
     */

    public function listController()
    {
        $CI = &get_instance();
        $CI->load->library('Controllerlist');
        return $CI->controllerlist->getControllers();
    }

}
