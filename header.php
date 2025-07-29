<?php /*
$huincha = consulta_bd("huincha","tienda_especiales","publicado = 1","id ASC");
$textoHuincha = $huincha[0][0];
if ($textoHuincha != "" && $textoHuincha != null) {
?>
<section class="huincha-covid">
    <MARQUEE SCROLLAMOUNT=10><?= $textoHuincha; ?></MARQUEE>
</section>
<?php 
}*/
?>
<header>
    <div class="line">
        <div class="contenedor_headerSuperior">
            <div class="izInfoHeader">
                <a href="mailto:info@scanavini.com" class="aFilaSuperior">
                    <img src="img/correo.png" alt="Correo eléctronico">
                    <span>info@scanavini.com</span>
                </a>
                <a href="https://wa.me/56228290100" target="_blank" class="aFilaSuperior">
                    <!-- <span class="material-icons-outlined" class="verificar">verified_user</span> -->
                    <!-- <img src="img/telefono.png" alt="Telefono">
                    <label>+56 2 28290100</label> -->
                </a>
            </div>
            <div class="deInfoHeader">
            <a class="aFilaSuperior iconosHeaderSuperior" target="_blank" href="https://web.facebook.com/scanaviniCL/?locale=es_LA&_rdc=1&_rdr"><i class="fab fa-facebook-f"></i></a>
                <a class="aFilaSuperior iconosHeaderSuperior" target="_blank" href="https://www.instagram.com/scanavini_cerraduras/"><i class="fab fa-instagram"></i></a>
                <a class="aFilaSuperior iconosHeaderSuperior" target="_blank" href="https://www.youtube.com/c/ScanaviniCerraduras"><i class="fab fa-youtube"></i></a>
                <a class="aFilaSuperior iconosHeaderSuperior" target="_blank" href="https://www.linkedin.com/company/comercial-scanavini-limitada/"><i class="fab fa-linkedin"></i></a>
                <!-- <a href="javascript:void(0)" data-fancybox data-type="ajax" data-src="ajax/user/sigue_pedido.php" class="aFilaSuperior">
                    <img src="img/icono_pedido.png" alt="Icono de pedido">
                    <label>Sigue tu pedido</label>
                </a> -->
                <!-- <a href="https://goo.gl/maps/j1KdZ8Qj3W6zR9g79" target="_blank" class="aFilaSuperior">
                    <img src="img/mapa.png" alt="Icono de mapa">
                    <label>Almirante Blanco Encalada 2545, Santiago</label>
                </a> -->
            </div>

        </div>
    </div>

	<div class="contenedorHeader">
        
        <h1 class="logo">
            <a href="home">
                <img src="<?= imagen("img/", "logo.png");?>" alt="Scanavini" width="100%"/>
            </a>
        </h1>
        
		<div class="contBtnMenuResponsive">
			<div class="hamburger">
				<div class="hamburger-inner"></div>
			</div>
		</div>
		
        <div class="buscador <?php if(campana()){ ?>campana<?php } ?>">
            <form method="GET" action="busquedas">
            <input type="text" name="buscar" class="campo_buscador" placeholder="¿Qué estás buscando?" value="<?php if(isset($_GET['buscar'])){ echo $_GET['buscar'];} ?>">
            <button class="btn_search" type="submit">BUSCAR<img src="img/icono_buscador.png" alt="Icono de buscador"></button>
            </form>
            <!--<div class="auto-busqueda desktop tablet"></div>-->
            <?php 
                if(campana() != "false"){             
            ?>
                <a href="campana" class="campana-btn">
                    <img src="<?= getCampanaLogo(); ?>" class="campana-desktop">
                    <img src="<?= getCampanaIcon(); ?>" class="campana-movil">
                </a>
            <?php } ?>
        </div>
        
        <?php
            $lineas_dest        = consulta_bd("id, nombre,imagen,imagen_color", "lineas", "publicado = 1 AND destacado = 1", "posicion asc limit 3");
        ?>
        
        <div class="contMenu">
            <div class="categories">
                <div class="get-categories">
                    <div class="hamburguesa">
                        <div class="hamburguesa-inner"></div>
                    </div>
                </div>
                <div class="texto">
                    <span>CATEGORÍAS</span>
                </div>
            </div>
            <div class="contenedorMenuHeader">
                <ul class="menu">                
                    <?php foreach($lineas_dest as $li){ ?>
                        <li class="listasMenu" nombre= "<?=$li[1] ?>" imagen= "<?=$li[2] ?>" imagenColor= "<?=$li[3] ?>">
                            <article class="lineaMenu">
                                <span class="separadorLineas">|</span>
                                <!-- <img src="imagenes/lineas/<?=$li[2] ?>" alt="<?=$li[1] ?>"> -->
                                <a href="lineas/<?= $li[0]; ?>/<?= url_amigables($li[1]); ?>">
                                    <?= $li[1]; ?> 
                                </a>
                            </article>
                        </li>
                    <?php } ?>
                    <!-- <li><a href="servicios">Servicios</a></li> -->
                    <?php /*  
                    $marcas = consulta_bd("id, nombre", "marcas", "publicado = 1  AND destacado = 1 AND nombre != ''", "posicion ASC, nombre asc limit 7"); ?>
                    <?php if($marcas){ ?>
                    <li class="marcasCont listasMenu"><a href="nuestras-marcas">Marcas<i class="fas fa-angle-down"></i></a>
                        <ul class="marcasUL">
                            <?php
                                foreach($marcas as $ma){
                            ?>
                                <li><a href="marcas/<?= $ma[0]; ?>/<?= url_amigables($ma[1]); ?>"><?= $ma[1]; ?></a></li>
                            <?php 
                                }
                                echo '<li><a class="verTodoMenu" href="nuestras-marcas">Ver todo</a></li>';
                            ?>
                        </ul>
                    <?php 
                        }
                        */
                    ?>
                    </li>
                    <!-- <li class="listasMenu"><a href="blog">Blog</a></li> -->
                    <!-- <li class="listasMenu"><a href="contacto">Contacto</a></li> -->
                    <li class="listasMenu ofertasMenu">
                        <article class="lineaMenu">
                            <span class="separadorLineas">|</span>
                                <a href="ofertas">OFERTAS</a>
                        </article>
                    </li>
                    <li class="listasMenu ofertasMenu">
                    <!-- <a href="javascript:void(0)" data-fancybox data-type="ajax" data-src="ajax/user/sigue_pedido.php" class="liPedido">
                        <img src="img/icono_pedido.png" alt="Icono de pedido">
                        <span>Sigue tu pedido</span>
                    </a> -->
                    </li>
                </ul>
            </div>
        </div>

        <div class="carro-header">
            <?php if(!isset($_SESSION['id_usuario_sesion'])){ ?>
                <a data-fancybox data-type="ajax" data-src="ajax/user/loginform.php" href="javascript:void(0)" class="contMiCuenta box">
                    <div class="icon"> <img src="img/icono_user.png" alt="Usuario"> </div><span>Inicia sesión</span>
                </a>
            <?php }else{ ?>

                <div class="contMiCarro contMiCuenta btnMenuUser">
                    <?php $usr = consulta_bd("id, nombre","clientes","id = {$_SESSION['id_usuario_sesion']}",""); ?>
                    <div class="userlog"><?= getInitials($usr[0][1]); ?></div>
                    <div class="menuUser">
                        <div class="tri"></div>
                        <ul>
                            <li class="active"><a href="mi-cuenta">Mi Cuenta <span><?= $usr[0][1]; ?></span></a></li>
                            <li><a href="mis-datos">Mis Datos</a></li>
                            <li><a href="mis-direcciones">Mis Direcciones</a></li>
                            <li><a href="mis-pedidos">Mis Pedidos</a></li>
                            <li><a href="productos-guardados">Productos Guardados</a></li>
                            <li><a href="ajax/cerrar-sesion.php">Cerrar sesión</a></li>
                        </ul>
                    </div>
                </div>
            <?php } ?>			
            <a href="productos-guardados" class="contMiCarro contWish box">
                <div class="icon"> <img src="img/icono_corazon.png" alt="icono de corazon"> </div>
                <span class="cantWish">(<?= qty_wish(); ?>)</span>
                <!-- <p class="cantWishParrafo">Productos guardados</p> -->
            </a>
            <div class="contCarroCompras btnMenuPopup">
                <a class="box botonCarroPopup" href="javascript:void(0)">
                    <div class="icon"> <img src="img/icono_bolsa.png" alt="icono de corazon"> </div>
                    <span class="cantItems">(<?= qty_pro(); ?>)</span>
                </a>
                <div class="fondoPopUp2"></div>
                    <div class="menuPopup">
                    </div>
                    <script>
                        $(function(){
                            $(".fondoPopUp2").click(function(){
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
            </div> 

        </div>
    </div>

    <?php
        $lineas        = consulta_bd("id, nombre,imagen", "lineas", "publicado = 1 AND nombre != ''", "posicion ASC, nombre asc");
        $categorias    = consulta_bd("id, nombre, linea_id,icono", "categorias", "publicado = 1 AND nombre != ''", "posicion ASC, nombre asc");
        // $subcategorias = consulta_bd("id, nombre, categoria_id", "subcategorias", "publicado = 1", "posicion asc");
        $marcas = consulta_bd("id, nombre", "marcas", "publicado = 1  AND destacado = 1 AND nombre != ''", "posicion ASC, nombre asc");
    ?>

    <div class="nav">
        <div class="contenedor bg">
            <ul class="lin">
				<?php foreach($lineas as $lin){ ?>
                    <li>
                        <!-- <img src="imagenes/lineas/<?=$lin[2] ?>" alt="<?= $lin[1] ?>"> -->
                        <a href="lineas/<?= $lin[0]; ?>/<?= url_amigables($lin[1]); ?>" class="lin_hov" rel="<?= $lin[0]; ?>">
                            <?= $lin[1]; ?>
                            <?php if(hasCatLin($lin[0])){ ?>
                                <i class="fas fa-angle-right ocultoMenuMovil"></i>
                            <?php } ?>
                        </a>
						<?php if(hasCatLin($lin[0])){ ?>
						<a href="javascript:void(0)" class="verMasLineas" rel="<?= $lin[0]; ?>"  nombreLinea="<a href='lineas/<?= $lin[0]; ?>/<?= url_amigables($lin[1]); ?> '><?= $lin[1]; ?></a>"><i class="fas fa-angle-right"></i></a>
						<?php } ?>
                    </li>
                <?php } ?>
                <li>
                    <a href="marcas" class="verMasMarcas">Marcas
                        <?php if($marcas){ ?>
                            <i class="fas fa-angle-right"></i>
                        <?php } ?>
                    </a>
                </li>
                <li class="visibleMovil"><a href="blog">Blog</a></li>
                <li class="visibleMovil"><a href="contacto">Contacto</a></li>
                <li class="visibleMovil ofertasMenu"><a href="ofertas" >Ofertas</a></li>
                <!-- <li class="visibleMovil ofertasMenu">
                    <img src="img/icono_pedido_movil.png" alt="Icono de pedido">
                    <a href="javascript:void(0)" data-fancybox data-type="ajax" data-src="ajax/user/sigue_pedido.php" class="liPedido">
                        <span>Sigue tu pedido</span>
                    </a>
                    <a href="seguimiento" class="liPedido">
                        <span>Sigue tu pedido</span>
                    </a>
                </li> -->
            </ul>
            <ul class="cat">
                <!--<div class="volver vcat movil"></div>-->
                <li class="volverMenu">
					<a href="javascript:void(0)" class="">Volver
					</a>
                    <b id="lineaEnCategorias"></b>
				</li>
				<?php
                    // $idLineasConCat = $lin[0];
                    // $categorias    = consulta_bd("id, nombre, linea_id", "categorias", "publicado = 1 AND nombre != '' AND linea_id = $idLineasConCat", "posicion ASC, nombre asc"); 
                    foreach($categorias as $cat){ 
                ?>
                    <li class="li-cat" rel="<?= $cat[2]; ?>">
                        <!-- <img src="imagenes/categorias/<?=$cat[3] ?>" alt="<?= $cat[1] ?>"> -->
                        <a href="categorias/<?= $cat[0]; ?>/<?= url_amigables($cat[1]); ?>" class="cat_hov" rel="<?= $cat[0]; ?>">
                            <?= $cat[1]; ?>
                            <?php if(hasSubCat($cat[0])){ ?>
                                <a href="javascript:void(0)" class="verMasCategorias2 accordeonCategorias" rel="<?= $cat[0]; ?>">
                                <i class="fas fa-angle-down"></i>
                                <!-- <i class="fas fa-angle-right"></i> -->
                            <?php } ?>
                        </a>
                    </li>
                    <ul class="contColumnaOcultaMovil subMovil">
                        <?php 
                            $idCategoriasConSub = $cat[0];
                            $subcategorias2 = consulta_bd("id, nombre, categoria_id", "subcategorias", "publicado = 1 AND categoria_id =$idCategoriasConSub", "posicion asc");

                            foreach($subcategorias2 as $sub2){ 
                        ?>
                            <li>
                                <a href="subcategorias/<?= $sub2[0]; ?>/<?= url_amigables($sub2[1]); ?>" class="sub_hov" rel="<?= $sub2[0]; ?>">
                                    <?= $sub2[1]; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </ul>
            <?php /* <ul class="sub">
                <div class="volver vsub movil"><i class="fas fa-angle-left"></i> Volver</div>
                <?php foreach($subcategorias as $sub){ ?>
                    <li class="cat-sub" rel="<?= $sub[2]; ?>">
                        <a href="subcategorias/<?= $sub[0]; ?>/<?= url_amigables($sub[1]); ?>" class="sub_hov" rel="<?= $sub[0]; ?>">
                            <?= $sub[1]; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            */?>
            <ul class="marcasResponsive">
                <li class="volverMenu">
					<a href="javascript:void(0)" class="">Volver
					</a>
                    <b>Marcas</b>
				</li>
				<?php
                    foreach($marcas as $marca){ 
                ?>
                    <li class="mar-responsive">
                        <a href="marcas/<?= $marca[0]; ?>/<?= url_amigables($marca[1]); ?>" class="cat_hov">
                            <?= $marca[1]; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <?php include('menu.php'); ?>

</header>

<script type="text/javascript">
   $(function(){
		
		$(".volverMenu").click(function(){
			$("ul.cat").fadeOut(100);
            $("ul.subMovil").fadeOut(100);
            $("ul.marcasResponsive").fadeOut(100);	
		});
		
		var ventana_ancho = $(window).width();
        if( ventana_ancho > 940) {

            $('.lin_hov').hover(function(){
                var $this   = $(this);
                var id      = $this.attr('rel');

                $('.lin_hov').each(function(){
                    $(this).removeClass('active');
                });

                $(this).addClass('active');

                $('.li-cat').each(function(){
                    if($(this).attr('rel') == id){
                        $(this).show();
                    }else{
                        $('.cat-sub').hide();
                        $(this).hide();
                    }
                });
            });

            $('.cat_hov').hover(function(){
                var $this   = $(this);
                var id      = $this.attr('rel');

                $('.cat_hov').each(function(){
                    $(this).removeClass('active');
                });

                $(this).addClass('active');
                
                $('.cat-sub').each(function(){
                    if($(this).attr('rel') == id){
                        $(this).show();
                    }else{
                        $('.sub-ter').hide();
                        $(this).hide();
                    }
                });
            });

            $('.sub_hov').hover(function(){
                var $this   = $(this);
                var id      = $this.attr('rel');

                $('.sub_hov').each(function(){
                    $(this).removeClass('active');
                });

                $(this).addClass('active');
                
                $('.sub-ter').each(function(){
                    if($(this).attr('rel') == id){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            });
        }else{
			/*aca es el menu responsive*/
            $('.verMasLineas').on('click', function(e){
                e.preventDefault();
                var $this   = $(this);
                var id      = $this.attr('rel');
                const nombreLinea = $this.attr('nombreLinea');
				$('#lineaEnCategorias').html(nombreLinea);
                $('#lineaEnCategorias').val(nombreLinea);
				
				$('.lin_hov').each(function(){
                    $(this).removeClass('active');
                });

                $(this).addClass('active');
				$('.li-cat').each(function(){
                    // alert($(this).attr('rel')+' = '+id);
                    if($(this).attr('rel') == id){
                        $(this).show();
                        $(this).css("display","flex");
                    }else{
                        $('.cat-sub').hide();
                        $(this).hide();
                    }
                });
				
				$(".nav .cat").fadeIn(100);
			
               /* if($this.find('i').length){
                    $('.cat').addClass('active');
                    $('.li-cat').each(function(){
                        if($(this).attr('rel') == id){
                            $(this).show();
                        }else{
                            $(this).hide();
                        }
                    });
                }else{
                    var link = $this.attr('href');
                    location.href = link;
                }*/
            });
            $('.verMasCategorias').on('click', function(e){
                e.preventDefault();
                var $this   = $(this);
                var id      = $this.attr('rel');
                console.log(id);
				
				
				$('.cat_hov').each(function(){
                    $(this).removeClass('active');
                });

                $(this).addClass('active');
				$('.cat-sub').each(function(){
                    if($(this).attr('rel') == id){
                        $(this).show();
                    }else{
                        // $('.cat-sub').hide();
                        $(this).hide();
                    }
                });
				
				$(".nav .sub").fadeIn(100);
		
            });
            // $('.cat_hov').on('click', function(e){
            //     e.preventDefault();
            //     var $this   = $(this);
            //     var id      = $this.attr('rel');

            //     if($this.find('i').length){
            //         $('.sub').addClass('active');
            //         $('.cat-sub').each(function(){
            //             if($(this).attr('rel') == id){
            //                 $(this).show();
            //             }else{
            //                 $(this).hide();
            //             }
            //         });
            //     }else{
            //         var link = $this.attr('href');
            //         location.href = link;
            //     }
            // });

            $('.sub_hov').on('click', function(e){
                e.preventDefault();
                var $this   = $(this);
                var id      = $this.attr('rel');

                if($this.find('i').length){
                    $('.ter').addClass('active');
                    $('.sub-ter').each(function(){
                        if($(this).attr('rel') == id){
                            $(this).show();
                        }else{
                            $(this).hide();
                        }
                    });
                }else{
                    var link = $this.attr('href');
                    location.href = link;
                }
            });
            $('.volver.vcat').on('click', function(){
                $('.cat').removeClass('active');
            });
            $('.volver.vsub').on('click', function(){
                $('.sub').removeClass('active');
            });
            $('.volver.vter').on('click', function(){
                $('.ter').removeClass('active');
            });
            $('.verMasMarcas').on('click', function(e){
                e.preventDefault();
                var $this   = $(this);	
                $(this).addClass('active');
                $('.marcasResponsive').show();
                $('.marcasResponsive').css("display","block");
				$(".nav .mar-responsive").fadeIn(100);
            });

			/*aca termina el menu responsive*/
        }
    })
</script>
