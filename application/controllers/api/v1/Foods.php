<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Foods Controller
 *
 * @filename   Foods.php
 * @access     public
 * @author     dev.khoailang <dev.khoailang@gmail.com>
 * @copyright  2015 dev.khoailang
 * @version    1.0
 */

defined('BASEPATH') or exit('You are not alone');

/**
 * Foods
 */
class Foods extends \API\MY_Controller
{
    private $foodId     = '';
    private $categoryId = '';
    private $keyword    = '';

    public function __construct()
    {
        parent::__construct();
        self::setClient();
        self::validateHash();
        $this->load->model('foods_model');
    }

    public function getFoodCategories()
    {
    }

    public function getFoodByCategory()
    {
    }

    public function getFoodDetail()
    {
    }

    public function searchFood()
    {
    }

    public function getDailyFoodMenu()
    {
    }

    public function getTopFoodInMonth()
    {
    }
}
