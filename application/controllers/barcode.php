<?php

class Barcode extends CI_Controller {
	public function index() 
	{
		$sudata =array (
						'current_tab' => 'barcode'
					);
		$this->session->set_userdata($sudata);
		$data['focus_id'] = 'Barcode';
		$data['page'] = "barcode_print";
		$data['title'] = "Barcode";
		$this->load->view('index',$data);
	}
	public function print_barcode() 
	{
            $this->load->view('test_1D',$_POST);	
	}

	function _getautocomplete($sql, $db = null) {
		$newline = array("\n", "\r\n", "\r");
		
		$data = array();
		if ($db == null)
			$query = $this->db->query($sql);
		else
			$query = $db->query($sql);
		$rows = $query->result_array();
		if ($rows) {
			foreach ($rows as $row) {
				if (count($row) == 1) {
					foreach($row as $k => $v)
						$data[] = '"' . addslashes(str_replace($newline, ' ', $v)) . '"';
				}
				else {
					$sdata = array();
					foreach($row as $k => $v)
						$sdata[] = '"' . $k . '": "' . addslashes(str_replace($newline, ' ', $v)) . '"';
					$data[] = '{' . join(',', $sdata) . '}';
				}
			}
		}
		echo '[' . join(',', $data) . ']';
	}


	function ajaxBarcode() {
			$search = strtolower($this->input->get('term'));	
			$sql = "SELECT PD.id, PD.barcode as name
			FROM purchase_details PD INNER JOIN purchases P ON P.id = PD.purchase_id 
			WHERE PD.barcode LIKE '%$search%' AND PD.sold = 0 AND P.company_id = ".$this->session->userdata['company_id'].
			" GROUP BY PD.barcode ORDER BY PD.barcode";
			$this->_getautocomplete($sql);
		
	}
}