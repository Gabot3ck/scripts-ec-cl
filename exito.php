<?php 
    $oc = (isset($_GET["oc"])) ? mysqli_real_escape_string($conexion, $_GET["oc"]) : 0;
	$nombre_sitio = opciones("nombre_cliente");
    $nombre_corto = opciones("dominio");
    $url_sitio="http://".$nombre_corto;
	$url_base = $url_sitio."/"; 
    $url_logo 		= $url_base."img/logo.png";
	$color_logo = opciones("color_logo");
	$datos_cliente = consulta_bd("nombre,email,id,direccion, medio_de_pago, numeracion_direccion, numero_dpto_oficina, id_envio, region_id, comuna_id, retiro_en_tienda, sucursal_id","pedidos","oc='$oc'","");
    $nombre_cliente = $datos_cliente[0][0];
    $email_cliente = $datos_cliente[0][1];
      
    $id_pedido   = $datos_cliente[0][2];
    $direccion   = $datos_cliente[0][3];
    $id_pedidoAdminitrador = $datos_cliente[0][4];
    $n_direccion = $datos_cliente[0][5];
    $n_dpto      = $datos_cliente[0][6];
	$idEnvio     = $datos_cliente[0][7];
    $regionId    = (isset($datos_cliente[0][8]) ? $datos_cliente[0][8]:0);
    $comunaId    = (isset($datos_cliente[0][9]) ? $datos_cliente[0][9]:0);
	$retiro_tienda= $datos_cliente[0][10];
	$sucursal_id = $datos_cliente[0][11];
	if ($retiro_tienda != 0 && $retiro_tienda != "") {
		$sucursal = consulta_bd("nombre,direccion,telefono,horario","sucursales","id='$sucursal_id'","");
		$sucursalNombre    = $sucursal[0][0];
		$sucursalDireccion = $sucursal[0][1];
		$sucursalTelefono  = $sucursal[0][2];
		$sucursalHorario   = $sucursal[0][3];
		$despachos = "retiro";
		$regionId = 0;
		setlocale(LC_TIME, 'es_CL');
		$diaSemana = date("w");
		if ($diaSemana == 0) {
			$diaSemana = 7;
		}
		$subtotal = 0;
		$paraCorreo = 1;
		$textoDias = DiasDespacho($despachos, $diaSemana, $subtotal, $regionId,$paraCorreo);
		$respuestaDespacho = '
					<p style="font-size:18px; color:#ff5b04;">'.$textoDias.'</p>
					<p style="font-size:18px; color:#ff5b04;">Esperar email de confirmación de retiro</p>';
	}else{
		setlocale(LC_TIME, 'es_CL');
		$diaSemana = date("w");
		if ($diaSemana == 0) {
			$diaSemana = 7;
		}
		$subtotal = 0;
		$despachos = "domicilio";
		$paraCorreo = 1;
		$textoDias = DiasDespacho($despachos, $diaSemana, $subtotal, $regionId,$paraCorreo);
		$respuestaDespacho = '
					<p style="font-size:18px; color:#ff5b04;">'.$textoDias.'</p>';
	}
    $regionActual = consulta_bd("nombre","regiones","id=$regionId ","");
    $region = $regionActual[0][0];
    $comunaActual = consulta_bd("nombre","comunas","id=$comunaId ","");
    $comuna = $comunaActual[0][0];
    $direccionCompleta = $direccion.", ".$n_direccion." dpto/of: ".$n_dpto." <br><br>".$region."<br><br>".$comuna;
      
      
	$detalle_pedido = consulta_bd("productos_detalle_id,cantidad,precio_unitario,codigo, codigo_pack","productos_pedidos","pedido_id=$id_pedido and codigo_pack is NULL","");
    
	$despacho = $datos_cliente[0][3]." ".$datos_cliente[0][5]." Depto ".$datos_cliente[0][6]; ;    

    $tabla_compra = '<table style="border-top: 1px dashed #dddddd; border-bottom: 1px solid #dddddd" width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
	  <td style="padding:0;" valign="top" align="left" width="30%" style="">
			<p>Este fue tu pedido</p>
	  </td>
	</tr>
	';
           
    for ($i=0; $i <sizeof($detalle_pedido) ; $i++) {
        $pD = consulta_bd("producto_id, nombre","productos_detalles","id=".$detalle_pedido[$i][0],"");
        $id_prod = $pD[0][0];
        $campos = "id, nombre,thumbs";
        $tabla  = "productos";
        $where  = "id=$id_prod";
        $productos = consulta_bd($campos,$tabla,$where,"");
        $precio_unitario = $detalle_pedido[$i][2];
        $cantidad = $detalle_pedido[$i][1];
        $subtotal = $precio_unitario * $cantidad;

        $tabla_compra .= '<tr>';
        $tabla_compra .= '  <td valign="top" align="left" width="20%" style="padding:10px;">
                                <img class="imgExitos"  style="border: 1px solid #ebebeb" alt="detalles pedidos" src="'.getIMG($detalle_pedido[$i][0]).'" width="100%"/>
                            </td>';
        $tabla_compra .= '  <td valign="top" align="left" width="60%" style="padding:10px;">
                                <p style="margin:10px 0 5px 0; font-size: 14px; font-weight: 600; color:#666666;">'.$productos[0][1].'</p>
                                <p style="margin:0 0 5px 0; color:#999999; font-size:14px;">SKU: '.$detalle_pedido[$i][3].'</p>
                                <p style="margin:0 0 5px 0; color:#999999; font-size:14px;">Cantidad: '.$detalle_pedido[$i][1].'</p>
                            </td>'; //nombre producto
		$tabla_compra .= '  <td valign="top" align="left" width="20%" style="padding:10px;">
								<p style="margin:10px 0 5px 0; font-size: 12px; font-weight: 600; color:#666666;">PRECIO</p>
								<br><br>
                                <p style="margin:0 0 5px 0; color:#005dbf;"><strong>$'.number_format($detalle_pedido[$i][2],0,",",".").'</strong></p>

						    </td>';
        
        $tabla_compra .= '</tr>';

    } 
