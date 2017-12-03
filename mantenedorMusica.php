<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Bibloteca</title>
<link rel="stylesheet" href="css/acdc.css" />
<script src="js/validacion.js"></script>
</head>
<?php
     //conección 
	  $mysqli = new MYSQLI('localhost','root','','basemusica');
	 if(!$mysqli) { die($mysqli->errno);}
	 
	 //agrega noticia
	 if( isset($_POST['btnAgregar']) )
	 {
		
		 $c = $_POST['nombre_b'];
		 $n = $_POST['foto_b'];
		 $i = $_POST['genero_b'];
		 
		 $sql = "insert into bandas values (null,'$c','$n','$i')";
		 $agregar = $mysqli->query($sql);
		 
	 }
	 
	 //eliminar
	 if( isset($_GET['id_b']) )
	 {
		 $id = $_GET['id_b'];
		 $sql = "DELETE FROM `basemusica`.`bandas` WHERE `bandas`.`id_b` = '$id' ";
		 $eliminar = $mysqli->query($sql);
	 }


?>
<body>

<form name="form1" id="form1" method="post" action="mantenedorMusica.php" 
      enctype="multipart/form-data" onsubmit="return valida();">
<div>
  <label class="label" for="nombre_b">Nombre_b</label>
  <input type="text" name="nombre_b" id="nombre_b" />
</div>
<div>
  <label class="label" for="foto_b">Foto_b</label>
  <input type="text" name="foto_b" id="foto_b" />
</div>
<div>
  <label class="label" for="genero_b">Genero_b</label>
  <input type="text" name="genero_b" id="genero_b" />
</div>



<div class="centro">
  <input type="submit" name="btnAgregar" id="btnAgregar" value="Agregar Libro" />
  <input type="reset" name="btnBorrar" id="btnBorrar" value="Borrar" />
</div>
</form>

<table border="1">
<tr>
   <th> Id_b </th>
   <th> Nombre_b </th>
   <th> Foto_b </th>
   <th> Genero_b </th>
   <th> Eliminar </th>
</tr>
<?php
    $sql = "select * from bandas";
	$resultado = $mysqli->query($sql);
	while( $registro = $resultado->fetch_array() )
	{
?>
<tr>
   <td> <?php echo $registro['id_b'];   ?> </td>
   <td> <?php echo $registro['nombre_b'];   ?> </td>
   <td> <?php echo $registro['foto_b'];   ?> </td>
   <td> <?php echo $registro['genero_b'];   ?> </td>
   
   
   
   <td> <a href="mantenedorMusica.php?id_b=<?php echo $registro['id_b']; ?>"> Eliminar </a> </td>
</tr>
<?php
	}
?>
</table>
</body>
</html>
