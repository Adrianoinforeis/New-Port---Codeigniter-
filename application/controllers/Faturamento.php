<?php
date_default_timezone_set('America/Sao_Paulo');
defined('BASEPATH') OR exit('No direct script access allowed');

class Faturamento extends CI_Controller {


public function cadastrar_faturamento() {    
$this->load->model('Model_faturamento', 'faturamento');
        $status = 'CANCELADO';
        $mes = '01'; //date('m') + 1;
        $ano =  '2019'; //date('Y');
        $dados_contratos = $this->faturamento->GetContratos($status);
         if($dados_contratos != null){
          foreach ($dados_contratos as $result) {
                $id = $result->cont_id;
                $dados['cont_id'] = $result->cont_id;
                $dados['cont_operadora'] = $result->cont_operadora;
               // $dados['cont_operadora'] = $result->cont_operadora;
                $dados['cont_cliente'] = $result->cont_cliente;
                $dados['cont_numero'] = $result->cont_numero;
                $dados['cont_dta_vcto'] = $result->cont_dta_vcto;
                $dados['mes_gerado'] = $mes;
                $dados['ano_gerado'] = $ano;
                $this->faturamento->addFaturamento($dados); //insere os dados no bd 
                $upconts['mes_fat'] = $mes;
                $upconts['ano_fat'] = $ano;
                $this->faturamento->UpdateContratosFat($upconts, $id); 
                   
        }
}
//        
//        if($dados_contratos == null){
//        $dados_contratosInverso1 = $this->faturamento->GetContratosInverso($mes, $ano, $status); 
//        if($dados_contratosInverso1 != null){
//          foreach ($dados_contratosInverso1 as $result) {
//          $dados['cont_id'] = $result->cont_id;
//                $dados['cont_operadora'] = $result->cont_operadora;
//                $dados['cont_operadora'] = $result->cont_operadora;
//                $dados['cont_cliente'] = $result->cont_cliente;
//                $dados['cont_numero'] = $result->cont_numero;
//                $dados['cont_dta_vcto'] = $result->cont_dta_vcto;
//                $dados['mes_gerado'] = $fat_mes;
//                $dados['ano_gerado'] = $ano;
//               $this->faturamento->addFaturamento($dados); //insere os dados no bd 
//               $upconts['mes_fat'] = $mes;
//               $upconts['ano_fat'] = $ano;
//               $this->faturamento->UpdateContratosFat($upconts, $dados_contratosInverso1[0]->cont_id); 
//        }
//        $msg = 'Novo faturamento adicionado';
//          $dadosmsg['info'] = array(
//          'url' => $url,
//          'msg' => $msg);
//          $this->load->view('includes/msg_success', $dadosmsg);
//        }else{
//            
//         
//        $daddos_faturamento1 = $this->faturamento->listFaturamentosGeradosContratos($mes, $ano);
//        
//        if($daddos_faturamento1 != null){
//           $msg = 'Esse faturamento já foi gerado';
//          $dadosmsg['info'] = array(
//          'url' => $url,
//          'msg' => $msg);
//          $this->load->view('includes/msg_error', $dadosmsg);
//        }else{
//        $todos_contratos = $this->faturamento->selectContratosGerais($status);
//         foreach ($todos_contratos as $result) {
//            $cont_id = $result->cont_id;
//                $dados1['cont_id'] = $result->cont_id;
//                $dados1['cont_operadora'] = $result->cont_operadora;
//                $dados1['cont_operadora'] = $result->cont_operadora;
//                $dados1['cont_cliente'] = $result->cont_cliente;
//                $dados1['cont_numero'] = $result->cont_numero;
//                $dados1['cont_dta_vcto'] = $result->cont_dta_vcto;
//                $dados1['mes_gerado'] = $fat_mes;
//                $dados1['ano_gerado'] = $ano;
//               $this->faturamento->addFaturamento($dados1); //insere os dados no bd 
//               $upconts1['mes_fat'] = $mes;
//               $upconts1['ano_fat'] = $ano;
//               $this->faturamento->UpdateContratosFat($upconts1, $cont_id); 
//        }    
//        $msg = 'Novo faturamento adicionado';
//          $dadosmsg['info'] = array(
//          'url' => $url,
//          'msg' => $msg);
//          $this->load->view('includes/msg_success', $dadosmsg);
//          }
//        }
//        }else{
//        $dados_contratosInverso = $this->faturamento->GetContratosInverso($mes, $ano, $status);    
//        //já foi gerado as faturas mas tem contratos novos, ai gera novamente
//        if($dados_contratosInverso != null){
//        foreach ($dados_contratosInverso as $result3) {
//                $dados3['cont_id'] = $result3->cont_id;
//                $dados3['cont_operadora'] = $result3->cont_operadora;
//                $dados3['cont_operadora'] = $result3->cont_operadora;
//                $dados3['cont_cliente'] = $result3->cont_cliente;
//                $dados3['cont_numero'] = $result3->cont_numero;
//                $dados3['cont_dta_vcto'] = $result3->cont_dta_vcto;
//                $dados3['mes_gerado'] = $fat_mes;
//                $dados3['ano_gerado'] = $ano;
//               $this->faturamento->addFaturamento($dados3); //insere os dados no bd 
//               $upconts['mes_fat'] = $mes;
//               $upconts['ano_fat'] = $ano;
//               $this->faturamento->UpdateContratosFat($upconts, $dados_contratosInverso[0]->cont_id); 
//        }
//        $msg = 'Novo faturamento adicionado';
//          $dadosmsg['info'] = array(
//          'url' => $url,
//          'msg' => $msg);
//          $this->load->view('includes/msg_success', $dadosmsg);
//        }else{
//        $msg = 'Não possui novos contratos';
//          $dadosmsg['info'] = array(
//          'url' => $url,
//          'msg' => $msg);
//          $this->load->view('includes/msg_error', $dadosmsg);
//        }
//        }
//            if ($daddos_faturamento == null) {
//              //  $parcela = ($result->quant_parcelas - 1);
//               // $dados_parcela['quant_parcelas'] = $parcela;
//               // $this->faturamento->diminuiParcelasContratos($dados_parcela, $result->cont_id);
//                $dados['cont_id'] = $result->cont_id;
//                $dados['cont_operadora'] = $result->cont_operadora;
//                $dados['cont_operadora'] = $result->cont_operadora;
//                $dados['cont_cliente'] = $result->cont_cliente;
//                $dados['cont_numero'] = $result->cont_numero;
//                $dados['cont_dta_vcto'] = $result->cont_dta_vcto;
//                $dados['mes_gerado'] = $fat_mes;
//                $dados['ano_gerado'] = $ano;
//               // $this->faturamento->addFaturamento($dados); //insere os dados no bd   
//            }else{
//                echo 'Sem contratos novos para gerar fatura';
//            }
        //}
        //quantidade de contratos

        //$resultado = $this->faturamento->listContratos($data, $parcelas); //lista os dados conforme ao filtro
       // $total = $this->faturamento->listContratosCont($data); //quantidade de contratos


        /*
          // print_r($daddos_faturamento);
          if ($daddos_faturamento != null) { //verifica se existe regitro
          foreach ($resultado as $result) {
          $id_cont_contratos = $result->cont_id; //selecionar fatura para verifica se tem esses ids
          $ids_encontrados = $this->faturamento->verificaGeradoFatura($id_cont_contratos);
          if ($ids_encontrados != null) {
          $fatura = 0;
          //ja foi faturado
          } else { //verifica o ramo e a quantidade de parcelas
          //não faturado
          // echo $result->cont_id;
          $parcela = ($result->quant_parcelas - 1);
          $dados_parcela['quant_parcelas'] = $parcela;
          $this->faturamento->diminuiParcelasContratos($dados_parcela, $result->cont_id);
          $dados['cont_id'] = $result->cont_id;
          $dados['cont_operadora'] = $result->cont_operadora;
          $dados['cont_operadora'] = $result->cont_operadora;
          $dados['cont_cliente'] = $result->cont_cliente;
          $dados['cont_numero'] = $result->cont_numero;
          $dados['cont_dta_vcto'] = $result->cont_dta_vcto;
          $dados['mes_gerado'] = $fat_mes;
          $dados['ano_gerado'] = $ano;
          $this->faturamento->addFaturamento($dados); //insere os dados no bd
          $fatura = 1;
          }
          }
          if ($fatura == 1) {
          $msg = 'Foi faturado novo(s) contrato(s)';
          $dadosmsg['info'] = array(
          'url' => $url,
          'msg' => $msg);
          $this->load->view('includes/msg_success', $dadosmsg);
          } else {
          $msg = 'Não possui novo contrato';
          $dadosmsg['info'] = array(
          'url' => $url,
          'msg' => $msg);
          $this->load->view('includes/msg_error', $dadosmsg);
          }
          } else {
          if ($resultado != null) {  // && ($resultado[0]->cont_ramo == 'VIDA') &&  ($resultado[0]->quant_parcelas > 0)) {
          foreach ($resultado as $result) {
          $parcela = ($result->quant_parcelas - 1);
          $dados_parcela['quant_parcelas'] = $parcela;
          $this->faturamento->diminuiParcelasContratos($dados_parcela, $result->cont_id);
          $dados['cont_id'] = $result->cont_id;
          $dados['cont_operadora'] = $result->cont_operadora;
          $dados['cont_operadora'] = $result->cont_operadora;
          $dados['cont_cliente'] = $result->cont_cliente;
          $dados['cont_numero'] = $result->cont_numero;
          $dados['cont_dta_vcto'] = $result->cont_dta_vcto;
          $dados['mes_gerado'] = $fat_mes;
          $dados['ano_gerado'] = $ano;
          $this->faturamento->addFaturamento($dados); //insere os dados no bd
          }
          }
*/
          
        
    } 

}
