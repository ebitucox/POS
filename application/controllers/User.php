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



        $this->form_validation->set_rules('fullname', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('Passconf', 'Password confirmation', 'required');
        $this->form_validation->set_rules('address', 'Alamat', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('template', 'user/user_form_add');
        } else {
            echo "data berhasil disimpan";
        }
    }
}
