<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_breadcrumbs
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<ul itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumb<?php echo $moduleclass_sfx; ?>">


	<?php
	
	//var_dump($list);
	// Get rid of duplicated entries on trail including home page when using multilanguage
	for ($i = 0; $i < $count; $i++)
	{	
		if ($i === 1 && !empty($list[$i]->link) && !empty($list[$i - 1]->link) && $list[$i]->link === $list[$i - 1]->link)
		{
			unset($list[$i]);
		}
	}

	// Find last and penultimate items in breadcrumbs list
	end($list);
	$last_item_key   = key($list);
	prev($list);
	$penult_item_key = key($list);

	// Make a link if not the last item in the breadcrumbs
	$show_last = $params->get('showLast', 1);

	// Generate the trail
	
$i = 0;
	foreach ($list as $key => $item) :
		//var_dump($list); 
	 
		if($i == 0 ):
		$i++;?>
		<a itemprop="item" href="javascript: goBack();" class="pathway"><span itemprop="name" style="padding-right: 5px;">  <?php echo utf8_encode("VOLTAR "); ?> </span></a> 
			<?php if((strpos($item->link, "gestao")!==false && strpos($item->link, "gestao-de-precedentes") === false) ||strpos($item->link, "gerenciais-e-planejamento")!==false || strpos($item->link, "governanca")!==false || strpos($item->link, "conven")!==false || strpos($item->link, "licitacoes")!==false || strpos($item->link, "acesso")!==false ): ?>
				<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<a itemprop="item" href="index.php/portal-transparencia" class="pathway"><span itemprop="name"><?php echo "PORTAL DA TRANSPARÊNCIA"; ?> </span></a> 
				</li>
			<?php elseif(strpos($item->link, "projetos") != false || strpos($item->link, "noticias") != false || strpos($item->link, "revista-argumento") != false || strpos($item->link, "assessoria") != false || strpos($item->link, "especiais") != false || strpos($item->link, "jornal-mural") != false || strpos($item->link, "banco") != false): ?>
				<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<a itemprop="item" href="index.php/imprensa" class="pathway"><span itemprop="name"><?php echo "IMPRENSA"; ?></span></a> 
				</li>
			<?php elseif (strpos($item->link, "TELA-PROCESSOS-FISICOS") === true || (strpos($item->link, "tela-judiciais") === true && strpos($item->link, "tela-processos-fisicos") === true) || strpos($item->link, "tela-processos-eletronicos") === true ): ?>
				<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<a itemprop="item" href="index.php/servicos" class="pathway"><span itemprop="name"><?php echo "PORTAL DOS SERVIÇOS PÚBLICOS"; ?></span></a> 
				</li>
				<?php if(strpos($item->link, "segundo-grau") != false || strpos($item->link, "primeiro-grau") != false || strpos($item->link, "movimentacao-mensal-detalhada") != false || strpos($item->link, "movimentacao-processual-2008-2014") != false): ?>
					<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
						<a itemprop="item" href="index.php/estatisticas" class="pathway"><span itemprop="name"><?php echo "ESTATÍSTICAS"; ?></span></a> 
					</li>
					<?php if(strpos($item->link, "movimentacao-mensal-detalhada") != false || strpos($item->link, "movimentacao-processual-2008-2014") != false): ?>
						<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
							<a itemprop="item" href="index.php/primeiro-grau" class="pathway"><span itemprop="name"><?php echo "PRIMEIRO GRAU"; ?></span></a> 
						</li>
					<?php endif; ?>
				<?php endif; ?>
			<?php elseif (strpos($item->link, "biblioteca") !== false ||  strpos($item->link, "orientacoes") != false || strpos($item->link, "consulta-legislacao") != false || strpos($item->link, "clube-do-livro") != false || strpos($item->link, "producao-intelectual") != false || strpos($item->link, "novas-aquisicoes-periodicas-e-livros") != false || strpos($item->link, "renovacao-de-livros") != false || strpos($item->link, "ferramentas") != false): ?>				<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<a itemprop="item" href="index.php/biblioteca" class="pathway"><span itemprop="name"><?php echo "BIBLIOTECA"; ?></span></a> 
				</li>
			<?php elseif (strpos($item->link, "arguicao") !== false || strpos($item->link, "uniformizacao") !== false || strpos($item->link, "julgados") !== false || strpos($item->link, "gestao-de-precedentes") !== false) : ?>
				<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<a itemprop="item" href="index.php/jurisprudencia-home" class="pathway"><span itemprop="name"><?php echo "JURISPRUDÊNCIA"; ?></span></a> 
				</li>
			<?php elseif (strpos($item->link, "/servidores-e-nomeacoes") !== false || strpos($item->link, "/magistrados") !== false || strpos($item->link, "/estagiarios") !== false || strpos($item->link, "/selecoes") !== false) : ?>
				<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<a itemprop="item" href="index.php/concursos-e-selecoes" class="pathway"><span itemprop="name"><?php echo "CONCURSOS E SELEÇÕES"; ?></span></a> 
				</li>
			<?php elseif (strpos($item->link, "entrevistas-juridicas") !== false || strpos($item->link, "esmafe-e-composicao") !== false || strpos($item->link, "escolas") !== false || strpos($item->link, "calendario-de-cursos") !== false || strpos($item->link, "esmafe") !== false) : ?>
				<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<a itemprop="item" href="index.php/esmafe-land" class="pathway"><span itemprop="name"><?php echo "ESMAFE"; ?></span></a> 
				</li>
			<?php elseif (strpos($item->link, "sobre-a-conciliacao") !== false || strpos($item->link, "gabinete-de-conciliacao") !== false || strpos($item->link, "iniciativas-estrategicas-dos-cejuc") !== false || strpos($item->link, "legislacao-base-legal") !== false || strpos($item->link, "cadastro-de-conciliadores") !== false || strpos($item->link, "mutiroes") !== false || strpos($item->link, "calendarios-iniciativas-e-resultados") !== false || strpos($item->link, "artigos-e-textos") !== false || strpos($item->link, "conciliacoes-realizadas-e-resultados") !== false) : ?>
				<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<a itemprop="item" href="index.php/conciliacao" class="pathway"><span itemprop="name"><?php echo "CONCILIAÇÃO"; ?></span></a> 
				</li>
			<?php elseif (strpos($item->link, "estatisticas-corregedoria") !== false || strpos($item->link, "legislacao-da-corregedoria") !== false || strpos($item->link, "metas") !== false || strpos($item->link, "calendario-de-inspecoes") !== false || strpos($item->link, "correicoes") !== false || strpos($item->link, "decisoes") !== false || strpos($item->link, "ouvidoria") !== false || strpos($item->link, "atos-administrativos") !== false) : ?>
				<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<a itemprop="item" href="index.php/corregedoria" class="pathway"><span itemprop="name"><?php echo "CORREGEDORIA"; ?></span></a> 
				</li>
			<?php elseif (strpos($item->link, "plano-de-logistica-sustentavel") !== false || strpos($item->link, "normativos-textos-e-links-associados") !== false || strpos($item->link, "trf5-sustentavel-institucional") !== false || strpos($item->link, "videos-educativos") !== false) : ?>
				<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<a itemprop="item" href="index.php/trf5-sustentavel" class="pathway"><span itemprop="name"><?php echo "TRF5 SUSTENTÁVEL"; ?></span></a> 
				</li>
			<?php elseif (strpos($item->link, "gabinete-da-revista-artigo") !== false || strpos($item->link, "jurisdicao-publicacoes") !== false || strpos($item->link, "boletins-administrativos") !== false || strpos($item->link, "boletins-jurisprudencia") !== false) : ?>
				<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<a itemprop="item" href="index.php/gabinete-da-revista" class="pathway"><span itemprop="name"><?php echo "GABINETE DA REVISTA"; ?></span></a> 
				</li>
			<?php elseif (strpos($item->link, "faq") !== false || strpos($item->link, "manuais") !== false || strpos($item->link, "normas") !== false || strpos($item->link, "tutoriais") !== false) : ?>
				<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<a itemprop="item" href="index.php/pje" class="pathway"><span itemprop="name"><?php echo "PJE"; ?></span></a> 
				</li>
			<?php else : ?>
					
			<?php endif; ?>
	<?php endif; ?> 
		
		<?php if ($key !== $last_item_key) :
			// Render all but last item - along with separator ?>
			<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
				<?php if (!empty($item->link)) : ?>
				  
					<?php 
					
					if(strpos($item->name, "PORTAL DA TRANS")!==false): ?>
					<a itemprop="item" href="http://localhost/joomla/index.php/portal-transparencia" class="pathway"><span itemprop="name">  <?php echo $item->name; ?></span></a>
					
					<?php elseif(strpos($item->name, "IMPRENSA")!== false): ?>
						<a itemprop="item" href="http://localhost/joomla/index.php/imprensa" class="pathway"><span itemprop="name"><?php echo $item->name; ?></span></a>
					<?php else : ?>
						<a itemprop="item" href="<?php echo $item->link; ?>" class="pathway"><span itemprop="name">  <?php echo $item->name; ?></span></a>
					<?php endif; ?>


				<?php else : ?>
					<span itemprop="name">
						<?php echo $item->name; ?>
					</span>
				<?php endif; ?>

				<?php if (($key !== $penult_item_key) || $show_last) : ?>
					<span class="divider">
						<?php //echo $separator; ?>
					</span>
				<?php endif; ?>
				<meta itemprop="position" content="<?php echo $key + 1; ?>">
			</li>
		<?php elseif ($show_last) :
			// Render last item if reqd. ?>
			<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="active">
				<span itemprop="name">
					<?php echo $item->name; ?>
				</span>
				<meta itemprop="position" content="<?php echo $key + 1; ?>">
			</li>
		<?php endif;
	endforeach; ?>
</ul>
