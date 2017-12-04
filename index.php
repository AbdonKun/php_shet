<?php
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
  <title>ACDC</title>
<link rel="SHORTCUT ICON" href="imagenes/logo.ico" />
  <link rel="stylesheet" href="css/estilo.css" />
  </head>
  <?php
     //conección 
	  $mysqli = new MYSQLI('localhost','root','','basemusica');
	 if(!$mysqli) { die($mysqli->errno);}
	 ?>
	 
  <body>
  <div id="contenedor">
  <header>
       <img src= "imagenes/principal.jpg"  width="950" height="300"/>
  </header>
  <nav class="h">
    <ul>
	  <li> <a href="file:///C:/Users/jose/Desktop/Jose/inacap/html/trabajo%20por%2050%25%20de%20la%20nota/Paginademusica.html"> Login </a> </li>
	   <li> <a href="file:///C:/Users/jose/Desktop/Jose/inacap/html/trabajo%20por%2050%25%20de%20la%20nota/Biografia.html"> Mantenedor </a> </li>
	   
	</ul>
	
  </nav>
  <nav class="t">
   <FONT FACE="impact" SIZE=6 COLOR="red">
 Discografia de U2</FONT>
       
  </nav>
  
  
<table border="1">
<tr>
   <th> ID </th>
   <th> Nombre Banda </th>
   <th> Nombre Disco </th>
   <th> Ultima Canción </th>
   <th> Link MP3 </th>
   
</tr>
<?php
    $sql = "SELECT b.id_b, b.nombre_b, d.nombre_cd, c.nombre_c, c.mp3_c
            FROM bandas as b
            inner join cds as d on d.banda_cd=b.id_b
            inner join canciones as c on c.cds_c=d.id_cd
            order by id_b desc LIMIT 1";
	$resultado = $mysqli->query($sql);
	while( $registro = $resultado->fetch_array() )
	{
?>
<tr>
   <td> <?php echo $registro['id_b'];   ?> </td>
   <td> <?php echo $registro['nombre_b'];   ?> </td>
   <td> <?php echo $registro['nombre_cd'];   ?> </td>
<!--    <td> <img width="400" height="300 src="imagenes/<?php echo $registro['foto_b']; ?>" class="img" /> </td> -->

   <td> <?php echo $registro['nombre_c'];   ?> </td>
   <td>
   <audio src="audios/<?=$registro['mp3_c'];?>.mp3" controls="false" loop="true"></audio>
  </td>
  <!--  <td> <?php echo $registro['genero_b'];   ?> </td> -->
   
   
	
</tr>

   
    <?php
	}
?>

 </table>
  <footer>
  <small> Derechos reservados</small>  <address>fono:99545332/Por Jose Villegas</address>
  </footer>
  
 
  </div>
  </body>
  </html> 