$tabla_compra .= '</table>';
$totales = consulta_bd("id, descuento, fecha_creacion, tipo_envio, total, total_pagado, valor_despacho","pedidos","oc='$oc'","");
			
            $tabla_compra .= '<table width="100%" style="border-bottom: 1px solid #dddddd; padding:10px">';

            $tabla_compra .='     <tr>';
            $tabla_compra .='       <td style="padding:0;" valign="top" align="right" width="70%">
									  <p style="margin:0 0 5px 0;font-size:14px;">Sub Total:</p>
									</td>';
            $tabla_compra .='       <td style="padding:0;" valign="top" align="right" width="30%">
										<p style="margin:0 0 5px 0; font-size:14px; text-align:right;">$'.number_format($totales[0][4],0,",",".") .'</p>
									</td>';
            $tabla_compra .='     </tr>';

			if($totales[0][1] != '' || $totales[0][1] != 0){
				$tabla_compra .='<tr>';
            	$tabla_compra .='   <td style="padding:0;" valign="top" align="right" width="70%">
										<p style="margin:0 0 5px 0;font-size:14px;">Descuento:</p>
									</td>';
            	$tabla_compra .='   <td style="padding:0;" valign="top" align="right" width="30%">
										<p style="margin:0 0 5px 0;font-size:14px;">$'.number_format($totales[0][1],0,",",".").'</p>
										</td>';
				$tabla_compra .='</tr>';
			}
			
			


			if($totales[0][6] != 0){ //DESPACHO
				$tabla_compra .='     <tr>';
	            $tabla_compra .='       <td style="padding:0;" valign="top" align="right" width="70%">
											<p style="margin:0 0 5px 0;font-size:14px;">Valor envío:</p>
										</td>';
	            $tabla_compra .='       <td style="padding:0;" valign="top" align="right" width="30%">
											<p style="margin:0 0 5px 0;font-size:14px;">$'.number_format($totales[0][6],0,',','.').'</p>
										</td>';
	            $tabla_compra .='     </tr>';
			}else{
				$tabla_compra .='     <tr>';
	            $tabla_compra .='       <td style="padding:0;" valign="top" align="right" width="70%">
											<p style="margin:0 0 5px 0;font-size:14px;">Valor envío:</p>
										</td>';
	            $tabla_compra .='       <td style="padding:0;" valign="top" align="right" width="30%">
											<p style="margin:0 0 5px 0;font-size:14px;">'.$totales[0][3].'</p>
										</td>';
	            $tabla_compra .='     </tr>';
			}

            

            $tabla_compra .='     <tr>';
            $tabla_compra .='       <td style="padding:0;" valign="top" align="right" width="70%">
										<p style="margin:0 0 5px 0;font-size:14px; color:#005dbf; font-weight: 900;">Total Pedido:</p>
									</td>';
            $tabla_compra .='       <td style="padding:0;" valign="top" align="right" width="30%">
										<p style="margin:0 0 5px 0;font-size:14px; color:#005dbf; font-weight: 900;">$'.number_format($totales[0][5],0,",",".").'</p>
									</td>';        
            $tabla_compra .='     </tr>';
            $tabla_compra .='</table>';

	$msg = '
	<!DOCTYPE html>
	<html>
	<head>
		<link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>'.$nombre_sitio.'</title>
		<style>
			table {
				margin: 0 auto;
			}
			.imgExitos{
				width: 100%;
				height: auto;
				display:block;
			}
			p{
				font-size: 16px;
				color: #444444;
			}
			td{
				padding: 0 0 20px 0;
			}
            .contExitoTabla{
                background: #f1f1f1;
                padding: 80px 0 25px 0;
            }
            .breadcrumb{
                background: #fff;
            }
		</style>
	</head>
	<body>
    <div class="breadcrumb" id="top">
        <div class="contenedor">
            <a href="javascript:history.back();" class="atras"><i class="fas fa-long-arrow-alt-left"></i> Atrás</a>
            <ul>
                <li><a href="home">Home</a></li>
                <li class="active">Compra exitosa</li>
            </ul>
        </div>
    </div> 
    <section class="contExitoTabla">
	  <table align="center" style ="background: #f1f1f1" cellpadding="0" cellspacing="0" width="100%">
	    <tr>
		  <td style="padding:0;">
			<table align="center" style ="background: #ffffff" cellpadding="0" cellspacing="0" width="650">
				<tr>
					<td align="center">
						<img class="imgExitos" src="'.$url_base.'img/correos/borde_superior.jpg" alt="Borde superior">
					</td>
				</tr>
				<tr>
				<td>
				<table style ="background: #ffffff" align="center" cellpadding="0" cellspacing="0" width="570">
						<tr>
							<td align="center">
								<img class="imgExitos" style="max-width:240px; display: block; margin: 0 auto;" src="'.$url_base.'img/correos/logo.jpg" alt="'.$nombre_sitio.'" border="0" width="240px"/>
							</td>
						</tr>
						<tr>
							<td align="center">
								<table style ="background: #ffffff" align="center" cellpadding="0" cellspacing="0" width="580">
								<tr>
									<td align="center">
										<p>Hola '.$nombre_cliente.', estamos muy content@s de haber recibido tu pedido.</p>
										<p style="font-size:18px;">El número de tu compra es: <strong style="color:#005dbf">'.$oc.'</strong></p>
										'.$respuestaDespacho.'
										</td>
								</tr>';
				if($datos_cliente[0][4] == 'transferencia'){
					$msg .= '<tr>
									<td align="center">
										<p style="text-align:left;">Lo único que queda pendiente es que nos transfieras para empezar a preparar tus pedido, los datos son:</p>
										</td>
								</tr>
								<tr>
									<td align="center">
										<table style ="background: #ffffff; border: 1px solid #005dbf; border-radius:10px; padding:20px;" align="center" cellpadding="0" cellspacing="0" width="470">
										<tr>
											<td style="padding:0;" align="center">
											<p style="font-size:18px; line-height:20px; margin:0 0 5px 0;">Nombre: COMERCIALIZADORA R&G SPA</p>
											<p style="font-size:18px; line-height:20px; margin:0 0 5px 0;">Banco: BANCO SANTANDER</p>
											<p style="font-size:18px; line-height:20px; margin:0 0 5px 0;">Cuenta corriente: 88909747</p>
											<p style="font-size:18px; line-height:20px; margin:0 0 5px 0;">Rut: 77.616.679-0</p>
											<p style="font-size:18px; line-height:20px; margin:0 0 5px 0;">Correo: <strong style="color:#005dbf;">escribenos@scanavini.cl</strong></p>
											</td>
										</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td style="padding:0;" align="center">
										<p style="text-align:left;">Apenas hagas la transferencia avisamos para poder revisar y confirmar tu compra.</p>
										</td>
								</tr>';
				}
				$msg .=       '</table>
							</td>
						</tr>
						<tr>
							<td align="center">
								'.$tabla_compra.'
							</td>
						</tr>';

						if ($retiro_tienda == 0) {
							$msg .= '
							<tr>
								<td align="center">
									<table style ="border-bottom: 1px dashed #dddddd; background: #ffffff; padding:10px 0;" align="center" cellpadding="0" cellspacing="0" width="570">
									<tr>
										<td style="font-size:14px; text-align:left; line-height:12px; margin:0 0 8px 0;" align="center">
											<p style="font-size:14px; line-height:12px; margin:0 0 8px 0;"><strong>Datos de Despacho:</strong></p>
											<p style="font-size:14px; line-height:12px; margin:0 0 8px 0;">'.$nombre_cliente.'</p>
											<p style="font-size:14px; line-height:12px; margin:0 0 8px 0;">'.$direccionCompleta.'</p>
										</td>
										</tr>
									</table>
								</td>
							</tr>';
						}else{
							$msg .= '
							<tr>
								<td align="center">
									<table style ="border-bottom: 1px dashed #dddddd; background: #ffffff; padding:10px 0;" align="center" cellpadding="0" cellspacing="0" width="570">
									<tr>
										<td style="font-size:14px; text-align:left; line-height:12px; margin:0 0 8px 0;" align="center">
											<p style="font-size:14px; line-height:12px; margin:0 0 8px 0;"><strong>Retiro en tienda:</strong></p>
											<p style="font-size:14px; line-height:12px; margin:0 0 8px 0;">'.$sucursalNombre.'</p>
											<p style="font-size:14px; line-height:12px; margin:0 0 8px 0;">'.$sucursalDireccion.'</p>
											<p style="font-size:14px; line-height:12px; margin:0 0 8px 0;">'.$sucursalTelefono.'</p>
											<p style="font-size:14px; line-height:12px; margin:0 0 8px 0;">'.$sucursalHorario.'</p>
										</td>
										</tr>
									</table>
								</td>
							</tr>';
						}
			$msg .=        '<tr>
							<td align="center">
								<table style ="background: #ffffff" align="center" cellpadding="0" cellspacing="0" width="580">
								<tr>
									<td align="center">
										<p>Mientras esperas tu pedido continúa vitrineando en nuestra web:</p>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td align="center">
							<a href="'.$url_sitio.'"><img class="imgExitos" src="'.$url_base.'img/correos/categorias.jpg" alt="Categorias"></a>
							</td>
						</tr>
					</table>
				</td>
				</tr>
				<tr style="background:#444444;" >
					<td style="padding:20px 20px 20px 20px;" align="center">
					<p style="text-align:center; font-size:18px; color:#ffffff; line-height:18px; margin:0 0 30px 0;">Equipo de Scanavini</p>
					<p style="text-align:center; font-size:18px; color:#ffffff; line-height:18px; margin:0 0 8px 0;">Si tienes alguna duda o sugerencia, estamos para ayudarte</p>
					<p style="text-align:center; font-size:18px; color:#ffffff; line-height:18px; margin:0 0 8px 0;">Contáctanos a través de nuestro <a style="text-decoration:underline; color:#ffffff;" href="'.$url_sitio.'/contacto"> Centro de ayuda. </a></p>
					<div style="padding:20px 20px 20px 20px; display:flex; justify-content:center; text-align:center; gap:20px;" align="center">
						<a href="https://web.facebook.com/scanaviniCL?_rdc=1&_rdr"><img style="max-width:25px;" src="'.$url_base.'img/correos/face.png" alt="Facebook"></a>
						<a href="https://www.instagram.com/scanavini_cerraduras/"><img style="max-width:25px;" src="'.$url_base.'img/correos/insta.png" alt="Instagram"></a>
						<a href="https://www.youtube.com/c/ScanaviniCerraduras"><img style="max-width:25px;" src="'.$url_base.'img/correos/youtube.png" alt="Youtube"></a>
						<a href="https://www.linkedin.com/company/comercial-scanavini-limitada/"><img style="max-width:25px;" src="'.$url_base.'img/correos/linkendin.png" alt="Linkedin"></a>	
					</div>					
					</td>
				</tr>
				<tr style="background:#737276;" >
					<td style="padding:0;" align="center">
					<p style="text-align:center; font-size:18px; color:ffffff; line-height:18px; margin:0 0 8px 0;"></p>
					</td>
				</tr>
			</table>
		   </td>
		  </tr>
	  </table>
    </section>
	</body>
	</html>
	';
    echo $msg;

