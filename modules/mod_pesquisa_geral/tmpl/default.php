<div class="container">

  <!-- BOX HEADER -->
  <header class="pesquisa__header">
    <div class="pesquisa__header-titulo">
      <h3>Busca no Portal do Tribunal Regional Federal da 5° Região</h3>
    </div>
 
  </header>

  <!-- BOX BODY -->
  <section class="pesquisa__body">

    <!-- BOX SIDEBAR PESQUISA -->
    <!-- <aside class="pesquisa__filter">
      <div class="pesquisa__filter-avancada">
        <h5>Pesquisa Avançada</h5>
        <button>Limpar Tudo</button>
      </div>

      <div class="pesquisa__filter-box">
        <h6>Categoria</h6>
        <select>
          <option value="">Processos</option>
          <option value="">Imprensa</option>
        </select>
      </div>

      <div class="pesquisa__filter-box">
        <h6>Assunto</h6>
        <select>
          <option value="">Processos</option>
          <option value="">Imprensa</option>
        </select>
      </div>

      <div class="pesquisa__filter-box">
        <h6>Período</h6>
        <input type="text" placeholder="Data Inicial">
        <input type="text" placeholder="Data Final">
      </div>

      <button class="btnPesquisa">Pesquisar</button>
    </aside> -->

    <!-- BOX CONTENT -->
    <section class="pesquisa__content">

      <!-- BOX INPUT PESQUISA -->
      <div class="pesquisa__search">
		<form id="formPesquisa">
		   <div class="pesquisa__header-resultado">
			<h5>Resultados (<span id="spanRes"></span>)</h5>
			<div style="text-align: right;">Ordenar por
			  <select name="ordenar"  id="pesquisaGeralOrdenacao">
				<option value="desc">Mais Novos</option>
				<option value="asc">Mais Antigos</option>
			  </select>
			</div> 
		  </div>
          <input type="text" placeholder="Procurar por" name="termo" id="inputPesquisa" autocomplete="off">
          <input type="submit" value="Procurar">
          <input type="button" id='botaoLimparPesquisaGeral' value="Limpar">
        </form>
      </div>
      
      <!-- BOX NOTICIAS -->
      <section class="pesquisa__body-news">
        <h5>Notícias</h5>
        <div class="pesquisa__body-box">
        </div>

        <button class="btnPesquisaNews" id="btnMostrarMaisNoticias">Mostrar Mais +</button>
      </section>

      <!-- BOX LINK UTEIS -->
      <section class="pesquisa__body-links">
        <h5>Links Úteis / Sugestões</h5>
        <div class="pesquisa__links-box">

        </div>

        <button class="btnPesquisaNews" id="btnMostrarMaisNoticiasJoomla">Mostrar Mais +</button>
      </section>

    </section>

  </section>

</div>