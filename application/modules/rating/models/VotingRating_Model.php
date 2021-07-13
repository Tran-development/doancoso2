<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class rating_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }


    /*  This function get ratings count number
    related to specfic item id.
     */

    function get_rate_numbers($post_id) {
        $rate_num = $this->db->query("select * from d_rating where rt_item_id='$post_id'")->num_rows();
        return $rate_num;
    }

    /*
 * This function check if user
    has rate specfic item or not
*/
    function get_user_numrate($post_id,$userid) {
        $rate_num = $this->db->query("
        select * from d_rating
         INNER JOIN d_rating_users ON rtu_rate_id = rt_id
         where rt_item_id ='$post_id'
         AND  rtu_user_id ='$userid' ");
        if ($rate_num->num_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    /*  This function get ratings
    related to specfic item id. */

    function get_article_rate($post_id) {
        $query = $this->db->query("select * from d_rating where rt_item_id='$post_id'");
        if ($query->num_rows() > 0)
        {
            $result = $query->row();
            return $result;

        }else{
            return false;
        }
    }
    /*  This function insert ratings
    with item id and user id. */

    function insert_rate($id,$rate,$user_id) {
        $this->db->query("insert into d_rating values('','$id','1','$rate')");
        $last_id = mysql_insert_id();
        $this->db->query("insert into d_rating_users values('',$last_id,$user_id,UNIX_TIMESTAMP())");
        return true;
    }

    function update_rate($id,$rate,$user_id) {

        $upadte_rate1=$this->db->query("select * from d_rating where rt_item_id='$id'")->row();
        $total_rates= $upadte_rate1->rt_total_rates+1;
        $total_points= $upadte_rate1->rt_total_points+$rate;
        $rate_id= $upadte_rate1->rt_id;
        $this->db->query("update d_rating set rt_total_rates='$total_rates', rt_total_points='$total_points' where rt_id='$rate_id'");
        $this->db->query("insert into d_rating_users values('','$id',$user_id,UNIX_TIMESTAMP())");

        return true;
    }
}