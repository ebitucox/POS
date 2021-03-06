<?php
// defined('BASEPATH') or exit('No direct script access allowed');

class Item extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->library('phpqrcode/qrlib');
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
        $config['upload_path']          = './uploads/product';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048;
        $config['file_name']            = 'item-' . date('ymd') . '_' . substr(md5(rand()), 0, 10);

        $this->load->library('upload', $config);

        $post = $this->input->post(null, TRUE);

        if (isset($_POST['add'])) {
            if ($this->item_m->check_barcode($post['barcode'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "barcode $post[barcode] sudah dipakai");
                redirect(base_url('item/add'));
            } else {

                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {
                        $post['image'] = $this->upload->data('file_name');
                        $this->item_m->add($post);
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('success', 'Data berhasil disimpan');
                        }
                        redirect(base_url('item'));
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', 'file yang anda upload tidak memenuhi syarat');
                        redirect(base_url('item/add'));
                    }
                } else {
                    $post['image'] = null;
                    $this->item_m->add($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                    }
                    redirect(base_url('item'));
                }
            }
        } else if (isset($_POST['edit'])) {
            if ($this->item_m->check_barcode($post['barcode'], $post['id'])->num_rows() > 0) {

                $this->session->set_flashdata('error', "barcode $post[barcode] sudah dipakai");
                redirect(base_url('item/edit/' . $post['id']));
            } else {

                if (@$_FILES['image']['name'] != null) {

                    if ($this->upload->do_upload('image')) {

                        // menghapus gambar lama setelah diedit
                        $item = $this->item_m->get($post['id'])->row();
                        if ($item->image != null) {
                            $target_file = './uploads/product/' . $item->image;
                            unlink($target_file);
                        }
                        // mengupload gambar
                        $post['image'] = $this->upload->data('file_name');
                        $this->item_m->edit($post);

                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('success', 'Data berhasil disimpan');
                        }
                        redirect(base_url('item'));
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect(base_url('item/add'));
                    }
                } else {
                    $post['image'] = null;
                    $this->item_m->edit($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                    }
                    redirect(base_url('item'));
                }
            }
        }
    }


    public function hapus($id)
    {

        $item = $this->item_m->get($id)->row();
        if ($item->image != null) {
            $target_file = './uploads/product/' . $item->image;
            unlink($target_file);
        }
        $this->item_m->hapus($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect(base_url('item'));
    }

    function barcode_qrcode($id)
    {
        $data['row'] = $this->item_m->get($id)->row();
        $this->template->load('template', 'produk/item/barcode_qrcode', $data);
    }

    public function barcode_print($id)
    {
        $data['row'] = $this->item_m->get($id)->row();

        $html = $this->load->view('produk/item/barcode_print', $data, true);
        $this->fungsi->PdfGenerator($html, 'barcode-' . $data['row']->barcode, 'A4', 'landscape');
    }

    public function qrcode_print($id)
    {
        $data['row'] = $this->item_m->get($id)->row();

        $html = $this->load->view('produk/item/qrcode_print', $data, true);
        $this->fungsi->PdfGenerator($html, 'qrcode-' . $data['row']->barcode, 'A4', 'landscape');
    }

    // public function qrcodeGenerator()
    // {


    //     $qrtext = "TES";

    //     if (isset($qrtext)) {

    //         //file path for store images
    //         $SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'] . '/POS/uploads/qr-code/';

    //         $text = $qrtext;
    //         $text1 = substr($text, 0, 9);

    //         $folder = $SERVERFILEPATH;
    //         $file_name1 = $text1 . "-Qrcode" . rand(2, 200) . ".png";
    //         $file_name = $folder . $file_name1;
    //         QRcode::png($text, $file_name);

    //         echo "<center><img src=" . 'http://localhost/POS/uploads/qr-code/' . $file_name1 . "></center";
    //     } else {
    //         echo 'No Text Entered';
    //     }
    // }
}
