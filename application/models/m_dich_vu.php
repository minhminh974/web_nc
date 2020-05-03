<?php 
	class m_dich_vu extends CI_Model {
		// Mục đích lấy tin tức theo loại tin
		public function lay_dich_vu_theo_ma_phong_kham($ma_phong_kham)
        {
			// Viết câu lệnh truy vấn SQL lấy các tin tức sự kiện (có mã loai_tin_id)
			$query = $this->db->query("
				SELECT * 
				FROM dich_vu
				WHERE ma_phong_kham='".$ma_phong_kham."'"
				);

			// Trả kết quả truy vấn dữ liệu
            return $query->result();
        }

        // Mục đích Lấy tin tức theo ID
		public function lay_dich_vu_theo_ID($ma_dv)
        {
			// Viết câu lệnh truy vấn SQL lấy các tin tức sự kiện (có mã loai_tin_id)
			$query = $this->db->query("
				SELECT * 
				FROM dich_vu
				WHERE ma_dv='".$ma_dv."'"
			);

			// Trả kết quả truy vấn dữ liệu
	        return  $query->row();
        }

		public function them_moi_dich_vu()
        {
			// Dữ liệu thu được từ FORM nhập dữ liệu
			$ma_phong_kham = $_POST['txtMaphongkham'];
			$ten_dich_vu = $_POST['txtTendv'];
			$nguoi_tao = $_POST['txtNguoiTao'];

			// Xử lý đoạn UPLOAD ảnh minh họa
			if (!empty($_FILES['txtAnhMinhHoa']['name'])) {
		        $config['upload_path'] = 'assets\images';
		        $config['allowed_types'] = 'jpg|jpeg|png|gif';
		        $config['file_name'] = $_FILES['txtAnhMinhHoa']['name'];

		        $this->load->library('upload', $config);
		        $this->upload->initialize($config);

		        if ($this->upload->do_upload('txtAnhMinhHoa')) {
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
				'ma_phong_kham' => $ma_phong_kham,
				'ten_dich_vu' => $ten_dich_vu,
				'hinh_anh' => $data["image"],
				'nguoi_tao' => $nguoi_tao
				
			);

			// Thực hiện chèn dữ liệu vào bảng TIN TỨC
			$this->db->insert('dich_vu', $data);
        }

		public function sua_dich_vu()
        {
        	// Dữ liệu thu được từ FORM nhập dữ liệu
			$ma_dv = $_POST['txtID'];
			
			$ten_dich_vu = $_POST['txtTendv'];
			$ma_phong_kham = $_POST['txtMaphongkham'];
			
			$nguoi_tao = $_POST['txtNguoiTao'];

			// Xử lý đoạn UPLOAD ảnh minh họa
			if (!empty($_FILES['txtAnhMinhHoa']['name'])) {
		        $config['upload_path'] = 'assets\images';
		        $config['allowed_types'] = 'jpg|jpeg|png|gif';
		        $config['file_name'] = $_FILES['txtAnhMinhHoa']['name'];

		        $this->load->library('upload', $config);
		        $this->upload->initialize($config);

		        if ($this->upload->do_upload('txtAnhMinhHoa')) {
		          $uploadData = $this->upload->data();
		          $data["image"] = $uploadData['file_name'];
		        } else{
		          $data["image"] = '';
		        }
		      } else {
		        $data["image"] = '';
		      }

			// Đẩy dữ liệu này vào CSDL

		    if($data["image"] == '')
		    {
				$data = array(
					'ma_phong_kham' => $ma_phong_kham,
					'ten_dich_vu' => $ten_dich_vu,
					'nguoi_tao' => $nguoi_tao
					
				);
			} else {
				$data = array(
					'ma_phong_kham' => $ma_phong_kham,
					'ten_dich_vu' => $ten_dich_vu,
					'hinh_anh' => $data["image"],
					'nguoi_tao' => $nguoi_tao
				
				);
			}

			// Thực hiện cập nhật dữ liệu vào bảng TIN TỨC
			$this->db->where('ma_dv', $ma_dv);
			$this->db->update('dich_vu', $data);
        }

		public function xoa_dich_vu($ma_dv)
        {
			// Thực hiện việc xóa dữ liệu
			$this->db->where('ma_dv', $ma_dv);
			$this->db->delete('dich_vu');
        }

	}
;?>