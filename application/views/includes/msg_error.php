<?php  
$msg = $info['msg'];
$local = $info['url'];
?>
<div class="alert alert-danger rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
    <strong>Informaçao !</strong> <?php echo $msg;?>.
</div>

<script>
    function removeMensagem() {
        setTimeout(function () {
            var msg = document.getElementById("rem");
            msg.parentNode.removeChild(msg);
            window.location = '<?php echo $local;?>';
        }, 2000);
    }
    document.onreadystatechange = () => {
        if (document.readyState === 'complete') {
            // toda vez que a página carregar, vai limpar a mensagem (se houver) após 5 segundos
            removeMensagem();
        }
    };
</script>