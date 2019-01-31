<?php
    class Purchases extends model{

        public function createPurchase($uid,$valorPagamento,$payment_type,$idpost){
            $sql = $this->db->prepare("INSERT INTO purchases SET id_user = :id_user, total_amount = :total_amount, payment_type = :payment_type, payment_status = :payment_status ");
			$sql->bindValue(':id_user', $uid);
            $sql->bindValue(':total_amount', $valorPagamento);
            $sql->bindValue(':payment_type', $payment_type);
            $sql->bindValue(':payment_status', 1);
            $sql->execute();
            
            $id_purchase =  $this->db->lastInsertId();

            $sql = $this->db->prepare("INSERT INTO purchases_qualpost SET id_purchase = :id_purchase, id_post = :id_post,post_value = :post_value ");
			$sql->bindValue(':id_purchase', $id_purchase);
            $sql->bindValue(':id_post', $idpost);
            $sql->bindValue(':post_value', $valorPagamento);
            $sql->execute();

            return $id_purchase;

        }

    }
?>