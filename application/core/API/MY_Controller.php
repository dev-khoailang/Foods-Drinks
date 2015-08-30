<?php

namespace API;

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * MY_Controller
 *
 * @filename   MY_Controller.php
 * @access     public
 * @author     dev.khoailang <dev.khoailang@gmail.com>
 * @copyright  2015 dev.khoailang
 * @version    1.0
 */

defined('BASEPATH') or exit('You are not alone');

/**
 * MY_controller
 */
class MY_Controller extends \CI_Controller
{
    // define constant
    const ERR_CODE_PARAMETERS     = 11;
    const ERR_CODE_PERMISSION     = 12;
    const ERR_CODE_DATA_NOT_FOUND = 13;
    const ERR_CODE_TIMEOUT        = 14;
    const ERR_MSG_PARAMETERS      = 'Some Parameters Invalid.';
    const ERR_MSG_PERMISSION      = 'Permission Denined.';
    const ERR_MSG_DATA_NOT_FOUND  = 'Data not Found.';
    const ERR_MSG_TIMEOUT         = 'Connection Timeout.';
    const SUCCESS_CODE            = 0;
    const SUCCESS_MSG             = 'Successfully';

    protected $clientOs      = '';
    protected $clientId      = '';
    protected $clientName    = '';
    protected $clientVersion = '';
    protected $clientToken   = '';
    protected $accessToken   = GUEST_TOKEN;
    protected $language      = 'en';
    protected $time          = '';
    protected $hash          = '';
    protected $page          = 1;

    protected $status;
    protected $code;
    protected $message;
    protected $data = [];

    private $requireParams = ['accessToken', 'time', 'hash', 'clientId', 'clientOs'];
    private $numericParams = ['userId', 'categoryId', 'foodId', 'drinkId', 'cakeId'];

    public function __construct()
    {
        parent::__construct();

        self::initPostParameters(); // init post parameters
        self::validateParameters(); // validate require parameters
    }

    /**
     * initialize post parameters
     *
     * @return null
     */
    protected function initPostParameters()
    {
        $post = $this->input->post();

        foreach ($post as $key => $val) {

            if (property_exists($this, $key)) {
                $this->$key = $val;
            }

        }

    }

    /**
     * validate require parameters
     *
     * @param  array  $params
     *
     * @return null
     */
    protected function validateParameters(array $params = [])
    {
        $requireParams = array_unique(array_merge($this->requireParams, $params));

        foreach ($requireParams as $val) {

            if (!$this->$val or (in_array($val, $this->numericParams and !is_numeric($val)))) {
                $this->status  = false;
                $this->code    = self::ERR_CODE_PARAMETERS;
                $this->message = self::ERR_MSG_PARAMETERS;
                self::response();
                exit();
            }

        }

    }

    /**
     * check hash client
     *
     * @return null
     */
    protected function validateHash()
    {
        $post = $this->input->post();
        unset($post['hash']);
        ksort($post);
        $str  = implode('', $post);
        $hash = md5($this->clientToken . $str);

        if ($hash != $this->hash) {
            $this->status  = false;
            $this->code    = self::ERR_CODE_PERMISSION;
            $this->message = self::ERR_MSG_PERMISSION;
            self::response();
            exit();
        }

    }

    public function validateData()
    {

        if (!$this->data or empty($this->data)) {
            $this->status  = true;
            $this->code    = self::ERR_CODE_DATA_NOT_FOUND;
            $this->message = self::ERR_MSG_DATA_NOT_FOUND;
            $this->data    = [];
            self::response();
            exit();
        }

    }

    /**
     * response data to client
     *
     * @return json
     */
    protected function response()
    {
        $resObj = [
            'status'  => $this->status,
            'code'    => $this->code,
            'message' => $this->message,
            'data'    => $this->data,
        ];

        $this->output->set_content_type('application/json')->set_output(json_encode($resObj));
        $output = $this->output->get_output();

        ob_start();
        echo $output;
        ignore_user_abort(true);
        header("Connection: close\r\n");
        header("Content-Length:" . ob_get_length());
        header("Content-Encoding: None", true);
        ob_flush();
        ob_end_clean();
    }

    protected function setClientToken($accessToken = API_KEY)
    {
        $this->clientToken = $accessToken;
    }

    protected function setClient()
    {
        $client = $this->client_model->getClientByClientIdAndOs($this->clientId, $this->clientOs);

        if (!$client) {
            $this->status  = false;
            $this->code    = self::ERR_CODE_PERMISSION;
            $this->message = self::ERR_MSG_PERMISSION;
            self::response();
            exit();
        }

        self::setClientToken($client->access_token);
    }

}
