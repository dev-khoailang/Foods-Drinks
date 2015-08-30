<?php

namespace CMS;

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * MY CMS Controller
 *
 * @filename   MY_Controller.php
 * @access     public
 * @author     dev.khoailang <dev.khoailang@gmail.com>
 * @copyright  2015 dev.khoailang
 * @version    1.0
 */

defined('BASEPATH') or exit('You are not alone');

/**
 * MY_Controller
 */
class MY_Controller extends \CI_Controller
{
    protected $header;
    protected $navbar;
    protected $body;

    public function __construct()
    {
        parent::__construct();
        $this->lang->load('cms', currentLanguage());
    }

    /** load view page */
    protected function __loadView()
    {
        $data = [
            'header' => $this->header,
            'navbar' => $this->navbar,
            'body'   => $this->body,
        ];

        $this->load->view('home_view', $data);
    }

    /** load navbar */
    protected function __loadNavbar($page)
    {
        $data = [
            'page' => $page,
        ];
        $this->navbar = $this->load->view('navbar_view', $data, true);
    }

    /** load header */
    protected function __loadHeader()
    {
        $data = [
            'success'   => $this->session->flashdata('success'),
            'error'     => $this->session->flashdata('error'),
            'alertUrl'  => $this->session->flashdata('alertUrl'),
            'alertText' => $this->session->flashdata('alertText'),
        ];

        $this->header = $this->load->view('header_view', $data, true);
    }

    protected function __uploadImage($name, $dir = '')
    {

        if (!empty($_FILES[$name]['name'])) {
            $this->load->library('upload');
            $ext      = $This->upload->get_extension($_FILES[$name]['name']);
            $fileName = uniqid() . '.' . $ext;
            $path     = 'assets/uploads/images/';

            if ($dir) {
                $path .= $dir;
            }

            if (!is_dir('./' . $path)) {
                mkdir('./' . $path, 0755, true);
            }

            $config = [
                'allowed_types' => 'jpg|jpeg|png|gif',
                'upload_path'   => $path,
                'file_name'     => $fileName,
                'overwrite'     => 1,
            ];
            $this->upload->initialize($config);

            if (!$this->upload->do_upload($name)) {
                return false;
            }

            $upload = $this->upload->data();
            return $upload['full_path'];
        }

    }

}
