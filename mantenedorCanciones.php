<?php
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mantenedor de Canciones</title>
<link rel="SHORTCUT ICON" href="imagenes/logo.ico" />
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
		
		 $c = $_POST['nombre_c'];
		 $n = $_POST['archivo'];
		 $i = $_POST['cds_c'];
		
		 $sql = "insert into canciones values (null,'$c','$n','$i')";
		 $agregar = $mysqli->query($sql);
		 
	 }

	 //eliminar
	 if( isset($_GET['id_c']) )
	 {
		 $id = $_GET['id_c'];
		 $sql = "DELETE FROM `basemusica`.`canciones` WHERE `canciones`.`id_c` = '$id' ";
		 $eliminar = $mysqli->query($sql);
	 }

?>


<body>

<form name="form1" id="form1" method="post" action="mantenedorCanciones.php" 
      enctype="multipart/form-data" onsubmit="return valida();">
<div>
  <label class="label" for="nombre_c">Nombre de la cancione</label>
  <input type="text" name="nombre_c" id="nombre_c" />
</div>

<div>
  <label class="label" >mp3</label>	
  <input  type="file" name="archivo"/>
</div>

<div>
 <label class="label" for="cds_c"> cds</label>

 <select name="cds_c" id="cds_c">
	    <option value="0">Seleccione:</option>
	    <?php
	      $query = $mysqli -> query ("SELECT c.id_cd as id, concat(c.nombre_cd, ' - ' ,b.nombre_b) as nombre from cds as c inner join bandas as b on c.banda_cd=b.id_b");
	      while ($valores = mysqli_fetch_array($query)) {
	        echo '<option value="'.$valores[id].'">'.$valores[nombre].'</option>';
	      }
	    ?>
	</select>

</div>



<div class="centro">
  <input type="submit" name="btnAgregar" id="btnAgregar" value="Agregar Cds" />
  <!-- <input type="reset" name="btnBorrar" id="btnBorrar" value="Borrar" /> -->
</div>
</form>

<table border="1">
<tr>
   <th> id </th>
   <th> Nombre Canción </th>
   <th> Link MP3 </th>
   <th> CD's y Banda </th>
   <th> Eliminar </th>
</tr>
<?php
    $sql = "select c.id_c, c.nombre_c, c.mp3_c, concat(d.nombre_cd, ' - ', b.nombre_b) as nombre_cd from canciones as c inner join cds as d on c.cds_c = d.id_cd inner join bandas as b on d.banda_cd=b.id_b";
	$resultado = $mysqli->query($sql);
	while( $registro = $resultado->fetch_array() )
	{
?>
<tr>
   <td> <?php echo $registro['id_c'];   ?> </td>
   <td> <?php echo $registro['nombre_c'];   ?> </td>

   <!-- <td> <img src="imagenes/<?php echo $registro['mp3_c']; ?>" class="img" /> </td> -->
	<td>
    <audio src="audios/<?=$registro['mp3_c'];?>.mp3" controls="false" loop="true"></audio>
    </td>
   <td> <?php echo $registro['nombre_cd'];   ?> </td>
     
   <td> <a href="mantenedorCanciones.php?id_c=<?php echo $registro['id_c']; ?>"> Eliminar </a> </td>
</tr>
<?php
	}
?>
</table>
</body>
</html>