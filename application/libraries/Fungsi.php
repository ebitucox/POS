<?php

class Fungsi
{
    protected $CI;


    public function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->CI = &get_instance();
    }


    public function user_login()
    {

        $this->CI->load->model('user_m');
        $user_id = $this->CI->session->userdata('userid');
        $user_data = $this->CI->user_m->get($user_id)->row();
        return $user_data;
    }
}
