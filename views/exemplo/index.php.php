<html>
<head>
<title>Gostar�amos de saber a sua opini�o sobre o nosso site da Web</title>
</head>
<body bgColor=#fcfde1>

<SCRIPT LANGUAGE="JAVASCRIPT">
function TestaCampos()
{
	if ((document.frmComent.nome.value.length == 0) ||
		 (document.frmComent.nome.value.length < 4))
	{
		alert('O nome deve conter mais que 4 caracteres.');
		document.frmComent.nome.focus();
		return false;
	}

	if (document.frmComent.comentarios.value.length < 8 )
	{
		alert('O coment�rio deve conter mais que 8 caracteres.');
		document.frmComent.mail.focus();
		return false;
	}

	if (document.frmComent.comentarios.value.length > 500 )
	{
		alert('O coment�rio deve conter menos que 500 caracteres.');
		document.frmComent.mail.focus();
		return false;
	}

	return true;
}

</SCRIPT>

<p align="center"><script language="JavaScript"><!--
function click() {
if (event.button==2||event.button==3) {
alert('Vai estudar!!');
}
}
document.onmousedown=click

// --></script> </p>

<?php

// ******************************************************** //
//										//
//  Nome: �der Josu� Chagas						//
//  homepage: http://www.dcc.ufmg.br/~ejchagas			//
//  E-mail: ejchagas@dcc.ufmg.br					//
//										//
// 			Script: Livro de Visitas			//
//										//
// 	Breve descri��o: Script simples em php, que utiliza   //
// apenas arquivos para gravar os coment�rios de seus 	//
// visitantes. S�o utilizados 15 arquivos, podendo esse 	//
// n�mero ser aumentado conforme a necessidade de cada 	//
// pessoa. Cada coment�rio pode conter apenas 500 		//
// caracteres para n�o ocupar muito espa�o na mem�ria.	//
//										//
// 	Para fazer o seu livro de visitas funcionar basta	//
// dar um chmod 766 nos arquivos que gravam os dados 		//
// incluse o contador.							//
//										//
// ******************************************************** //


//
// se os comentarios n�o foram digitados
//
if ((empty($comentarios)) or (empty($nome)) or (strlen($comentarios)>500)
	or (strlen($comentarios)<10) or (strlen($nome)<4))
	{
?>

<center>

<p>Gostar�amos de saber a sua opini�o sobre o nosso site da Web. Escreva os<br>
seus coment�rios neste livro p�blico de convidados para compartilhar suas<br>
id�ias com outros visitantes.</p>

<table width="311" border="0" cellspacing="1" 
	cellpadding="0" height="136">

<form name="frmComent" action="index.php" OnSubmit="return TestaCampos()"
  method="POST">
	<tr>
	  <th colspan=2>
  		<h2><strong>Adicione seus coment�rios</strong></h2>
     </th>
	</tr>

	<tr>
		<td> 
			<p>Nome:
		</td>
		<td>
			<input type=text name="nome" size="25">
			</P>
		</td>
	</tr>

	<tr>
		<td> 
			<p>E-mail:
		</td>
		<td>
			<input type=text name="mail" size="25">
			</P>
		</td>
	</tr>

	<tr>
		<td> 
			<p>Homepage:
		</td>
		<td>
			<input type=text name="page" size="25" value="http://">
			</P>
		</td>
	</tr>

	<tr>
		<td> 
			<p>Cidade:
		</td>
		<td>
			<input type=text name="cidade" size="25">
			</P>
		</td>
	</tr>


	<tr>
		<td> 
			<p>Coment�rios:<br>
			(m�ximo de 500 <br>
			caracteres)
		</td>
		<td>
			<textarea name="comentarios" rows="8" cols="30"></textarea></p>
			</P>
		</td>
	</tr>
</table>
  <p><input type="submit" value="Enviar"> 
     &nbsp;&nbsp;<input type="reset" value="Limpar"><br>
  <br>
  </p>
</form>
&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;

<a href="coment.php"><b> Ler coment�rios </b></a>

</body>

</html>

<?php
	} // fim do if
//
// se tiver sido enviado comentario
//
else
	{
	$data = date("d/m/Y", time()); 
	$hora = date("H:i", time());

	$COUNT_FILE = "count.txt"; // arquivo que armazena o n�mero
	$n_chamado=file($COUNT_FILE); // copia o arquivo
	$count = $n_chamado[0];
	$count += 1; // incrementa o contador
	if ($count == 16)// para retornar ao arquivo 1
		$count=1;
	$fp_c=fopen($COUNT_FILE,"w");
	fputs($fp_c,$count);
	fclose($fp_c);		

	$fp_a=fopen($count,"w"); // arquivo que armazena os coment�rios

	// $conteudo � a vari�vel que ser� gravada no arquivo
	$conteudo="<p><b>Nome:</b> $nome <br>";

	if(empty($mail) or (!(strpos($mail,"@")) or
			strpos($mail,"@")!=strrpos($mail,"@")))
		echo "E-mail inv�lido<br>";
	else
  		$conteudo.="<b>E-mail:</b> <a href='mailto:$mail'> $mail</a><br>";

       if(strlen($page)>15)
  		$conteudo.="<b>Homepage:</b> <a href='$page'> $page</a><br>";

	 if(strlen($cidade)>5)
		$conteudo.="<b>Cidade:</b> $cidade<br>";
		
	 $conteudo.="<b>Data:</b> $data $hora</b>";
	 $conteudo.="<br>";
	 $conteudo.="<b>Coment�rios:</b>  $comentarios<br></p>";

	fputs($fp_a,$conteudo);
	fclose($fp_a);		

	echo "Obrigado por enviar os seus coment�rios.";
	echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0;
		URL='http://www.dcc.ufmg.br/~ejchagas/visitas/coment.php'\">";
	}
?>
