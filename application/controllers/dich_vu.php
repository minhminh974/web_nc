<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dich_vu extends CI_Controller {
	function __construct()
	{
		parent::__construct();

		// Load thư viện URL
		$this->load->helper('url');

		// Kết nối đến CSDL
		$this->load->database();

		// Kết nối đến MODEL
		$this->load->model('m_dich_vu');
		//$this->load->model('m_loai_tin_tuc');

		// Load thư viện session
		$this->load->library('session');

		/*if ($this->session->userdata('email')=="") {
			redirect(base_url()."admin/dang_nhap.html");
		}*/
	}
	public function index()
	{
		// Kết nối đến CSDL
		/*$this->load->helper('url');
		$this->load->database();
		$this->load->model('m_tin_tuc');*/

		// Viết câu lệnh truy vấn SQL lấy các tin tức sự kiện (có mã loai_tin_id=1)
		

		// Lấy kết quả truy vấn dữ liệu
		$data['dich_vu'] = $this->m_dich_vu->lay_dich_vu_theo_ma_phong_kham($ma_phong_kham);



		// Hiển thị dữ liệu ra view
		$this->load->view('v_dich_vu', $data);
	}
	public function xem_dich_vu()
	{
		// Load thư viện URL
		$this->load->helper('url');

		// Kết nối đến CSDL
		$this->load->database();

		// Kết nối đến MODEL
		$this->load->model('m_dich_vu');

		// Lấy ra ID của tin tức cần cập nhật
		$id = $this->uri->segment(4);

		// Lấy thông tin về tin tức thông qua qua MODEL
		$data['dich_vu'] = $this->m_dich_vu->lay_dich_vu_theo_ID($ma_dv);
		// Hiển thị dữ liệu ra view

		$this->load->view('v_dich_vu_chi_tiet', $data);
	}

}

