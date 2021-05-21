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
                $row = $query->row();
                $params = array(
                    'userid' => $row->user_id,
                    'level' => $row->level
                );
                $this->session->set_userdata($params);
                echo "<script>
                    alert('selamat login berhasil');
                    window.location='" . base_url('dashbord') . "';
                </script>";
            } else {
                echo "<script>
                    alert('username atau password salah');
                    window.location='" . base_url('auth/login') . "';
                </script>";
            }
        }
    }
}
