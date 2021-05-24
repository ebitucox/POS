<?php

class User_m extends CI_Model
{
    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $post['username']);
        $this->db->where('password', md5($post['password']));

        $query = $this->db->get();
        return $query;
    }

    public function get($id = null)
    {

        $this->db->select('*');
        $this->db->from('user');
        if ($id != null) { // menampilkan  data berdasarkan parameter id jika ada data yang dikirimkan

            $this->db->where('user_id', $id);
        }
        // menampilkan data keselurah pada tabel karna tidakn ada data pada parameter id yang dikirim
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params['username'] = $post['username'];
        $params['password'] = md5($post['passconf']);
        $params['name'] = $post['fullname'];
        $params['address'] = $post['address'];
        $params['level'] = $post['level'];

        $this->db->insert('user', $params);
    }

    public function hapus_data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
