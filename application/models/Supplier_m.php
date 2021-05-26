<?php

class Supplier_m extends CI_Model
{


    public function get($id = null)
    {

        $this->db->select('*');
        $this->db->from('supplier');
        if ($id != null) { // menampilkan  data berdasarkan parameter id jika ada data yang dikirimkan

            $this->db->where('supplier_id', $id);
        }
        // menampilkan data keselurah pada tabel karna tidakn ada data pada parameter id yang dikirim
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'name' => $post['name'],
            'phone' => $post['phone'],
            'address' => $post['address'],
            'description' => empty($post['description']) ? null : $post['description'],
        ];
        $this->db->insert('supplier', $params);
    }

    public function hapus($id)
    {

        $this->db->where('supplier_id', $id);
        $this->db->delete('supplier');
    }
}
