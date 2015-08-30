<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Admin Manager
 *
 * @filename   Admin.php
 * @access     public
 * @author     dev.khoailang <dev.khoailang@gmail.com>
 * @copyright  2015 dev.khoailang
 * @version    1.0
 */

defined('BASEPATH') or exit('You are not alone');

/**
 * Admin
 */
class Admin extends CMS\MY_Controller
{
    const STT_ACTIVED  = 'acvited';
    const STT_INACTIVE = 'inactive';
    const STT_BLOCKED  = 'blocked';

    public function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->auth->checkPermissions(true);
        $this->load->model('admin_model');
        $this->lang->load('auth', currentLanguage());
    }

    public function listAdmins($username = '0', $email = '0', $status = 'all', $group = '0', $limit = 30, $start = 0)
    {
        $filter = [
            'username' => urldecode($username),
            'email'    => urldecode($email),
            'status'   => $status,
            'group'    => $group,
            'limit'    => $limit,
            'start'    => $start,
        ];

        $admins = $this->admin_model->getListAdmins($filter);
        $total  = $this->admin_model->getListAdmins($filter, true);

        $config = [
            'base_url'    => base_url() . "$username/$email/$status/$group/$limit/",
            'total_rows'  => $total,
            'per_page'    => $limit,
            'uri_segment' => 6,
        ];
        $this->load->library('cms_pagination', $config);
        $pagination = $this->cms_pagination->create_links();

        $data               = $filter;
        $data['admins']     = $admins;
        $data['total']      = $total;
        $data['pagination'] = $pagination;

        self::__loadHeader();
        self::__loadNavbar('admin');
        $this->body = $this->load->view('admin/index_view', $data, true);
        self::__loadView();
    }

    public function addAdmin()
    {

        if (requestMethod() == 'POST') {
            $username = $this->input->post('username');
            $email    = $this->input->post('email');

            if ($this->admin_model->getAdminLogin($username) or $this->admin_model->getAdminLogin($email)) {
                $this->session->flashdata('error', lang('username_or_email_exist'));
                redirect('cms/admin/addAdmin');
            }

            $data = [
                'username'            => $this->input->post('username'),
                'email'               => $this->input->post('email'),
                'phone'               => $this->input->post('phone'),
                'root'                => (int) $this->input->post('root'),
                'permission_group_id' => $this->input->post('group'),
                'status'              => $this->input->post('status'),
                'role'                => 'admin',
                'created_time'        => time(),
                'last_update'         => time(),
            ];
            $salt             = uniqid();
            $password         = $this->input->post('password');
            $data['salt']     = $salt;
            $data['password'] = md5($password . $salt);

            if (!empty($_FILES['image']['name'])) {
                $avatar = self::__uploadImage('image', 'admin/');

                if ($avatar) {
                    $data['avatar'] = $avatar;
                }

            }

            $res = $this->admin_model->addAdmin($data);

            if ($res) {
                $this->session->set_flashdata('success', lang('success'));
                redirect('cms/admin');
            } else {
                $this->session->set_flashdata('error', lang('failed'));
                redirect('cms/admin/addAdmin');
            }

        }

        $data['groups'] = $this->admin_model->getListGroups();

        self::__loadHeader();
        self::__loadNavbar('admin');
        $this->body = $this->load->view('admin/add_view', $data, true);
        self::__loadView();
    }

    public function editAdmin($id)
    {

        if (requestMethod() == 'POST') {
            $data = [
                'phone'               => $this->input->post('phone'),
                'root'                => (int) $this->input->post('root'),
                'permission_group_id' => $this->input->post('group'),
                'status'              => $this->input->post('status'),
                'last_update'         => time(),
            ];

            if (!empty($_FILES['image']['name'])) {
                $avatar = self::__uploadImage('image', 'admin/');

                if ($avatar) {
                    $data['avatar'] = $avatar;
                }

            }

            $res = $this->admin_model->updateAdmin($id, $data);

            if ($res) {
                $this->session->set_flashdata('success', lang('success'));
                redirect('cms/admin');
            } else {
                $this->session->set_flashdata('error', lang('failed'));
                redirect('cms/admin/addAdmin');
            }

        }

        $data['groups'] = $this->admin_model->getListGroups();
        $data['admin']  = $this->admin_model->getAdminById($id);

        self::__loadHeader();
        self::__loadNavbar('admin');
        $this->body = $this->load->view('admin/edit_view', $data, true);
        self::__loadView();
    }

    public function blockAdmin($id)
    {
    }

    /**
     * [listGroups description]
     */
    public function listGroups($name = '0', $limit = 30, $start = 0)
    {
        $filter = [
            'name'  => urldecode($name),
            'limit' => $limit,
            'start' => $start,
        ];
        $groups = $this->admin_model->getListGroups($filter);
        $total  = $this->admin_model->getListGroups($filter, true);
        $config = [
            'base_url'    => base_url() . "admin/listGroups/$name/$limit/",
            'total_rows'  => $total,
            'per_page'    => $limit,
            'uri_segment' => 5,
        ];
        $this->load->library('cms_pagination', $config);
        $pagination         = $this->cms_pagination->create_links();
        $data               = $filter;
        $data['groups']     = $groups;
        $data['total']      = $total;
        $data['pagination'] = $pagination;

        self::__loadHeader();
        self::__loadNavbar('admin');
        $this->body = $this->load->view('admin/group_view', $data, true);
        self::__loadView();
    }

    /**
     * add new group permission
     */
    public function addGroup()
    {

        if (requestMethod() == 'POST') {
            $controllers = $this->input->post('cont_permission');
            $methods     = $this->input->post('method_permission');
            $permissions = [];

            // set full permission controller

            if ($controllers) {

                foreach ($controllers as $controller) {
                    $permissions[] = $controller;
                }

            }

            // set permission method

            if ($methods) {

                foreach ($methods as $cont => $method) {

                    if (!$controllers or !in_array($cont, $controllers)) {
                        $permissions[] = $method;
                    }

                }

            }

            $data = [
                'name'         => $this->input->post('name'),
                'desc'         => $this->input->post('desc'),
                'permissions'  => serialize($permissions),
                'created_time' => time(),
                'last_update'  => time(),
            ];

            $res = $this->admin_model->addGroup($data);

            if ($res) {
                $this->session->set_flashdata('success', lang('success'));
                $this->session->set_flashdata('alertUrl', base_url() . 'cms/admin/addGroup');
                $this->session->set_flashdata('alertText', lang('add_new_one'));
                redirect('/cms/admin');
            } else {
                $this->session->set_flashdata('error', lang('failed'));
                redirect('/cms/addGroup');
            }

        }

        $data['controllers'] = $this->auth->listController();

        self::__loadHeader();
        self::__loadNavbar('admin');
        $this->body = $this->load->view('admin/add_group_view', $data, true);
        self::__loadView();

    }

    public function editGroup($id)
    {

        if (requestMethod() == 'POST') {
            $controllers = $this->input->post('cont_permission');
            $methods     = $this->input->post('method_permission');
            $permissions = [];

            // set full permission controller

            if ($controllers) {

                foreach ($controllers as $controller) {
                    $permissions[] = $controller;
                }

            }

            // set permission method

            if ($methods) {

                foreach ($methods as $cont => $method) {

                    if (!$controllers or !in_array($cont, $controllers)) {
                        $permissions[] = $method;
                    }

                }

            }

            $data = [
                'name'        => $this->input->post('name'),
                'desc'        => $this->input->post('desc'),
                'permissions' => serialize($permissions),
                'last_update' => time(),
            ];

            $res = $this->admin_model->updateGroup($id, $data);

            if ($res) {
                $this->session->set_flashdata('success', lang('success'));
            } else {
                $this->session->set_flashdata('error', lang('failed'));
            }

            redirect('cms/admin/editGroup/' . $id);

        }

        $data['controllers'] = $this->auth->listController();
        $group               = $this->admin_model->getGroupById($id);
        $group->permissions  = unserialize($group->permissions);
        $data['group']       = $group;

        self::__loadHeader();
        self::__loadNavbar('admin');
        $this->body = $this->load->view('admin/edit_group_view', $data, true);
        self::__loadView();

    }

}
