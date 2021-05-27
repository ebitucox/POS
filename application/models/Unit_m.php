<?php

class unit_m extends CI_Model
{


    public function get($id = null)
    {

        $this->db->select('*');
        $this->db->from('P_unit');
        if ($id != null) { // menampilkan  data berdasarkan parameter id jika ada data yang dikirimkan

            $this->db->where('unit_id', $id);
        }
        // menampilkan data keselurah pada tabel karna tidakn ada data pada parameter id yang dikirim
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'name' => $post['name'],

        ];
        $this->db->insert('p_unit', $params);
    }

    public function edit($post)
    {
        $params['name'] = $post['name'];
        $params['updated'] = date('Y-m-d H:i:s');

        $this->db->where('unit_id', $post['id']);
        $this->db->update('p_unit', $params);
    }



    public function hapus($id)
    {

        $this->db->where('unit_id', $id);
        $this->db->delete('p_unit');
    }
}
