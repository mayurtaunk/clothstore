<?php 

class Top_selling_item extends CI_controller 
	{
	function __construct() {
		parent::__construct();
	}

	function index() {
		$sudata =array (
						'current_tab' => 'topsale_rep'
					);
			$this->session->set_userdata($sudata);
		$canlog=$this->radhe->canlogin();
		if ($canlog!=1) {
			redirect('main/login');
		}
		$data['rows']=array();
		$data['showtitle'] = 0;
		$data['txttitle']="Product";
		$data['ajaxurl']="reports/sale_report/ajaxProduct";
		$data['showdate'] = 1;
		if($this->input->post('submit')) 
		{

			$data['customer_id']   = $this->input->post('customer_id');
			$data['customer_name'] = $this->input->post('customerName');
			$data['from_date'] 	  = $this->input->post('from_date');
			$data['to_date']	  = $this->input->post('to_date');
			$sql="";
			
				if($this->session->userdata('key') == "1")
				{

					$sql = "SELECT  P.name AS product, SUM(SD.quantity) as squantity
						FROM sales S INNER JOIN sale_details SD ON S.id = SD.sale_id 
						INNER JOIN purchase_details PD ON PD.id = SD.purchase_detail_id
						INNER JOIN purchases PR ON PR.id = PD.purchase_id
						INNER JOIN products P ON P.id = PD.product_id 
						WHERE DATE_FORMAT(S.datetime, '%d-%m-%Y') >= '".$data['from_date']."' AND
						DATE_FORMAT(S.datetime, '%d-%m-%Y') <= '".$data['to_date']."' AND
						P.company_id=". $this->session->userdata('company_id'). " GROUP BY P.name ORDER BY squantity DESC";
				}
				else
				{
					$sql = "SELECT  P.name AS product, SUM(SD.quantity) as squantity
						FROM sales S INNER JOIN sale_details SD ON S.id = SD.sale_id 
						INNER JOIN purchase_details PD ON PD.id = SD.purchase_detail_id
						INNER JOIN purchases PR ON PR.id = PD.purchase_id
						INNER JOIN purchases PU ON PD.purchase_id = PU.id
						INNER JOIN products P ON P.id = PD.product_id 
						WHERE DATE_FORMAT(S.datetime, '%d-%m-%Y') >= '".$data['from_date']."' AND
						DATE_FORMAT(S.datetime, '%d-%m-%Y') <= '".$data['to_date']."' AND
						PU.recieved = 1 AND
						P.company_id=". $this->session->userdata('company_id'). " GROUP BY P.name ORDER BY squantity DESC";
				}

			$data['heading'] = array('Product Name','Sold');
			$data['fields']= array('product','squantity');
			//$data['link_col'] = 'id';
			//$data['link_url'] = 'purchase/edit/';
			//$query = $this->db->query($sql);
			//$data['sumrows'] = $this->radhe->getrowarray($summ);
			$data['rows'] = $this->radhe->getresultarray($sql);
			//$query = $this->db->query($sql);
			//$data['rows'] = $query->result_array();

		}
		else 
		{
			$data['customer_id']   = 0;
			$data['customer_name'] = '';
			$data['from_date']	  = date('d-m-Y');
			$data['to_date']	  = date('d-m-Y');
		}
		$data['headd'] = "Sale Report";
		$data['page'] = "reports/creditreport";
		$data['page_title'] = "Sale Report";
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
	function ajaxProduct() {
		
			$search = strtolower($this->input->get('term'));
			if($this->session->userdata('key') == 1)
			{
				$sql = "SELECT P.name AS cname, P.id 
				FROM products P
				INNER JOIN purchase_details PD ON PD.product_id = P.id
				WHERE P.active = 1 AND P.name LIKE '%$search%' AND P.company_id=".$this->session->userdata('company_id'). 
				" GROUP BY P.name ORDER BY P.name";
			}
			else
			{
				$sql = "SELECT P.name AS cname, P.id 
				FROM products P
				INNER JOIN purchase_details PD ON PD.product_id = P.id
				INNER JOIN purchases PR ON PD.purchase_id = PR.id
				WHERE P.active = 1 AND PR.recieved = 1 AND P.name LIKE '%$search%' AND P.company_id=".$this->session->userdata('company_id'). 
				" GROUP BY P.name ORDER BY P.name";
			}
			$this->_getautocomplete($sql);
	}
}