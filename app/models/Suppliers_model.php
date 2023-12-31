<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Suppliers_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }

    public function getSupplierByID($id) {
        $q = $this->db->get_where('suppliers', array('id' => $id), 1);
        if( $q->num_rows() > 0 ) {
            return $q->row();
        }
        return FALSE;
    }

    public function addSupplier($data = array()) {
        if($this->db->insert('suppliers', $data)) {
            return $this->db->insert_id();
        }
        return false;
    }

    public function updateSupplier($id, $data = array()) {
        if($this->db->update('suppliers', $data, array('id' => $id))) {
            return true;
        }
        return false;
    }

    public function deleteSupplier($id) {
        
        // Verificando que no esté asociado a un documento
        $cSql = "select id from tec_purchases where supplier_id = {$id}";

        $query = $this->db->query($cSql);
        
        $cantidad = $query->num_rows() * 1;

        if ($cantidad == 0){
            if($this->db->delete('suppliers', array('id' => $id))) {
                return true;
            }
        }
        return FALSE;
    }

}
