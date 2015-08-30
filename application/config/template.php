<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Template config
 *
 * @filename   template.php
 * @access     public
 * @author     dev.khoailang <dev.khoailang@gmail.com>
 * @copyright  2015 dev.khoailang
 * @version    1.0
 */

defined('BASEPATH') or exit('You are not alone');

$config['template'] = 'default';

$config['default_tmp'] = [
    'view'  => 'default',
    'asset' => 'assets/templates/default',
];

$config['custom_tmp'] = [
    'view'  => 'custom',
    'asset' => 'assets/templates/custom',
];
