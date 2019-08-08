<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
    public function getOperadoras() {
        $this->load->model('Model_operadoras');
        $nome = $this->input->post('palavra');
        echo $this->Model_operadoras->selectOperadorasPorNome($nome);
    }

    public function getPlanos() {
        $this->load->model('Model_planos');
        $nome = $this->input->post('palavra');
        echo $this->Model_planos->selectPlanosPorNome($nome);
    }

    public function getOperadorasRamo() {
        $this->load->model('Model_operadoras');
         $cliente_id = $this->input->post('cliente_id');
         $ramo_da_operadora = $this->input->post('ramo_da_operadora');
         echo $this->Model_operadoras->selectNomeOperadoras($ramo_da_operadora, $cliente_id);
    }

     public function getOperadorasRamo_contrato() {
        $this->load->model('Model_operadoras');
         $ramo_da_operadora = $this->input->post('ramo_da_operadora');
         echo $this->Model_operadoras->selectNomeOperadoras_contrato($ramo_da_operadora);
    }
    public function getClientes() {
        $this->load->model('Model_clientes');
        $nome = $this->input->post('palavra');
        echo $this->Model_clientes->selectClientesPorNome($nome);
    }

    public function getBeneficiarios() {
        $this->load->model('Model_beneficiario');
        $nome = $this->input->post('palavra');
        echo $this->Model_beneficiario->selectBeneficiariosPorNome($nome);
    }
       public function getBeneficiarios_inativos() {
        $this->load->model('Model_beneficiario');
        $nome = $this->input->post('palavra');
        echo $this->Model_beneficiario->selectBeneficiariosPorNome_inativos($nome);
    }
      public function getBeneficiariosCpf() {
        $this->load->model('Model_beneficiario');
        $documento = $this->input->post('documento');
        if($this->Model_beneficiario->getBeneficiariosCpf($documento) != null){
           var_dump($this->Model_beneficiario->getBeneficiariosCpf($documento)); 
        }else{
            
        }
    }
 public function getDependentes() {
        $this->load->model('Model_beneficiario'); 
        $nome = $this->input->post('palavra');
        echo $this->Model_beneficiario->selectDependentesPorNome($nome);
    }
    public function getOperadorasPlanos() {   //seleciona os planos não está utilizando
        $this->load->model('Model_operadoras');
        $id_operadora = $this->input->post('id_operadora');
        echo $this->Model_operadoras->selectPlanoOperadoras($id_operadora);
    }
    public function getOperadorasContrato(){
        $this->load->model('Model_contato');
        $id_operadora = $this->input->post('id_operadora');
        $cliente_id = $this->input->post('cliente_id');
        echo $this->Model_contato->selectContratosOperadoras($id_operadora, $cliente_id);
    }
  public function getOperadorasContratoNovo(){
        $this->load->model('Model_operadoras');
        $num_contrato = $this->input->post('num_contrato');
       // $cliente_id = $this->input->post('cliente_id');
        
        $dados = $this->Model_operadoras->selectContratosOperadorasNovo($num_contrato);
        if($dados != null){
         die(json_encode($dados));   
        }else{
        die(json_encode(0));       
        }
       // die(json_encode($this->Model_operadoras->selectContratosOperadorasNovo($num_contrato, $cliente_id)));

    }
    public function getBeneficiariosAbreSolicitacao() {
        $this->load->model('Model_beneficiario');
        $id = $this->input->post('palavra');
        $tipo_categoria = $this->input->post('categoria');  
        $ramo = $this->input->post('ramo');
        echo $this->Model_beneficiario->selectBeneficiariosPorNomeSolicitacao($id, $tipo_categoria, $ramo);
    }
    public function getBeneficiariosAbreSolicitacaoDependente(){
       $this->load->model('Model_beneficiario');
        $id= $this->input->post('palavra');
        $tipo_categoria = $this->input->post('categoria');
        $ramo = $this->input->post('ramo'); 
        echo $this->Model_beneficiario->selecionaDependentesAbreSolicitacao($id, $tipo_categoria, $ramo); 
    }

    public function getContratos() {
        $this->load->model('Model_contratos');
        $numero = $this->input->post('palavra');
        echo $this->Model_contratos->selectContratoPorNumero($numero);
    }
    /*
    public function addAndamentos(){
        $this->load->model('Model_atendimento', 'atendimento'); 
        $dados['id_beneficiario'] = $this->input->post('id_beneficiario');
        $dados['status'] = $this->input->post('status');
        $dados['prev_retorno'] = $this->input->post('prev_retorno');
        $dados['data_inicio'] = $this->input->post('dta_ini');
        $dados['obs'] = $this->input->post('obs');
    } */
    /*
    public function updateFaturamento(){
        $this->load->model('Model_faturamento');
        $dados = $this->input->post('id_faturamento');
       $mes_filtro = $this->input->post('mes_filtro');
       $ano_filtro = $this->input->post('ano_filtro');
       
       echo 'aa '.$dados;
       */
     //  $dados = $this->Model_faturamento->selectPlanosPorNome($mes_filtro, $ano_filtro);
      // echo json_encode($dados);
       
       // echo json_encode($query);
        //return $query->result();
    //}
      public function getEmailsClientes(){
        $this->load->model('Model_faturamento');
        $id_cliente = $this->input->post('id_cliente'); 
        echo $this->Model_faturamento->selecionaEmailsCliente($id_cliente);
       // var_dump($id_beneficiario);
    }
     public function getAnexosCliente(){
        $this->load->model('Model_faturamento');
       $id_fatura = $this->input->post('id_fatura'); 
       $mes = $this->input->post('mes'); 
       $ano = $this->input->post('ano'); 
       echo $this->Model_faturamento->selecionaAnexosCliente($id_fatura, $mes, $ano);
       // var_dump($ano);
    }
    public function getEmailsChamado(){
        $this->load->model('Model_atendimento');
        $id_beneficiario = $this->input->post('id_beneficiario'); 
        echo $this->Model_atendimento->selecionaEmailsBeneficiarios($id_beneficiario);
       // var_dump($id_beneficiario);
    }
    public function getEmailsChamadoBeneficiario(){
       $this->load->model('Model_atendimento');
        $id_beneficiario = $this->input->post('id_beneficiario'); 
        echo $this->Model_atendimento->selecionaEmailsBeneficiariosseparado($id_beneficiario); 
    }

    public function getAnexosChamado(){
      $this->load->model('Model_atendimento');
        $id_beneficiario = $this->input->post('id_do_chamado'); 
        echo $this->Model_atendimento->selecionaAnexosAtendimentos($id_beneficiario);  
    }
     public function getAnexoAssociado(){
     $this->load->model('Model_faturamento');
        $id_img = $this->input->post('id_img');
        $dados = $this->Model_faturamento->selectAnexoFatura($id_img);  
        die(json_encode($dados));
    }
    public function getAnexosFaturamento(){
      $this->load->model('Model_faturamento');
      $id_fatura = $this->input->post('id_da_fatura'); 
      echo $this->Model_faturamento->selecionaAnexosFaturamento($id_fatura);  
    }
    public function getAnexosFaturamentoSeparado(){
      $this->load->model('Model_faturamento');
      $id_fatura = $this->input->post('id_da_fatura'); 
      echo $this->Model_faturamento->selecionaAnexosFaturamentoSeparado($id_fatura);   
    }

    public function getContratosNovos(){
      $this->load->model('Model_faturamento');
        $mes = null;
        $ano = null;
        $status = 'CANCELADO';
        $result = $this->Model_faturamento->GetContratosNovos($mes, $ano, $status);  
        if($result != null){
            echo 'ok';
        }
    }
    public function baixar_fat() {
      $this->load->helper('download');
      $arquivo = $this->input->post("arquivo");
      if (file_exists($arquivo)) {
          echo 'tem';
         // $this->baixar($arquivo);

       }
     }
    public function baixar($arquivo) {
        $this->load->helper('download');
        //$url = $this->input->get("url");

        if (isset($arquivo) && file_exists($arquivo)) {
            switch (strtolower(substr(strrchr(basename($arquivo), "."), 1))) {
                case "pdf": $tipo = "application/pdf";
                    break;
                case "exe": $tipo = "application/octet-stream";
                    break;
                case "zip": $tipo = "application/zip";
                    break;
                case "doc": $tipo = "application/msword";
                    break;
                case "xls": $tipo = "application/vnd.ms-excel";
                    break;
                case "ppt": $tipo = "application/vnd.ms-powerpoint";
                    break;
                case "gif": $tipo = "image/gif";
                    break;
                case "png": $tipo = "image/png";
                    break;
                case "jpg": $tipo = "image/jpg";
                    break;
                case "mp3": $tipo = "audio/mpeg";
                    break;
                case "php": // deixar vazio por seurança
                case "htm": // deixar vazio por seurança
                case "html": // deixar vazio por seurança
            }
            header("Content-Type: " . $tipo); // informa o tipo do arquivo ao navegador
            //header("Content-Length: " . filesize($arquivo)); // informa o tamanho do arquivo ao navegador
            header("Content-Disposition: attachment; filename=" . basename($arquivo)); // informa ao navegador que é tipo anexo e faz abrir a janela de download, tambem informa o nome do arquivo
            readfile($arquivo); // lê o arquivo
            exit; // aborta pós-ações
        }
    }
     public function faturasEmailsEnviados(){
      $this->load->model('Model_faturamento');
        $id_fatura = $this->input->post('id_da_fatura'); 
        echo $this->Model_faturamento->selecionaEmailsEnviadoFatura($id_fatura);  
    }
    public function getDadosPlanosDependente(){
        $this->load->model('Model_dependentes');
        $id_do_dependente = $this->input->post('id_do_dependente');
        echo $this->Model_dependentes->selecionaDadosDoPlanoDependente($id_do_dependente);
    }
    public function getUsuariosBeneficiarios(){
     $this->load->model('Model_usuario');
        $id_do_cliente = $this->input->post('id_clientes');
        echo $this->Model_usuario->getUsuariosBeneficiarios($id_do_cliente);   
    }
        public function GetContratosPorNumero() {  
        $this->load->model('Model_contratos', 'contrato');
        $num = $this->input->post('num_contrato');
                
        $result = $this->contrato->GetContratosGerais($num);
        if ($result != null) {
            $dados = 'sim';
            die(json_encode($dados));
        } else {
            $dados = 'nao';
            die(json_encode($dados));
        }
    }
}
