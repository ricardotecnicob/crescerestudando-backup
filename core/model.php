<?php
	class model{
		
		protected $db;
		
		public function __construct(){
			global $db;
			$this->db = $db;
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}	
	}
?>