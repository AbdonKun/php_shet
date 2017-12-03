function valida()
{
	var titulo = document.getElementById('titulo');
	var autor = document.getElementById('autor');
	var editorial = document.getElementById('editorial');
	var isbn = document.getElementById('isbn');
	
	if(titulo.value == "" || titulo.value == null)
	{
		alert("El titulo es obligatorio");
		titulo.focus();
		return false;
	}
	if(autor..value == "" || autor.value == null)
	{
		alert("el autor es obligatoria");
		autor.focus();
		return false;
	}
	if(editorial.value == "" || editorial.value == null)
	{
		alert("La editorial es obligatoria");
		editorial.focus();
		return false;
	}
	if(isbn.value == "" || isbn.value == null)
	{
		alert("El isbn es obligatoria");
		isbn.focus();
		return false;
	}
	
}