<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Crawler Controller
 *
 * @filename   Clients.php
 * @access     public
 * @author     dev.khoailang <dev.khoailang@gmail.com>
 * @copyright  2015 dev.khoailang
 * @version    1.0
 */

defined('BASEPATH') or exit('You are not alone');

/**
* Crawler
*/
class Crawler extends CI_Controller
{
    const MON_NGON_MOI_NGAY = 'monngonmoingay.com';

    private $method;
    private $class;
    private $url;


    public function __construct()
    {
        parent::__construct();
        $this->class = $this->router->fetch_class();
        $this->method = $this->router->fetch_method();
    }

    public function index()
    {
        die('ggf');
    }

    public function getHost()
    {
        $parse = parse_url($this->url);
        if(isset($parse['host'])) {
            return $parse['host'];
        }

        return false;
    }

    public function getCategories($url = '')
    {
        $url = 'http://monngonmoingay.com/';
        $this->url = $url;
        $host = $this->getHost();
        switch ($host) {
            case self::MON_NGON_MOI_NGAY:
                $this->load->library('Monngonmoingay', ['url' => $this->url]);
                return $this->monngonmoingay->getCategories();
                break;

            default:
                break;
        }
    }


}