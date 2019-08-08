<script>
    function removeMensagem() {
        setTimeout(function () {
            var msg = document.getElementById("rem");
            msg.parentNode.removeChild(msg);
            // window.location = '<?php // echo $local;                            ?>';
        }, 2000);
    }
    document.onreadystatechange = () => {
        if (document.readyState === 'complete') {
            // toda vez que a página carregar, vai limpar a mensagem (se houver) após 5 segundos
            removeMensagem();
        }
    };
</script>
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Deletar extends CI_Controller {

    public function deletar_usuario() {
        $this->load->model('Model_usuario', 'usuario');
        if ($this->input->get('id') != null):
            $this->usuario->DeletarUser($this->input->get('id'));
        endif;
        $url = $this->input->get('url');
        $msg = 'Usuário excluído com sucesso';
        $dados['info'] = array(
            'url' => $url,
            'msg' => $msg);
        //volta página
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/msg_success', $dados);
        $this->load->view('includes/menu');
        $this->load->view('sair_sistema_modal');
    }
    public function deletar_beneficiario(){
      $this->load->model('Model_beneficiario', 'beneficiario');
        if ($this->input->get('id') != null):
            $this->beneficiario->DeletarBeneficiario($this->input->get('id'));
            $this->beneficiario->DeletarBeneficiario_dependente($this->input->get('id'));
            $this->beneficiario->DeletarBeneficiario_plano($this->input->get('id'));
        endif;
         redirect('Intranet/cadastro_de_funcionarios');
         echo '<div class="alert alert-success rem" id="rem" style="margin-top: 1%; margin-left: 1%;">
                <strong>Atenção !</strong> Usuário excluído com sucesso!
                </div>';
        /*
        $url = $this->input->get('url');
        $msg = 'Beneficiário excluído com sucesso';
        $dados['info'] = array(
            'url' => $url,
            'msg' => $msg);
        //volta página
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('cadastro_de_funcionarios', $dados);
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal'); */
    }

    public function deletar_dependente() {
        $this->load->model('Model_dependentes', 'dependente');
        $this->load->model('Model_beneficiario', 'beneficiario');
        $id_beneficiario = $this->input->get('beneficiarios');
        if ($this->input->get('id') != null):
            $this->dependente->DeletarDependente($this->input->get('id'));
        endif;
        
        $dados_beneficiario = $this->beneficiario->getBeneficiario($id_beneficiario); //benefi..
        $dados_plano_ben = $this->beneficiario->getPlanosBeneficiario($id_beneficiario); //plano
        $dados_depend_ben = $this->beneficiario->getDependenteBeneficiario($id_beneficiario); //depend
        $dados_empresa = $this->beneficiario->getClientesEmpresa(); //cliente
        
        $dados['dados_geral'] = array(
            'dados_beneficiario' => $dados_beneficiario,
            'planos_sel_beneficiario' => $dados_plano_ben,
            'dados_dependentes' => $dados_depend_ben,
            'dados_empresa' => $dados_empresa);
        $this->load->view('includes/heade_adm');

        $url = $this->input->get('url');
        $msg = 'Operação efetuada com sucesso';
        $dados['info'] = array(
            'url' => $url,
            'msg' => $msg);
        $this->load->view('includes/msg_success', $dados);
        $this->load->view('includes/menu');
       // $this->load->view('editar_beneficiario', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('abre_chamado_modal');
     
    }

    public function deletar_categoria() {
        $this->load->model('Model_categorias', 'categoria');
        if ($this->input->get('id') != null):
            $this->categoria->DeletarCategoria($this->input->get('id'));
        endif;
        //$url['local'] = $this->input->get('url');
        $url = $this->input->get('url');
        $msg = 'Categoria excluída com sucesso';
        $dados['info'] = array(
            'url' => $url,
            'msg' => $msg);
        //volta página
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/msg_success', $dados);
        $this->load->view('includes/menu');
        $this->load->view('sair_sistema_modal');
    }

    public function deletar_produto() {
        $this->load->model('Model_produtos', 'produto');
        if ($this->input->get('id') != null):
            $this->produto->DeletarProdutos($this->input->get('id'));
        endif;
        //$url['local'] = $this->input->get('url');
        $url = $this->input->get('url');
        $msg = 'Produto excluída com sucesso';
        $dados['info'] = array(
            'url' => $url,
            'msg' => $msg);
        //volta página
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/msg_success', $dados);
        $this->load->view('includes/menu');
        $this->load->view('sair_sistema_modal');
    }
      public function deletar_anexo_cliente() {
       $this->load->model('Model_clientes', 'cliente');
       $nome_arq = $this->input->get('arq');

        if ($this->input->get('id') != null):
             $dir = 'anexos/';
        unlink ($dir.$nome_arq); //apaga o arquivo da pasta
        $this->cliente->DeletarAnexoCliente($this->input->get('id'));
        endif;
       // $url['local'] = $this->input->get('url');
        $url = $this->input->get('url');
        $msg = 'Anexo excluída com sucesso';
        $dados['info'] = array(
            'url' => $url,
            'msg' => $msg);
        //volta página
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/msg_success', $dados);
        $this->load->view('includes/menu');
        $this->load->view('sair_sistema_modal');
    }
      public function deletar_anexo_contrato() {
       $this->load->model('Model_contratos', 'contrato');
       $nome_arq = $this->input->get('arq');
        $id_contrato = $this->input->get('id_contrato');

        if ($this->input->get('id') != null):
             $dir = 'anexos/';
        unlink ($dir.$nome_arq); //apaga o arquivo da pasta
        $this->contrato->DeletarAnexoContrato($this->input->get('id'));
        endif;
       // $url['local'] = $this->input->get('url');
        $base = base_url();
        $url = $base.'Intranet/edit_contratos?id_contrato='.$id_contrato;
        $msg = 'Anexo excluída com sucesso';
        $dados['info'] = array(
            'url' => $url,
            'msg' => $msg);
        //volta página
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/msg_success', $dados);
        $this->load->view('includes/menu');
        $this->load->view('sair_sistema_modal');
    }
    public function desvincular_plano(){
        $this->load->model('Model_planos_escolhidos', 'planos');
         if ($this->input->get('id') != null):
            $this->planos->DeletarVinculo($this->input->get('id'));
        endif;
        
        
        $id_beneficiario = ($this->input->get('beneficiario'));
        
        
         $this->load->model('Model_beneficiario', 'beneficiario');
        // $this->load->model('Model_planos', 'plano');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $dados_beneficiario = $this->beneficiario->getBeneficiario($id_beneficiario); //benefi..
        $dados_plano_ben = $this->beneficiario->getPlanosBeneficiario($id_beneficiario); //plano
        $dados_depend_ben = $this->beneficiario->getDependenteBeneficiario($id_beneficiario); //depend
        $dados_empresa = $this->beneficiario->getClientesEmpresa(); //cliente
        #################################
        $this->load->model('Model_operadoras');
        $selectOperadora = $this->Model_operadoras->selectOperadorasPlanos();
        #################################

        $dados['dados_geral'] = array(
            'dados_beneficiario' => $dados_beneficiario,
            'planos_sel_beneficiario' => $dados_plano_ben,
            'dados_dependentes' => $dados_depend_ben,
            'dados_empresa' => $dados_empresa,
            'abre_solicitacao' => $abre_solicitacao,
            'selectOperadora' => $selectOperadora);

        
         $url = $this->input->get('url');
        $msg = 'Produto excluída com sucesso';
        $dados['info'] = array(
            'url' => $url,
            'msg' => $msg);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/msg_success', $dados);
        $this->load->view('includes/menu');
       // $this->load->view('editar_beneficiario', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('abre_chamado_modal');
    }
        public function faturamento() {
        $this->load->model('Model_faturamento', 'faturamento');
        if ($this->input->get('id') != null):
           $this->faturamento->DeletarFaturamento($this->input->get('id'));
           $this->faturamento->DeletarFaturamentoSeparado($this->input->get('id'));
        endif;
        $mes = $this->input->get('mes');
        $ano = $this->input->get('ano'); 
        $id_fatura = $this->input->get('idfatura');
        $id_do_cliente = $this->input->get('idcliente');
        $filtro_tabela = $this->input->get('filtro_tabela');
        
        $url = base_url()."Cadastrar/filtro_faturamento?mes_filtro=$mes&ano_filtro=$ano&id_do_cliente=$id_do_cliente&id_faturamento=$id_fatura&filtro_tabela=$filtro_tabela";
        $msg = 'Anexo excluído com sucesso';
        $dados['info'] = array(
            'url' => $url,
            'msg' => $msg);
        //volta página
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/msg_success', $dados);
        $this->load->view('includes/menu');
        $this->load->view('sair_sistema_modal');

    }
        public function faturamentoRelatorio() {
        $this->load->model('Model_faturamento', 'faturamento');
        if ($this->input->get('id') != null):
           $this->faturamento->DeletarFaturamento($this->input->get('id'));
        endif;
        $mes = $this->input->get('mes');
        $ano = $this->input->get('ano'); 
        $id_fatura = $this->input->get('idfatura');
        $id_do_cliente = $this->input->get('idcliente');
        $filtro_tabela = $this->input->get('filtro_tabela');
        
        $url = base_url()."Cadastrar/filtro_faturamentoRelatorio?mes_filtro=$mes&ano_filtro=$ano&id_do_cliente=$id_do_cliente&id_faturamento=$id_fatura&filtro_tabela=$filtro_tabela";
        $msg = 'Anexo excluído com sucesso';
        $dados['info'] = array(
            'url' => $url,
            'msg' => $msg);
        //volta página
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/msg_success', $dados);
        $this->load->view('includes/menu');
        $this->load->view('sair_sistema_modal');

    }
}
