<?php
// defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('supplier_m');
    }

    public function index()
    {
        $data['row'] = $this->supplier_m->get();
        $this->template->load('template', 'supplier/supplier_data', $data);
        // $this->template->load('template', 'supplier/supplier_data', $data);
    }

    public function hapus($id)
    {

        $this->supplier_m->hapus($id);
        if ($this->db->affected_rows() > 0) {
            echo "<script>
                alert('data berhasil dihapus');
            </script>";
        }

        echo "<script>
        window.location='" . base_url('supplier') . "'
        </script>";
    }
}
