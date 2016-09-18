<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Crm_model extends CI_Model {
    /*
     * Select row from tabel and retun number of deleted rows
     * para 1 - Table name
     * para 2 - Select array
     * para 3 - Where Condition array
     * para 4 - join => array(
     *          [
     *              "table"=>value,
     *              "on" => value
     *          ],
     *          [
     *              "table"=>value,
     *              "on" => value
     *          ]
     * )
     * para 5 - order by
     * para 6 - order => asc , desc
     * para 7 - Limit
     * para 8 - Offset
     * para 9 - or_like => array(
     *              columnname => search,
     *              columnname => search,
     *              columnname => search
     * )
     * 
     * This return the array of result data if no data found return blank array.
     */

    public function getData($tablename, $select = '*', $where = false, $join = false, $order_by = false, $order = 'DESC', $limit = false, $offset = false, $or_like = false,$group_by = false) {

        $this->db->select($select)
                ->from($tablename);

        if ($where != FALSE) {
            $this->db->where($where);
        }

        if ($join != false && is_array($join)) {

            foreach ($join as $value) {
                
                if(array_key_exists("join",$value)){
                    $this->db->join($value['table'], $value['on'], $value['join']);
                }
                else{
                    $this->db->join($value['table'], $value['on'], 'left');
                }
                
            }
        }

        if ($order_by != false) {
            $this->db->order_by($order_by, $order);
        }

        if ($limit != FALSE && $offset == FALSE) {
            $this->db->limit($limit);
        } elseif ($limit != FALSE && $offset != FALSE) {
            $this->db->limit($limit, $offset);
        }
        // 

        if ($or_like != FALSE) {
            $str = "";
            foreach ($or_like as $key => $val) {
                if (strlen($str) == 0)
                    $str .= "(`" . $key . "` LIKE '%" . $val . "%'";
                else
                    $str .= " OR `" . $key . "` LIKE '%" . $val . "%'";
            }
            $str .=')';

            $this->db->where($str);
        }
        
        if($group_by!=FALSE){
           $this->db->group_by($group_by); 
        }

        $res = $this->db->get();
//        echo $this->db->last_query();

        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return array();
        }
    }

    /*
     * Count row from tabel and retun number of deleted rows
     * para 1 - Table name
     * para 2 - Select array
     * para 3 - Where Condition array
     * para 4 - join => array(
     *          [
     *              "table"=>value,
     *              "on" => value
     *          ],
     *          [
     *              "table"=>value,
     *              "on" => value
     *          ]
     * )
     * para 5 - order by
     * para 6 - order => asc , desc
     * para 7 - or_like => array(
     *              columnname => search,
     *              columnname => search,
     *              columnname => search
     * )
     * 
     * This return the array of result data if no data found return blank array.
     */

    public function getRowCount($tablename, $select = '*', $where = false, $join = false, $order_by = false, $order = 'desc', $or_like = false) {

        $this->db->select($select)
                ->from($tablename);

        if ($where != FALSE && is_array($where)) {
            $this->db->where($where);
        }

        if ($join != false && is_array($join)) {

            foreach ($join as $value) {
                $this->db->join($value['table'], $value['on'], 'left');
            }
        }

        if ($order_by != false) {
            $this->db->order_by($order_by, $order);
        }

         if ($or_like != FALSE) {
            $str = "";
            foreach ($or_like as $key => $val) {
                if (strlen($str) == 0)
                    $str .= "(`" . $key . "` LIKE '%" . $val . "%'";
                else
                    $str .= " OR `" . $key . "` LIKE '%" . $val . "%'";
            }
            $str .=')';

            $this->db->where($str);
        }

        return $this->db->count_all_results();
        ;
    }

    /*
     * Insert row from tabel and retun number of deleted rows
     * para 1 - Table name
     * para 2 - Data to insert
     */

    public function rowInsert($tablename, $data) {

        $query = $this->db->insert($tablename, $data);

        if ($query) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
//            echo $this->db->last_query();
        } else {
            return false;
        }
    }

    /*
     * Insert row from tabel and retun number of deleted rows
     * para 1 - Table name
     * para 2 - Data to insert
     */

    public function rowUpdate($tablename, $data, $where) {

        $query = $this->db->where($where)
                ->update($tablename, $data);
        if ($query) {
            $affected_rows = $this->db->affected_rows();
            return true;
        } else {
            return false;
        }
    }

    /*
     * Delete rows from tabel and retun number of deleted rows
     * para 1 - Table name
     * para 2 - where condition
     */

    public function rowsDelete($tablename, $where) {

        if ($this->db->delete($tablename, $where)) {

            return true;
        } else {
            return false;
        }
    }

    /*
     * Delete rows from tabel and retun number of deleted rows
     * para 1 - Table name
     * para 2 - where condition
     * para 3 - Column name
     */

    public function rowsDeleteWhereIn($tablename, $where, $column_name) {

        $this->db->where_in($column_name, $where);
        if ($this->db->delete($tablename)) {
            return true;
        } else {
            return false;
        }
    }

    public function getWhereInData($tablename, $select, $where, $column_name,$join = false,$condition=False) {

        $this->db->select($select);
               $this->db->from($tablename);
        
               if ($join != false && is_array($join)) {

            foreach ($join as $value) {
                $this->db->join($value['table'], $value['on'], 'left');
            }
            }         
                $this->db->where_in($column_name, $where);
                if ($condition != FALSE && is_array($condition)) {
            $this->db->where($condition);
                }
                $res =$this->db->get();

        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return array();
        }
    }

}
