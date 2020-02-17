<div class="container">

  <!-- BOX HEADER -->
  <header class="pesquisa__header">
    <div class="pesquisa__header-titulo">
      <h3>Busca Processual no Portal do Tribunal Regional Federal da 5ª Região</h3>
    </div>
   
  </header>

  <!-- BOX BODY -->
  <section class="pesquisa__body">

    <!-- BOX CONTENT -->
    <section class="pesquisa__content">

      <!-- BOX INPUT PESQUISA -->
      <div class="pesquisa__search">

	  
	  
        <form id="formPesquisaNumero" method="POST">
		
		 <div class="pesquisa__header-resultado">
		  <h5>Resultados (<span id="spanRes" class="spanResResulta">0</span>)</h5>
			<div style="align-items: center;">
			Ordenar por 
			<select name="ordenar" >
			  <option value="true">Movimentados Recentemente</option>
			  <option value="false">Mais Antigos</option>
			</select>
			</div>
		</div>
		
		
          <input type="hidden" name="criterio" value="porNumero">
          <input 
            type="text" 
            placeholder="Pesquisar Número Processo" 
            name="termo" 
			id="campoNumero"
            autocomplete="off">
          <input type="submit" value="Procurar">
		  <input type="button" class="botaoLimparProcessual" value="Limpar">
        </form>

        <form id="formPesquisaNome" method="POST">
		
		<div class="pesquisa__header-resultado">
		  <h5>Resultados (<span id="spanRes" class="spanResResulta">0</span>)</h5>
			
			<div style="align-items: center;">
			Ordenar por 
			<select name="ordenar" >
			  <option value="true">Movimentados Recentemente</option>
			  <option value="false">Mais Antigos</option>
			</select>
			</div>
		</div>
		
          <input type="hidden" name="criterio" value="porNome">
          <input 
            type="text" 
            placeholder="Pesquisar Nome Parte Processo" 
            name="termo" 
			id="campoNome"
            autocomplete="off">
          <input type="submit" value="Procurar">
		  <input type="button" class="botaoLimparProcessual" value="Limpar">
        </form>

        <form id="formPesquisaOab" method="POST">
		
		<div class="pesquisa__header-resultado">
		  <h5>Resultados (<span id="spanRes" class="spanResResulta">0</span>)</h5>
			<div style="align-items: center;">
			Ordenar por 
			<select name="ordenar" >
			  <option value="true">Movimentados Recentemente</option>
			  <option value="false">Mais Antigos</option>
			</select>
			</div>
		</div>
		
          <input type="hidden" name="criterio" value="porOAB">
          <input 
            type="text" 
            placeholder="Pesquisar OAB do Processo" 
            name="termo" 
			id="campoCriterio"
            autocomplete="off"
            >
            <select name="estado">
              <option value="" selected>Selecione</option>
              <option value="PE">PE</option>
              <option value="AC">AC</option>
              <option value="AL">AL</option>
              <option value="AM">AM</option>
              <option value="AP">AP</option>
              <option value="BA">BA</option>
              <option value="CE">CE</option>
              <option value="DF">DF</option>
              <option value="ES">ES</option>
              <option value="GO">GO</option>
              <option value="MA">MA</option>
              <option value="MG">MG</option>
              <option value="MS">MS</option>
              <option value="MT">MT</option>
              <option value="PA">PA</option>
              <option value="PB">PB</option>
              <option value="PI">PI</option>
              <option value="PR">PR</option>
              <option value="RJ">RJ</option>
              <option value="RN">RN</option>
              <option value="RO">RO</option>
              <option value="RR">RR</option>
              <option value="RS">RS</option>
              <option value="SC">SC</option>
              <option value="SE">SE</option>
              <option value="SP">SP</option>
              <option value="TO">TO</option>
            </select>
          <input type="submit" value="Procurar">
		  <input type="button" class="botaoLimparProcessual" value="Limpar">
        </form>
        
        <form id="formPesquisaCpf" method="POST">
		
		<div class="pesquisa__header-resultado">
		  <h5>Resultados (<span id="spanRes" class="spanResResulta">0</span>)</h5>
			<div style="align-items: center;">
			Ordenar por 
			<select name="ordenar" >
			  <option value="true">Movimentados Recentemente</option>
			  <option value="false">Mais Antigos</option>
			</select>
			</div>
		</div>
		
          <input type="hidden" name="criterio" value="porCpfCnpj">
          <input 
            type="text" 
            placeholder="Pesquisar CPF ou CNPJ do Processo" 
            name="termo" 
			id="campoCPF"
            autocomplete="off">
          <input type="submit" value="Procurar">
		  <input type="button" class="botaoLimparProcessual" value="Limpar">
        </form>

        <div class="pesquisa__search-filter">
          <a href="#container" class="pesquisa__box-button box-button--active textoSemSublinhado">Número do Processo</a>
          <a href="#container" class="pesquisa__box-button textoSemSublinhado">Nome da Parte</a>
          <a href="#container" class="pesquisa__box-button textoSemSublinhado">Número da OAB</a>
          <a href="#container" class="pesquisa__box-button textoSemSublinhado">Número do CPF ou CNPJ</a>
        </div>
      </div>
      
      <!-- BOX NOTICIAS -->
      <section class="pesquisa__body-news">
        <h5>Eletrônicos</h5>
        <div class="pesquisa__body-box" id="pesquisa__body-processos">
        </div>
      </section>

      <br/>

      <!-- BOX LINK UTEIS -->
      <section class="pesquisa__body-links">
        <h5>Físicos</h5>
        <div class="pesquisa__links-box" id="pesquisa__body-processos-esparta"></div>
      </section>

    </section>

  </section>

</div>