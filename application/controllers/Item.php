<?php
// defined('BASEPATH') or exit('No direct script access allowed');

class Item extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model(['item_m', 'category_m', 'unit_m']);
    }

    public function index()
    {
        $data['row'] = $this->item_m->get();
        $this->template->load('template', 'produk/item/item_data', $data);
        // $this->template->load('template', 'produk/item/item_data', $data);
    }

    public function add()
    {
        $item = new stdClass();

        $item->item_id = null;
        $item->barcode = null;
        $item->name = null;
        $item->price = null;
        $item->category_id = null;

        // melempar data lalu melakukan perulangan di utem_form
        $category  = $this->category_m->get();

        // melakukan perulangan lalu melempar data ke item_form

        $query_unit = $this->unit_m->get();
        $unit[null] = '-pilih-';
        foreach ($query_unit->result() as $key => $value) {
            $unit[$value->unit_id] = $value->name;
        }
        $data = array(
            'page' => 'add',
            'row'   => $item,
            'category' => $category,
            'unit' => $unit, 'selectedunit' => null,
        );

        $this->template->load('template', 'produk/item/item_form', $data);
    }


    public function edit($id)
    {
        $query = $this->item_m->get($id);

        if ($query->num_rows() > 0) {
            $item = $query->row();
            // melempar data lalu melakukan perulangan di utem_form
            $category  = $this->category_m->get();

            // melakukan perulangan lalu melempar data ke item_form

            $query_unit = $this->unit_m->get();
            $unit[null] = '-pilih-';
            foreach ($query_unit->result() as $key => $value) {
                $unit[$value->unit_id] = $value->name;
            }
            $data = array(
                'page' => 'edit',
                'row'   => $item,
                'category' => $category,
                'unit' => $unit, 'selectedunit' => $item->unit_id,
            );

            $this->template->load('template', 'produk/item/item_form', $data);
        } else {
            echo "<script> alert('Data tidak ditemukan ');</script>";
            echo "<script>window.location='" . base_url('supllier') . "' </script>";
        }
    }

    public function process()
    {

        $post = $this->input->post(null, TRUE);

        if (isset($_POST['add'])) {
            if ($this->item_m->check_barcode($post['barcode'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "barcode $post[barcode] sudah dipakai");
                redirect(base_url('item/add'));
            } else {
                $this->item_m->add($post);
            }
        } else if (isset($_POST['edit'])) {
            if ($this->item_m->check_barcode($post['barcode'], $post['id'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "barcode $post[barcode] sudah dipakai");
                redirect(base_url('item/edit/' . $post['id']));
            } else {

                $this->item_m->edit($post);
            }
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil diubah');
        }
        redirect(base_url('item'));
    }




    public function hapus($id)
    {

        $this->item_m->hapus($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect(base_url('item'));
    }
}
