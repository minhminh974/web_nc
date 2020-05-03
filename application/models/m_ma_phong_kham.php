<?php 
	class m_ma_phong_kham extends CI_Model {
		// Mục đích lấy tin tức theo loại tin
		public function lay_danh_sach_ma_phong_kham()
        {
			// Viết câu lệnh truy vấn SQL lấy ra được danh sách các loại pk
			$query = $this->db->query("
				SELECT * 
				FROM phong_kham
			");

			// Trả kết quả truy vấn dữ liệu
            return $query->result();
        }
	}
;?>