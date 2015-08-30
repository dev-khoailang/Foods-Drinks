<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Controller Login
 *
 * @filename   Login.php
 * @access     public
 * @author     dev.khoailang <dev.khoailang@gmail.com>
 * @copyright  2015 dev.khoailang
 * @version    1.0
 */

defined('BASEPATH') or exit('You are not alone');

/**
 * Login
 */
class Login extends \CMS\MY_Controller
{
    private $backUrl;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }

    public function adminLogin()
    {

        if (isAdminLogedIn()) {
            redirect('cms/home');
        }

        if (requestMethod() == 'POST') {

            $usernameOrEmail = $this->input->post('username');
            $password        = $this->input->post('password');

            $admin = $this->admin_model->getAdminLogin($usernameOrEmail);

            if (!$admin) {
                show_error(lang('not_author'), 401);
            }

            $hashPassword = md5($password . $admin->salt);

            if ($hashPassword != $admin->password) {
                $this->session->set_flashdata('error', lang('login_failed'));
            }

            $group = $this->admin_model->getGroupById($admin->permission_group_id);

            if (!$admin) {
                show_error(lang('not_author'), 401);
            }

            $this->setAdminSession($admin, $group);

            $this->backUrl = $this->input->get('backUrl');

            if ($this->backUrl) {
                redirect($this->backUrl);
            }

            redirect('cms/dashboard');
        }

        $this->load->view('login_view');

    }

    public function logout()
    {
        $this->destroyAdminSession();

        $this->backUrl = $this->input->get('backUrl');

        if ($this->backUrl) {
            redirect($this->backUrl);
        }

        redirect('cms/login');
    }

    public function setAdminSession($admin, $group)
    {
        $session = [
            'id'          => $admin->id,
            'isRoot'      => $admin->root,
            'name'        => $admin->username,
            'email'       => $admin->email,
            'avatar'      => $admin->avatar,
            'groupId'     => $group->id,
            'groupName'   => $group->name,
            'permissions' => $group->permissions,
            'timeLogin'   => date('Y-m-d H:i:s', time()),
        ];

        $this->session->set_userdata('admin', $session);
    }

    public function destroyAdminSession()
    {
        $this->session->unset_userdata('admin');
    }

}
