<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Model_beneficiario extends CI_Model {

    //insert
    public function addBeneficiario($dados = null) {
        if ($dados != NULL):
            $this->db->insert('tb_beneficiario', $dados);
         return $this->db->insert_id();
        endif;
    }
    public function selectAnalistas(){
        $tipo_acesso  = 'Colaborador';
        $this->db->where('tipo_acesso', $tipo_acesso);
        $result = $this->db->get('tb_usuarios');
        return $result->result();
    }

    //select beneficiario abre solicitação
//    public function getBeneficiarioSolicitacao($id, $ramp) {
//        if ($id != null):
//            $this->db->select('tb_beneficiario.*, tb_clientes.id_clientes, tb_clientes.nome_cliente,
//                              tb_planos_escolhidos.id_beneficiario, tb_planos_escolhidos.nome_plano,
//                              tb_contratos.cont_id, tb_contratos.cont_cliente, tb_contratos.cont_ramo');
//            $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
//            $this->db->join('tb_planos_escolhidos', 'tb_beneficiario.id_beneficiario = tb_planos_escolhidos.id_beneficiario');
//            $this->db->join('tb_contratos', 'tb_clientes.id_clientes = tb_contratos.cont_cliente');
//            //$this->db->join('tb_operadoras', 'tb_planos.id_operadoras = tb_operadoras.id_operadoras');
//            $this->db->where('tb_beneficiario.id_beneficiario', $id);
//            $this->db->where('tb_contratos.cont_ramo', $ramp);
//            $query = $this->db->get('tb_beneficiario');
//            return $query->row();
//        endif;
//    }
    
        public function getBeneficiarioSolicitacao($id, $ramp) {
        if ($id != null):
            $this->db->select('tb_planos_escolhidos.*, 
                    tb_contratos.cont_numero,
                    tb_beneficiario.id_beneficiario, tb_beneficiario.id_empresa, tb_beneficiario.benef_email, tb_beneficiario.nome_ben,
                    tb_clientes.id_clientes, tb_clientes.nome_cliente');
            $this->db->join('tb_contratos', 'tb_planos_escolhidos.num_contrato = tb_contratos.cont_numero');
            $this->db->join('tb_beneficiario', 'tb_planos_escolhidos.id_beneficiario = tb_beneficiario.id_beneficiario');
            $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
//            $this->db->join('tb_planos_escolhidos', 'tb_beneficiario.id_beneficiario = tb_planos_escolhidos.id_beneficiario');
           
            //$this->db->join('tb_operadoras', 'tb_planos.id_operadoras = tb_operadoras.id_operadoras');
            $this->db->where('tb_planos_escolhidos.id_beneficiario', $id);
            $this->db->where('tb_contratos.cont_ramo', $ramp);
            $query = $this->db->get('tb_planos_escolhidos');
            return $query->row();
        endif;
    }
    public function contratos_cliente($id_beneficiario){
      $this->db->select('tb_beneficiario.id_beneficiario, tb_beneficiario.id_empresa,
                        tb_clientes.id_clientes,
                        tb_contratos.*, tb_operadoras.id_operadoras, tb_operadoras.nome_op');
           $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
           $this->db->join('tb_contratos', 'tb_clientes.id_clientes = tb_contratos.cont_cliente');
           $this->db->join('tb_operadoras', 'tb_contratos.cont_operadora = tb_operadoras.id_operadoras');
           $this->db->where('tb_beneficiario.id_beneficiario', $id_beneficiario);
           $this->db->where('tb_contratos.status', 'ATIVO');
           $query = $this->db->get('tb_beneficiario');
            return $query->result();  
    }

    //select
    public function getBeneficiario($id) {
        if ($id != null):
            $this->db->select('tb_beneficiario.*, tb_clientes.id_clientes, tb_clientes.nome_cliente');
            //$this->db->from('tb_beneficiario');
            $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
            $this->db->where('id_beneficiario', $id);
            //$this->db->limit(1);
            $query = $this->db->get('tb_beneficiario');
            return $query->row();
        endif;
    }
    
    public function getBeneficiariosMovimentacao($status){
        $ativada = 'ativa';
        $this->db->select('tb_beneficiario.*,
                         tb_atendimentos.id_beneficiario, tb_atendimentos.andamento, tb_atendimentos.movimentacao,
                        tb_atendimentos.movimentacao, tb_atendimentos.id_atend');
     $this->db->join('tb_atendimentos','tb_beneficiario.id_beneficiario = tb_atendimentos.id_beneficiario');
     $this->db->where('tb_beneficiario.status', $status);   
     $this->db->where('tb_atendimentos.movimentacao', $ativada); 
     $resultado = $this->db->get('tb_beneficiario');
     return $resultado->result();
    }
    public function getAtendimentosBeneficiario($id){ 
      $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        //$this->db->from('tb_atendimentos');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        //$this->db->join('tb_contratos', 'tb_clientes.id_clientes = tb_contratos.cont_cliente');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
       $this->db->where('tb_atendimentos.id_beneficiario', $id);  
        $query = $this->db->get('tb_atendimentos');
        return $query->result();   
    }

    public function QuantidadeDePlanosBeneficiario($id) {
        if ($id != null):
           return $this->db
            ->select('tb_planos_escolhidos.*, tb_beneficiario.id_beneficiario, tb_operadoras.nome_op, tb_operadoras.ramo')
            //->from('tb_planos_escolhidos')
            //$this->db->join('tb_planos', 'tb_planos_escolhidos.id_plano = tb_planos.id_planos');
            ->join('tb_beneficiario', 'tb_planos_escolhidos.id_beneficiario = tb_beneficiario.id_beneficiario')
            ->join('tb_operadoras', 'tb_planos_escolhidos.id_operadora = tb_operadoras.id_operadoras')
            ->where('tb_beneficiario.id_beneficiario', $id)
            //$this->db->limit(1);
            ->get('tb_planos_escolhidos');
        endif;
    }
      public function getPlanosBeneficiario($id) {
        if ($id != null):
            $this->db->select('tb_planos_escolhidos.*, tb_beneficiario.id_beneficiario, tb_operadoras.nome_op, tb_operadoras.id_operadoras, tb_contratos.*');
            //tb_operadoras.*, tb_contratos.*');
            $this->db->from('tb_planos_escolhidos');
            //$this->db->join('tb_planos', 'tb_planos_escolhidos.id_plano = tb_planos.id_planos');
            $this->db->join('tb_beneficiario', 'tb_planos_escolhidos.id_beneficiario = tb_beneficiario.id_beneficiario');
            $this->db->join('tb_operadoras', 'tb_planos_escolhidos.id_operadora = tb_operadoras.id_operadoras');
            $this->db->join('tb_contratos', 'tb_planos_escolhidos.num_contrato = tb_contratos.cont_numero');
            $this->db->where('tb_beneficiario.id_beneficiario', $id);
            //$this->db->limit(1);
            $query = $this->db->get();
            return $query->result();
        endif;
    }

    public function getDependenteBeneficiario($id) {
        if ($id != null):
            // $this->db->select('tb_planos_escolhidos');
            $this->db->where('id_beneficiario', $id);
            //$this->db->limit(1);
            $query = $this->db->get('tb_dependentes');
            return $query->result();
        endif;
    }
    public function getBeneficiariosCpf($cpf){
       $this->db->where('cpf', $cpf); 
       $dados = $this->db->get('tb_beneficiario');
            return $dados->result();
    }

    /* $this->db->select('tb_beneficiario.*, tb_dependentes.*, tb_planos_escolhidos.*');
      $this->db->from('tb_beneficiario');
      $this->db->join('tb_dependentes', 'tb_beneficiario.id_beneficiario = tb_dependentes.id_beneficiario');
      $this->db->join('tb_planos_escolhidos', 'tb_beneficiario.id_beneficiario = tb_planos_escolhidos.id_beneficiario');
      $this->db->where('tb_beneficiario.id_beneficiario', $id);
      $this->db->order_by("nome");
      $query = $this->db->get();
      return $query->result(); */
    
    
      //trazendo os socios baseado na letra digitada
    public function listBeneficiariosAbreSolicitacao($nome = null, $ramo = null) {
        return $this->db
                        ->select('tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben,
                                 tb_beneficiario.id_empresa, tb_clientes.id_clientes, tb_clientes.nome_cliente,
                                 tb_contratos.cont_id, tb_contratos.cont_ramo')
                        ->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes')
                       ->join('tb_contratos', 'tb_clientes.id_clientes = tb_contratos.cont_cliente')
                        ->like('nome_ben', $nome)
                        ->where('tb_contratos.cont_ramo', $ramo)
                        // ->or_like('tb_dependentes.nome', $nome)
                        //->order_by('nome_op')
                        ->get('tb_beneficiario');
    }

    //monta um select com os produtos selecionados pela categoria
    public function selectBeneficiariosPorNomeSolicitacao($nome = null, $cat, $ramo) {
        $operadoras = $this->listBeneficiariosAbreSolicitacao($nome, $ramo);
        $total_operadoras = $operadoras->num_rows();

        $option = "<li><a href='#' class='list-group-item list-group-item-action active'>Foi encontrado: ({$total_operadoras})</a></li>";
        foreach ($operadoras->result() as $visitante) {            
            //<a href="#" class="list-group-item list-group-item-action active">
            $option .= "<li value='{$visitante->id_beneficiario}'><a href='atendimento?id=$visitante->id_beneficiario&cat=$cat&ramo=$ramo&nome=$visitante->nome_ben' class='list-group-item list-group-item-action'>$visitante->nome_ben - $visitante->nome_cliente </a></li>" . PHP_EOL;
        }
        return $option;
    }

        //trazendo os socios baseado na letra digitada dos dependentes
    public function listDependentesAbreSolicitacao($nome = null) {
        return $this->db
                        ->select('tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben,
                                 tb_dependentes.id_dependentes, tb_dependentes.id_beneficiario, tb_dependentes.nome,
                                 tb_beneficiario.id_empresa, tb_clientes.id_clientes, tb_clientes.nome_cliente')
                        ->join('tb_beneficiario', 'tb_dependentes.id_beneficiario = tb_beneficiario.id_beneficiario')
                        ->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes')
                        ->like('tb_dependentes.nome', $nome)
                        // ->or_like('tb_dependentes.nome', $nome)
                        //->order_by('nome_op')
                        ->get('tb_dependentes');
    }

    //monta um select com os produtos selecionados pela categoria
    public function selecionaDependentesAbreSolicitacao($nome = null, $cat, $ramo) {
        $operadoras = $this->listDependentesAbreSolicitacao($nome);
        $total_operadoras = $operadoras->num_rows();

        $option = "<li><a href='#' class='list-group-item list-group-item-action active'>Foi encontrado: ({$total_operadoras})</a></li>";
        foreach ($operadoras->result() as $visitante) {            
            //<a href="#" class="list-group-item list-group-item-action active">
            $option .= "<li value='{$visitante->id_beneficiario}'><a href='atendimento?id=$visitante->id_beneficiario&cat=$cat&ramo=$ramo&nome=$visitante->nome' class='list-group-item list-group-item-action'>$visitante->nome - $visitante->nome_cliente </a></li>" . PHP_EOL;
        }
        return $option;
    }
    //trazendo os socios baseado na letra digitada
    public function listBeneficiarios($nome = null) {
        $status = 'INATIVO';
        return $this->db
                        ->select('tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben,
                                 tb_beneficiario.id_empresa, tb_clientes.id_clientes, tb_clientes.nome_cliente')
                        ->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes')
                      // ->join('tb_dependentes', 'tb_beneficiario.id_beneficiario = tb_dependentes.id_beneficiario')
                        ->where('tb_beneficiario.status !=', $status) 
                        ->like('nome_ben', $nome)
                        // ->or_like('tb_dependentes.nome', $nome)
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
            $option .= "<li value='{$visitante->id_beneficiario}'><a href='filtro_beneficiario?id=$visitante->id_beneficiario' class='list-group-item list-group-item-action'>$visitante->nome_ben - $visitante->nome_cliente </a></li>" . PHP_EOL;
        }
        return $option;
    }
    public function listBeneficiarios_inativos($nome = null) {
        $status = 'INATIVO';
        return $this->db
                        ->select('tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben,
                                 tb_beneficiario.id_empresa, tb_clientes.id_clientes, tb_clientes.nome_cliente')
                        ->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes')
                      // ->join('tb_dependentes', 'tb_beneficiario.id_beneficiario = tb_dependentes.id_beneficiario')
                        ->where('tb_beneficiario.status', $status)       
                        ->like('nome_ben', $nome)
                        //->order_by('nome_op')
                        ->get('tb_beneficiario');
    }

    //monta um select com os produtos selecionados pela categoria
    public function selectBeneficiariosPorNome_inativos($nome = null) {
        $operadoras = $this->listBeneficiarios_inativos($nome);
        $total_operadoras = $operadoras->num_rows();

        $option = "<li><a href='#' class='list-group-item list-group-item-action active'>Foi encontrado: ({$total_operadoras})</a></li>";
        foreach ($operadoras->result() as $visitante) {
            //<a href="#" class="list-group-item list-group-item-action active">
            $option .= "<li value='{$visitante->id_beneficiario}'><a href='filtro_beneficiario?id=$visitante->id_beneficiario' class='list-group-item list-group-item-action'>$visitante->nome_ben - $visitante->nome_cliente </a></li>" . PHP_EOL;
        }
        return $option;
    }
       public function listDependentes($nome = null) {
        return $this->db
                        ->select('tb_dependentes.nome, tb_dependentes.id_beneficiario, tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben,
                                 tb_beneficiario.id_empresa, tb_clientes.id_clientes, tb_clientes.nome_cliente')
                        ->join('tb_beneficiario', 'tb_dependentes.id_beneficiario = tb_beneficiario.id_beneficiario')
                        ->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes')
                        ->like('tb_dependentes.nome', $nome)
                        ->get('tb_dependentes'); 
    }

    //monta um select com os produtos selecionados pela categoria
    public function selectDependentesPorNome($nome = null) {
        $operadoras = $this->listDependentes($nome);
        $total_operadoras = $operadoras->num_rows(); 

        $option = "<li><a href='#' class='list-group-item list-group-item-action active'>Foi encontrado: ({$total_operadoras})</a></li>";
        foreach ($operadoras->result() as $visitante) {
            //<a href="#" class="list-group-item list-group-item-action active">
            $option .= "<li value='{$visitante->id_beneficiario}'><a href='filtro_beneficiario?id=$visitante->id_beneficiario' class='list-group-item list-group-item-action'>$visitante->nome - $visitante->nome_cliente </a></li>" . PHP_EOL;
        }
        return $option;
    }
    public function dados_filtro($dtainicio, $dtafim){
        $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.categoria =', $tipo);
       $this->db->where('data_inicio >', $dtainicio);
       $this->db->where('data_inicio <', $dtafim);
        $query = $this->db->get('tb_atendimentos');
        return $query->result(); 
    }
  public function dados_filtro_outros($dtainicio, $dtafim){
        $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.categoria !=', $tipo);
       $this->db->where('data_inicio >', $dtainicio);
       $this->db->where('data_inicio <', $dtafim);
        $query = $this->db->get('tb_atendimentos');
        return $query->result(); 
    }
    public function dados_filtro_outro_cliente($cli){
        $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.categoria !=', $tipo);
        $this->db->like('tb_clientes.nome_cliente', $cli);
        $query = $this->db->get('tb_atendimentos');
        return $query->result();
    }
    public function dados_filtro_outro_beneficiario($ben){
    $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.categoria !=', $tipo);
        $this->db->like('tb_atendimentos.nome_atendimento', $ben);
        $query = $this->db->get('tb_atendimentos');
        return $query->result(); 
    }
     public function dados_filtro_outro_andamento($and){
    $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.categoria !=', $tipo);
        $this->db->like('tb_atendimentos.andamento', $and);
        $query = $this->db->get('tb_atendimentos');
        return $query->result(); 
    }
      public function dados_filtro_outro_andamento_cli($and, $cli){
    $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.categoria !=', $tipo);
        $this->db->like('tb_atendimentos.andamento', $and);
        $this->db->like('tb_clientes.nome_cliente', $cli);
        $query = $this->db->get('tb_atendimentos');
        return $query->result(); 
    }
     public function dados_filtro_outro_andamento_ben($and, $ben){
    $tipo = 'REEMBOLSO';
        $this->db->select('tb_atendimentos.*,
            tb_beneficiario.id_beneficiario, tb_beneficiario.nome_ben, tb_beneficiario.id_empresa,
            tb_clientes.id_clientes, tb_clientes.nome_cliente');
        $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
        $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
        $this->db->where('tb_atendimentos.categoria !=', $tipo);
        $this->db->like('tb_atendimentos.andamento', $and);
        $this->db->like('tb_atendimentos.nome_atendimento', $ben);
        $query = $this->db->get('tb_atendimentos');
        return $query->result(); 
    }
    public function getClientesEmpresa() {
        $status = 'ATIVO';
        $this->db->order_by("nome_cliente ASC");
        $this->db->where("status",$status);
        $query = $this->db->get('tb_clientes');
        return $query->result();
    }
    public function aniversariantes($status, $parabenizado){
      $this->db->where("status",$status);
      $this->db->where("parabenizado",$parabenizado);
        $query = $this->db->get("tb_beneficiario");
        return $query->result();  
    }
     public function tem_aniversariantes($dia, $parabenizado){
      $this->db->order_by("nome_ben ASC");
      $this->db->where("dia_aniversario",$dia);
      $this->db->where("parabenizado",$parabenizado);
        $query = $this->db->get("tb_beneficiario");
        return $query->result();  
    }
    public function AtualizaIdade($id, $dados){
      if (($dados && $id) != null):
            $this->db->update('tb_beneficiario', $dados, array('id_beneficiario' => $id));
        endif;  
    }

    public function updateBeneficiario($dados = null, $id = null) {
        if (($dados && $id) != null):
            $this->db->update('tb_beneficiario', $dados, array('id_beneficiario' => $id));
        endif;
    }

    public function DeletarBeneficiario($id = null) {
        if (($id) != null):
            $this->db->delete('tb_beneficiario', array('id_beneficiario' => $id));
        endif;
    }
 public function DeletarBeneficiario_dependente($id = null) {
        if (($id) != null):
            $this->db->delete('tb_dependentes', array('id_beneficiario' => $id));
        endif;
    }
     public function DeletarBeneficiario_plano($id = null) {
        if (($id) != null):
            $this->db->delete('tb_planos_escolhidos', array('id_beneficiario' => $id));
        endif;
    }
}
