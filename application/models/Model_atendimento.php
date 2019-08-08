<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Model_atendimento extends CI_Model {

    //insert
    public function addAtendimento($dados = null) {
        if ($dados != NULL):
            $this->db->insert('tb_atendimentos', $dados);
        endif;
         return $this->db->insert_id();
    }
    public function addArquivos($dados){
        $this->db->insert('tb_anexos', $dados);
    }
    public function addArquivos_contrato($dados){
      $this->db->insert('tb_anexos', $dados);   
    }

    public function addInteracao($dados){
       $this->db->insert('tb_interacao', $dados); 
    }

    public function getInteracoes($id_chamado) {
        $this->db->select('*');
        $this->db->where('id_chamado',$id_chamado );
        $query = $this->db->get('tb_interacao');
        return $query->result();
    }
    public function peganomeanalista($id){
      $this->db->where('id',$id );
        $query = $this->db->get('tb_usuarios');
        return $query->result();  
    }

    //select
    public function getAtendimentos_adm() {
        $status = 'FINALIZADO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        //$this->db->from('tb_atendimentos');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        //$this->db->join('tb_contratos', 'tb_clientes.id_clientes = tb_contratos.cont_cliente');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.andamento !=', $status);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();
    }
    public function GetProtocoloAdicionado($id){
      $this->db->where('id_prot', $id);
      $dados = $this->db->get('tb_protocolo_reembolso');
      return $dados->result();
    }

    public function addProtocolo($dados){
      $this->db->insert('tb_protocolo_reembolso', $dados);
      return $this->db->insert_id();
    }

    public function getProtocolo($id, $data){ 
    $data_ma = $data.' 00:00:00';
    $data_men = $data.' 23:00:00'; 
    $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,tb_beneficiario.cpf,
            tb_clientes.id_clientes, tb_clientes.nome_cliente,
            tb_planos_escolhidos.id_beneficiario, tb_planos_escolhidos.num_contrato,
            tb_contratos.cont_numero, tb_contratos.cont_operadora, tb_contratos.cont_ramo,
            tb_operadoras.*'); 
    $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
    $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
    $this->db->join('tb_planos_escolhidos', 'tb_beneficiario.id_beneficiario = tb_planos_escolhidos.id_beneficiario');
    $this->db->join('tb_contratos', 'tb_clientes.id_clientes = tb_contratos.cont_cliente');
    $this->db->join('tb_operadoras', 'tb_contratos.cont_operadora = tb_operadoras.id_operadoras');
    $this->db->where('tb_atendimentos.id_beneficiario', $id);
    //$this->db->where('tb_atendimentos.protocolo', null);
    $this->db->where('tb_atendimentos.data_inicio >', $data_ma);
    $this->db->where('tb_atendimentos.data_inicio <', $data_men);
    $this->db->where('tb_atendimentos.categoria', 'REEMBOLSO');
    //$this->db->where('tb_atendimentos.protocolo',1);
    $this->db->where('tb_atendimentos.andamento', 'ABERTO');
    
    $this->db->group_by('tb_atendimentos.data_inicio');
    $query = $this->db->get('tb_atendimentos');
    return $query->result();
    }
    public function GetProtocolosGerais($id, $data){
      $data_ma = $data.' 00:00:00';
      $data_men = $data.' 23:00:00';
      $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,tb_beneficiario.cpf,
            tb_clientes.id_clientes, tb_clientes.nome_cliente, tb_clientes.endereco, tb_clientes.cep, tb_clientes.numero,
            tb_planos_escolhidos.id_beneficiario, tb_planos_escolhidos.num_contrato,
            tb_contratos.cont_numero, tb_contratos.cont_operadora, tb_contratos.cont_ramo,
            tb_operadoras.nome_op'); 
    $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
    $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
    $this->db->join('tb_planos_escolhidos', 'tb_beneficiario.id_beneficiario = tb_planos_escolhidos.id_beneficiario');
    $this->db->join('tb_contratos', 'tb_clientes.id_clientes = tb_contratos.cont_cliente');
    $this->db->join('tb_operadoras', 'tb_contratos.cont_operadora = tb_operadoras.id_operadoras');
    $this->db->where('tb_atendimentos.id_beneficiario', $id);
    $this->db->where('tb_atendimentos.data_inicio >', $data_ma);
     $this->db->where('tb_atendimentos.data_inicio <', $data_men);
    $this->db->where('tb_atendimentos.categoria', 'REEMBOLSO');
    $this->db->where('tb_atendimentos.andamento', 'ABERTO');
    //$this->db->where('protocolo', null);
    $this->db->group_by('tb_atendimentos.id_atend');
    $query = $this->db->get('tb_atendimentos');
    return $query->result();   
    }
        public function GetProtocolosGeraisInverso($id, $data){
       $data_ma = $data.' 00:00:00';
       $data_men = $data.' 23:00:00'; 
       
      $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,tb_beneficiario.cpf,
            tb_clientes.id_clientes, tb_clientes.nome_cliente, tb_clientes.endereco, tb_clientes.cep, tb_clientes.numero,
            tb_planos_escolhidos.id_beneficiario, tb_planos_escolhidos.num_contrato,
            tb_contratos.cont_numero, tb_contratos.cont_operadora, tb_contratos.cont_ramo,
            tb_operadoras.nome_op'); 
    $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
    $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
    $this->db->join('tb_planos_escolhidos', 'tb_beneficiario.id_beneficiario = tb_planos_escolhidos.id_beneficiario');
    $this->db->join('tb_contratos', 'tb_clientes.id_clientes = tb_contratos.cont_cliente');
    $this->db->join('tb_operadoras', 'tb_contratos.cont_operadora = tb_operadoras.id_operadoras');
    $this->db->where('tb_atendimentos.id_beneficiario', $id);
    $this->db->where('tb_atendimentos.data_inicio >', $data_ma);
    $this->db->where('tb_atendimentos.data_inicio <', $data_men);
    $this->db->where('tb_atendimentos.categoria', 'REEMBOLSO');
    //$this->db->where('tb_atendimentos.protocolo',1);
    $this->db->where('tb_atendimentos.andamento', 'ABERTO');
    $this->db->group_by('tb_atendimentos.data_inicio');
    //$this->db->group_by('tb_atendimentos.id_atend');
    $query = $this->db->get('tb_atendimentos');
    return $query->result();   
    }

    public function getAtendimentos_comum() {
        $status = 'ABERTO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        //$this->db->from('tb_atendimentos');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        //$this->db->join('tb_contratos', 'tb_clientes.id_clientes = tb_contratos.cont_cliente');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.andamento', $status);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();
    }
    
    public function GerarProtocolosPesquisaData($data){
      $data_ma = $data.' 00:00:00';
      $data_men = $data.' 23:00:00';

    $this->db->where('data_inicio >', $data_ma);
    $this->db->where('data_inicio <', $data_men);
     $this->db->where('tb_atendimentos.categoria', 'REEMBOLSO');
    //$this->db->where('tb_atendimentos.protocolo',1);
    $this->db->where('tb_atendimentos.andamento', 'ABERTO');
    //$this->db->where('protocolo', null);d
    $this->db->group_by('nome_atendimento');
    $query = $this->db->get('tb_atendimentos');
    return $query->result();   
    }
     public function getAtendimentos_outros() {
        $status = 'FINALIZADO';
        $id = 0;
       // $this->db->select('tb_atendimentos');
        $this->db->where('andamento !=', $status);
        $this->db->where('id_beneficiario', $id);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();
    }
    public function getAtendimentos_outros_finalizados() {
        $status = 'FINALIZADO';
        $id = 0;
       // $this->db->select('tb_atendimentos');
        $this->db->where('andamento', $status);
        $this->db->where('id_beneficiario', $id);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();
    }

    public function detalhes_outros_atendimentos($id) {
        $this->db->where('id_atend', $id);
        $query = $this->db->get('tb_atendimentos');
        return $query->row();
    }
     public function getAtendimentos() {
        $status = 'ABERTO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        //$this->db->from('tb_atendimentos');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        //$this->db->join('tb_contratos', 'tb_clientes.id_clientes = tb_contratos.cont_cliente');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.andamento', $status);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();
    }
    public function atendimentos_separados($id){
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        //$this->db->from('tb_atendimentos');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        //$this->db->join('tb_contratos', 'tb_clientes.id_clientes = tb_contratos.cont_cliente');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.analista', $id);
        $this->db->where('tb_atendimentos.andamento !=', 'FINALIZADO');
        $query = $this->db->get('tb_atendimentos');
        return $query->result();
    }  

    public function getAtendimentosFinalizados() {
        $status = 'FINALIZADO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        //$this->db->from('tb_atendimentos');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        //$this->db->join('tb_contratos', 'tb_clientes.id_clientes = tb_contratos.cont_cliente');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.andamento =', $status);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();
    }
    public function getRelatorioReembolsos() {
        $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.categoria =', $tipo);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();
    }
      public function getRelatorioReembolsosBeneficiarios($beneficiario) {
        $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.categoria =', $tipo);
        $this->db->like('tb_atendimentos.nome_atendimento', $beneficiario);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();
    }
      public function getRelatorioReembolsosClientes($cliente) {
        $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.categoria =', $tipo);
        $this->db->like('tb_clientes.nome_cliente', $cliente);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();
    }
    public function getRelatorioReembolsosClientesBeneficiario($cli, $ben){
      $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.categoria =', $tipo);
        $this->db->like('tb_clientes.nome_cliente', $cli);
        $this->db->like('tb_atendimentos.nome_atendimento', $ben);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();   
    }
    public function getRelatorioReembolsosClientesBeneficiarioTipoAt($cli, $ben, $tipo_at, $status){
      $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.categoria =', $tipo);
        $this->db->like('tb_clientes.nome_cliente', $cli);
        $this->db->like('tb_atendimentos.nome_atendimento', $ben);
        $this->db->like('tb_atendimentos.tipo', $tipo_at);
        $this->db->like('tb_atendimentos.tipo', $status);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();   
    }

    public function getRelatorioReembolsoBenCliTipAte($tipo_at){
      $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.categoria =', $tipo);
        //$this->db->like('tb_clientes.nome_cliente', $cli);
        $this->db->like('tb_atendimentos.tipo', $tipo_at);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();   
    }
      public function getRelatorioReembolsoBenStatusPag($statusPag){
      $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.categoria =', $tipo);
        //$this->db->like('tb_clientes.nome_cliente', $cli);
        $this->db->like('tb_atendimentos.status', $statusPag);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();   
    }

      public function getRelatorioReembolsoBenStatusPagBenef($statusPag, $ben){
      $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.categoria =', $tipo);
        $this->db->like('tb_atendimentos.nome_atendimento', $ben);
        $this->db->like('tb_atendimentos.status', $statusPag);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();   
    }
      public function getRelatorioReembolsoBenStatusPagClie($statusPag, $cli){
      $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.categoria =', $tipo);
        $this->db->like('tb_clientes.nome_cliente', $cli);
        $this->db->like('tb_atendimentos.status', $statusPag);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();   
    }
      public function getRelatorioReembolsoBenStatusPagClieBenef($statusPag, $cli, $ben){
      $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.categoria =', $tipo);
        $this->db->like('tb_clientes.nome_cliente', $cli);
        $this->db->like('tb_atendimentos.status', $statusPag);
         $this->db->like('tb_atendimentos.nome_atendimento', $ben);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();   
    }
    public function getRelatorioReembolsosDtaReemb($dtaReemb){
     $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.categoria =', $tipo);
        $this->db->like('tb_atendimentos.dta_reembolso', $dtaReemb);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();    
    }
     public function getRelatorioReembolsosPrestador($prestador){
     $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.categoria =', $tipo);
        $this->db->like('tb_atendimentos.nome_prestador', $prestador);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();    
    }
     public function getRelatorioReembolsosAnalista($analista){
     $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.categoria =', $tipo);
        $this->db->like('tb_atendimentos.nome_analista', $analista);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();    
    }
     public function getRelatorioReembolsosAnalistaCliente($analista, $cli){
     $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.categoria =', $tipo);
        $this->db->like('tb_atendimentos.nome_analista', $analista);
        $this->db->like('tb_clientes.nome_cliente', $cli);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();    
    }
       public function getRelatorioReembolsosDtaInicioDtaFim($dta_in, $dta_fim){
     $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.ini_pro_operadora >=', $dta_in);
        $this->db->where('tb_atendimentos.ini_pro_operadora <=', $dta_fim);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();    
    }
       public function getRelatorioReembolsosBeneficiarioDtaInicioDtaFim($beneficiario, $dta_in, $dta_fim){
     $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.ini_pro_operadora >=', $dta_in);
        $this->db->where('tb_atendimentos.ini_pro_operadora <=', $dta_fim);
        $this->db->like('tb_atendimentos.nome_atendimento', $beneficiario);
       // $this->db->like('tb_clientes.nome_cliente', $cli);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();    
    }
    public function getRelatorioReembolsosClienteBeneficiarioDtaInicioDtaFim($cliente, $beneficiario, $dta_in, $dta_fim){
     $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.ini_pro_operadora >=', $dta_in);
        $this->db->where('tb_atendimentos.ini_pro_operadora <=', $dta_fim);
        $this->db->like('tb_atendimentos.nome_atendimento', $beneficiario);
        $this->db->like('tb_clientes.nome_cliente', $cliente);
        $query = $this->db->get('tb_atendimentos');
        return $query->result(); 
    }
      public function getRelatorioReembolsosStatusBeneficiarioDtaInicioDtaFim($status, $beneficiario, $dta_in, $dta_fim){
     $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.ini_pro_operadora >=', $dta_in);
        $this->db->where('tb_atendimentos.ini_pro_operadora <=', $dta_fim);
        $this->db->where('tb_atendimentos.status', $status);
        $this->db->like('tb_atendimentos.nome_atendimento', $beneficiario);
        
        //$this->db->like('tb_clientes.nome_cliente', $cliente);
        $query = $this->db->get('tb_atendimentos');
        return $query->result(); 
    }
       public function getRelatorioReembolsosStatusDtaInicioDtaFim($status, $dta_in, $dta_fim){
     $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.ini_pro_operadora >=', $dta_in);
        $this->db->where('tb_atendimentos.ini_pro_operadora <=', $dta_fim);
        $this->db->where('tb_atendimentos.status', $status);
        
        //$this->db->like('tb_clientes.nome_cliente', $cliente);
        $query = $this->db->get('tb_atendimentos');
        return $query->result(); 
    }
    public function getRelatorioReembolsosDetalhados() {
        $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.categoria =', $tipo);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();
    }
     public function getRelatorioOutrosAtendimentos() {
        $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        //$this->db->from('tb_atendimentos');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        //$this->db->join('tb_contratos', 'tb_clientes.id_clientes = tb_contratos.cont_cliente');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.categoria !=', $tipo);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();
    }
   public function getAtendimentosClientes($id) {
        $status = 'FINALIZADO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        //$this->db->from('tb_atendimentos');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        // $this->db->join('tb_dependentes', 'tb_beneficiario.id_beneficiario = tb_dependentes.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
       // $this->db->where('tb_atendimentos.andamento !=', $status);
        $this->db->where('tb_atendimentos.id_beneficiario', $id);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();
    }

    public function detalhesAtendimento($id_chamado) {
        $this->db->select('tb_atendimentos.*,
                tb_beneficiario.nome_ben, tb_clientes.id_clientes, tb_clientes.nome_cliente,
                tb_planos_escolhidos.id_beneficiario, tb_planos_escolhidos.nome_plano,
                ');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->join('tb_planos_escolhidos', 'tb_beneficiario.id_beneficiario = tb_planos_escolhidos.id_beneficiario');
        $this->db->where('tb_atendimentos.id_atend', $id_chamado);
        $query = $this->db->get('tb_atendimentos');
        return $query->row();
    }
    public function detalhesAtendimento_semplano($id_chamado){
      $this->db->select('tb_atendimentos.*,
                tb_beneficiario.nome_ben, tb_clientes.id_clientes, tb_clientes.nome_cliente
                ');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        //$this->db->join('tb_planos_escolhidos', 'tb_beneficiario.id_beneficiario = tb_planos_escolhidos.id_beneficiario');
        $this->db->where('tb_atendimentos.id_atend', $id_chamado);
        $query = $this->db->get('tb_atendimentos');
        return $query->row();  
    }
  public function GetAtendimentosInteracao($id_chamado){
      $this->db->select('tb_atendimentos.*');
       //         tb_interacao.*');
        //$this->db->join('tb_interacao', 'tb_atendimentos.id_atend = tb_interacao.id_chamado');
        $this->db->where('tb_atendimentos.id_atend', $id_chamado);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();  
    }
    //trazendo os socios baseado na letra digitada
    public function listplanos($nome = null) {
        return $this->db
                        ->like('pl_nome', $nome)
                        ->get('tb_planos');
    }

    //monta um select com os produtos selecionados pela categoria
    public function selectPlanosPorNome($nome = null) {
        $planos = $this->listplanos($nome);
        $total_planos = $planos->num_rows();

        $option = "<li><a href='#' class='list-group-item list-group-item-action active'>Foi encontrado: ({$total_planos})</a></li>";
        foreach ($planos->result() as $plano) {
            //<a href="#" class="list-group-item list-group-item-action active">
            $option .= "<li value='{$plano->id_planos}'><a href='filtro_planos?id=$plano->id_planos' class='list-group-item list-group-item-action'>$plano->pl_nome</a></li>" . PHP_EOL;
        }
        return $option;
    }
    public function pegaEmails($id_benef = null) {
         return $this->db->select('tb_beneficiario.benef_email, tb_beneficiario.id_beneficiario, tb_beneficiario.id_empresa,
                                tb_contatos.email')
        ->join('tb_contatos', 'tb_beneficiario.id_empresa = tb_contatos.id_cliente')
        ->where('tb_beneficiario.id_beneficiario', $id_benef)
        ->get('tb_beneficiario');
       
    }
    public function selecionaEmailsBeneficiarios($id_benef=null){
       $planos = $this->pegaEmails($id_benef);
       //var_dump($planos);
        $total_planos = $planos->num_rows();
        $option = '';
       // $option = "<li><a href='#' class='list-group-item list-group-item-action active'>Foi encontrado: ({$total_planos})</a></li>";
        foreach ($planos->result() as $plano) {
        $option .= "
                  <tr>
                  <td style='background-color: #f7f4f4;'><input size='30' type='text' style='background-color: #ffff99; border: 1;' value='$plano->email' name='emailCliente' placeholder='E-MAIL CLIENTE'><input name='enviarparacliente' type='checkbox' value='sim'></td>
                 </tr>";
        }
        return $option;  
    }
    public function pegaEmailsbeneficiario($id = null) {
         return $this->db->select('tb_beneficiario.benef_email, tb_beneficiario.id_beneficiario')
        ->where('tb_beneficiario.id_beneficiario', $id)
        ->get('tb_beneficiario');
       
    }
    public function selecionaEmailsBeneficiariosseparado($id=null){
       $planos = $this->pegaEmailsbeneficiario($id);
       //var_dump($planos);
        $total_planos = $planos->num_rows();
        $option = '';
        foreach ($planos->result() as $pl) {
        $option = "<tr>
                   <td style='background-color: #fff;'>
                   <div class='col-md-11'>
                   <input class='form-control' type='text' size='10' style='background-color: #ffff99; border: 1; marging-right: 1%;' value='$pl->benef_email' name='emailbeneficiario' placeholder='Digite o e-mail'>
                       </div>
                        <input name='enviarbeneficiario' type='checkbox' value='sim'>
                   </td>
              </tr>";
          }   
          //<input class='form-control' style='float: right, marging-left:40%;' type='checkbox' checked='checked' name='enviarbeneficiario' value='sim'>
          return $option;  
    }

    

    //buscando anexo via ajax
     public function pegaAnexos($id_chamado = null) {
         return $this->db->select('*')
        ->where('id_chamado', $id_chamado)
        ->get('tb_anexos');
       
    }
     public function selecionaAnexosAtendimentos($id_chamado=null){
       $anexos = $this->pegaAnexos($id_chamado);
        $total_tr = $anexos->num_rows();
        $tr = "({$total_tr})";
       // $option = "<li><a href='#' class='list-group-item list-group-item-action active'>Foi encontrado: ({$total_planos})</a></li>";
        foreach ($anexos->result() as $anexo) {
            //<a href="#" class="list-group-item list-group-item-action active">
            $base = base_url().'anexos';
            $tr .= "<tr>
                         <td><a href='$base/$anexo->nome_arquivo' target='_blank'> $anexo->descricao </a></td>
                      </tr>";
        }
        return $tr;  
    }
    public function detalhesInteracao($id_chamado){
        $this->db->where('id_chamado', $id_chamado);
        $dados = $this->db->get('tb_interacao');
        return $dados->result();
    }
    
      public function verificasetemchamado($id_benef, $moviment){
        $this->db->where('id_beneficiario', $id_benef); 
        $this->db->where('movimentacao', $moviment);
        $dados = $this->db->get('tb_atendimentos');
        return $dados->result();
    }
    public function UpdateAtendimentoGeral($id, $dados){
       $this->db->update('tb_atendimentos', $dados, array('id_atend' => $id)); 
    }

    public function updateAtendimento($dados = null, $id = null) {
        if (($dados && $id) != null):
            $this->db->update('tb_atendimentos', $dados, array('id_atend' => $id));
        endif;
    }
    public function UpdateAtendimentosProtocolo($dados, $id, $categoria, $data){
        $data_ma = $data.' 00:00:00';
       $data_men = $data.' 23:00:00';
       $this->db->update('tb_atendimentos', $dados, 
               array('id_beneficiario' => $id, 
                    'categoria' => $categoria,
                    'data_inicio >' => $data_ma,
                    'data_inicio <' => $data_men,
                   ));  
    }

    public function UpdateProtocolo($dados = null, $id = null) {
        if (($dados && $id) != null):
            $this->db->update('tb_protocolo_reembolso', $dados, array('id_prot' => $id));
        endif;
    }
    public function posseAoChamado($id, $analista){
       $this->db->update('tb_atendimentos', $analista, array('id_atend' => $id));  
    }

    public function DeletarFornecedor($id = null) {
        if (($id) != null):
            $this->db->delete('tb_fornecedor', array('fn_id' => $id));
        endif;
    }
}
