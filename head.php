<!DOCTYPE html>
<html lang="es">

<head>
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-MJ8SJHSQKB"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'G-MJ8SJHSQKB');
	</script>
	<!-- End Google Tag Manager -->


	<!-- Google Tag Manager -->
	<!-- <script>
		(function(w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				'gtm.start': new Date().getTime(),
				event: 'gtm.js'
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s),
				dl = l != 'dataLayer' ? '&l=' + l : '';
			j.async = true;
			j.src =
				'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-N752TV92');
	</script> -->
	<!-- End Google Tag Manager -->


	<!-- Facebook Pixel Code -->
	<script>
		! function(f, b, e, v, n, t, s) {
			if (f.fbq) return;
			n = f.fbq = function() {
				n.callMethod ?
					n.callMethod.apply(n, arguments) : n.queue.push(arguments)
			};
			if (!f._fbq) f._fbq = n;
			n.push = n;
			n.loaded = !0;
			n.version = '2.0';
			n.queue = [];
			t = b.createElement(e);
			t.async = !0;
			t.src = v;
			s = b.getElementsByTagName(e)[0];
			s.parentNode.insertBefore(t, s)
		}(window, document, 'script',
			'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '1206755723523449');
		fbq('track', 'PageView');
	</script>
	<noscript>
		<img height="1" width="1"
			src="https://www.facebook.com/tr?id=1206755723523449&ev=PageView
        &noscript=1" />
	</noscript>
	<!-- End Facebook Pixel Code -->
	<?php include("includes/metatags.php"); ?>
	<?php include("includes/titulos.php"); ?>

	<script src="https://kit.fontawesome.com/b59bcd2c9b.js" crossorigin="anonymous"></script>

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">

	<script src="js/jquery-3.6.1.min.js"></script>

	<!-- Sweet alert -->
	<script type="text/javascript" src="js/sweetalert.js"></script>
	<link href="css/sweetalert2.min.css" rel="stylesheet">
	<?php

	$base = file_get_contents('tienda/base_tienda.css');
	echo '<style type="text/css">';
	echo minify_css($base);
	echo '</style>';

	$uniform = file_get_contents('css/agent.css');
	echo '<style type="text/css">';
	echo minify_css($uniform);
	echo '</style>';

	$main = file_get_contents('css/main.css');
	echo '<style type="text/css">';
	echo minify_css($main);
	echo '</style>';

	$baseResp = file_get_contents('tienda/base_responsive.css');
	echo '<style type="text/css">';
	echo minify_css($baseResp);
	echo '</style>';

	$baseResp = file_get_contents('css/responsive.css');
	echo '<style type="text/css">';
	echo minify_css($baseResp);
	echo '</style>';
	?>

	<script src="js/jquery.cycle2.js"></script>
	<script src="js/jquery.mousewheel.js"></script>
	<script src="js/jquery.ui.core.min.js"></script>
	<script src="js/jquery.ui.widget.min.js"></script>
	<script src="js/jquery.ui.button.min.js"></script>
	<script src="js/jquery.ui.spinner.min.js"></script>


	<script>
		function productClick(sku, nombre_producto, categoria, variante, posicion, lista, marca) {
			gtag('event', 'select_content', {
				"content_type": "product",
				"items": [{
					"id": sku,
					"name": nombre_producto,
					"list_name": lista,
					"brand": marca,
					"category": categoria,
					"variant": variante,
					"list_position": position,
					"quantity": 1,
					"price": 0
				}]
			});
		};

		function addToCart(sku, nombre_producto, categoria, variante, precio, cantidad, marca) {
			gtag('event', 'add_to_cart', {
				"items": [{
					"id": sku,
					"name": nombre_producto,
					"list_name": categoria,
					"brand": marca,
					"category": categoria,
					"variant": variante,
					"list_position": 1,
					"quantity": cantidad,
					"price": precio
				}]
			});
		}
	</script>
	<?php if ($op == 'home' || $op == '404' || $op == 'busqueda') { ?>
		<!-- Owl Stylesheets -->
		<link rel="stylesheet" href="css/owl.carousel.min.css">
		<link rel="stylesheet" href="css/owl.theme.default.min.css">

		<!-- javascript -->
		<script src="js/owl.carousel.js"></script>

		<script>
			$(function() {
				$('.owl-bannerMarcas').owlCarousel({
					loop: true,
					margin: 10,
					nav: false,
					dots: true,
					responsive: {
						0: {
							items: 2
						},
						500: {
							items: 4
						},
						700: {
							items: 5
						},
						900: {
							items: 6
						}
					}
				});


				$('.owl-carouselBlogs').owlCarousel({
					loop: false,
					margin: 10,
					nav: true,
					dots: false,
					responsive: {
						0: {
							items: 1
						},
						500: {
							items: 2
						},
						1100: {
							items: 3
						}
					}
				});
				$('.contenedorBanner').owlCarousel({
					loop: false,
					margin: 15,
					nav: true,
					dots: false,
					onInitialized: counter,
					onTranslated: counter,
					responsive: {
						0: {
							items: 1
						},
						360: {
							items: 3
						},
						700: {
							items: 4
						},
						900: {
							items: 5
						},
						1180: {
							items: 6
						}
					}
				});
				$('.owl-carouselProductos').owlCarousel({
					loop: false,
					margin: 20,
					nav: true,
					dots: false,
					onInitialized: counter,
					onTranslated: counter,
					responsive: {
						0: {
							items: 1
						},
						500: {
							items: 2
						},
						700: {
							items: 3
						},
						900: {
							items: 4
						},
						1100: {
							items: 5
						}
					}
				});


				function counter(event) {
					var element = event.target;
					var elementosPantalla = event.page.size;
					var items = event.item.count;
					var item = event.item.index + elementosPantalla;
					var sldtxt = $('.active .ivySlideTxt').html();
					var sldWidth = 100;
					var sldPercent = sldWidth * item / items;
					$('.slideState span').css("width", sldPercent + "%");
					// $('.slideState span').html(sldPercent + "%")
				}
			});
		</script>
	<?php } ?>
	<!--Label_better -->
	<script type="text/javascript" src="js/label_better-master/jquery.label_better.js"></script>
	<!--agrego el chat en el caso que el cliente lo cargo en su pagina de configuracion -->
	<?php
	if (opciones("chat") != "false") {
		echo opciones("chat");
	}
	?>

	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>