<?php 
	class m_tin_tuc extends CI_Model {
		// Mục đích lấy tin tức theo loại tin
		public function lay_tin_tuc_theo_loai_tin($loai_tin_id)
        {
			// Viết câu lệnh truy vấn SQL lấy các tin tức sự kiện (có mã loai_tin_id)
			$query = $this->db->query("
				SELECT * 
				FROM tin_tuc
				WHERE loai_tin_id=".$loai_tin_id."
			");

			// Trả kết quả truy vấn dữ liệu
            return $query->result();
        }

        // Mục đích Lấy tin tức theo ID
		public function lay_tin_tuc_theo_ID($ma_tin_tuc)
        {
			// Viết câu lệnh truy vấn SQL lấy các tin tức sự kiện (có mã loai_tin_id)
			$query = $this->db->query("
				SELECT * 
				FROM tin_tuc
				WHERE ma_tin_tuc=".$ma_tin_tuc
			);

			// Trả kết quả truy vấn dữ liệu
	        return  $query->row();
        }

		public function them_moi_tin_tuc()
        {
			// Dữ liệu thu được từ FORM nhập dữ liệu
			$loai_tin_id = '1';
			$tieu_de = $_POST['txtTieuDe'];
			$mo_ta = $_POST['txtMoTa'];
			$noi_dung = $_POST['txtNoiDung'];
			$nguoi_tao = $_POST['txtNguoiTao'];

			// Xử lý đoạn UPLOAD ảnh minh họa
			if (!empty($_FILES['txtAnh']['name'])) {
		        $config['upload_path'] = 'assets\images';
		        $config['allowed_types'] = 'jpg|jpeg|png|gif';
		        $config['file_name'] = $_FILES['txtAnh']['name'];

		        $this->load->library('upload', $config);
		        $this->upload->initialize($config);

		        if ($this->upload->do_upload('txtAnh')) {
		          $uploadData = $this->upload->data();
		          $data["image"] = $uploadData['file_name'];
		        } else{
		          $data["image"] = '';
		        }
		      } else {
		        $data["image"] = '';
		      }

			

			// Đẩy dữ liệu này vào CSDL
			$data = array(
				'loai_tin_id' => $loai_tin_id,
				'tieu_de' => $tieu_de,
				'mo_ta' => $mo_ta,
				'noi_dung' => $noi_dung,
				'anh' => $data["image"],
				'nguoi_tao' => $nguoi_tao
			);

			// Thực hiện chèn dữ liệu vào bảng TIN TỨC
			$this->db->insert('tin_tuc', $data);
        }

		public function sua_tin_tuc()
        {
        	// Dữ liệu thu được từ FORM nhập dữ liệu
			$ma_tin_tuc = $_POST['txtID'];
			$loai_tin_id = '1';
			$tieu_de = $_POST['txtTieuDe'];
			$mo_ta = $_POST['txtMoTa'];
			$noi_dung = $_POST['txtNoiDung'];
			$nguoi_tao = $_POST['txtNguoiTao'];

			// Đẩy dữ liệu này vào CSDL
			$data = array(
				'loai_tin_id' => $loai_tin_id,
				'tieu_de' => $tieu_de,
				'mo_ta' => $mo_ta,
				'noi_dung' => $noi_dung,
				'nguoi_tao' => $nguoi_tao
			);

			// Thực hiện cập nhật dữ liệu vào bảng TIN TỨC
			$this->db->where('ma_tin_tuc', $ma_tin_tuc);
			$this->db->update('tin_tuc', $data);
        }

		public function xoa_tin_tuc($ma_tin_tuc)
        {
			// Thực hiện việc xóa dữ liệu
			$this->db->where('ma_tin_tuc', $ma_tin_tuc);
			$this->db->delete('tin_tuc');
        }

	}
;?>