<?php
class Berita_model extends CI_Model
{

    private $_table = "berita";
    private $primary_key = "ID_BERITA";
    var $table='praktikumelektro';
    public function __construct()
    {
        $this->load->database();
    }

    function tampil()
    {
        $this->db->from('berita');
        $this->db->order_by('ID_BERITA', 'desc');
        $query = $this->db->get();
        if($query ->num_rows()>0) {
            return $query->result();
        }else

        {
            return array();
        }
    }

    function department5($id)
    {
        $this->db->from($this->tabel);
        $this->db->where('nim', $id);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        }
    }

    function per_id($id)
    {
        $this->db->where('ID_BERITA', $id);
        $query = $this->db->get($this->_table);
        return $query->result();
    }

}
