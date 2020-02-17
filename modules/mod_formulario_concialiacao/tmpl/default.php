<?php 
    defined('_JEXEC') or die;

    //recebe o título do formulário
    $titulo = $params->get('title');
    
?>

<div class="container demonstrativo bg_azul_fundo">
    <div class="row conteudo selecionado responsivo" data-aba-id="1">
        <div class="col-12">
            <div class="row">
                <div class="titulo lower" style="">
                    <?=$titulo?>
                </div>
            </div>
            <form action="#" method="post" class="form-baixa-login">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row normalmargin">
                            <input type="text" class="text-left" placeholder="Insira o seu nome*">
                        </div>
                        <div class="row normalmargin">
                            <input type="text" class="text-left" placeholder="Insira seu e-mail*">
                        </div>
                        <div class="row normalmargin">
                            <input type="text" class="text-left" placeholder="Insira o número do seu processo*">
                        </div>
                        <div class="row normalmargin">
                            <input type="text" class="text-left" placeholder="Insira seu telefone">
                        </div>
                        <div class="row normalmargin">
                            <textarea class="text-left" placeholder="Caso julgue necessário, insira aqui comentários e observações relevantes à conciliação."></textarea>
                        </div>
                        <div class="row normalmargin">
                            <div class="subtitulo text-left">* campos obrigatórios</div>
                        </div>
                        <div class="row normalmargin">
                            <button type="submit" class="no-background" style="margin-top: 0.2vh;">SOLICITAR AGENDAMENTO</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>