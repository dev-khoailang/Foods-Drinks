<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Product Manager
 *
 * @filename   Products.php
 * @access     public
 * @author     dev.khoailang <dev.khoailang@gmail.com>
 * @copyright  2015 dev.khoailang
 * @version    1.0
 */

defined('BASEPATH') or exit('You are not alone');

/**
 * Products
 */
class Products extends \CMS\MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->auth->checkPermissions();
    }

    /**
     * List all Products
     *
     * @param  string  $name     product's name
     * @param  string  $type     product's type
     * @param  string  $username usename
     * @param  integer $limit    limit records
     * @param  integer $start
     *
     * @return
     */
    public function listProducts($name = '0', $type = '0', $username = '0', $limit = 30, $start = 0)
    {
        $filter = [
            'name'     => urldecode($name),
            'type'     => $type,
            'username' => urldecode($username),
            'limit'    => $limit,
            'start'    => $start,
        ];

        $products = $this->products_model->getListProducts($filter);

        if ($products) {

            foreach ($products as &$item) {
                $item->photos = [];
                $photo        = $this->products_model->getPhotoByProductId($item->id);

                if ($photo) {
                    $item->photos = $photo;
                }

            }

        }

        $total  = $this->products_model->getListProducts($filter, true);
        $config = [
            'base_url'    => base_url() . "listProducts/$name/$type/$username/$limit/",
            'total_rows'  => $total,
            'per_page'    => $limit,
            'uri_segment' => 6,
        ];
        $this->load->library('cms_pagination', $config);
        $pagination = $this->cms_pagination->create_links();

        $data               = $fitler;
        $data['products']   = $products;
        $data['total']      = $total;
        $data['pagination'] = $pagination;

        self::__loadHeader();
        self::__loadNavbar('product');
        $this->body = $this->load->view('products_view', $data);
        self::__loadView();
    }

    public function addProduct()
    {
    }

    public function editProduct($id)
    {
    }

    public function removeProduct()
    {
    }

    public function removePhoto($photoId)
    {
    }

}
