<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Model_dependentes extends CI_Model {

    //insert
    public function addDependente($dados = null) {
        if ($dados != NULL):
            $this->db->insert('tb_dependentes', $dados);
            return $this->db->insert_id();
        endif;
    }

    //select
    public function getBeneficiario($id) {
        if ($id != null):
            $this->db->where('id_clientes', $id);
            $this->db->limit(1);
            $query = $this->db->get('tb_clientes');
            return $query->row();
        endif;
    }

    //trazendo os socios baseado na letra digitada
    public function listBeneficiarios($nome = null) {
        return $this->db
                        ->like('nome_ben', $nome)
                        // ->or_like('Documento', $nome)
                        //->order_by('nome_op')
                        ->get('tb_beneficiario');
    }

    //monta um select com os produtos selecionados pela categoria
    public function selectBeneficiariosPorNome($nome = null) {
        $operadoras = $this->listBeneficiarios($nome);
        $total_operadoras = $operadoras->num_rows();

        $option = "<li><a href='#' class='list-group-item list-group-item-action active'>Foi encontrado: ({$total_operadoras})</a></li>";
        foreach ($operadoras->result() as $visitante) {
            //<a href="#" class="list-group-item list-group-item-action active">
            $option .= "<li value='{$visitante->id_beneficiario}'><a href='filtro_beneficiario?id=$visitante->id_beneficiario' class='list-group-item list-group-item-action'>$visitante->nome_ben</a></li>" . PHP_EOL;
        }
        return $option;
    }

    public function pegaDadosDpendente($id_dependente = null) {
        return $this->db
                        ->where('id_dependentes', $id_dependente)
                        ->get('tb_dependentes');
    }

    public function selecionaDadosDoPlanoDependente($id_dependente = null) {
        $planos = $this->pegaDadosDpendente($id_dependente);
        $total_planos = $planos->num_rows();
        $option = '';
        // $option = "<li><a href='#' class='list-group-item list-group-item-action active'>Foi encontrado: ({$total_planos})</a></li>";
        foreach ($planos->result() as $plano) {
            if ($plano->id_plano1 != null) {
                $option .= "<tr>
                              <td style='background-color: #f7f4f4;'><input disabled style='border: 0;' size='25' type='text' value='$plano->id_plano1' name=''></td>
                              <td style='background-color: #f7f4f4;'><input size='30' style='background-color: #f7f4f4;' type='text' value='$plano->cart1' name='1_carteirinha'></td>
                              <td style='background-color: #f7f4f4;'><input type='checkbox' checked='checked' value='$plano->id_plano1' name='1_check'></td>
                      </tr>";
            }
            if ($plano->id_plano2 != null) {
                $option .= "<tr>
                              <td style='background-color: #f7f4f4;'><input disabled style='border: 0;' size='25' type='text' value='$plano->id_plano2' name=''></td>
                              <td style='background-color: #f7f4f4;'><input style='background-color: #f7f4f4;' size='30' type='text' value='$plano->cart2' name='2_carteirinha'></td>
                              <td style='background-color: #f7f4f4;'><input type='checkbox' checked='checked' value='$plano->id_plano2' name='2_check'></td>
                      </tr>";
            }
            if ($plano->id_plano3 != null) {
                $option .= "<tr>
                              <td style='background-color: #f7f4f4;'><input disabled style='border: 0;' size='25' type='text' value='$plano->id_plano3' name=''></td>
                              <td style='background-color: #f7f4f4;'><input style='background-color: #f7f4f4;' size='30' type='text' value='$plano->cart3' name='3_carteirinha'></td>
                              <td style='background-color: #f7f4f4;'><input type='checkbox' checked='checked' value='$plano->id_plano3' name='3_check'></td>
                      </tr>";
            }
            if ($plano->id_plano4 != null) {
                $option .= "<tr>
                              <td style='background-color: #f7f4f4;'><input disabled style='border: 0;' size='25' type='text' value='$plano->id_plano4' name=''></td>
                              <td style='background-color: #f7f4f4;'><input style='background-color: #f7f4f4;' size='30' type='text' value='$plano->cart4' name='4_carteirinha'></td>
                              <td style='background-color: #f7f4f4;'><input type='checkbox' checked='checked' value='$plano->id_plano4' name='4_check'></td>
                      </tr>";
            }
            if ($plano->id_plano5 != null) {
                $option .= "<tr>
                              <td style='background-color: #f7f4f4;'><input disabled style='border: 0;' size='25' type='text' value='$plano->id_plano5' name=''></td>
                              <td style='background-color: #f7f4f4;'><input style='background-color: #f7f4f4;' size='30' type='text' value='$plano->cart5' name='5_carteirinha'></td>
                              <td style='background-color: #f7f4f4;'><input type='checkbox' checked='checked' value='$plano->id_plano5' name='5_check'></td>
                      </tr>";
            }
        }
        return $option;
    }

    public function getDependentesMovimentacao($status) {
        $ativada = 'ativa'; 
        $this->db->select('tb_dependentes.*,
                          tb_atendimentos.id_beneficiario, tb_atendimentos.andamento, tb_atendimentos.movimentacao,
                          tb_beneficiario.id_beneficiario,
                          tb_atendimentos.id_atend');
        $this->db->join('tb_beneficiario', 'tb_dependentes.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_atendimentos', 'tb_beneficiario.id_beneficiario = tb_atendimentos.id_beneficiario');
        // $this->db->join('tb_dependentes','tb_atendimentos.id_beneficiario = tb_dependentes.id_beneficiario');
        $this->db->where('tb_dependentes.status', $status);
        $this->db->where('tb_atendimentos.movimentacao', $ativada);
        $resultado = $this->db->get('tb_dependentes');
        return $resultado->result();
    }

    public function updateDependente($dados = null, $id = null) {
        if (($dados && $id) != null):
            $this->db->update('tb_dependentes', $dados, array('id_dependentes' => $id));
        endif;
    }

    public function DeletarDependente($id = null) {
        if (($id) != null):
            $this->db->delete('tb_dependentes', array('id_dependentes' => $id));
        endif;
    }

}
