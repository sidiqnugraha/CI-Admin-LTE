<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		if($this->ion_auth->logged_in())
         {
             //sudah login, redirect ke halaman welcome
             redirect('Dashboard1','refresh'); //tapi mungkin perlu menggunakan load->view untuk menambahkan link logout di index
         }
         else{
           $this->load->view('login'); 
         }
		if (isset($_POST['submit']))
         {
 
             if($this->ion_auth->login($this->input->post('email'),$this->input->post('password')))
             {
                 //jika login sukses, redirect ke halaman admin
                $pesan = $this->ion_auth->messages();
 
               redirect('Dashboard1','refresh');
 
             }
             else
             {
                //jika login gagal, redirect kembali ke halaman login
 
                //redirect('login','refresh'); //use redirect instead of loading views compatibility with MY_Controller libraries
                $this->ion_auth->errors();
                redirect('auth','refresh');
             }
         }
	}
        
        public function logout()
	{
          $logout = $this->ion_auth->logout();
         //redirect ke halaman sebelumnya
         redirect('auth','refresh');
	}
}
