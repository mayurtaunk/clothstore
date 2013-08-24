<?php 

class Purchasecredit extends CI_controller {
	function __construct() {
		parent::__construct();
	}
	function index() {
		$sudata =array (
						'current_tab' => 'pur_rep'
					);
		$this->session->set_userdata($sudata);
		$canlog=$this->radhe->canlogin();
		if ($canlog!=1) 
		{
			redirect('main/login');
		}
		$data['rows']=array();
		$data['ajaxurl']="reports/Purchasecredit/ajaxParty";
		if($this->input->post('submit')) 
		{
			//
			$data['customer_id']   = $this->input->post('customer_id');
			$data['customer_name'] = $this->input->post('customerName');
			$data['from_date'] 	  = $this->input->post('from_date');
			$data['to_date']	  = $this->input->post('to_date');


			if($data['customer_name'] != "")
			{
				if($this->session->userdata('key') == "1")
				{
					$sql = "SELECT P.id, PR.name, PR.contact, DATE_FORMAT(P.date,'%d-%m-%Y') AS date 	,P.amount AS totalbill , 
							P.amount_paid AS paid, (P.amount - P.amount_paid) AS topay 
							FROM purchases P 
							INNER JOIN parties PR ON P.party_id = PR.id 
							WHERE P.amount != P.amount_Paid AND PR.name ='".$data['customer_name']."' AND
					        DATE_FORMAT(P.date, '%d-%m-%Y') >='" .$data['from_date']. "' AND
							DATE_FORMAT(P.date, '%d-%m-%Y') <= '". $data['to_date'] . "' AND
							P.company_id=" .$this->session->userdata('company_id') .
							" GROUP BY P.id";
					$summ = "SELECT sum(P.amount) AS totalbill , 
							sum(P.amount_paid) AS paid, sum((P.amount - P.amount_paid)) AS topay 
							FROM purchases P 
							INNER JOIN parties PR ON P.party_id = PR.id 
							WHERE P.amount != P.amount_Paid AND PR.name ='".$data['customer_name']."' AND 
					        DATE_FORMAT(P.date, '%d-%m-%Y') >='" .$data['from_date']. "' AND
							DATE_FORMAT(P.date, '%d-%m-%Y') <= '". $data['to_date'] . "' AND
							P.company_id=" .$this->session->userdata('company_id');
			
				}
				else
				{
					$sql = "SELECT P.id, PR.name, PR.contact, DATE_FORMAT(P.date,'%d-%m-%Y') AS date 	,P.amount AS totalbill , 
							P.amount_paid AS paid, (P.amount - P.amount_paid) AS topay 
							FROM purchases P 
							INNER JOIN parties PR ON P.party_id = PR.id 
							WHERE P.amount != P.amount_Paid AND PR.name ='".$data['customer_name']."' AND
					        DATE_FORMAT(P.date, '%d-%m-%Y') >='" .$data['from_date']. "' AND
							DATE_FORMAT(P.date, '%d-%m-%Y') <= '". $data['to_date'] . "' AND
							P.recieved = 1 AND
							P.company_id=" .$this->session->userdata('company_id') .
							" GROUP BY P.id";
					$summ = "SELECT sum(P.amount) AS totalbill , 
							sum(P.amount_paid) AS paid, sum((P.amount - P.amount_paid)) AS topay 
							FROM purchases P 
							INNER JOIN parties PR ON P.party_id = PR.id 
							WHERE P.amount != P.amount_Paid AND PR.name ='".$data['customer_name']."' AND 
					        DATE_FORMAT(P.date, '%d-%m-%Y') >='" .$data['from_date']. "' AND
							DATE_FORMAT(P.date, '%d-%m-%Y') <= '". $data['to_date'] . "' AND
							P.recieved = 1 AND
							P.company_id=" .$this->session->userdata('company_id');
				 }
				
			}
			else
			{
				if($this->session->userdata('key') == "1")
				{
					$sql = "SELECT P.id, PR.name, PR.contact, DATE_FORMAT(P.date,'%d-%m-%Y') AS date 	,P.amount AS totalbill , 
							P.amount_paid AS paid, (P.amount - P.amount_paid) AS topay 
							FROM purchases P 
							INNER JOIN parties PR ON P.party_id = PR.id 
							WHERE P.amount != P.amount_Paid AND 
					        DATE_FORMAT(P.date, '%d-%m-%Y') >='" .$data['from_date']. "' AND
							DATE_FORMAT(P.date, '%d-%m-%Y') <= '". $data['to_date'] . "' AND
							P.company_id=" .$this->session->userdata('company_id') .
							" GROUP BY P.id";
					$summ = "SELECT sum(P.amount) AS totalbill , 
							sum(P.amount_paid) AS paid, sum((P.amount - P.amount_paid)) AS topay 
							FROM purchases P 
							INNER JOIN parties PR ON P.party_id = PR.id 
							WHERE P.amount != P.amount_Paid AND 
					        DATE_FORMAT(P.date, '%d-%m-%Y') >='" .$data['from_date']. "' AND
							DATE_FORMAT(P.date, '%d-%m-%Y') <= '". $data['to_date'] . "' AND
							P.company_id=" .$this->session->userdata('company_id');
			
				}
				else
				{
					$sql = "SELECT P.id, PR.name, PR.contact, DATE_FORMAT(P.date,'%d-%m-%Y') AS date 	,P.amount AS totalbill , 
							P.amount_paid AS paid, (P.amount - P.amount_paid) AS topay 
							FROM purchases P 
							INNER JOIN parties PR ON P.party_id = PR.id 
							WHERE P.amount != P.amount_Paid AND 
					        DATE_FORMAT(P.date, '%d-%m-%Y') >='" .$data['from_date']. "' AND
							DATE_FORMAT(P.date, '%d-%m-%Y') <= '". $data['to_date'] . "' AND
							P.recieved = 1 AND
							P.company_id=" .$this->session->userdata('company_id') .
							" GROUP BY P.id";
					$summ = "SELECT sum(P.amount) AS totalbill , 
							sum(P.amount_paid) AS paid, sum((P.amount - P.amount_paid)) AS topay 
							FROM purchases P 
							INNER JOIN parties PR ON P.party_id = PR.id 
							WHERE P.amount != P.amount_Paid AND 
					        DATE_FORMAT(P.date, '%d-%m-%Y') >='" .$data['from_date']. "' AND
							DATE_FORMAT(P.date, '%d-%m-%Y') <= '". $data['to_date'] . "' AND
							P.recieved = 1 AND
							P.company_id=" .$this->session->userdata('company_id');
				 }

			}
			
			$data['heading'] = array('Bill NO','Party Name','Party Contact','Date','Total Bill','Amount Paid','To Pay');
			$data['fields']= array('id','name','contact', 'date', 'totalbill','paid' ,'topay');
			$data['link_col'] = 'id';
			$data['link_url'] = 'purchase/edit/';
			$query = $this->db->query($sql);
			$data['summary'] = $this->radhe->getrowarray($summ);
			$data['rows'] = $query->result_array();

		}
		else 
		{
			$data['customer_id']   = 0;
			$data['customer_name'] = '';
			$data['from_date']	  = date('d-m-Y');
			$data['to_date']	  = date('d-m-Y');
		}
		$data['headd'] = "Purchase Credit Report";
		$data['page'] = "reports/creditreport";
		$data['page_title'] = "Credit Report";
		$this->load->view('index',$data);
	}
	function _getautocomplete($sql, $db = null) 
	{
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
	function ajaxParty() 
	{
				$search = strtolower($this->input->get('term'));
				$sql= "SELECT P.name AS cname, P.id
				FROM parties P  
				WHERE P.name LIKE '%$search%' AND P.name IS NOT NULL AND P.company_id = 1
				GROUP BY P.name";	
				$this->_getautocomplete($sql);
			
	}
}