<bod-y bgcolor=blue>


<?php

$diretoria = ""; // esta linha n�o precisas � s� um exemplo do conteudo que a vari�vel vai ter

// selecionar s� .jpg
$imagens = glob($diretoria . "*.svg");
//var_dump($imagens);
// fazer echo de cada imagem
foreach($imagens as $imagem){
echo $imagem;
  echo '<img src="'.$imagem.'" width=150 lavel='.$imagem.' />';
 echo "<br>";
}

?>