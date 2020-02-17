<bod-y bgcolor=blue>


<?php

$diretoria = ""; // esta linha não precisas é só um exemplo do conteudo que a variável vai ter

// selecionar só .jpg
$imagens = glob($diretoria . "*.svg");
//var_dump($imagens);
// fazer echo de cada imagem
foreach($imagens as $imagem){
echo $imagem;
  echo '<img src="'.$imagem.'" width=150 lavel='.$imagem.' />';
 echo "<br>";
}

?>