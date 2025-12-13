<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class WebModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function validate_email($id)
    {
        if (! empty($id)) {
            $this->db->where('email', $id);
        }
        $res = $this->db->get('web_user')->result();

        return $res;
    }

    public function validate_student($id)
    {
        if (! empty($id)) {
            $this->db->where('teacher_code', $id);
            $res = $this->db->get('web_user')->row_array();
            if (! $res) {
                $this->error = $this->db->error();

                return false;
            } else {
                return $res;
            }
        } else {
            return false;
        }
    }

    // this function modified for student limit feature
    public function validate_student_mod($id)
    {
        if (! empty($id)) {
            $this->db->where('teacher_code', $id);
            $res = $this->db->get('web_user')->row_array();
            if (! $res) {
                $this->error = $this->db->error();

                return false;
            } else {
                $this->db->where('stu_teacher_id', $id);
                $limit_exhausted = count($this->db->get('web_user')->result()) <= (int) $res['stu_limit'] ? $res : 'limit_exhausted';

                // var_dump($limit_exhausted);
                // exit;
                return $limit_exhausted;
            }
        } else {
            return false;
        }
    }

    public function Webuser()
    {
        $username = $this->session->userdata('username');
        if (! empty($username)) {
            $this->db->where('email', $username);
        }
        $row = $this->db->get('web_user')->row();
        if (! $row) {
            $this->error = $this->db->error();

            return false;
        } else {
            return $row;
        }
    }

    public function subjects()
    {
        $sub = $this->session->userdata('subject');
        $this->db->where('id', $sub);
        $result = $this->db->get('subject')->result();
        if (! $result) {
            $this->error = $this->db->error();

            return false;
        } else {
            return $result;
        }
    }

    public function msubjects()
    {
        $sub = $this->session->userdata('msubject');
        $this->db->where('id', $sub);
        $result = $this->db->get('main_subject')->result();
        if (! $result) {
            $this->error = $this->db->error();

            return false;
        } else {
            return $result;
        }
    }
}
