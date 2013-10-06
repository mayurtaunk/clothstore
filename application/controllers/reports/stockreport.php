<?php 

class Stockreport extends CI_controller {
	function __construct() {
		parent::__construct();
	}
	function index() {
		$sudata =array (
						'current_tab' => 'stock_rep'
					);
		$this->session->set_userdata($sudata);
		$canlog      = $this->radhe->canlogin();
		if ($canlog != 1) 
		{
			redirect('main/login');
		}
		$data['rows']=array();
		$data['showtitle'] = 1;
		$data['txttitle']="Item Category";
		$data['ajaxurl']="reports/stockreport/ajaxType";
		$data['showdate'] = 0;
		if($this->input->post('submit')) 
		{
			
			$data['customer_id']   = $this->input->post('customer_id');
			$data['customer_name'] = $this->input->post('customerName');
			$data['from_date']     = $this->input->post('from_date');
			$data['to_date']       = $this->input->post('to_date');


			if($data['customer_name'] != "")
			{
				if($this->session->userdata('key') == "1")
				{
					
					$sql=	"SELECT PR.id, PR.name,
					 		PD.barcode, 
                     		CASE 
                     		WHEN (SUM(SD.quantity)) IS NULL THEN PD.quantity 
                     		ELSE (PD.quantity - sum(SD.quantity)) 
                     		END AS stock,
                     		PD.quantity AS quantity,
					 		PA.name as partyname,
					 		PA.contact
					 		FROM products PR
					 		INNER JOIN (SELECT id,sum(quantity) as quantity ,barcode,product_id,purchase_id 
								 FROM purchase_details GROUP BY barcode)PD ON PR.id = PD.product_id
					 		INNER JOIN purchases P ON P.id=PD.purchase_id
					 		INNER JOIN parties PA ON PA.id=P.party_id
					 		LEFT OUTER JOIN sale_details SD ON PD.id = SD.purchase_detail_id
					 		WHERE PR.category ='".$data['customer_name']."' AND P.company_id=".$this->session->userdata('company_id'). 
					 		" GROUP BY PD.id, PD.barcode ORDER BY stock";

			
				}
				else
				{
					$sql="SELECT PR.id, PR.name,
					 		PD.barcode, 
                     		CASE 
                     		WHEN (SUM(SD.quantity)) IS NULL THEN PD.quantity 
                     		ELSE (PD.quantity - sum(SD.quantity)) 
                     		END AS stock,
                     		PD.quantity AS quantity,
					 		PA.name as partyname,
					 		PA.contact
					 		FROM products PR
					 		INNER JOIN (SELECT id,sum(quantity) as quantity ,barcode,product_id,purchase_id 
								 FROM purchase_details GROUP BY barcode)PD ON PR.id = PD.product_id
					 		INNER JOIN purchases P ON P.id=PD.purchase_id
					 		INNER JOIN parties PA ON PA.id=P.party_id
					 		LEFT OUTER JOIN sale_details SD ON PD.id = SD.purchase_detail_id
					 	  WHERE PR.category ='".$data['customer_name']."' AND P.recieved = 1 AND P.company_id=".$this->session->userdata('company_id'). 
					 	  " GROUP BY PD.id, PD.barcode ORDER BY stock ";	
					
				 }
				
			}
			else
			{
				if($this->session->userdata('key') == "1")
				{
					$sql=	"SELECT PR.id, PR.name,
					 		PD.barcode, 
                     		CASE 
                     		WHEN (SUM(SD.quantity)) IS NULL THEN PD.quantity 
                     		ELSE (PD.quantity - sum(SD.quantity)) 
                     		END AS stock,
                     		PD.quantity AS quantity,
					 		PA.name as partyname,
					 		PA.contact
					 		FROM products PR
					 		INNER JOIN (SELECT id,sum(quantity) as quantity ,barcode,product_id,purchase_id 
								 FROM purchase_details GROUP BY barcode)PD ON PR.id = PD.product_id
					 		INNER JOIN purchases P ON P.id=PD.purchase_id
					 		INNER JOIN parties PA ON PA.id=P.party_id
					 		LEFT OUTER JOIN sale_details SD ON PD.id = SD.purchase_detail_id
					 		WHERE P.company_id=".$this->session->userdata('company_id'). 
					 		" GROUP BY PD.id, PD.barcode ORDER BY stock";
			
				}
				else
				{
					$sql="SELECT PR.id, PR.name,
					 		PD.barcode, 
                     		CASE 
                     		WHEN (SUM(SD.quantity)) IS NULL THEN PD.quantity 
                     		ELSE (PD.quantity - sum(SD.quantity)) 
                     		END AS stock,
                     		PD.quantity AS quantity,
					 		PA.name as partyname,
					 		PA.contact
					 		FROM products PR
					 		INNER JOIN (SELECT id,sum(quantity) as quantity ,barcode,product_id,purchase_id 
								 FROM purchase_details GROUP BY barcode)PD ON PR.id = PD.product_id
					 		INNER JOIN purchases P ON P.id=PD.purchase_id
					 		INNER JOIN parties PA ON PA.id=P.party_id
					 		LEFT OUTER JOIN sale_details SD ON PD.id = SD.purchase_detail_id
					 	  WHERE P.recieved = 1 AND P.company_id=".$this->session->userdata('company_id'). 
					 	  " GROUP BY Pd.id, PD.barcode ORDER BY stock ";
					
				 }

			}

			$data['heading'] = array('Product Id','Product Name','Barcode','Quantity','Available','Partyname','Contact');
			$data['fields']= array('id','name','barcode','quantity', 'stock', 'partyname','contact');
			$data['link_col'] = 'id';
			$data['link_url'] = 'product/edit/';
			
			//$data['summary'] = $this->radhe->getrowarray($summ);
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
		$data['headd'] = "Stock Report";
		$data['page'] = "reports/creditreport";
		$data['page_title'] = "Stock Report";
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
	function ajaxType() 
	{
				$search = strtolower($this->input->get('term'));
				$sql= "SELECT P.category AS cname, P.id
				FROM products P  
				INNER JOIN purchase_details PD ON PD.product_id = P.id
				WHERE P.category LIKE '%$search%' AND P.company_id = ".$this->session->userdata['company_id'].
				" GROUP BY P.category";	
				$this->_getautocomplete($sql);
			
	}
}