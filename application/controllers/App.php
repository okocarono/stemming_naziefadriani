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
    }