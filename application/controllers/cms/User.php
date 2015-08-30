<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * User Manager
 *
 * @filename   User.php
 * @access     public
 * @author     dev.khoailang <dev.khoailang@gmail.com>
 * @copyright  2015 dev.khoailang
 * @version    1.0
 */

defined('BASEPATH') or exit('You are not alone');

/**
 * User
 */
class User extends \CMS\MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->auth->checkPermissions();
        $this->load->model('user_model');
    }

    public function listUsers($username = 'all', $email = 'all', $status = 'all', $limit = 30, $start = 0)
    {
        $filter = [
            'username' => urldecode($username),
            'email'    => urldecode($email),
            'status'   => $status,
            'limit'    => $limit,
            'start'    => $start,
        ];

        $users = $this->user_model->getListUser($filter);
        $total = $this->user_model->getListUser($filter, true);

        if ($users) {

            foreach ($users as &$user) {
                $user->totalProduct = $this->user_model->getTotalProductByUserId($user->id);
            }

        }

        $config = [
            'base_url'    => base_url() . "cms/user/listUsers/$username/$email/$status/$limit/",
            'total_rows'  => $total,
            'per_page'    => $limit,
            'uri_segment' => 8,
        ];
        $this->load->library('cms_pagination', $config);
        $pagination = $this->cms_pagination->create_links();

        $data               = $filter;
        $data['users']      = $users;
        $data['total']      = $total;
        $data['pagination'] = $pagination;

        $this->body = $this->load->view('users/index_view', $data, true);
        self::__loadHeader();
        self::__loadNavbar('user');
        self::__loadView();
    }

    public function getProductsByUser($userId, $limit = 30, $start = 0)
    {
        $filter = [
            'userId' => $userId,
            'limit'  => $limit,
            'start'  => $start,
        ];
        $products = $this->user_model->getProductsByUser($filter);
        $total    = $this->user_model->getProductsByUser($filter, true);

        if ($products) {

            foreach ($products as &$item) {
                $item->photos = $this->products_model->getPhotoByProductId($item->id);
            }

        }

        // pagination
        $config = [
            'base_url'    => base_url() . "cms/user/products/$userId/$limit/",
            'total_rows'  => $total,
            'per_page'    => $limit,
            'uri_segment' => 6,
        ];
        $this->load->library('cms_pagination', $config);
        $pagination         = $this->cms_pagination->create_links();
        $data               = $filter;
        $data['product']    = $products;
        $data['total']      = $total;
        $data['user']       = $this->user_model->getUserById($userId);
        $data['pagination'] = $pagination;

        $this->body = $this->load->view('users/products_view', $data, true);
        self::__loadHeader();
        self::__loadNavbar('user');
        self::__loadView();

    }

    public function getUserDetail($userId)
    {
        $user         = $this->user_model->getUserById($userId);
        $totalProduct = $this->user_model->getTotalProductByUserId($userId);

        if (!$user) {
            show_error(lang('user_not_exist'), 404, lang('user_not_exist'));
        }

        $data = [
            'user'         => $user,
            'totalProduct' => $totalProduct,
        ];

        $this->body = $this->load->view('users/detail_view', $data, true);
        self::__loadHeader();
        self::__loadNavbar('user');
        self::__loadView();
    }

    public function banUser()
    {
        $data = [
            'user_id'  => $this->input->post('user_id'),
            'admin_id' => admin()->id,
            'reason'   => $this->input->post('reason'),
            'expired'  => $this->input->post('expired'),
            'timstamp' => time(),
        ];

        $res = $this->user_model->addUserBanned($data);

        if ($res) {
            exit(json_encode(['status' => true, 'message' => lang('success')]));
        }

        exit(json_encode(['status' => false, 'message' => lang('failed')]));
    }

}
