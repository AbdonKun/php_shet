<?php
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mantenedor de Cds</title>
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
		
		 $c = $_POST['nombre_cd'];
		 $n = $_FILES['caratula_cds']['name'];
		 $i = $_POST['banda_cd'];
		
		 
		 $sql = "insert into cds values (null,'$c','$n','$i')";
		 $agregar = $mysqli->query($sql);
		 if($agregar)
		  {
		  move_uploaded_file($_FILES['caratula_cds']['tmp_name'],"imagenes/".$_FILES['caratula_cds']['name']);
		 }
		 
	 }
	 
	 //eliminar
	 if( isset($_GET['id_cd']) )
	 {
		 $id = $_GET['id_cd'];
		 $sql = "DELETE FROM `basemusica`.`cds` WHERE `cds`.`id_cd` = '$id' ";
		 $eliminar = $mysqli->query($sql);
	 }


?>
<body>

<form name="form1" id="form1" method="post" action="mantenedorCDS.php" 
      enctype="multipart/form-data" onsubmit="return valida();">
<div>
  <label class="label" for="nombre_cd">Nombre del Disco</label>
  <input type="text" name="nombre_cd" id="nombre_cd" />
</div>

<div>
  <label class="label" for="caratula_cds">Caratula de Disco</label>	
  <input type="file" name="caratula_cds" id="caratula_cds" />
</div>

<div>
 <label class="label" for="banda_cd"> banda</label>

	<select name="banda_cd" id="banda_cd">
	    <option value="0">Seleccione:</option>
	    <?php
	      $query = $mysqli -> query ("SELECT * FROM bandas");
	      while ($valores = mysqli_fetch_array($query)) {
	        echo '<option value="'.$valores[id_b].'">'.$valores[nombre_b].'</option>';
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
   <th> Nombre de CD </th>
   <th> Caratula de CD </th>
   <th> Banda CD </th>
   <th> Eliminar </th>
</tr>
<?php
    $sql = "select c.id_cd, c.nombre_cd, c.caratula_cd, b.nombre_b from cds as c inner join bandas as b on c.banda_cd=b.id_b";
	$resultado = $mysqli->query($sql);
	while( $registro = $resultado->fetch_array() )
	{
?>
<tr>
   <td> <?php echo $registro['id_cd'];   ?> </td>
   <td> <?php echo $registro['nombre_cd'];   ?> </td>
   <td> <img src="imagenes/<?php echo $registro['caratula_cd']; ?>" class="img" /> </td>
   <td> <?php echo $registro['nombre_b'];   ?> </td>
     
   <td> <a href="mantenedorCDS.php?id_cd=<?php echo $registro['id_cd']; ?>"> Eliminar </a> </td>
</tr>
<?php
	}
?>
</table>
</body>
</html>