<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Model_faturamento extends CI_Model {

    //insert
    public function addFaturamento($dados = null) {
        if ($dados != NULL):
            $this->db->insert('tb_faturamento', $dados);
        endif;
    }

    public function addEmailsFaturamento($dados) {
        $this->db->insert('tb_emails_faturamentos', $dados);
    }

    public function addArquivos($dados = null) {
        if ($dados != NULL):
            $this->db->insert('tb_anexos', $dados);
            return $this->db->insert_id();
        endif;
    }

    public function tb_anexos_fatura($dados) {
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $this->db->insert('tb_anexos_fatura', $dados);
        $this->db->limit(25000);
    }

    //buscando anexo via ajax
    public function pegaAnexos($id_fatura = null) {
        return $this->db->select('*')
                        ->where('id_faturamento', $id_fatura)
                        ->get('tb_anexos');
    }

    public function selecionaAnexosFaturamento($id_fatura = null) {
        $anexos = $this->pegaAnexos($id_fatura);
        $total_tr = $anexos->num_rows();
        $tr = "({$total_tr})";
        // $option = "<li><a href='#' class='list-group-item list-group-item-action active'>Foi encontrado: ({$total_planos})</a></li>";
        foreach ($anexos->result() as $anexo) {
            $nom = explode("_", $anexo->descricao);
            //<a href="#" class="list-group-item list-group-item-action active">
            $base = base_url();
            $dir = 'anexos/';
            $tr .= "<tr>
                         <td>
                    <button id='download_anexo_$anexo->id_anexo' type='button' onclick='download_baixar($anexo->id_anexo)' value='anexos/$anexo->nome_arquivo' class='btn btn-info btn-xs btn-mini' title='Baixar'>
                    <input type='hidden' id='desc_$anexo->id_anexo' value='$anexo->descricao'>
                    <i class='fa fa-download'></i> $nom[0] </button>
                    <a  style='float: right'  href='$base"."$dir"."$anexo->nome_arquivo' target='_blank' class='btn btn-default btn-xs btn-mini' title='Visualizar' onclick='ver_arquivo($anexo->id_anexo)'>  <i class='fa fa-search fa-1x'></i>  </a>
                    <button onclick='deletar($anexo->id_anexo, $anexo->mes, $anexo->ano, $anexo->id_faturamento, $anexo->id_do_cliente)' style='margin-left: 8%; float: right' type='button' class='btn btn-danger btn-xs btn-mini' title='Excluir'><i class='fa fa-times'></i></button></td>
                    </tr>";
        }
        return $tr;
    }

    public function selectAnexoFatura($img) {
        $this->db->select('tb_anexos.id_anexo, tb_anexos.nome_arquivo');
        $this->db->where('id_anexo', $img);
        $res = $this->db->get('tb_anexos');
        return $res->result();
    }

    //buscando anexo via ajax
    public function pegaAnexosSeparado($id_fatura = null) {
        return $this->db->select('tb_anexos.*, tb_anexos_fatura.*')
                        ->join('tb_anexos_fatura', 'tb_anexos.id_anexo = tb_anexos_fatura.id_do_anexo')
                        ->where('tb_anexos_fatura.id_da_fatura', $id_fatura)
                        ->get('tb_anexos');
    }

    public function selecionaAnexosFaturamentoSeparado($id_fatura = null) {
        $anexos = $this->pegaAnexosSeparado($id_fatura);
        $total_tr = $anexos->num_rows();
        $tr = "({$total_tr})";
        // $option = "<li><a href='#' class='list-group-item list-group-item-action active'>Foi encontrado: ({$total_planos})</a></li>";
        foreach ($anexos->result() as $anexo) {
            $nom = explode("_", $anexo->descricao);
            //<a href="#" class="list-group-item list-group-item-action active">
            $tr .= "<tr>
                         <td>
                    <button id='download_anexo_$anexo->id_anexo' type='button' onclick='download_baixar($anexo->id_anexo)' value='anexos/$anexo->nome_arquivo' class='btn btn-info btn-xs btn-mini' title='Baixar'>
                    <input type='hidden' id='desc_$anexo->id_anexo' value='$anexo->descricao'>
                    <i class='fa fa-download'></i> $nom[0] </button>
                    <button onclick='deletar($anexo->id_anexo, $anexo->mes, $anexo->ano, $anexo->id_faturamento, $anexo->id_do_cliente)' style='margin-left: 8%; float: right' type='button' class='btn btn-danger btn-xs btn-mini' title='Excluir'><i class='fa fa-times'></i></button></td>
                    </tr>";
        }
        return $tr;
    }

    public function pegaEmailsEnviados($id_fatura = null) {
        return $this->db->select('*')
                        ->where('id_fatura', $id_fatura)
                        ->get('tb_emails_faturamentos');
    }

    public function selecionaEmailsEnviadoFatura($id_fatura = null) {
        $anexos = $this->pegaEmailsEnviados($id_fatura);
        $total_tr = $anexos->num_rows();
        $tr = "({$total_tr})";
        // $option = "<li><a href='#' class='list-group-item list-group-item-action active'>Foi encontrado: ({$total_planos})</a></li>";
        foreach ($anexos->result() as $anexo) {
            //<a href="#" class="list-group-item list-group-item-action active">
            $tr .= "<tr>
                         <td> $anexo->email</td>
                      </tr>";
        }
        return $tr;
    }

    public function getFaturamento() {
        $this->db->select('tb_faturamento.*, tb_clientes.nome_cliente, tb_operadoras.nome_op,
                        tb_contratos.cont_vig_fin,tb_contratos.cont_id, tb_contratos.cont_vige_inic');
        $this->db->join('tb_clientes', 'tb_faturamento.cont_cliente = tb_clientes.id_clientes');
        $this->db->join('tb_operadoras', 'tb_faturamento.cont_operadora = tb_operadoras.id_operadoras');
        $this->db->join('tb_contratos', 'tb_faturamento.cont_id = tb_contratos.cont_id');
        $this->db->order_by('fat_id DESC');
        $query = $this->db->get('tb_faturamento');
        return $query->result();
    }

    public function getMaiorDataContrato() {
        $this->db->select_max('cont_vig_fin');
        $query = $this->db->get('tb_contratos');
        return $query->result();
    }

    public function listContratos($data, $parcelas) {
        $this->db->select('*');
        $this->db->where('quant_parcelas > ', $parcelas);
        //$this->db->where('cont_vig_fin9 <=  $data OR cont_vige_inic >= '. $data.'');
        $this->db->where('cont_vig_fin >= ', $data);
        //$this->db->where('cont_vige_inic <= ', $data);  //or_where
        $query = $this->db->get('tb_contratos');
        return $query->result();
    }

    public function GetContratos($cancelado) {
        $this->db->where('status !=', $cancelado);
        $query = $this->db->get('tb_contratos');
        return $query->result();
    }

    public function GetContratosNovos($mes, $ano, $cancelado) {
        $this->db->where('mes_fat', $mes);
        $this->db->where('ano_fat', $ano);
        $this->db->where('status !=', $cancelado);
        $query = $this->db->get('tb_contratos');
        return $query->result();
    }

    public function selectContratosGerais($cancelado) {
        $this->db->where('status !=', $cancelado);
        $query = $this->db->get('tb_contratos');
        return $query->result();
    }

    public function GetContratosInverso($mes, $ano, $cancelado) {
        $this->db->where('mes_fat !=', $mes);
        $this->db->where('ano_fat !=', $ano);
        $this->db->where('status !=', $cancelado);
        $query = $this->db->get('tb_contratos');
        return $query->result();
    }

    public function filtroPorDataAA($mes, $ano) {
        return $this->db
                        ->select('tb_faturamento.*, tb_clientes.nome_cliente,  tb_clientes.id_clientes, tb_operadoras.nome_op,
                        tb_contratos.cont_vig_fin,tb_contratos.cont_id, tb_contratos.cont_vige_inic, tb_contratos.cont_ramo')
                        ->join('tb_clientes', 'tb_faturamento.cont_cliente = tb_clientes.id_clientes')
                        ->join('tb_operadoras', 'tb_faturamento.cont_operadora = tb_operadoras.id_operadoras')
                        ->join('tb_contratos', 'tb_faturamento.cont_id = tb_contratos.cont_id')
                        ->order_by('fat_id DESC')
                        ->where('mes_gerado', $mes)
                        ->where('ano_gerado', $ano)
                        ->get('tb_faturamento');
        // echo json_encode($query);
        //return $query->result();
    }

    public function selectPlanosPorNome($mes, $ano) {
        $planos = $this->filtroPorDataAA($mes, $ano);
        // $planos = $planos->num_rows();


        foreach ($planos->result() as $plano) {
            //<a href="#" class="list-group-item list-group-item-action active">
            $option = "<td>" . $plano->nome_op . "</td>";
        }
        return $option;
    }

    //apenas contar as quantidades de contratos
    public function listContratosContador($data = null) {
        return $this->db
                        ->where('cont_vige_inic >= ', $data)
                        ->get('tb_contratos');
    }

    public function listContratosCont($data = null) {
        $contratos = $this->listContratosContador($data);
        $total_contratos = $contratos->num_rows();
        return $total_contratos;
    }

//fim contratos quantidade

    public function listFaturamentosGerados($mes, $ano) {
        $this->db->select('*');
        $this->db->where('mes_gerado', $mes);
        $this->db->where('ano_gerado', $ano);
        $query = $this->db->get('tb_faturamento');
        return $query->result();
    }

    public function listFaturamentosGeradosContratos($mes, $ano) {
        $this->db->select('*');
        // $this->db->where('cont_numero', $numContrato);
        $this->db->where('mes_gerado', $mes);
        $this->db->where('ano_gerado', $ano);
        $query = $this->db->get('tb_faturamento');
        return $query->result();
    }

    public function verificaGeradoFatura($ids) {
        $this->db->select('*');
        $this->db->where('cont_id', $ids);
        $query = $this->db->get('tb_faturamento');
        return $query->result();
    }

    public function filtroPorData($mes, $ano) {
        $this->db->select('tb_faturamento.*, tb_clientes.nome_cliente, tb_clientes.razao, tb_clientes.id_clientes, tb_operadoras.nome_op,
                        tb_contratos.cont_vig_fin,tb_contratos.cont_id, tb_contratos.cont_vige_inic, tb_contratos.cont_ramo');
        $this->db->join('tb_clientes', 'tb_faturamento.cont_cliente = tb_clientes.id_clientes');
        $this->db->join('tb_operadoras', 'tb_faturamento.cont_operadora = tb_operadoras.id_operadoras');
        $this->db->join('tb_contratos', 'tb_faturamento.cont_id = tb_contratos.cont_id');
        $this->db->order_by('fat_id DESC');
        $this->db->where('mes_gerado', $mes);
        $this->db->where('ano_gerado', $ano);
        $query = $this->db->get('tb_faturamento');
        return $query->result();
    }

    public function filtroPorDataRelatorio($mes, $ano, $like_campo) {
        $this->db->select('tb_faturamento.*, tb_clientes.nome_cliente, tb_clientes.razao, tb_clientes.id_clientes, tb_operadoras.nome_op,
                        tb_contratos.cont_vig_fin,tb_contratos.cont_id, tb_contratos.cont_vige_inic, tb_contratos.cont_ramo');
        $this->db->join('tb_clientes', 'tb_faturamento.cont_cliente = tb_clientes.id_clientes');
        $this->db->join('tb_operadoras', 'tb_faturamento.cont_operadora = tb_operadoras.id_operadoras');
        $this->db->join('tb_contratos', 'tb_faturamento.cont_id = tb_contratos.cont_id');
        $this->db->order_by('fat_id DESC');
        $this->db->where('mes_gerado', $mes);
        $this->db->where('ano_gerado', $ano);
        $this->db->like('tb_clientes.nome_cliente', $like_campo);
        $query = $this->db->get('tb_faturamento');
        return $query->result();
    }

    public function filtroPorDataRelatorioContrato($mes, $ano, $like_campo) {
        $this->db->select('tb_faturamento.*, tb_clientes.nome_cliente, tb_clientes.razao, tb_clientes.id_clientes, tb_operadoras.nome_op,
                        tb_contratos.cont_numero, tb_contratos.cont_vig_fin,tb_contratos.cont_id, tb_contratos.cont_vige_inic, tb_contratos.cont_ramo');
        $this->db->join('tb_clientes', 'tb_faturamento.cont_cliente = tb_clientes.id_clientes');
        $this->db->join('tb_operadoras', 'tb_faturamento.cont_operadora = tb_operadoras.id_operadoras');
        $this->db->join('tb_contratos', 'tb_faturamento.cont_id = tb_contratos.cont_id');
        $this->db->order_by('fat_id DESC');
        $this->db->where('mes_gerado', $mes);
        $this->db->where('ano_gerado', $ano);
        $this->db->like('tb_contratos.cont_numero', $like_campo);
        $query = $this->db->get('tb_faturamento');
        return $query->result();
    }

    public function filtroPorDataRelatorioRamo($mes, $ano, $like_campo) {
        $this->db->select('tb_faturamento.*, tb_clientes.nome_cliente, tb_clientes.razao, tb_clientes.id_clientes, tb_operadoras.nome_op,
                        tb_contratos.cont_numero, tb_contratos.cont_vig_fin,tb_contratos.cont_id, tb_contratos.cont_vige_inic, tb_contratos.cont_ramo');
        $this->db->join('tb_clientes', 'tb_faturamento.cont_cliente = tb_clientes.id_clientes');
        $this->db->join('tb_operadoras', 'tb_faturamento.cont_operadora = tb_operadoras.id_operadoras');
        $this->db->join('tb_contratos', 'tb_faturamento.cont_id = tb_contratos.cont_id');
        $this->db->order_by('fat_id DESC');
        $this->db->where('mes_gerado', $mes);
        $this->db->where('ano_gerado', $ano);
        $this->db->like('tb_contratos.cont_ramo', $like_campo);
        $query = $this->db->get('tb_faturamento');
        return $query->result();
    }

    public function filtroPorDataRelatorioDia($mes, $ano, $like_campo) {
        $this->db->select('tb_faturamento.*, tb_clientes.nome_cliente, tb_clientes.razao, tb_clientes.id_clientes, tb_operadoras.nome_op,
                        tb_contratos.cont_numero, tb_contratos.cont_vig_fin,tb_contratos.cont_id, tb_contratos.cont_vige_inic, tb_contratos.cont_ramo');
        $this->db->join('tb_clientes', 'tb_faturamento.cont_cliente = tb_clientes.id_clientes');
        $this->db->join('tb_operadoras', 'tb_faturamento.cont_operadora = tb_operadoras.id_operadoras');
        $this->db->join('tb_contratos', 'tb_faturamento.cont_id = tb_contratos.cont_id');
        $this->db->order_by('fat_id DESC');
        $this->db->where('mes_gerado', $mes);
        $this->db->where('ano_gerado', $ano);
        $this->db->like('tb_faturamento.cont_dta_vcto', $like_campo);
        $query = $this->db->get('tb_faturamento');
        return $query->result();
    }

    public function pegaEmails($id_cliente = null) {
        return $this->db->select('tb_clientes.id_clientes, tb_clientes.nome_cliente, tb_contatos.id_cliente,
                                tb_contatos.email')
                        ->join('tb_clientes', 'tb_contatos.id_cliente = tb_clientes.id_clientes')
                        ->where('tb_clientes.id_clientes', $id_cliente)
                        ->get('tb_contatos');
    }

    public function pegaultimoid() {
        $this->db->select_max('id_anexo');
        $query = $this->db->get('tb_anexos');
        return $query->result();
    }

    public function detalhesDasFaturasEnviarEmail($id, $mes, $ano) {
        $this->db->select('tb_clientes.*, tb_anexos.id_anexo, tb_anexos.descricao, tb_anexos.id_faturamento,
                        tb_anexos.nome_arquivo, tb_anexos.mes, tb_anexos.ano, tb_faturamento.cont_cliente, tb_faturamento.fat_id');
        $this->db->join('tb_faturamento', 'tb_clientes.id_clientes = tb_faturamento.cont_cliente');
        $this->db->join('tb_anexos', 'tb_faturamento.fat_id = tb_anexos.id_faturamento');
        $this->db->where('tb_anexos.mes', $mes);
        $this->db->where('tb_anexos.ano', $ano);
        $this->db->where('tb_anexos.id_do_cliente', $id);
        $this->db->where('tb_clientes.id_clientes', $id);
        $query = $this->db->get('tb_clientes');
        return $query->result();
    }

    public function selecionaEmailsCliente($id_cliente = null) {
        $planos = $this->pegaEmails($id_cliente);
        //var_dump($planos);
        $total_planos = $planos->num_rows();
        $option = '';
        // $option = "<li><a href='#' class='list-group-item list-group-item-action active'>Foi encontrado: ({$total_planos})</a></li>";
        $num = null;
        foreach ($planos->result() as $plano) {
            $num .= $num++;
            if ($total_planos == 1) {
                $option .= "
                  <tr>
                  <td>
                  <div class='col-md-12 form-group'>
                   <input class='form-control' type='hidden' size='200' style='width: 400px;' value='$total_planos' name='totalPlanos'>
                  <input class='form-control' type='text' size='200' style='width: 400px;' value='$plano->email' name='emailCliente0'>
                 </div>
                 </td>
                 </tr>";
            } else if ($total_planos == 2) {
                $option .= "
                  <tr>
                  <td>
                  <div class='col-md-12 form-group'>
                  <input class='form-control' type='hidden' size='200' style='width: 400px;' value='$total_planos' name='totalPlanos'>
                  <input class='form-control' type='text' size='200' style='width: 400px;' value='$plano->email' name='emailCliente" . $num . "'>
                 </div>
                 </td>
                 </tr>";
            } else if ($total_planos == 3) {
                $option .= "
                  <tr>
                  <td>
                  <div class='col-md-12 form-group'>
                   <input class='form-control' type='hidden' size='200' style='width: 400px;' value='$total_planos' name='totalPlanos'>
                  <input class='form-control' type='text' size='200' style='width: 400px;' value='$plano->email' name='emailCliente" . $num . "'>
                 </div>
                 </td>
                 </tr>";
            } else if ($total_planos == 4) {
                $option .= "
                  <tr>
                  <td>
                  <div class='col-md-12 form-group'>
                   <input class='form-control' type='hidden' size='200' style='width: 400px;' value='$total_planos' name='totalPlanos'>
                  <input class='form-control' type='text' size='200' style='width: 400px;' value='$plano->email' name='emailCliente" . $num . "'>
                 </div>
                 </td>
                 </tr>";
            } else if ($total_planos == 5) {
                $option .= "
                  <tr>
                  <td>
                  <div class='col-md-12 form-group'>
                   <input class='form-control' type='hidden' size='200' style='width: 400px;' value='$total_planos' name='totalPlanos'>
                  <input class='form-control' type='text' size='200' style='width: 400px;' value='$plano->email' name='emailCliente" . $num . "'>
                 </div>
                 </td>
                 </tr>";
            }
        }
        return $option;
    }

    public function pegaAnexosCliente($id_fatura = null, $mes = null, $ano = null) {
        return $this->db->select('*')
                        // ->join('tb_clientes', 'tb_contatos.id_cliente = tb_clientes.id_clientes')
                        ->where('id_faturamento', $id_fatura)
                        ->where('mes', $mes)
                        ->where('ano', $ano)
                        ->get('tb_anexos');
    }

    public function selecionaAnexosCliente($id_fatura = null, $mes = null, $ano = null) {
        $planos = $this->pegaAnexosCliente($id_fatura, $mes, $ano);
        //var_dump($planos);
        $total_planos = $planos->num_rows();
        $option = '';
        // $option = "<li><a href='#' class='list-group-item list-group-item-action active'>Foi encontrado: ({$total_planos})</a></li>";
        foreach ($planos->result() as $plano) {
            $nom = explode("_", $plano->descricao);
            //$extensao = strtolower(substr($plano->nome_arquivo, -4));
            $option .= "
                  <tr>
                  <td><input type='checkbox' size='20' name='$plano->id_anexo' value='$plano->id_anexo'> </td>
                  <td> $nom[0]</td>
                 </tr>";
        }
        return $option;
    }

    public function updateFaturamento($dados, $id) {
        if (($dados && $id) != null):
            $this->db->update('tb_faturamento', $dados, array('fat_id' => $id));
        endif;
    }

    public function UpdateContratosFat($dados, $id) {
        $this->db->update('tb_contratos', $dados, array('cont_id' => $id));
    }

    public function envio_da_fatura($dados, $id) {
        $this->db->update('tb_faturamento', $dados, array('fat_id' => $id));
    }

    public function diminuiParcelasContratos($dados, $id) {
        if (($dados && $id) != null):
            $this->db->update('tb_contratos', $dados, array('cont_id' => $id));
        endif;
    }

    public function DeletarFaturamento($id) {
        if (($id) != null):
            $this->db->delete('tb_anexos', array('id_anexo' => $id));
        endif;
    }

    public function DeletarFaturamentoSeparado($id) {
        if (($id) != null):
            $this->db->delete('tb_anexos_fatura', array('id_do_anexo' => $id));
        endif;
    }

    public function u() {
        $this->db->select('*');
        $query = $this->db->get('tb_anexos');
        return $query->result();
    }

}
