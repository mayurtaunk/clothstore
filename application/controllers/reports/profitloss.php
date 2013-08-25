<?php 

class Profitloss extends CI_controller {
	function __construct() {
		parent::__construct();
	}
	function index() {
		$sudata =array (
						'current_tab' => 'proloss_rep'
					);
		$this->session->set_userdata($sudata);
		$canlog      = $this->radhe->canlogin();
		if ($canlog != 1) 
		{
			redirect('main/login');
		}
		$data['rows']=array();
		$data['txttitle']="Customer Name";
		$data['showtitle'] = 0;
		$data['ajaxurl']="reports/creditreport/ajaxCustomer";
		$data['showdate'] = 1;
		if($this->input->post('submit')) 
		{
			$data['customer_id']   = $this->input->post('customer_id');
			$data['customer_name'] = $this->input->post('customerName');
			$data['from_date']     = $this->input->post('from_date');
			$data['to_date']       = $this->input->post('to_date');

			if($this->session->userdata('key') == "1")
			{
				$sql = "SELECT DATE_FORMAT(S.datetime,'%d-%m-%Y') AS date ,'Sales A/C' as particular, 'Sales' as Vchtype, ' ' as Vch_No, ' ' as Debit, 
						S.amount_recieved AS credit from sales S where S.amount_recieved != 0 
						UNION
						SELECT DATE_FORMAT(P.date,'%d-%m-%Y') AS date ,'PURCHASE A/C' as particular, 'Purchase' as Vchtype, P.bill_no as Vch_No, P.amount_paid as Debit,' ' AS credit from purchases P where P.amount_paid != 0  
						UNION
						SELECT DATE_FORMAT(T.date,'%d-%m-%Y') AS date ,T.particular as particular, 'Payment' as Vchtype, T.remarks as Vch_No, 
                     	CASE 
                     	WHEN type ='debit' THEN T.amount 
                     	ELSE '' 
                     	END AS debit,
                     	CASE 
                     	WHEN type ='credit' THEN T.amount 
                     	ELSE '' 
                     	END AS credit from transactions T  
						
						S.amount_recieved AS paid, (S.amount - S.amount_recieved) AS topay 
						FROM sales S 
						SELECT DATE_FORMAT(T.date,'%d-%m-%Y') AS date ,'PURCHASE A/C' as particular, 'Purchase' as Vchtype, P.bill_no as Vch_No, P.amount_paid as Debit, 
						' ' AS credit from purchases P where P.amount_paid != 0  
						WHERE S.amount != S.amount_recieved AND
				        DATE_FORMAT(S.datetime, '%d-%m-%Y') >='" .$data['from_date']. "' AND
						DATE_FORMAT(S.datetime, '%d-%m-%Y') <= '". $data['to_date'] . "' AND
						S.company_id=" .$this->session->userdata('company_id') .
						" GROUP BY S.id";
				$summ = "SELECT sum(S.amount) AS totalbill , 
						sum(S.amount_recieved) AS paid, sum((S.amount - S.amount_recieved)) AS topay 
						FROM sales S 
						WHERE S.amount != S.amount_recieved AND
				        DATE_FORMAT(S.datetime, '%d-%m-%Y') >='" .$data['from_date']. "' AND
						DATE_FORMAT(S.datetime, '%d-%m-%Y') <= '". $data['to_date'] . "' AND
						S.company_id=" .$this->session->userdata('company_id') .
						" GROUP BY S.id";	
			}
			else
			{
				$sql = "SELECT S.id, S.party_name, S.party_contact, DATE_FORMAT(S.datetime,'%d-%m-%Y') AS date ,S.amount AS totalbill , 
						S.amount_recieved AS paid, (S.amount - S.amount_recieved) AS topay 
						FROM sales S INNER JOIN sale_details SD ON S.id = SD.sale_id 
						INNER JOIN purchase_details PD ON PD.id = SD.purchase_detail_id
						INNER JOIN purchases PU ON PD.purchase_id = PU.id 
						INNER JOIN products P ON P.id = PD.product_id 
						WHERE S.amount != S.amount_recieved AND
						DATE_FORMAT(S.datetime, '%d-%m-%Y') >= '".$data['from_date']."' AND
						DATE_FORMAT(S.datetime, '%d-%m-%Y') <= '".$data['to_date']."' AND
						PU.recieved = 1 AND
						P.company_id=". $this->session->userdata('company_id') .
						" GROUP BY S.id";
					$summ = "SELECT sum(S.amount) AS totalbill , 
						sum(S.amount_recieved) AS paid, sum((S.amount - S.amount_recieved)) AS topay 
						FROM sales S INNER JOIN sale_details SD ON S.id = SD.sale_id 
						INNER JOIN purchase_details PD ON PD.id = SD.purchase_detail_id
						INNER JOIN purchases PU ON PD.purchase_id = PU.id 
						INNER JOIN products P ON P.id = PD.product_id 
							WHERE S.amount != S.amount_recieved AND
								DATE_FORMAT(S.datetime, '%d-%m-%Y') >= '".$data['from_date']."' AND
								DATE_FORMAT(S.datetime, '%d-%m-%Y') <= '".$data['to_date']."' AND
								PU.recieved = 1 AND
								P.company_id=". $this->session->userdata('company_id') .
								" GROUP BY S.id";
						
			}

			$data['heading'] = array('Bill NO','Customer Name','CUstomer Contact','Date','Total Bill','Amount Paid','To Pay');
			$data['fields']= array('id','party_name','party_contact', 'date', 'totalbill','paid' ,'topay');
			$data['link_col'] = 'id';
			$data['link_url'] = 'sales/edit/';
			$data['summary'] = $this->radhe->getrowarray($summ);
			$query = $this->db->query($sql);
			$data['rows'] = $query->result_array();

		}
		else 
		{
			$data['customer_id']   = 0;
			$data['customer_name'] = '';
			$data['from_date']	  = date('d-m-Y');
			$data['to_date']	  = date('d-m-Y');
		}
		$data['headd'] = "Customer Credit Report";
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
	function ajaxCustomer() 
	{
				$search = strtolower($this->input->get('term'));
				$sql= "SELECT S.party_name AS cname, S.id
				FROM sales S  
				WHERE S.party_name LIKE '%$search%' AND S.party_name IS NOT NULL AND S.company_id = ".$this->session->userdata['company_id'].
				" GROUP BY S.party_name";	
				$this->_getautocomplete($sql);
			
	}
}