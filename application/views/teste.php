<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Calcula a data de nascimento..:Reis</title> 
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
        <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
        <script type="text/javascript">
           
            $(function () {
                $("#calendario").datepicker();
            });
            /* Máscaras ER */
            function mascara(o, f) {
                v_obj = o
                v_fun = f
                setTimeout("execmascara()", 1)
            }
            function execmascara() {
                v_obj.value = v_fun(v_obj.value)
            }
            function mcep(v) {
                v = v.replace(/\D/g, "")                    //Remove tudo o que não é dígito
                v = v.replace(/^(\d{5})(\d)/, "$1-$2")         //Esse é tão fácil que não merece explicações
                return v
            }
            function mdata(v) {
                v = v.replace(/\D/g, "");                    //Remove tudo o que não é dígito
                v = v.replace(/(\d{2})(\d)/, "$1/$2");
                v = v.replace(/(\d{2})(\d)/, "$1/$2");

                v = v.replace(/(\d{2})(\d{2})$/, "$1$2");
                return v;
            }
            function mrg(v) {
                v = v.replace(/\D/g, '');
                v = v.replace(/^(\d{2})(\d)/g, "$1.$2");
                v = v.replace(/(\d{3})(\d)/g, "$1.$2");
                v = v.replace(/(\d{3})(\d)/g, "$1-$2");
                return v;
            }
            function mvalor(v) {
                v = v.replace(/\D/g, "");//Remove tudo o que não é dígito
                v = v.replace(/(\d)(\d{8})$/, "$1.$2");//coloca o ponto dos milhões
                v = v.replace(/(\d)(\d{5})$/, "$1.$2");//coloca o ponto dos milhares

                v = v.replace(/(\d)(\d{2})$/, "$1,$2");//coloca a virgula antes dos 2 últimos dígitos
                return v;
            }
            function id(el) {
                return document.getElementById(el);
            }
            function next(el, next)
            {
                if (el.value.length >= el.maxLength)
                    id(next).focus();
            }
        </script>
        
    </head>
    <body>

        <!--Data: <input type="text" name="data" id="calendario" onkeypress="mascara(this, mdata);" size="14" maxlength="10" value="" />-->

        <form method="post">
            Data de Nascimento: <input type="text" name="data" id="calendario" onkeypress="mascara(this, mdata);" size="14" maxlength="10" value="" />
            <button type="submit" name=""  />Calcular Idade</button><br />
    </form>
   <script type="text/javascript">
    $(document).ready(function () {
       document.getElementById('calendario').focus();  
    })
 </script>
    <?php
    if (isset($_POST['data'])) {

        $data_nasc = $_POST['data']; //date("10/05/2017"); //data fixa
        if ($data_nasc != null) {
            $dataP = explode('/', $data_nasc); //quebra a variavel data e separa em cada local que tem a /
            $dataNoFormatoParaOBranco = $dataP[2] . '-' . $dataP[1] . '-' . $dataP[0]; //substitui a / por -  para ficar no formato do banco
            $nascido = $dataNoFormatoParaOBranco . date(" 12:00:00"); //acrescenta a hora na data fixa

            $data_hora = date("Y-m-d H:i:s"); //data com hora no formato america ingles
            $data1 = new DateTime($data_hora); //instancia a data de hoje
            $data2 = new DateTime($nascido); //instancia a data de nascimento
            //
                                    //Calcula a diferença
            $intervalo = $data1->diff($data2);
            $anos = ($intervalo->y); //em anos
            $meses = ($intervalo->m); //em meses
            $dias_d = ($intervalo->d); //em dias
            $multiplicames = ($meses * 30); //mes em dias inteiro
            $transformandomesemdias = ($multiplicames + $dias_d); //soma os meses com os dias
            $horas = ($intervalo->h); //horas
            $min = ($intervalo->i); //min
            $seg = ($intervalo->s); //seg
            echo 'Anos: ' . $anos . '<br />';
            echo 'Meses: ' . $meses . '<br />';
            echo 'Dias: ' . $dias_d . '<br />';
            echo 'Horas: ' . $horas . '<br />';
            echo 'Minutos: ' . $min . '<br />';
            echo 'Segundos: ' . $seg . '<br />';
            echo '<hr>';
            echo 'Idade da Pessoa: ' . $anos . ', ano ' . $meses . ', meses e ' . $dias_d . ' dias. Diferença em horas: ' . $horas . ':' . $min . ':' . $seg;
        } else {
            echo 'Informe a data de nascimento';
        }
    }
    ?>
</body>
</html>