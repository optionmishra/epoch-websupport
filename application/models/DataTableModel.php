<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class DataTableModel extends CI_Model
{
    public function __construct()
    {
        // Set table name
        $this->table = 'websupport_downloads_tracking';
        // Set orderable column fields
        // $this->column_order = array(null, 'title', 'email', 'downloaded_at');
        // Set searchable column fields
        // $this->column_search = array('title', 'email');
        // Set default order
        // $this->order = array('downloaded_at' => 'desc');
    }

    /*
     * Fetch members data from the database
     * @param $_POST filter data based on the posted parameters
     */
    public function getRows($postData)
    {
        $this->_get_datatables_query($postData);
        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();

        return $query->result();
    }

    // public function getCategoryAnalytics($postData)
    // {
    //     $this->_get_datatables_query($postData);
    //     if ($postData['length'] != -1) {
    //         $this->db->limit($postData['length'], $postData['start']);
    //     }
    //     // $this->db->from($this->table);
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    /*
     * Count all records
     */
    public function countAll()
    {
        $this->db->from($this->table);

        return $this->db->count_all_results();
    }

    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */

    public function countFiltered($postData)
    {
        $this->_get_datatables_query($postData);
        $query = $this->db->get();

        return $query->num_rows();
    }

    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */

    public function recently_downloaded()
    {
        $this->db->select(['title', 'email', 'fullname']);
        $this->db->select('websupport.subject as websupport_subject');
        $this->db->select('websupport_downloads_tracking.date as downloaded_at');
        $this->db->join('websupport', 'websupport.id = websupport_downloads_tracking.websupport_id');
        $this->db->join('web_user', 'web_user.id = websupport_downloads_tracking.user_id');
    }

    public function category_wise_download_data($cat_id)
    {
        $this->db->select(['title', 'email', 'fullname', 'type', 'websupport_id']);
        $this->db->select('COUNT(websupport_id) as downloads');
        $this->db->select('websupport.subject as websupport_subject');

        $this->db->select('websupport_downloads_tracking.date as downloaded_at');
        $this->db->select('classes.name as class_name');
        $this->db->select('main_subject.name as subject_name');

        $this->db->order_by('downloaded_at', 'desc');
        // $this->db->from('websupport_downloads_tracking');

        $this->db->join('websupport', 'websupport.id = websupport_downloads_tracking.websupport_id');
        $this->db->join('web_user', 'web_user.id = websupport_downloads_tracking.user_id');
        $this->db->join('classes', 'websupport.classes = classes.id');
        $this->db->join('main_subject', 'websupport.msubject = main_subject.id');

        $this->db->where('type', $cat_id);
        $this->db->group_by('websupport_id');
    }

    private function _get_datatables_query($postData)
    {
        $this->db->from($this->table);
        if (isset($postData['categoryID'])) {
            $this->category_wise_download_data($postData['categoryID']);
        } else {
            $this->recently_downloaded();
        }

        $i = 0;
        // loop searchable columns
        foreach ($this->column_search as $item) {
            // if datatable send POST for search
            if ($postData['search']['value']) {
                // first loop
                if ($i === 0) {
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                } else {
                    $this->db->or_like($item, $postData['search']['value']);
                }

                // last loop
                if (count($this->column_search) - 1 == $i) {
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }

        if (isset($postData['order'])) {
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        } elseif (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
}
