<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Food helper
 *
 * @filename   food_helper.php
 * @access     public
 * @author     dev.khoailang <dev.khoailang@gmail.com>
 * @copyright  2015 dev.khoailang
 * @version    1.0
 */
defined('BASEPATH') or exit('You are not alone');

if (!function_exists('loadAssets')) {
    /**
     * Load assets by template
     *
     * @param  string $path uri
     *
     * @return string uri
     */
    function loadAssets($path)
    {
        $CI       = &get_instance();
        $tmp      = $CI->config->item('template');
        $tempDesc = $CI->config->item($tmp . '_tmp');

        $fullPath = base_url() . $tempDesc['asset'] . DIRECTORY_SEPARATOR . $path;
        return $fullPath;
    }

}

if (!function_exists('admin')) {
    /**
     * [admin description]
     *
     * @return Object admin
     */
    function admin()
    {
        $CI    = &get_instance();
        $admin = $CI->session->userdata('admin');

        if ($admin) {
            $result              = new stdClass();
            $result->id          = $admin['id'];
            $result->isRoot      = $admin['isRoot'];
            $result->name        = $admin['name'];
            $result->email       = $admin['email'];
            $result->avatar      = $admin['avatar'];
            $result->groupId     = $admin['groupId'];
            $result->groupName   = $admin['groupName'];
            $result->permissions = $admin['permissions'];
            $result->timeLogin   = $admin['timeLogin'];
            return $result;
        }

        return false;
    }

}

if (!function_exists('isAdminLogedIn')) {
    function isAdminLogedIn()
    {
        $CI    = &get_instance();
        $admin = $CI->session->userdata('admin');

        if ($admin and !empty($admin)) {
            return true;
        }

        return false;
    }

}

if (!function_exists('currentLanguage')) {
    /**
     * [currentLanguage description]
     *
     * @return string, current language in used
     */
    function currentLanguage()
    {
        $CI       = &get_instance();
        $language = $CI->session->userdata('language');

        if (!$language) {
            return 'english';
        }

        return $language;
    }

}

if (!function_exists('debug')) {

    /**
     * [debug description]
     *
     * @param  [type] $data [description]
     *
     * @return [type]       [description]
     */
    function debug($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }

}

if (!function_exists('requestMethod')) {
    /**
     * [requestMethod description]
     *
     * @return string, method of Request GET|POST|PUT|DELETE
     */
    function requestMethod()
    {
        $CI     = &get_instance();
        $method = $CI->input->server('REQUEST_METHOD');
        return $method;
    }

}

if (!function_exists('loadImage')) {
    /**
     * [loadImage description]
     *
     * @param  string $path
     *
     * @return string, url of image
     */
    function loadImage($path = '')
    {

        if (strpos($path, 'http://') === false and strpos($path, 'https://') == false) {
            $path = ltrim($path, '.');
            $url  = base_url() . ltrim($path, '/');
            return $url;
        }

        return $path;
    }

}
