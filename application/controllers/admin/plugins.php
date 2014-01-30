<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plugins extends My_Controller {
	
	function __construct()
	{
		parent::__construct(array("required_group"=>1));
	}
	
	public function table_export() {
		$table = $this->uri->segment(4);
		
		$this->form_validation->set_rules("export_file_name", "trim|required|xss_clean");
		if ($this->form_validation->run()) {
			$query = $this->db->get($table);
 
	        if(!$query)
	            return false;
	 
	        // Starting the PHPExcel library
	        $this->load->library('excel');
	        //activate worksheet number 1
	        $this->excel->setActiveSheetIndex(0);
	        //name the worksheet
	        $this->excel->getActiveSheet()->setTitle($table);
	        
	        // Field names in the first row
	        $fields = $query->list_fields();
	        $col = 0;
	        foreach ($fields as $field)
	        {
	        	$this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
	        	$col++;
	        }
	        /*
	        //set cell A1 content with some text
	        $this->excel->getActiveSheet()->setCellValue('A1', 'This is just some text value');
	        //change the font size
	        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
	        //make the font become bold
	        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	        //merge cell A1 until D1
	        $this->excel->getActiveSheet()->mergeCells('A1:D1');
	        //set aligment to center for that merged cell (A1 to D1)
	        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        */
	        // Fetching the table data
	        $row = 2;
	        foreach($query->result() as $data)
	        {
	        	$col = 0;
	        	foreach ($fields as $field)
	        	{
	        		$this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
	        		$col++;
	        	}
	        
	        	$row++;
	        }
	        $this->excel->setActiveSheetIndex(0);
	        
	        
	        
	        $filename=$this->input->post("export_file_name"); //save our workbook as this file name
	        header('Content-Type: application/vnd.ms-excel'); //mime type
	        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	        header('Cache-Control: max-age=0'); //no cache
	         
	        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
	        //if you want to save it as .XLSX Excel 2007 format
	        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	        //force user to download the Excel file without writing it to server's HD
	        $objWriter->save('php://output');
	        /*
	        $this->load->library('Excel');
	        $this->load->library('PHPExcel/IOFactory');
	 
	        $objPHPExcel = new Excel();
	        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
	 
	        $objPHPExcel->setActiveSheetIndex(0);
	 
	        // Field names in the first row
	        $fields = $query->list_fields();
	        $col = 0;
	        foreach ($fields as $field)
	        {
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
	            $col++;
	        }
	 
	        // Fetching the table data
	        $row = 2;
	        foreach($query->result() as $data)
	        {
	            $col = 0;
	            foreach ($fields as $field)
	            {
	                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
	                $col++;
	            }
	 
	            $row++;
	        }
	 
	        $objPHPExcel->setActiveSheetIndex(0);
	 
	        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
	 
	        // Sending headers to force the user to download the file
	        header('Content-Type: application/vnd.ms-excel');
	        header('Content-Disposition: attachment;filename="'.$this->input->post("export_file_name").'"');
	        header('Cache-Control: max-age=0');
	 
	        $objWriter->save('php://output');
			*/
			return true;
		}
		$this->add_body_view("admin/common/table_export", array("table"=>$table));
		
		$this->show_admin_page();
	}
	
	public function view_location() {
		$this->load->view("admin/common/view_location");
	}
}