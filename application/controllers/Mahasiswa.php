<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Modelmahasiswa', 'mahasiswa');
        
    }

	public function index()
	{
        $data = [
            'title' => 'Mahasiswa',
            'judul' => '<i class="fa fa-users"></i> Mahasiswa',
            'isi'   => $this->load->view('mahasiswa/tampil_data', '' ,true)
        ];
		$this->parser->parse('template/main', $data);
	}

    // function untuk menampilkan data serverside
    public function ambildata()
    {
        if ($this->input->is_ajax_request() == true) {
            $list = $this->mahasiswa->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $field) {
                
                $no++;
                $row = array();
               
                $row[] = $no;
                $row[] = $field->nobp;
                $row[] = $field->nama;
                $row[] = $field->tmp_lahir;
                $row[] = $field->tgl_lahir;
                $row[] = $field->jenis_kelamin;
                $row[] = "";
                $data[] = $row;
            }
 
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->mahasiswa->count_all(),
                "recordsFiltered" => $this->mahasiswa->count_filtered(),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }

    // function jika menerima perintah tomboltambah ajax dan load modal tambah
    public function formtambah(){

        if($this->input->is_ajax_request() == true){
            $msg = [
                'sukses' => $this->load->view('mahasiswa/modaltambah', '', true)
            ];
            echo json_encode($msg);
        }
    }

    // function simpan data tambah dari modal
    public function simpandata(){

        if ($this->input->is_ajax_request() == true) {
            $nopb           = $this->input->post('nobp', true);
            $nama           = $this->input->post('name', true);
            $tmp_lahir      = $this->input->post('tmp_lahir', true);
            $tgl_lahir      = $this->input->post('tgl_lahir', true);
            $jenis_kelamin  = $this->input->post('jenis_kelamin', true);

            $this->form_validation->set_rules('nopb', 'NOBP', 'trim|required|is_unique[mahasiswa.nobp]',
            [
                'required'  => '{field} Tidak Boleh Kosong',
                'is_unique' => '{field} Sudah Terdaftar Silahkan Cari {field} Yang Baru',
            ]);

            $this->form_validation->set_rules('name', 'Name', 'trim|required',
            [
                'required'  => '{field} Tidak Boleh Kosong'
            ]);

            $this->form_validation->set_rules('tmp_lahir', 'Tempat Lahir', 'trim|required',
            [
                'required'  => '{field} Tidak Boleh Kosong'
            ]);

            $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required',
            [
                'required'  => '{field} Tidak Boleh Kosong',
            ]);

            $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required',
            [
                'required'  => '{field} Tidak Boleh Kosong',
            ]);

            if ($this->form_validation->run() == false) {
                $msg = [
                    'error' => '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    '.validation_errors().'
                                </div>'
                ];
            }else{
                $this->mahasiswa->simpan($nopb, $nama, $tmp_lahir, $tgl_lahir, $jenis_kelamin);
                $msg = [
                    'sukses' => 'Anda Berhasil Menambahkan Data'
                ];
            }
            echo json_encode($msg);
        }
    }
}
