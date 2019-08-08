<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Model_usuario extends CI_Model {

    //insert
    public function addUsers($dados = null) {
        if ($dados != NULL):
            $this->db->insert('tb_usuarios', $dados);
        endif;
    }

    public function getBeneficiariosPorCliente($id_cliente = null) {
        return $this->db
                        ->where('id_empresa', $id_cliente)
                        ->where("status ", "ATIVO")
                        ->order_by('nome_ben')
                        ->get('tb_beneficiario');
    }

    //monta um select com os produtos selecionados pela categoria
    public function getUsuariosBeneficiarios($id_cliente = null) {
        $beneficiarios = $this->getBeneficiariosPorCliente($id_cliente);
        $total_beneficiarios = $beneficiarios->num_rows();
        $options = "<option value=''>Selecione o Beneficiário ({$total_beneficiarios})</option>";
        foreach ($beneficiarios->result() as $beneficiario) {
            $options .= "<option value='{$beneficiario->id_beneficiario}'>$beneficiario->nome_ben</option>" . PHP_EOL;
        }
        return $options;
    }

    //select
    public function getUsuarios() {
        $query = $this->db->get('tb_usuarios');
        $this->db->order_by("nome");
        return $query->result();
    }

    public function dados_beneficiario($id) {
        $this->db->where('id_beneficiario', $id);
        $query = $this->db->get('tb_beneficiario');
        return $query->result();
    }

    public function dados_cliente($id) {
        $this->db->where('id_clientes', $id);
        $query = $this->db->get('tb_clientes');
        return $query->result();
    }

    //update
    public function listUsers($id = null) {
        if ($id != null):
            $this->db->where('id', $id);
            $this->db->limit(1);
            $query = $this->db->get('tb_usuarios');
            return $query->row();
        endif;
    }

    public function listUsersLogin($ilogin) {
        $this->db->where('login', $ilogin);
        $query = $this->db->get('tb_usuarios');
        return $query->result();
    }

    public function DeletarUser($id) {
        if (($id) != null):
            $this->db->delete('tb_usuarios', array('id' => $id));
        endif;
    }

    public function UpdateUsers($id, $dados) {
        $this->db->where('id', $id);
        $this->db->update('tb_usuarios', $dados);
    }

}
