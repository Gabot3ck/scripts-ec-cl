<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <base href="<?= $url_base; ?>" />
    
    <META NAME="Author" CONTENT="Moldeable S.A.">
    <META NAME="DC.Author" CONTENT="Moldeable S.A.">
    <META NAME="DC.Creator" CONTENT="Moldeable S.A.">
    <META NAME="Generator" CONTENT="Moldeable CMS">
    <META NAME="authoring.tool" CONTENT="Moldeable CMS">
    <META NAME="VW96.objecttype" CONTENT="Homepage">
    <META NAME="resource-type" CONTENT="Homepage">
    <META NAME="doc-type" CONTENT="Homepage">
    <META NAME="Classification" CONTENT="General">
    <META NAME="RATING" CONTENT="General">
    <META NAME="Distribution" CONTENT="Global">
    <META NAME="Language" CONTENT="Spanish">
    <META NAME="DC.Language" SCHEME="RFC1766" CONTENT="Spanish">
    <META NAME="Robots" CONTENT="index,follow">
    <META NAME="Revisit-after" CONTENT="15 days">
    <META NAME="CREDITS" CONTENT="Diseño y Prgramación: Moldeable S.A., www.moldeable.com">
    
    
        
    <META NAME="copyright" CONTENT="<?= opciones("nombre_cliente"); ?>">
    

	<?php if($op == "ficha"){ 
		$idProd = (isset($_GET["id"]) && is_numeric($_GET["id"])) ? mysqli_real_escape_string($conexion, $_GET["id"]) : 0;
		$prod = consulta_bd("nombre, descripcion, thumbs, descripcion_seo, keywords","productos","id=$idProd","");
        $descripcion = (isset($prod[0][1])) ? strip_tags($prod[0][1]) : strip_tags($prod[0][0]);
	?>
        <meta property="og:title" content="<?= $prod[0][0]; ?>" />
        <meta property="og:description" content="<?= $descripcion; ?>" />
         <META NAME="DESCRIPTION" CONTENT="<?= strip_tags($descripcion); ?>">
        
        <meta property="og:image" content="<?= $url_base.'imagenes/productos/'.$prod[0][2]; ?>" />
        <meta property="og:image" content="<?= $url_base.'imagenes/productos/'.$prod[0][2]; ?>" />
        <meta property="og:site_name" content="<?= $url_base; ?>" />
        <link rel="canonical" href="<?= obtenerURL(); ?>">

    <?php } else if($op == "lineas"){ 
		$idLinea = (isset($_GET["id"])) ? mysqli_real_escape_string($conexion, $_GET["id"]) : 0;
		$seoLineas = consulta_bd("titulo_seo, imagen_seo, descripcion_seo, keywords_seo","lineas","id=$idLinea","");
        $titulo_seo = (isset($seoLineas[0][0])) ? $seoLineas[0][0] : "";
        $imagen_seo = (isset($seoLineas[0][1])) ? $seoLineas[0][1] : ""; 
        $descripcion_seo = (isset($seoLineas[0][2])) ? $seoLineas[0][2] : ""; 
        $keywords_seo = (isset($seoLineas[0][3])) ? $seoLineas[0][3] : ""; 
	?>

        <meta property="og:title" content="<?= $titulo_seo; ?>" />
        <meta property="og:description" content="<?= strip_tags($descripcion_seo); ?>" />
         <META NAME="DESCRIPTION" CONTENT="<?= strip_tags($descripcion_seo); ?>">
        <meta property="og:keywords" content="<?= strip_tags($keywords_seo); ?>" />
        <meta property="og:image" content="<?= $url_base.'imagenes/lineas/'.$imagen_seo; ?>" />
        <meta property="og:image" content="<?= $url_base.'imagenes/lineas/'.$imagen_seo; ?>" />
        <meta property="og:site_name" content="<?= $url_base; ?>" />
        <link rel="canonical" href="<?= obtenerURL(); ?>">

    <?php } else if($op == "categorias"){ 
		$idCatSeo = (isset($_GET["id"])) ? mysqli_real_escape_string($conexion, $_GET["id"]) : 0;
		$seoCat = consulta_bd("titulo_seo, imagen_seo, descripcion_seo, keywords_seo","categorias","id=$idCatSeo","");
        
        $titulo_seo = (isset($seoCat[0][0])) ? $seoCat[0][0] : "";
        $imagen_seo = (isset($seoCat[0][1])) ? $seoCat[0][1] : ""; 
        $descripcion_seo = (isset($seoCat[0][2])) ? $seoCat[0][2] : ""; 
        $keywords_seo = (isset($seoCat[0][3])) ? $seoCat[0][3] : ""; 
	?>

        <meta property="og:title" content="<?= $titulo_seo; ?>" />
        <meta property="og:description" content="<?= strip_tags($descripcion_seo); ?>" />
         <META NAME="DESCRIPTION" CONTENT="<?= strip_tags($descripcion_seo); ?>">
        <meta property="og:keywords" content="<?= strip_tags($keywords_seo); ?>" />
        <meta property="og:image" content="<?= $url_base.'imagenes/categorias/'.$imagen_seo; ?>" />
        <meta property="og:image" content="<?= $url_base.'imagenes/categorias/'.$imagen_seo; ?>" />
        <meta property="og:site_name" content="<?= $url_base; ?>" />
        <link rel="canonical" href="<?= obtenerURL(); ?>">
        
    <?php } else if($op == "subcategorias"){ 
		$idSubCatSeo = (isset($_GET["id"])) ? mysqli_real_escape_string($conexion, $_GET["id"]) : 0;
		$seoSubCat = consulta_bd("titulo_seo, imagen_seo, descripcion_seo, keywords_seo","categorias","id=$idSubCatSeo","");
    
        $titulo_seo = (isset($seoSubCat[0][0])) ? $seoSubCat[0][0] : "";
        $imagen_seo = (isset($seoSubCat[0][1])) ? $seoSubCat[0][1] : ""; 
        $descripcion_seo = (isset($seoSubCat[0][2])) ? $seoSubCat[0][2] : ""; 
        $keywords_seo = (isset($seoSubCat[0][3])) ? $seoSubCat[0][3] : ""; 
	?>

        <meta property="og:title" content="<?= $titulo_seo; ?>" />
        <meta property="og:description" content="<?= strip_tags($descripcion_seo); ?>" />
        <META NAME="DESCRIPTION" CONTENT="<?= strip_tags($descripcion_seo); ?>">
        <meta property="og:keywords" content="<?= strip_tags($keywords_seo); ?>" />
        <meta property="og:image" content="<?= $url_base.'imagenes/subcategorias/'.$imagen_seo; ?>" />
        <meta property="og:image" content="<?= $url_base.'imagenes/subcategorias/'.$imagen_seo; ?>" />
        <meta property="og:site_name" content="<?= $url_base; ?>" />
        <link rel="canonical" href="<?= obtenerURL(); ?>">
   
    <?php } else { ?>
        
        <META NAME="Title" CONTENT="<?= opciones("seo_titulo"); ?>">
        <META NAME="DC.Title" CONTENT="<?= opciones("seo_titulo"); ?>">
        <META http-equiv="title" CONTENT="<?= opciones("seo_titulo"); ?>">
        <META NAME="DESCRIPTION" CONTENT="<?= strip_tags(opciones("seo_descripcion")); ?>">
        <META NAME="Keywords" CONTENT="<?= opciones("seo_keywords"); ?>">
        <META http-equiv="keywords" CONTENT="<?= opciones("seo_keywords"); ?>">
        <meta property="og:title" content="<?= opciones("seo_titulo"); ?>" />
        <meta property="og:description" content="<?= opciones("seo_descripcion"); ?>" />
        <meta property="og:image" content="<?= opciones("seo_url_imagen"); ?>" />
        <meta property="og:site_name" content="<?= $url_base; ?>" />
        <link rel="canonical" href="<?= obtenerURL(); ?>">
        
    <?php } ?>


    <!-- FAVICONS -->
    <link rel="icon" type="image/png" href="<?= $url_base; ?>img/favicon.png">
