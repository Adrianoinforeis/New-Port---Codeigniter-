<?php  
$local = $info['url'];
?>
<script type="text/javascript">
    $(document).ready(function(){

    //Esconde preloader
    $(window).load(function(){
        $('#preloader').fadeOut(6000);//1500 é a duração do efeito (1.5 seg)
        window.location = '<?php echo $local;?>';
    });

});
</script>