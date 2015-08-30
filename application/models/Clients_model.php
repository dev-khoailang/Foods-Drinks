<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Client Model
 *
 * @filename   Clients_model.php
 * @access     public
 * @author     dev.khoailang <dev.khoailang@gmail.com>
 * @copyright  2015 dev.khoailang
 * @version    1.0
 */

defined('BASEPATH') or exit('You are not alone');

/**
 * Clients_model
 */
class Clients_model extends \API\MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * insert new client
     *
     * @param array $clientData
     *
     * @return int|bool
     */
    public function addClientData(array $clientData = [])
    {
        $res = $this->db->insert('clients', $clientData);

        if ($res) {
            return $this->db->insert_id();
        }

        return false;
    }

    public function getClientByClientIdAndOs($clientId, $clientOs)
    {
        $this->db->where('client_id', $clientId);
        $this->db->where('client_os', $clientOs);
        $query = $this->db->get('clients');
        self::returnRecords($query, true);
    }

}
