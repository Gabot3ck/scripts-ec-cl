<?php
include("fl8tm4ec/conf.php");
require_once('fl8tm4ec/includes/tienda/cart/inc/functions.inc.php');

// die("HIOLA");

if(isset($_GET["op"])){
    $op=$_GET["op"];
}else{
    $op="home";
    //die('<script> location.href="trabajando"; </script>');
}
	include("minifier.php");
    include("includes/cookies.php");

if($op == 'envio-y-pago'){
    $ca = (isset($_GET['ca'])) ? mysqli_real_escape_string($conexion, $_GET['ca']) : 0;
    if($ca){
        $resumen = false;
        if (strpos($_SERVER["REQUEST_URI"], 'resumen-compra') !== false) {
            $resumen = true;
        }
        if(!$resumen){
            $oc = (isset($_GET['oc'])) ? mysqli_real_escape_string($conexion, $_GET['oc']) : 0;
            include('pags/carroAbandonado.php');
        }
    }
}
?>
<?php 
	ob_start(); # apertura de bufer
	include("includes/head.php");
	$head = ob_get_contents();
	ob_end_clean(); # cierre de bufer
	echo minify_html($head);
?>

<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N752TV92"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="loader"></div>
<div class="cont_loading">
	<div class="lds-dual-ring"></div>
</div>
<div id='popUp'></div>
	<?php 
		if($op != 'envio-y-pago'){
			ob_start(); # apertura de bufer
			include("includes/header.php");
			$header = ob_get_contents();
	        ob_end_clean(); # cierre de bufer
	        echo minify_html($header);
		}
		
		ob_start(); # apertura de bufer
        include("pags/$op.php");
        $pags = ob_get_contents();
        ob_end_clean(); # cierre de bufer
        echo minify_html($pags);
		
		ob_start(); # apertura de bufer
        include("includes/footer.php");
        $footer = ob_get_contents();
        ob_end_clean(); # cierre de bufer
        echo minify_html($footer);
    ?>
 
<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.min.css">
<script src="js/jquery.fancybox.min.js"></script>
<script type="text/javascript">
	$(function(){
		$(".editarDireccion").fancybox({
			maxWidth	: 800,
			maxHeight	: 600,
			fitToView	: false,
			width		: '70%',
			height		: '70%',
			autoSize	: false,
			closeClick	: false,
			openEffect	: 'none',
			closeEffect	: 'none'
		});
		$("#nuevaDireccion").fancybox({
			'titlePosition'		: 'inside',
			'transitionIn'		: 'none',
			'transitionOut'		: 'none'
			});
		$(".fancybox").fancybox({
			'titlePosition'		: 'inside',
			'transitionIn'		: 'none',
			'transitionOut'		: 'none'
			});
		
		});
	
</script>   
	<script type="text/javascript" src="js/jquery.Rut.js"></script>

	<script type="text/javascript">
		
		$('#rut_retiro').Rut({
  			format_on: 'keyup',
  			on_error: function(){
  				swal('','Rut invalido','');
  				$('#rut_retiro').val('');
  			}
  		});

  		$('#rut_empresa').Rut({
  			format_on: 'keyup',
  			on_error: function(){
  				swal('','Rut invalido','');
  				$('#rut_retiro').val('');
  			}
  		});

  		$('#rut_cliente').Rut({
  			format_on: 'keyup',
  			on_error: function(){
  				swal('','Rut invalido','');
  				$('#rut_cliente').val('');
  			}
  		});
	</script>

	<script type="text/javascript" src="fl8tm4ec/js/jquery.numeric.js"></script>
    <script type="text/javascript">$(function(){$("#telefono, #phone, .numeric").numeric();});</script>
    <script type="text/javascript" src="js/validacionCompraRapida.js"></script>
    <script type="text/javascript" src="js/agrega_desde_ficha.js"></script>
    <script type="text/javascript" src="js/cotiza_desde_ficha.js"></script>
    <?php 
		$codigoDescuento = file_get_contents('js/codigoDescuento.js');
		echo '<script>';
		echo minify_css($codigoDescuento);
		echo '</script>';
	?>
	<script type="text/javascript" src="js/js.cookie.min.js"></script>
    <script type="text/javascript" src="js/funciones.js?<?= rand(); ?>"></script>
	<script>
		$(document).ready(function(){
		
			$(".menuPopup").on("click", "#btnSeguir", function(){
				$(".fondoPopUp2").fadeOut(10);
				if($('.menuPopup').is(':visible')){
					$('.menuPopup').slideUp(100);
				}else{
					$('.menuPopup').slideDown(100);
				}
				return false;
			}); 
		});
	</script>
    <script type="text/javascript">
    	function cerrar(){ 
    		$(".fondoPopUp").fadeOut(100);
			$('.contPop').css('right','-380px');
    	}
    	</script>
    <script type="text/javascript" src="js/agrega_quita_elimina_ShowCart.js"></script>
	<script type="text/javascript" src="js/agrega_quita_elimina_ShowCartCotizacion.js"></script>
    <script type="text/javascript" src="js/lista_productos.js"></script>
    <script type="text/javascript" src="js/validacionCotizacion.js"></script>

    <script type="text/javascript" src="js/slick.min.js"></script>
    <script type="text/javascript" src="js/main.js?<?= rand(); ?>"></script>
    

    
	<?php if (isset($_GET["msje"])) {
		if($_GET["a"] == 1){$type = "success";} else {$type = "error";}
		?>
	<script type="text/javascript">
        $(function() { 
				swal('','<?= $_GET["msje"];?>','<?= $type; ?>'); 
			});
    </script>     
    <?php } ?>
    
	
    
    
    <?php /*
    <div class="bubble-whats">
    	<div class="close"><i class="fas fa-times"></i></div>
		¿Necesitas ayuda?<br/>envíame un mensaje por WhatsApp! 
		<div class="triangle-down"></div>
    </div>
    <a href="https://wa.me/56934325646" class="whatsapp-fix" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>
    */?>

	<?php /* 
		if($op != 'envio-y-pago' and $op != 'carro-resumen' and $op != 'identificacion'){
	?> 
		<a href="https://wa.me/56933017797" class="btnWhatsApp" target="_blank">
			<img src="img/whatsapp.svg" width="100%">
		</a>
	<?php } */ ?> 
	<!-- Código de instalación Cliengo para tiendavirtual.scanavini.cl -->
	<script type="text/javascript">
	(function () { 
		var ldk = document.createElement('script'); 
		ldk.type = 'text/javascript'; 
		ldk.async = true; 
		ldk.src = 'https://s.cliengo.com/weboptimizer/617850e5bf2972002ac5e423/617850e6bf2972002ac5e426.js?platform=view_installation_code'; 
		var s = document.getElementsByTagName('script')[0]; 
		s.parentNode.insertBefore(ldk, s); })();
	</script>
</body>
</html>
<?php mysqli_close($conexion);?>