<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Mon ngon moi ngay
 *
 * @filename   Clients.php
 * @access     public
 * @author     dev.khoailang <dev.khoailang@gmail.com>
 * @copyright  2015 dev.khoailang
 * @version    1.0
 */
defined('BASEPATH') or exit('You are not alone');

use ENTITY\Category;
use ENTITY\Food;

/**
* Monngonmoingay
*/
class Monngonmoingay
{
    private $url;

    public function __construct(array $config = [])
    {
        if(isset($config['url'])) {
            $this->url = $config['url'];
        }
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getCategories()
    {
        $html = $this->_cURL();
        $dom = str_get_html($html);
        $foodGroup = $dom->find('div.food_group');
        $listCategories = [];
        foreach($foodGroup as $group) {
            $groupName = trim($group->find('h2[itemprop=name]', 0)->plaintext);
            $groupImage = $group->find('img', 0)->src;

            // group category
            $groupCategory = new Category($groupName);
            $groupCategory->setImage($groupImage);
            $groupCategory->setTimestamp(time());
            $groupCategory->setType($groupCategory::TYPE_FOOD);

            // order category
            $orders = $group->find('.hl02a');
            foreach($orders as $order) {
                $categoryOrder = is_null($order->find('h3',0)) ? null : trim($order->find('h3', 0)->plaintext);

                $listItems = $order->find('li[itemprop=itemListElement]');
                foreach($listItems as $item) {
                    $itemName = trim($item->find('a', 0)->plaintext);
                    $itemCategory = new Category($itemName);
                    $itemCategory->setRootLink($item->find('a', 0)->href);
                    $itemCategory->setTimestamp(time());
                    $itemCategory->setType($itemCategory::TYPE_FOOD);

                    switch ($categoryOrder) {
                        case 'Thịt':
                            $itemCategory->setOrder($itemCategory::ORDER_FOOD_MEAT);
                            break;

                        case 'Hải sản':
                            $itemCategory->setOrder($itemCategory::ORDER_FOOD_SEAFOOD);
                            break;

                        case 'Rau củ quả':
                            $itemCategory->setOrder($itemCategory::ORDER_FOOD_VEGETABLE);
                            break;

                        case 'Khác':
                            if($groupName == 'NGUYÊN LIỆU') {
                                $itemCategory->setOrder($itemCategory::ORDER_FOOD_MATERIALS_OTHER);
                            } else {
                                $itemCategory->setOrder($itemCategory::ORDER_FOOD_OCCASION_OTHER);
                            }

                            break;

                        case 'Ngày':
                            $itemCategory->setOrder($itemCategory::ORDER_FOOD_DAY);
                            break;
                        case 'Lễ tiệc':
                            $itemCategory->setOrder($itemCategory::ORDER_FOOD_HOLIDAY);
                            break;
                        case 'Vùng miền':
                            $itemCategory->setOrder($itemCategory::ORDER_FOOD_LOCATION);
                            break;

                        default:
                            break;
                    }

                    $groupCategory->setChilds($itemCategory);
                }
            }

            $listCategories[] = $groupCategory;
        }

        return $listCategories;
    }


    public function _cURL()
    {
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $response = curl_exec($ch);
        $error = curl_errno($ch);
        curl_close($ch);
        if($error) {
            return false;
        }

        return $response;
    }


}