<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Model_contratos extends CI_Model {

    //insert
    public function addContratos($dados = null) {
        if ($dados != NULL):
            $this->db->insert('tb_contratos', $dados);
        endif;
    }
    public function addRenovacao($dados){
     $this->db->insert('tb_renova_contratos', $dados);   
    }

    //select
    public function getContratos() {
        $this->db->select('tb_contratos.*, tb_operadoras.nome_op, tb_clientes.nome_cliente');
        //$this->db->from('tb_contratos');
        $this->db->join('tb_operadoras', 'tb_contratos.cont_operadora = tb_operadoras.id_operadoras');
        $this->db->join('tb_clientes', 'tb_contratos.cont_cliente = tb_clientes.id_clientes');
        //$this->db->where('id_planos', $id);
        $query = $this->db->get('tb_contratos');
        return $query->result();
    }
    public function getAnexos($id){
       $this->db->select('tb_anexos.*, tb_contratos.cont_id');
        $this->db->join('tb_contratos', 'tb_anexos.id_contratos_anexos = tb_contratos.cont_id');
        $this->db->where('tb_anexos.id_contratos_anexos',$id);
        $query = $this->db->get('tb_anexos');
        return $query->result();  
    }

    //select
    public function getContratosAlteracao($id) {
        $this->db->select('tb_contratos.*, tb_operadoras.id_operadoras, tb_operadoras.nome_op, tb_clientes.nome_cliente, tb_clientes.id_clientes');
        //$this->db->from('tb_contratos');
        $this->db->join('tb_operadoras', 'tb_contratos.cont_operadora = tb_operadoras.id_operadoras');
        $this->db->join('tb_clientes', 'tb_contratos.cont_cliente = tb_clientes.id_clientes');
        $this->db->where('tb_contratos.cont_id', $id);
        $query = $this->db->get('tb_contratos');
        return $query->row();
    }
    public function dados_renovacao_contrato($id){
       $this->db->select('tb_contratos.cont_id, tb_renova_contratos.*');
        $this->db->join('tb_renova_contratos', 'tb_contratos.cont_id = tb_renova_contratos.id_contrato');
        $this->db->where('tb_contratos.cont_id', $id);
        $query = $this->db->get('tb_contratos');
        return $query->result();  
    }
     public function dados_contrato_simples($id){
       $this->db->select('tb_contratos.*');
        $this->db->where('tb_contratos.cont_id', $id);
        $query = $this->db->get('tb_contratos');
        return $query->result();  
    }

    public function listandoBeneficiariosContratos($numcontratos) {
        $this->db->select('tb_planos_escolhidos.*, tb_contratos.cont_numero, tb_contratos.cont_id,
                           tb_beneficiario.nome_ben, tb_beneficiario.id_beneficiario, tb_beneficiario.cpf,
                           tb_beneficiario.benef_email, tb_beneficiario.telefone, tb_beneficiario.status');
        //$this->db->from('tb_contratos');
        $this->db->join('tb_contratos', 'tb_planos_escolhidos.num_contrato = tb_contratos.cont_numero');
        $this->db->join('tb_beneficiario', 'tb_planos_escolhidos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->where('tb_contratos.cont_id', $numcontratos);
        $query = $this->db->get('tb_planos_escolhidos');
        return $query->result();
    }

    //trazendo os socios baseado na letra digitada
    public function listContratos($numero = null) {
        return $this->db
                        ->like('cont_numero', $numero)
                        ->get('tb_contratos');
    }

    //monta um select com os produtos selecionados pela categoria
    public function selectContratoPorNumero($numero = null) {
        $contratos = $this->listContratos($numero);
        $total_planos = $contratos->num_rows();

        $option = "<li><a href='#' class='list-group-item list-group-item-action active'>Foi encontrado: ({$total_planos})</a></li>";
        foreach ($contratos->result() as $contrato) {
            //<a href="#" class="list-group-item list-group-item-action active">
            $option .= "<li value='{$contrato->cont_id}'><a href='filtro_contratos?id=$contrato->cont_id' class='list-group-item list-group-item-action'>$contrato->cont_numero</a></li>" . PHP_EOL;
        }
        return $option;
    }

    public function dados_inicio($dtainicio, $dtafim) {
        $this->db->select('tb_contratos.*,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');

        $this->db->join('tb_clientes', 'tb_contratos.cont_cliente = tb_clientes.id_clientes');
        $this->db->where('tb_contratos.cont_vige_inic >=', $dtainicio);
        $this->db->where('tb_contratos.cont_vige_inic <=', $dtafim);
        $this->db->order_by('nome_cliente', 'asc');
        $query = $this->db->get('tb_contratos');
        return $query->result();
    }
      public function dados_final($dtainicio, $dtafim) {
        $this->db->select('tb_contratos.*,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');

        $this->db->join('tb_clientes', 'tb_contratos.cont_cliente = tb_clientes.id_clientes');
        $this->db->where('tb_contratos.cont_vig_fin >=', $dtainicio);
        $this->db->where('tb_contratos.cont_vig_fin <=', $dtafim);
        $this->db->order_by('nome_cliente', 'asc');
        $query = $this->db->get('tb_contratos');
        return $query->result();
    }

    public function getRelatorioContratos() {
        $estipulante = 'NÃO';
        $this->db->select('tb_contratos.*,
            tb_clientes.id_clientes, tb_clientes.nome_cliente, tb_clientes.estipulante');

        $this->db->join('tb_clientes', 'tb_contratos.cont_cliente = tb_clientes.id_clientes');
        $this->db->where('tb_clientes.estipulante', $estipulante);
        $this->db->order_by('cont_vig_fin', 'asc');
        $query = $this->db->get('tb_contratos');
        return $query->result();
    }
   public function getRelatorioContratos_todos() {
        $this->db->select('tb_contratos.*,
            tb_clientes.id_clientes, tb_clientes.nome_cliente, tb_clientes.estipulante');

        $this->db->join('tb_clientes', 'tb_contratos.cont_cliente = tb_clientes.id_clientes');
        $this->db->order_by('cont_vig_fin', 'asc');
        $query = $this->db->get('tb_contratos');
        return $query->result();
    }
    public function getRelatorioContratos_relatorio90() {
        $data = date('Y-m-d'); 
        $hoje = date('Y-m-d'); 
        $status = 'ATIVO';
        $datafiltro = date('Y-m-d', strtotime("+90 days",strtotime($data))); 
        $this->db->select('tb_contratos.*,
        tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_clientes', 'tb_contratos.cont_cliente = tb_clientes.id_clientes');
        //$this->db->where('tb_contratos.cont_vige_inic >=', $hoje);
        $this->db->where('tb_contratos.cont_vig_fin <=', $datafiltro);
        $this->db->where('tb_contratos.status ', $status);
        $this->db->order_by('cont_vig_fin', 'asc');
        $query = $this->db->get('tb_contratos');
        return $query->result();
    }
  public function verificar_se_gerou_relatorio($hoje){
      $this->db->where('data_gerado', $hoje);
      $query = $this->db->get('tb_relatorio_contratos_vencer90dias');
        return $query->result();  
    }
 
     public function gerouRelatorios90dias($dados = null) {
        if ($dados != NULL):
            $this->db->insert('tb_relatorio_contratos_vencer90dias', $dados);
        endif;
    }

 public function GetContratosGerais($num){
        $this->db->where('cont_numero', $num);
        $query = $this->db->get('tb_contratos');
        return $query->result();  
    }

    public function getClientesEmpresa() {
        $status = 'ATIVO';
        $this->db->order_by("nome_cliente ASC");
        $this->db->where("status",$status);
        $query = $this->db->get('tb_clientes');
        return $query->result();
    }

    public function updateContratos($dados = null, $id = null) {
        if (($dados && $id) != null):
            $this->db->update('tb_contratos', $dados, array('cont_id' => $id));
        endif;
    }
    public function updateContratosFaturas($dados, $id){
        $this->db->update('tb_faturamento', $dados, array('cont_id' => $id));
    }

    public function updateAnexoContrato($dados = null, $id = null) {
        if (($dados && $id) != null):
            $this->db->update('tb_anexos', $dados, array('id_anexo' => $id));
        endif;   
    }

    public function DeletarFornecedor($id = null) {
        if (($id) != null):
            $this->db->delete('tb_fornecedor', array('fn_id' => $id));
        endif;
    }
    public function DeletarAnexoContrato($id = null) {
        if (($id) != null):
            $this->db->delete('tb_anexos', array('id_anexo' => $id));
        endif;
    }

}
