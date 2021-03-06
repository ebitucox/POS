<?php

class User extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model('user_m');
    }


    public function index()
    {
        // $this->load->model('user_m');

        $data['row'] = $this->user_m->get(); //meload model user_m
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
                $this->session->set_flashdata('success', 'Data Berhasil diupload');
            }
            redirect(base_url('user'));
        }
    }

    public function edit($id)
    {


        $this->form_validation->set_rules('fullname', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|callback_username_check');

        // 
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
            $this->form_validation->set_rules(
                'passconf',
                'Password confirmation',
                'required|matches[password]',
                array('matches' => '%s tidak sesuai dengan password')
            );
        }

        if ($this->input->post('passconf')) {
            $this->form_validation->set_rules(
                'passconf',
                'Password confirmation',
                'required|matches[password]',
                array('matches' => '%s tidak sesuai dengan password')
            );
        }
        $this->form_validation->set_rules('address', 'Alamat', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');

        $this->form_validation->set_message('required', '%s  masih kosong silahkan diisi...!!');
        $this->form_validation->set_message('min_length', '{field} minimal 5 karakter');
        $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan ganti');



        if ($this->form_validation->run() == FALSE) {
            $query = $this->user_m->get($id);
            if ($query->num_rows() > 0) {

                $data['row'] = $query->row();
                $this->template->load('template', 'user/user_form_edit', $data);
            } else {
                echo "<script> alert('Data tidak ditemukan ');</script>";
                echo "<script>window.location='" . base_url('user') . "' </script>";
            }
        } else {
            $post = $this->input->post(null, TRUE);
            $this->user_m->edit($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Berhasil diedit');
            }
            redirect(base_url('user'));
        }
    }

    public function username_check()
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM user WHERE username = '$post[username]' AND user_id != '$post[user_id]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('username_check', '{field} ini sudah dipakai, silahkan ganti');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function hapus()
    {

        $id = $this->input->post('user_id');
        $this->user_m->hapus($id);


        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Berhasil dihapus');
        }
        redirect(base_url('user'));
    }
}
