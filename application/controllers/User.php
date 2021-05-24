<?php

class User extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('user_m');
    }


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
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|is_unique[user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules(
            'passconf',
            'Password confirmation',
            'required|matches[password]',
            array('matches' => '%s tidak sesuai dengan password')
        );
        $this->form_validation->set_rules('address', 'Alamat', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');

        $this->form_validation->set_message('required', '%s  masih kosong silahkan diisi...!!');
        $this->form_validation->set_message('min_length', '{field} minimal 5 karakter');
        $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');





        if ($this->form_validation->run() == FALSE) {
            $this->template->load('template', 'user/user_form_add');
        } else {
            $post = $this->input->post(null, TRUE);
            $this->user_m->add($post);
            if ($this->db->affected_rows() > 0) {
                echo "<script>
                    alert('Date berhasil diupload);
            </script>";
            }
            echo "<script>window.location='" . base_url('user') . "' </script>";
        }
    }

    public function hapus()
    {

        $id = $this->input->post('user_id');
        $this->user_m->hapus($id);


        if ($this->db->affected_rows() > 0) {
            echo "<script>
                alert('data berhasil dihapus');
            </script>";
        }

        echo "<script>
        window.location='" . base_url('user') . "'
        </script>";
    }
}
