<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * CMS Pagination
 *
 * @filename   Cms_pagination.php
 * @access     public
 * @author     dev.khoailang <dev.khoailang@gmail.com>
 * @copyright  2015 dev.khoailang
 * @version    1.0
 */
defined('BASEPATH') or exit('You are not alone');

require_once BASEPATH . 'libraries/Pagination.php';

/**
 * CMS Pagination
 */
class Cms_pagination extends CI_Pagination
{

    public function __construct($params = [])
    {
        parent::__construct($params);

        $this->first_link     = '';
        $this->pre_link       = 'Previous';
        $this->next_link      = 'Next';
        $this->last_link      = '';
        $this->cur_tag_open   = '<li class="paginate_button active"><a href="#">';
        $this->cur_tag_close  = '</a></li>';
        $this->next_tag_open  = '<li class="paginate_button next">';
        $this->next_tag_close = '</li>';
        $this->prev_tag_open  = '<li class="paginate_button previous">';
        $this->prev_tag_close = '</li>';
        $this->num_tag_open   = '<li class="paginate_button">';
        $this->num_tag_close  = '</li>';
        $this->num_link       = 5;
    }
}
