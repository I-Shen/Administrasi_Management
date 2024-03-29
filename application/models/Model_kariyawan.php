<?php
class model_kariyawan extends CI_Model
{
	public function get_registrasi()
	{
		# code...
		$query = $this->db->get('registrasi');
		return $query;
	}

	public function get_postingan()
	{
		# code...
		return $this->db->get('post_information')->result_array();
	}
	public function get_postingan_by($keyword)
	{
		# code...
		return $this->db->get_where('post_information', ['keyword' => $keyword])->result_array();
	}

	public function get_profil($email)
	{
		return $this->db->get_where('registrasi', ['email' => $email]);
	}

	public function insert_registrasi($user, $email, $password, $no_telp, $gender, $umur)
	{
		# code...
		$data = [
			'user_name' => htmlspecialchars($user),
			'email' => htmlspecialchars($email),
			'password' => password_hash($password, PASSWORD_DEFAULT),
			'role_id' => 2,
			'is_active' => 1,
			'no_telp' => $no_telp,
			'gender' => $gender,
			'umur' => $umur
		];
		$this->db->insert('registrasi', $data);
	}
	public function cek_email($email, $password)
	{
		# code...
		$registrasi = $this->db->get_where('registrasi', ['email' => $email])->row_array();
		if ($registrasi) {
			# code...
			if ($registrasi['is_active'] == 1 && password_verify($password, $registrasi['password'])) {
				# code...
				$data = [
					'email' => $registrasi['email'],
					'role_id' => $registrasi['role_id'],
				];

				$this->session->set_userdata($data);

				if ($registrasi['role_id'] == 2) {
					redirect(base_url('index.php/Kariyawan_ctrl/main_page'));
				} elseif ($registrasi['role_id'] == 1) {
					redirect(base_url('index.php/Welcome/dashboard'));
				} else {
					redirect(base_url('index.php/Kariyawan_ctrl/'));
				}
			} else {
				# code...
				$this->session->set_flashdata('massage', 'LOGIN GAGAL');
			}
		} else {
			# code...
			$this->session->set_flashdata('massage', 'LOGIN GAGAL');
		}
		return $registrasi;
	}
}