if ($totales[0][5] > 0) {
	$valor_despacho = $totales[0][5];
}else{
	$valor_despacho = 0;
}

?>
<script type="text/javascript">  
gtag('event', 'purchase', {
  "transaction_id": "<?= $oc; ?>",
  "affiliation": "<?= opciones('nombre_cliente');?>",
  "value": <?= round($totales[0][5]); ?>,
  "currency": "CLP",
  "tax": <?= round(($totales[0][5]/1.19) * 0.19); ?>,
  "shipping": <?= $valor_despacho; ?>,
  "items": [
     <?php
        for ($i=0; $i <sizeof($detalle_pedido) ; $i++) {
                $pro_id = $detalle_pedido[$i][0]; 
                $details_pro = consulta_bd("nombre,producto_id,id","productos_detalles","id = $pro_id","");
                $total_item = round($detalle_pedido[$i][2])*$detalle_pedido[$i][1];
                $marca = consulta_bd("m.nombre","productos p, marcas m","p.id = ".$details_pro[0][1]." and p.marca_id = m.id","");
                $categoria = consulta_bd("sc.nombre","lineas_productos cp, categorias c, subcategorias sc","cp.producto_id=".$details_pro[0][1]." and cp.categoria_id = c.id and sc.id = cp.subcategoria_id and cp.subcategoria_id <> ''","");
        ?>	
             <?php if($i > 0){echo ",";} ?>
             {
              "id": "<?= $details_pro[0][2]; ?>",
              "name": "<?= $details_pro[0][0]; ?>",
              "list_name": "General",
              "brand": "<?= $marca[0][0] ?>",
              "category": "<?= $categoria[0][0] ?>",
              "variant": "<?= $details_pro[$i][0]; ?>",
              "list_position": 0,
              "quantity": <?= $detalle_pedido[$i][1]; ?>,
              "price": "<?= round($detalle_pedido[$i][2]); ?>"
            }
            
        <?php } ?>
    
     
     
     
  ]
});
</script>

<!-- <script>
    setTimeout(function(){
        var ids = [];
        var valueTotal = 0;
        for (var i = 0; i < getCartFacebook.length; i++) {
            ids.push(getCartFacebook[i].id);
            valueTotal += parseInt(getCartFacebook[i].total);
        }
        var a = {
            content_type: "product",
            content_ids: ids,
            num_items: getCartFacebook.length,
            currency: "CLP",
            value: valueTotal
        };
        fbq('track', 'Purchase', a);
    },1000);
</script> -->