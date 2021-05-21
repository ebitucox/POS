<?php

class Auth extends CI_Controller
{

    public function login()
    {
        $this->load->view('login');
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);

        if (isset($post['login'])) {

            $this->load->model('user_m');
            $query = $this->user_m->login($post);
            if ($query->num_rows() > 0) {
                echo "login berhasil";
            } else {
                echo 'login gagal';
            }
        }
    }
}
