<?php 
defined('BASEPATH')	OR exit('No direct script access allowed');


 
class Konfigurasi extends CI_Controller{
	
	// load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('konfigurasi_model');
	}

// konfigurasi umum
	public function index()
	{ 
		$Konfigurasi 			= $this->konfigurasi_model->listing();


        //Validasi Input, Membuat variabel valid
        $valid = $this->form_validation;
        $valid->set_rules(
            'namaweb',
            'Nama website',
            'required',
            array('required' => '%s Harus diisi'));

        

        if ($valid->run() === FALSE) {
            //End Validasi
            $data = array('title' 			=> 'Konfigurasi Website',
            			  'konfigurasi'		=> $Konfigurasi,
            			  'isi'				=> 'admin/konfigurasi/list' );
            $this->load->view('admin/layout/wrapper', $data);
            //Masuk database
        } else {
            $i                  = $this->input;
            $data = array(	'id_konfigurasi'		=> $konfigurasi->id_konfigurasi,
                			'namaweb' 				=> $i->post('namaweb'),
                			'tagline'		 		=> $i->post('tagline'),
                			'email'   				=> $i->post('email'),
                			'website'   			=> $i->post('website'),
                			'keywords'   			=> $i->post('keywords'),
                			'metatext' 				=> $i->post('metatext'),
                			'telepon'   			=> $i->post('telepon'),
                			'alamat'   				=> $i->post('alamat'),
                			'facebook' 				=> $i->post('facebook'),
                			'instagram'   			=> $i->post('instagram'),
                			'deskripsi'				=> $i->post('deskripsi'),
                			'rekening_pembayaran'  	=> $i->post('rekening_pembayaran'),
            );
			var_dump($data);die();            
			$this->konfigurasi_model->edit($data);
            $this->session->set_flashdata('sukses', '<div class="alert alert-success" role="alert"><center><span>Data berhasil diupdate!</span></center></div>');
            redirect(base_url('admin/konfigurasi'), 'refresh');
        }
	}

	//konfigurasi logo website
	public function logo()
	{	

		$konfigurasi = $this->konfigurasi_model->listing();
			//validasi input
		$valid = $this->form_validation;
        $valid->set_rules(
            'namaweb',
            'Nama Website',
            'required',
            array('required' => '%s Harus diisi')
        );

            
    

       
        if ($valid->run()) {
            //cek jika gamabar diganti
            if(!empty($_FILES['gambar']['name'])) {


            $config['upload_path']      = './assets/upload/image/thumbs';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
           // $config['max_widht']        = '2024';
            //$config['max_height']       = '2024';
            $config['overwrite']        = true;
            $config['max_size']         = 1024;

            $name = $_FILES['image']['name']; // get file name from form
            $fileNameParts = explode('.', $name); // explode file name to two part
            $default_name = $fileNameParts[0]; // get raw name from client
            $config['file_name'] = $default_name . "_jiosdesired_name"; //constructing a new name


            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('logo')){

            //End Validasi
            $data =  array(  'title'         => 'konfigurasi logo website',
                            'Konfigurasi'      => $Konfigurasi,
                            'error'         => $this->upload->display_errors(),
                            'isi'           => 'admin/konfigurasi/logo'
                        );
            
            $this->load->view('admin/layout/wrapper', $data, FALSE);
            //Masuk database
        } else {
            $upload_gambar = array('uploads_data' => $this->upload->data());

            //create thumbnail gambar
                $config['image_library']        = 'gd2';
                $config['source_image']         = './assets/upload/image/thumbs'.$upload_gambar['uploads_data']
                ['file_name'];
                //lokasi folder thumbnail
                $config['new_image']            ='./assets/upload/image/thumbs/'; 
                $config['create_thumb']         = TRUE;
                $config['maintain_ratio']       = TRUE;
                $config['width']                = 2450;//pixel
                $config['height']               = 250999;//pixel
                $config['thumb_marker']         = '';

                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

            // end thumbnail 

            $i = $this->input;
            //slug menu 
             $data = array( 'id_konfigurasi'    => $konfigurasi->id_konfigurasi,   
                          	'namaweb'			=> $i->post('namaweb'),

                            // disimpan nama file gambarnya
                            'logo'            => $upload_gambar['uploads_data']['file_name'],

                        );

           
            $this->konfigurasi_model->edit($data);
            $this->session->set_flashdata('sukses', '<div class="alert alert-success" role="alert"><center><span>Data berhasil diupdate!</span></center></div>');
            redirect('admin/konfigurasi/logo', 'refresh');
        }}else{
            
            $i = $this->input;
            //slug menu 
             $data = array( 'id_konfigurasi'    => $konfigurasi->id_konfigurasi,   
                          	'namaweb'			=> $i->post('namaweb'),

                            // disimpan nama file gambarnya
                            'logo'            => $upload_gambar['uploads_data']['file_name'],

                        );

           
            $this->konfigurasi_model->edit($data);
            $this->session->set_flashdata('sukses', '<div class="alert alert-success" role="alert"><center><span>Data berhasil diupdate!</span></center></div>');
            redirect('admin/konfigurasi/logo', 'refresh');
        }}
        //End menu database
          $data =  array(  'title'         => 'konfigurasi logo website',
                            'konfigurasi'      => $konfigurasi,
            
                            'isi'           => 'admin/konfigurasi/logo'
                        );
              $this->load->view('admin/layout/wrapper', $data, FALSE);
    
	}

	//konfigurasi icon website
	public function icon()
	{

	}
}