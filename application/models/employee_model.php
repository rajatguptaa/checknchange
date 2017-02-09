<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Employee_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function delete_user($user_ids) {

        $this->load->model("crm_model");

        $this->db->trans_begin();
        
        //Delete User Images  
        $user_profile = $this->crm_model->getWhereInData("user", array("user_profile"), $user_ids, "user_id");
        if (!empty($user_profile)) {
            foreach ($user_profile as $val) {
                image_delete("./" . $val['user_profile']);
            }
        }
        
        // User Relation Delete
        $this->crm_model->rowsDeleteWhereIn("user_organisation_rel", $user_ids, "user_id");
        $this->crm_model->rowsDeleteWhereIn("user_group_rel", $user_ids, "user_id");
        $this->crm_model->rowsDeleteWhereIn("feedback", $user_ids, "user_id");

        //Ticket Delete Module 
        $user_ticket = $this->crm_model->getWhereInData("ticket", array("ticket_id"), $user_ids, "user_id");
        if (!empty($user_ticket)) {
            $ticket_ids = array();

            foreach ($user_ticket as $val) {
                $ticket_ids[] = $val["ticket_id"];
            }

            $this->crm_model->rowsDeleteWhereIn("ticket_assign", $ticket_ids, "ticket_id");
            $this->crm_model->rowsDeleteWhereIn("ticket_history", $ticket_ids, "ticket_id");

            // getting ticket comment ids
            $comment_ids =array();
            $ticket_comment_rel = $this->crm_model->getWhereInData("ticket_comment_rel", array("comment_id"), $ticket_ids, "ticket_id");
            if (!empty($ticket_comment_rel)) {
                $comment_ids = array();
                foreach ($ticket_comment_rel as $val) {
                    $comment_ids[] = $val["comment_id"];
                }
            }

            // getting comment attachment ids
            $attachment_ids = array();
            if(!empty($comment_ids)){
            $ticket_attachment_rel = $this->crm_model->getWhereInData("comment_attachment_rel", array("attachment_id"), $comment_ids, "comment_id");
            if (!empty($ticket_attachment_rel)) {
                foreach ($ticket_attachment_rel as $val) {
                    $attachment_ids[] = $val["attachment_id"];
                }
            }
            }

            // getting ticket attachment ids
            $ticket_attachment_rel = $this->crm_model->getWhereInData("ticket_attachment_rel", array("attachment_id"), $ticket_ids, "ticket_id");
            if (!empty($ticket_attachment_rel)) {
                foreach ($ticket_attachment_rel as $val) {
                    $attachment_ids[] = $val["attachment_id"];
                }
            }

            // Delete ticket Rel tables
           
            if(!empty($ticket_ids))
            $this->crm_model->rowsDeleteWhereIn("ticket_comment_rel", $ticket_ids, "ticket_id");
            $this->crm_model->rowsDeleteWhereIn("ticket_attachment_rel", $ticket_ids, "ticket_id");
            if(!empty($comment_ids))
            $this->crm_model->rowsDeleteWhereIn("comment_attachment_rel", $comment_ids, "comment_id");

            //Delete attachment file
            $attachment_path = $this->crm_model->getWhereInData("attachment", array("attachment_path"), $attachment_ids, "attachment_id");
            if (!empty($attachment_path)) {
                foreach ($attachment_path as $val) {
                    image_delete("./" . $val['attachment_path']);
                }
            }

            //Delete attachment  
            $this->crm_model->rowsDeleteWhereIn("attachment", $attachment_ids, "attachment_id");
        }

        // Delete Ticket 
        $this->crm_model->rowsDeleteWhereIn("ticket", $user_ids, "user_id");

        // Delete User
        $this->crm_model->rowsDeleteWhereIn("user", $user_ids, "user_id");

        $this->db->trans_complete();
    }

}
