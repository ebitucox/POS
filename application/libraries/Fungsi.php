<?php

class Fungsi
{
    protected $CI;


    public function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->CI = &get_instance();
    }


    public function user_login()
    {

        $this->CI->load->model('user_m');
        $user_id = $this->CI->session->userdata('userid');
        $user_data = $this->CI->user_m->get($user_id)->row();
        return $user_data;
    }
    function PdfGenerator($html, $filename, $paper, $orientation)
    {
        // instantiate and use the dompdf class
        $dompdf = new Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper($paper, $orientation);
        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser

        $dompdf->stream($filename, array('Attachment' => true));
    }
}
