<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Model_operadoras extends CI_Model {

    //insert
    public function addOperadoras($dados = null) {
        if ($dados != NULL):
            $this->db->insert('tb_operadoras', $dados);
        endif;
    }

    //select
    public function getOperadora($id) {
        if ($id != null):
            $this->db->where('id_operadoras', $id);
            $this->db->limit(1);
            $query = $this->db->get('tb_operadoras');
            return $query->row();
        endif;
    }

    //trazendo os socios baseado na letra digitada
    public function listOperadoras($nome = null) {
        return $this->db
                        ->like('nome_op', $nome)
                        // ->or_like('Documento', $nome)
                        //->order_by('nome_op')
                        ->get('tb_operadoras');
    }

    //monta um select com os produtos selecionados pela categoria
    public function selectOperadorasPorNome($nome = null) {
        $operadoras = $this->listOperadoras($nome);
        $total_operadoras = $operadoras->num_rows();

        $option = "<li><a href='#' class='list-group-item list-group-item-action active'>Foi encontrado: ({$total_operadoras})</a></li>";
        foreach ($operadoras->result() as $visitante) {
            //<a href="#" class="list-group-item list-group-item-action active">
            $option .= "<li value='{$visitante->id_operadoras}'><a href='filtro_operadora?id=$visitante->id_operadoras' class='list-group-item list-group-item-action'>$visitante->nome_op</a></li>" . PHP_EOL;
        }
        return $option;
    }
//Selecionando o plano com base na operadora
   public function listPlanos($id_operadora = null) {
        return $this->db
                        ->where('id_operadoras', $id_operadora)
                        ->get('tb_planos');
    }

    //monta um select com as operadoras cadastradas
    public function selectPlanoOperadoras($id_operadora = null) {
        $planos = $this->listPlanos($id_operadora);
        $total_planos = $planos->num_rows();
        $options = "<option value=''>Selecione o Plano ({$total_planos})</option>";
        foreach ($planos->result() as $plano) {
            $options .= "<option value='{$plano->id_planos}'>{$plano->pl_nome}</option>" . PHP_EOL;
        }
        return $options;
    }
     
   //monta um select com os contratos
    public function selectContratosOperadorasNovo($num_contrato = null, $id_cliente = null) {
        $this->db->select('tb_contratos.cont_operadora, tb_contratos.cont_numero, tb_contratos.cont_cliente,
                               tb_operadoras.id_operadoras, tb_operadoras.nome_op');
        $this->db->join('tb_operadoras','tb_contratos.cont_operadora = tb_operadoras.id_operadoras');
        $this->db->where('cont_numero', $num_contrato);
        //$this->db->where('cont_cliente', $id_cliente);
        $query = $this->db->get('tb_contratos');
        return $query->result();
    }

    public function getAllOperadoras() {
        return $this->db
                        ->order_by('nome_op')
                        ->get('tb_operadoras');
    }

    //monta um select com as operadoras cadastradas
    public function selectOperadorasPlanos() {
        $options = "<option value=''>Selecione a Operadora</option>";
        $operadoras = $this->getAllOperadoras();
        foreach ($operadoras->result() as $operadora) {
            $options .= "<option value='{$operadora->id_operadoras}'>{$operadora->nome_op}</option>" . PHP_EOL;
        }
        return $options;
    }
    
      public function getAllOperadoras_contrato($ramo = null) {
        return $this->db
                        ->where('ramo', $ramo)
                        ->or_where ('ramo_1', $ramo)
                        ->or_where ('ramo_2', $ramo)
                        ->or_where ('ramo_3', $ramo)
                        ->get('tb_operadoras');
    }

    //monta um select com as operadoras cadastradas
    public function selectNomeOperadoras_contrato($ramo = null) {
        $operadoras = $this->getAllOperadoras_contrato($ramo);
        $total_operadoras = $operadoras->num_rows();
        $options = "<option value=''>Selecione a Operadora ({$total_operadoras})</option>";
        foreach ($operadoras->result() as $operadora) {
            $options .= "<option value='{$operadora->id_operadoras}'>{$operadora->nome_op}</option>" . PHP_EOL;
        }
        return $options;
    }

    //filtra os planos das operadoras acima
    public function listOperadorasRamo($ramo = null, $cliente_id = null) {
        return $this->db
                        ->select('tb_contratos.*, 
                            tb_operadoras.nome_op, tb_operadoras.id_operadoras, tb_operadoras.ramo, tb_operadoras.ramo_1,
                            tb_operadoras.ramo_2, tb_operadoras.ramo_3')
                        ->join('tb_operadoras', 'tb_contratos.cont_operadora = tb_operadoras.id_operadoras')
                        ->group_by('tb_operadoras.nome_op')
                        ->where('cont_cliente', $cliente_id)
                        ->where('ramo', $ramo)
 //                       ->where('cont_operadora', )
                      //  ->where('ramo', $ramo)
                        ->or_where('ramo_1', $ramo)
                        ->or_where('ramo_2', $ramo)
                        ->or_where('ramo_3', $ramo)
//                        ->or_where ('ramo_1', $ramo)
//                        ->or_where ('ramo_2', $ramo)
//                        ->or_where ('ramo_3', $ramo)
                        ->get('tb_contratos');
    }

    //monta um select com as operadoras cadastradas
    public function selectNomeOperadoras($ramo = null, $cliente_id = null) {
        $planos = $this->listOperadorasRamo($ramo, $cliente_id);
        $total_planos = $planos->num_rows();
        $options = "<option value=''>Selecione a Operadora ({$total_planos})</option>";
        foreach ($planos->result() as $plano) {
            $options .= "<option value='{$plano->id_operadoras}'>{$plano->nome_op}</option>" . PHP_EOL;
        }
        return $options;
    }

    public function updateOperadoras($dados = null, $id = null) {
        if (($dados && $id) != null):
            $this->db->update('tb_operadoras', $dados, array('id_operadoras' => $id));
        endif;
    }

    public function DeletarFornecedor($id = null) {
        if (($id) != null):
            $this->db->delete('tb_fornecedor', array('fn_id' => $id));
        endif;
    }

}
