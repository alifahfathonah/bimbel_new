<?php

class Program_model extends CI_Model {

    public $program;
    public $harga;
    public $keterangan;

    public function program($id_program = NULL) {
        return $this->db->get_where('program',$id_program);
        //return $this->db->get('program');
    }

    public function program2() {
        //return $this->db->get('program');
        return $this->db->get('program');
    }

    public function rules() {
        return [
            ['field' => 'harga',
            'label' => 'Harga',
            'rules' => 'required'],
            
            ['field' => 'program',
            'label' => 'Program',
            'rules' => 'required'],
            
            ['field' => 'keterangan',
            'label' => 'Keterangan',
            'rules' => 'required']
        ];
    }

    public function save($program) {
        $data = [
            'program' => $program['program'],
            'harga' => $program['harga'],
            'keterangan' => $program['keterangan'],
            'status' => false
        ];
        $this->db->insert('program', $data);
    }

	public function update($id_program,$program){
        $data = [
            'program' => $program['program'],
            'harga' => $program['harga'],
            'keterangan' => $program['keterangan'],
            'status' => false
        ];
        $where = array('id_program' => $id_program);
        $this->db->update('program', $data, $where);
    }

    public function delete_program($id) {
        $this->db->delete('program', ['id_program' => $id]);
    }

	
}