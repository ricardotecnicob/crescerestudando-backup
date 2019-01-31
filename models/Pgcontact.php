<?php
	/**
	 * 
	 */
	class Pgcontact extends model{

		// public function infoContact(){
		// 	$array = array();

		// 	$sql = "SELECT * FROM pgcontact WHERE id = :id";
		// 	$sql = $this->db->prepare($sql);
		// 	$sql->bindValue(':id',1);
		// 	$sql->execute();

		// 	if($sql->rowCount() > 0){
		// 		$array = $sql->fetch();
		// 	}

		// 	return $array;
		// }

		// public function nmsg(){
		// 	$array = array();

		// 		$sql = "SELECT COUNT(*) as c FROM mensages WHERE status = :status";
		// 		$sql = $this->db->prepare($sql);
		// 		$sql->bindValue(':status',0);
		// 		$sql->execute();

		// 		if($sql->rowCount() > 0){
		// 			$sql = $sql->fetch();
		// 			$array = $sql['c'];
		// 		}else{
		// 			$array = 0;
		// 		}

		// 		return $array;
		// }

		// 	public function getEmails(){
		// 			$array = array();

		// 				$sql = "SELECT * FROM mensages ORDER BY ID DESC";
		// 				$sql = $this->db->prepare($sql);
		// 				$sql->execute();

		// 				if($sql->rowCount() > 0){
		// 					$array = $sql->fetchAll();
		// 				}

		// 				return $array;
		// 	}	

		// 	public function mudarstatus($id){
		// 		$sql = "UPDATE mensages SET status = :status WHERE id = :id ";
		// 		$sql = $this->db->prepare($sql);
		// 		$sql->bindValue(':status', 1);
		// 		$sql->bindValue(':id', $id);
		// 		$sql->execute();
		// 	}

		// 	public function delmsg($id){
		// 		$sql = "DELETE FROM mensages  WHERE id = :id ";
		// 		$sql = $this->db->prepare($sql);
		// 		$sql->bindValue(':id', $id);
		// 		$sql->execute();
		// 	}

	}
?>