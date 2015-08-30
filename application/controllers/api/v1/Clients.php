<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Clients API
 *
 * @filename   Clients.php
 * @access     public
 * @author     dev.khoailang <dev.khoailang@gmail.com>
 * @copyright  2015 dev.khoailang
 * @version    1.0
 */

defined('BASEPATH') or exit('You are not alone');

/**
 * Clients
 */
class Clients extends \API\MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        self::setClientToken(); // set client token
        self::validateHash(); // validate client hash
        $this->load->model('clients_model');
    }

    /**
     * client request token
     *
     * @return json
     */
    public function requestAccessToken()
    {
        $this->load->helper('string');
        $randStr       = random_string('alnum', 8);
        $clientToken   = uniqid() . '-' . $randStr . '-!@#$-' . md5(uniqid());
        $this->status  = true;
        $this->code    = self::SUCCESS_CODE;
        $this->message = self::SUCCESS_MSG;
        $this->data    = $clientToken;
        self::response();
        self::saveClientAccessToken($clientToken);
        exit();
    }

    protected function saveClientAccessToken($accessToken)
    {
        $clientData = [
            'client_id'      => $this->clientId,
            'client_os'      => $this->clientOs,
            'client_name'    => $this->clientName,
            'client_version' => $this->clientVersion,
            'access_token'   => $accessToken,
            'timestamp'      => time(),
        ];

        $this->clients_model->addClientData($clientData);
    }

}
