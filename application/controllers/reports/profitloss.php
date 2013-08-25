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
				$sql ="SELECT UN.date , UN.particular, UN.vchtype, UN.vch_No, UN.debit, UN.credit  FROM (
						SELECT DATE_FORMAT(S.datetime,'%d-%m-%Y') as  date, 'Sales A/C' AS particular, 'Sales' AS vchtype, 
						' ' AS vch_No, ' ' AS debit,
						S.amount_recieved AS credit
						FROM sales S 
						INNER JOIN sale_details SD ON S.id = SD.sale_id
						WHERE S.company_id=" . $this->session->userdata('company_id') . "
						AND S.amount_recieved != 0 
						AND SD.sale_id=S.id AND 
						DATE_FORMAT(S.datetime, '%d-%m-%Y') >='" .$data['from_date']. "' AND
						DATE_FORMAT(S.datetime, '%d-%m-%Y') <= '". $data['to_date'] . "'
						GROUP BY S.id
						UNION
						SELECT DATE_FORMAT(P.date,'%d-%m-%Y') AS date ,'PURCHASE A/C' AS particular, 'Purchase' AS vchtype, 
						P.bill_no AS vch_No, P.amount_paid AS debit,' ' AS credit
						FROM purchases P
						WHERE P.amount_paid != 0  AND P.company_id=" . $this->session->userdata('company_id') . " AND
						DATE_FORMAT(P.date, '%d-%m-%Y') >='" .$data['from_date']. "' AND
						DATE_FORMAT(P.date, '%d-%m-%Y') <= '". $data['to_date'] . "'
						UNION
						SELECT DATE_FORMAT(T.date,'%d-%m-%Y') AS date ,T.particular AS particular, 'Payment' AS vchtype,
						T.remarks AS vch_No, 
						CASE 
						WHEN type ='debit' THEN T.amount 
						ELSE '' 
						END AS debit, 
						CASE 
						WHEN type ='credit' THEN T.amount 
						ELSE '' 
						END AS credit 
						FROM transactions T  
						WHERE T.company_id=" . $this->session->userdata('company_id') . " AND
						DATE_FORMAT(T.date, '%d-%m-%Y') >='" .$data['from_date']. "' AND
						DATE_FORMAT(T.date, '%d-%m-%Y') <= '". $data['to_date'] . "'
						) AS UN
						ORDER BY UN.date"; 
				
			}
			else
			{
				$sql ="SELECT UN.date , UN.particular, UN.vchtype, UN.vch_No, UN.debit, UN.credit  FROM (
						SELECT 
						DATE_FORMAT(S.datetime,'%d-%m-%Y') as  date, 'Sales A/C' AS particular, 'Sales' AS vchtype, 
						'' AS vch_No, '' AS debit,
						CASE
						WHEN SUM(SD.price) < S.amount_recieved THEN SD.price
						ELSE S.amount_recieved
						END AS credit
						FROM sales S 
						INNER JOIN sale_details SD ON S.id = SD.sale_id
						INNER JOIN purchase_details PD ON PD.id = SD.purchase_detail_id
						INNER JOIN purchases P ON PD.purchase_id = P.id
						WHERE S.company_id=" . $this->session->userdata('company_id') . " 
						AND S.amount_recieved != 0
						AND P.recieved = 1
						AND SD.sale_id = S.id AND 
						DATE_FORMAT(S.datetime, '%d-%m-%Y') >='" .$data['from_date']. "' AND
						DATE_FORMAT(S.datetime, '%d-%m-%Y') <= '". $data['to_date'] . "'
						GROUP BY S.id
						UNION
						SELECT DATE_FORMAT(P.date,'%d-%m-%Y') AS date ,'PURCHASE A/C' AS particular, 'Purchase' AS vchtype, 
						P.bill_no AS vch_No, P.amount_paid AS debit,'' AS credit
						FROM purchases P
						WHERE P.amount_paid != 0  AND P.company_id=" . $this->session->userdata('company_id') . " AND
						P.recieved = 1 AND
						DATE_FORMAT(P.date, '%d-%m-%Y') >='" .$data['from_date']. "' AND
						DATE_FORMAT(P.date, '%d-%m-%Y') <= '". $data['to_date'] . "'
						UNION
						SELECT DATE_FORMAT(T.date,'%d-%m-%Y') AS date ,T.particular AS particular, 'Payment' AS vchtype,
						T.remarks AS vch_No, 
						CASE 
						WHEN type ='debit' THEN T.amount 
						ELSE '' 
						END AS debit, 
						CASE 
						WHEN type ='credit' THEN T.amount 
						ELSE '' 
						END AS credit 
						FROM transactions T  
						WHERE T.company_id=" . $this->session->userdata('company_id') . " AND
						T.type1 = 0 AND
						DATE_FORMAT(T.date, '%d-%m-%Y') >='" .$data['from_date']. "' AND
						DATE_FORMAT(T.date, '%d-%m-%Y') <= '". $data['to_date'] . "'
						) AS UN
						ORDER BY UN.date";
				$summ ="SELECT '' as blank1, '' as blank2, '' as blank3, '' as blank4, SUM(UN.debit) as debit, SUM(UN.credit) as credit  FROM (
						SELECT 
						DATE_FORMAT(S.datetime,'%d-%m-%Y') as  date, 'Sales A/C' AS particular, 'Sales' AS vchtype, 
						' ' AS vch_No, ' ' AS debit,
						CASE
						WHEN SUM(SD.price) < S.amount_recieved THEN SD.price
						ELSE S.amount_recieved
						END AS credit
						FROM sales S 
						INNER JOIN sale_details SD ON S.id = SD.sale_id
						INNER JOIN purchase_details PD ON PD.id = SD.purchase_detail_id
						INNER JOIN purchases P ON PD.purchase_id = P.id
						WHERE S.company_id=" . $this->session->userdata('company_id') . " 
						AND S.amount_recieved != 0
						AND P.recieved = 1
						AND SD.sale_id = S.id AND 
						DATE_FORMAT(S.datetime, '%d-%m-%Y') >='" .$data['from_date']. "' AND
						DATE_FORMAT(S.datetime, '%d-%m-%Y') <= '". $data['to_date'] . "'
						GROUP BY S.id
						UNION
						SELECT DATE_FORMAT(P.date,'%d-%m-%Y') AS date ,'PURCHASE A/C' AS particular, 'Purchase' AS vchtype, 
						P.bill_no AS vch_No, P.amount_paid AS debit,' ' AS credit
						FROM purchases P
						WHERE P.amount_paid != 0  AND P.company_id=" . $this->session->userdata('company_id') . " AND
						P.recieved = 1 AND
						DATE_FORMAT(P.date, '%d-%m-%Y') >='" .$data['from_date']. "' AND
						DATE_FORMAT(P.date, '%d-%m-%Y') <= '". $data['to_date'] . "'
						UNION
						SELECT DATE_FORMAT(T.date,'%d-%m-%Y') AS date ,T.particular AS particular, 'Payment' AS vchtype,
						T.remarks AS vch_No, 
						CASE 
						WHEN type ='debit' THEN T.amount 
						ELSE '' 
						END AS debit, 
						CASE 
						WHEN type ='credit' THEN T.amount 
						ELSE '' 
						END AS credit 
						FROM transactions T  
						WHERE T.company_id=" . $this->session->userdata('company_id') . " AND
						T.type1 = 0 AND
						DATE_FORMAT(T.date, '%d-%m-%Y') >='" .$data['from_date']. "' AND
						DATE_FORMAT(T.date, '%d-%m-%Y') <= '". $data['to_date'] . "'
						) AS UN";
						
			}

			$data['heading'] = array('Date','Particular','Voucher Type','Voucher Number','Debit','Credit');
			$data['fields']= array('date','particular','vchtype', 'vch_No', 'debit','credit');
			//$data['link_col'] = 'id';
			//$data['link_url'] = 'sales/edit/';
			$data['sumrows'] = $this->radhe->getrowarray($summ);
			$query = $this->db->query($sql);
			$data['rows'] = $query->result_array();

		}
		else 
		{
			$data['customer_id']   = 0;
			$data['customer_name'] = '';
			$data['from_date']	  = date('d-m-Y');
			$data['to_date']	  = date('d-m-Y');
			$data['sumrows'] = array();
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