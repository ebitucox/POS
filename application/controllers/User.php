<?php

class User extends CI_Controller
{

    public function index()
    {

        $this->load->model('user_m');
        $data['row'] = $this->user_m->get(); //meload model user_m

        check_not_login();
        $this->template->load('template', 'user/user_data', $data);
    }
    public function add()
    {

        $this->template->load('template', 'user/user_form_add');
    }
}
