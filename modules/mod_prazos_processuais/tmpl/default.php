
<div class="container demonstrativo bg_azul_fundo" id="tabela_1">
    <?php echo $list['parametro']['subtitle'];	?>
	<div style="display:none;"><input id="table_1" type="text" value="<?php echo urlencode($list['parametro']['subtitle']); ?>" />
	<input id="table_2" type="text" value="<?php echo urlencode(strip_tags($list['parametro']['subtitle'])); ?>" /></div>
</div>

<div class="container demonstrativo bg_azul_fundo">
	<div class="container demonstrativo bg_azul_fundo">
		<div class="row conteudo selecionado responsivo" data-aba-id="1">
			<div class="col-12">
                <div class="row download-row left">
                    <div class="d-md-block hidden-sm-down">
                        <a href="#conteudo" role="button"  class="download" style="width: inherit; padding: 15px " onClick="javascript:compartilharWhatsapp(2);">
                            <div class="icone"><img src="templates/portalProcessosConsultas/images/share.svg"></div>
                            Compartilhar
                        </a>
                        <a href="#conteudo" role="button"  class="download"  onClick="javascript:baixarPDF(1);">
                            <div class="icone"><img src="templates/portalProcessosConsultas/images/download.svg"></div>
                            PDF
                        </a>
                        <a href="#conteudo" role="button"  class="download"  onClick="javascript:imiprimirTabela('1', 'print', '' );">
                            <div class="icone"><img src="templates/portalProcessosConsultas/images/impressora.svg"></div>
                            IMPRIMIR
                        </a>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>






