<?php 
$versao ="



versão 02/04/2019
<br>
<br>1.0.0_37
<br>










";?>


<!-- indra --> 

<center>
<?php 

if(!empty($_POST['senha'])){
	$senha = $_POST['senha']; 
}else{
	$senha = "";
}

if($senha == "indracompanytrf5"){
	 ?>


<font face="arial"><b>Aministrador Mestre</b><br><br>
<table border="1" width="600">
<tr bgcolor="#cccccc"><td>Arquivo</td><td>Desenvolvedor</td></tr> 
<?php
/*
 * Tiago Severino - 28/08/2015
 */



echo "<br/><br/>".$versao."<br/><br/><br/><br/>";




echo"
<tr><td>
<form method='POST'>
<h3>Teste de Envio de Email</h3>
<input name='ativarfuncaoenvioemail' value='ativarfuncaoenvioemail' type='hidden'>
<input name='senha' value='".$_POST['senha']."' type='hidden'>
<br>Email:<input name='emailenviar' type='text' value='tsantonio@indracompany.com'>
<br>Titulo:<input name='tituloenviar' type='text' value='Titulo'>
<br>Mensagem:<textarea name='mensagemenviar' rows='6' cols='40' >teste de email do master</textarea>
<br><br><input name='' type='submit' value='Enviar email'>
</form>
</td>
";

echo"<td rowspan='1'><h3>Resultado</h3>";
if(!empty($_POST['ativarfuncaoenvioemail']) && $_POST['ativarfuncaoenvioemail'] == 'ativarfuncaoenvioemail'){
$headers = "Content-Type: text/html; charset=UTF-8". "\r\n";
	mail($_POST['emailenviar'], $_POST['tituloenviar'], utf8_encode( $_POST['mensagemenviar'] ), $headers);
	echo"<br><br>email foi enviado!<br><br>"."<br>".$_POST['emailenviar']."<br>".$_POST['tituloenviar']."<br>".$_POST['mensagemenviar'];		
}
echo"</td></tr>";




if(!empty($_POST['nomeServico'])){
	$nomeServico = $_POST['nomeServico']; 
}else{
	$nomeServico = "bannersHome";
}
if(!empty($_POST['linkServico'])){
	$linkServico = $_POST['linkServico']; 
}else{
	$linkServico = "http://localhost:8087/feeder2/FeedService?wsdl";
}
echo"<tr>
<td>
<form method='POST'>
<h3>Teste do Serviço</h3>
<input name='testeServico' value='testeServico' type='hidden'>
<input name='senha' value='".$_POST['senha']."' type='hidden'>
<input name='link' value='".$linkServico."' type='h-idden'>
<br>Nome Servico:<input name='nomeServico' type='text' value='".$nomeServico."'>
<br>Att:<input name='att' type='text' size='5' value='arg0'>
Val:<input name='val' type='text' size='5' value=''>
<br><br><input name='' type='submit' value='Exibir Servico'>
</form>
</td>";


echo"<td rowspan='1'><h3>Retorno Servico</h3>";
		try {
			if(!empty($_POST['testeServico']) && $_POST['testeServico'] == 'testeServico'){
				$nomeServico = $_POST['testeServico'];
				$link = $_POST['link'];
				$client = new SoapClient($link);
				$attr = $_POST['nomeServico'];
				if(!empty($_POST['val'])){
					$arguments = array($_POST['nomeServico'] => array($_POST['att'] => $_POST['val']));
					$result = $client->__soapCall($_POST['nomeServico'], $arguments ); 
					echo "<pre>";
					var_dump($result);
					echo "</pre>";
				
				}else{
					$response = json_decode(json_encode($client->$attr()), True);
					echo "<pre>";
					var_dump($response);
					echo "</pre>";
				}
			}
		} catch (Exception $e) {
			echo "Erro ao consumir WebService!";
		}
echo"</td>";
echo"</tr>";







echo"<tr><td>

</td>";


echo"<td rowspan='1'><h3>Retorno</h3>";

echo"6</td>";
echo"</tr>";












phpinfo();

}else{
?>

<br><br><br><br><br><br><br>
<form method="POST">
Senha:<br><input name="senha" type="password">
</form>



<?php 
}
?>
</table>
</center>


