<?php

class item_m extends CI_Model
{


    public function get($id = null)
    {

        $this->db->select('p_item.*, p_category.name as category_name, p_unit.name as unit_name');
        $this->db->from('p_item');
        $this->db->join('p_unit', 'p_unit.unit_id = p_item.unit_id');
        $this->db->join('p_category', 'p_category.category_id = p_item.category_id');
        if ($id != null) { // menampilkan  data berdasarkan parameter id jika ada data yang dikirimkan

            $this->db->where('item_id', $id);
        }
        // menampilkan data keselurah pada tabel karna tidakn ada data pada parameter id yang dikirim
        $query = $this->db->get();
        return $query;
    }

    function check_barcode($code, $id = null)
    {
        $this->db->from('p_item');
        $this->db->where('barcode', $code);
        if ($id != null) {
            $this->db->where('item_id !=', $id);
        }
        $this->db->order_by('barcode', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'barcode' => $post['barcode'],
            'name' => $post['name'],
            'category_id' => $post['category'],
            'unit_id' => $post['unit'],
            'price' => $post['price'],
            'image' => $post['image'],

        ];
        $this->db->insert('p_item', $params);
    }

    public function edit($post)
    {
        $params['barcode'] = $post['barcode'];
        $params['name'] = $post['name'];
        $category['category_id'] = $post['category'];
        $unit_id['unit_id'] = $post['unit'];
        $price['price'] = $post['price'];
        $params['updated'] = date('Y-m-d H:i:s');


        if ($post['image'] != null) {
            $params['image'] = $post['image'];
        }

        $params['image'] = $post['image'];
        $this->db->where('item_id', $post['id']);
        $this->db->update('p_item', $params);
    }



    public function hapus($id)
    {

        $this->db->where('item_id', $id);
        $this->db->delete('p_item');
    }
}
