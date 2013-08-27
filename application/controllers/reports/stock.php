<?php 

class Stock extends CI_controller {
	function __construct() {
		parent::__construct();
	}

	function index() {
		$canlog=$this->radhe->canlogin();
		if ($canlog!=1) {
			redirect('main/login');
		}
		if($this->session->userdata('key') == 1)
		{
			$sql = "SELECT DATE_FORMAT(S.datetime,'%d-%m-%Y') AS date, P.name AS product, SUM(SD.quantity) as quantity, PD.quantity
				FROM sales S INNER JOIN sale_details SD ON S.id = SD.sale_id 
				INNER JOIN purchase_details PD ON PD.id = SD.purchase_detail_id
				INNER JOIN purchases PR ON PR.id = PD.purchase_id
				INNER JOIN products P ON P.id = PD.product_id 
				WHERE DATE_FORMAT(S.datetime, '%d-%m-%Y') >= '".$data['from_date']."' AND
				DATE_FORMAT(S.datetime, '%d-%m-%Y') <= '".$data['to_date']."' AND
				P.company_id=". $this->session->userdata('company_id'). " GROUP BY PR.id";
			//$query = $this->db->query($sql);
		//	$data['rows'] = $query->result_array();	
		}
		else
		{
			$sql = "SELECT DATE_FORMAT(S.datetime,'%d-%m-%Y') AS date, P.name AS product, SUM(SD.quantity) as quantity, PD.quantity
				FROM sales S INNER JOIN sale_details SD ON S.id = SD.sale_id 
				INNER JOIN purchase_details PD ON PD.id = SD.purchase_detail_id
				INNER JOIN purchases PR ON PR.id = PD.purchase_id
				INNER JOIN purchases PR ON PD.purchase_id = PR.id
				INNER JOIN products P ON P.id = PD.product_id 
				WHERE DATE_FORMAT(S.datetime, '%d-%m-%Y') >= '".$data['from_date']."' AND
				DATE_FORMAT(S.datetime, '%d-%m-%Y') <= '".$data['to_date']."' AND PR.recieved = 1
				P.company_id=". $this->session->userdata('company_id'). " GROUP BY PR.id";
			
		}
		$data['rows'] = $this->radhe->getresultarray($sql);
		

		$data['page'] = "reports/stock";
		$data['page_title'] = "Stock Report";
		$this->load->view('index',$data);
	}
}