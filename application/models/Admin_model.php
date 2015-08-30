<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Admin Model
 *
 * @filename   Admin_model.php
 * @access     protected
 * @author     dev.khoailang <dev.khoailang@gmail.com>
 * @copyright  2015 dev.khoailang
 * @version    1.0
 */

defined('BASEPATH') or exit('You are not alone');

/**
 *  Admin Model
 */
class Admin_model extends CMS\MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * [getAdminById description]
     *
     * @param  int $adminId
     *
     * @return {}
     */
    public function getAdminById($adminId)
    {
        $this->db->where('id', (int) $adminId);
        $query = $this->db->get('users');
        return $this->getRecord($query, true);
    }

    /**
     * [getListAdmins description]
     *
     * @param  array   $filter
     * @param  boolean $count
     *
     * @return []
     */
    public function getListAdmins(array $filter = array(), $count = false)
    {

        if (isset($filter['username']) and $filter['username']) {
            $this->db->like('username', $filter['username']);
        }

        if (isset($filter['email']) and $filter['email']) {
            $this->db->where('email', $filter['email']);
        }

        if (isset($filter['status']) and $filter['status'] != 'all') {
            $this->db->where('status', $filter['status']);
        }

        $this->db->where('role', 'admin');

        if ($count) {
            return $this->db->count_all_results('users');
        }

        if (isset($filter['limit'])) {
            $this->db->limit($filter['limit'], $filter['start']);
        }

        $query = $this->db->get('users');
        return $this->getRecord($query);
    }

    /**
     * [getGroupById description]
     *
     * @param  int $groupId
     *
     * @return {}
     */
    public function getGroupById($groupId)
    {
        $this->db->where('id', $groupId);
        $query = $this->db->get('group_permissions');
        return $this->getRecord($query, true);
    }

    /**
     * [getListGroups description]
     *
     * @param  array   $filter
     * @param  boolean $count
     *
     * @return []
     */
    public function getListGroups(array $filter = array(), $count = false)
    {

        if (isset($filter['name']) and $filter['name']) {
            $this->db->like('name', $filter['name']);
        }

        if ($count) {
            return $this->db->count_all_results('group_permissions');
        }

        if (isset($filter['limit'])) {
            $this->db->limit((int) $filter['limit'], (int) $filter['start']);
        }

        $query = $this->db->get('group_permissions');
        return $this->getRecord($query);
    }

    /**
     * [addAdmin description]
     *
     * @param array $data
     *
     * @return int
     */
    public function addAdmin(array $data = array())
    {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    /**
     * [updateAdmin description]
     *
     * @param  int $adminId
     * @param  array  $data
     *
     * @return bool
     */
    public function updateAdmin($adminId, array $data = array())
    {
        $this->db->where('id', $adminId);
        return $this->db->update('users', $data);
    }

    /**
     * [blockAdmin description]
     *
     * @param  int $adminId
     *
     * @return bool
     */
    public function blockAdmin($adminId)
    {
    }

    /**
     * [addGroup description]
     *
     * @param array $data
     */
    public function addGroup(array $data = array())
    {
        $this->db->insert('group_permissions', $data);
        return $this->db->insert_id();
    }

    /**
     * [updateGroup description]
     *
     * @param  int $groupId
     * @param  array  $data
     *
     * @return bool
     */
    public function updateGroup($groupId, array $data = array())
    {
        $this->db->where('id', $groupId);
        return $this->db->update('group_permissions', $data);
    }

    /**
     * [getAdminLogin description]
     *
     * @param  string $usernameOrEmail
     *
     * @return {}
     */
    public function getAdminLogin($usernameOrEmail)
    {
        $sql = "SELECT * FROM users
                WHERE (username = '$usernameOrEmail' OR email   = '$usernameOrEmail')
                AND role = 'admin' AND status='actived'";
        $query = $this->db->query($sql);
        return $this->getRecord($query, true);
    }

}
