<?php

    class App extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->model('Model_Stemming', 'stem');
            $this->load->library('form_validation');
        }
        
        public function index() {
            $data['stemming'] = NULL;
            $data['kata'] = ' ';
            // $this->stem->gabung_bro(); // hapus setelah kamu menjalankan programnya
            // die;
            $this->form_validation->set_rules('kata', 'Kata', 'required', [
                'required' => 'Silahkan Inputin Kalimat Terlebih Dahulu..'
            ]);
            if($this->form_validation->run() != FALSE) {
                $kata = $this->input->post('kata', 1);
                $hasil = $this->stem->stemming($kata);
                $data['stemming'] = $hasil;
                $data['kata'] = $kata;
            }    
            
            $this->load->view('app/index', $data);
            
        }

        public function file_upload() { // digunakan untuk upload file
            $uploadPath = 'dokumen/';
        
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'doc|docx';
            $config['max_size'] = 3000;
        
            $this->load->library('upload', $config);
        
            if ( ! $this->upload->do_upload('file')) {
        
                    $error = array('error' => $this->upload->display_errors());
        
                    echo "Periksa permission folder ".$uploadPath;
                    var_dump($error); die;
        
            } else {
                    $this->session->set_flashdata('pesan','<div class="alert alert-success" role="alert">Dokumen berhasil diunggah</div>');
        
                    $data = array('upload_data' => $this->upload->data());
        
            }
            redirect('App/index');
        
          } // sampai sini

    }
