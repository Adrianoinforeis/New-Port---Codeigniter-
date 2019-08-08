<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Model_autenticacao extends CI_Model {

    //autenticação
    public function UserAutenticacao($user = null, $pass = null) {
        if (($user != null) && ($pass != null)):
            $this->db->where('login', $user);
            $this->db->where('password', $pass);
            $this->db->from('tb_usuarios');
            $query = $this->db->get();
            return $query->result();
        endif;
    }

    public function EsqueceuSenha($email) { 
        $this->db->where('email', $email);
        $this->db->from('tb_usuarios');
        $query = $this->db->get();
        return $query->result();
    }
    public function atualizavezes($id, $dados){
        $this->db->update('tb_usuarios', $dados,
                          array('id' => $id));
    }

}
