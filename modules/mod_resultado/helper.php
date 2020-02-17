<?php

class ModResultadoHelper {

  public function getDadosWebService($params, $id, $mod, $niveis) {
	 $dados["dados"] = [
      'titulo_tab_1' => $params->get('titulo_tab_1'),
      'titulo_tab_2' => $params->get('titulo_tab_2'),
      'titulo_tab_3' => $params->get('titulo_tab_3'),
      'titulo_box_1' => $params->get('titulo_box_1'),
      'titulo_box_2' => $params->get('titulo_box_2'),
      'titulo_box_3' => $params->get('titulo_box_3')
    ];
	
		try {
			ini_set("soap.wsdl_cache_enabled", "0");
			ini_set('soap.wsdl_cache_ttl', 900);
			ini_set('default_socket_timeout', 15);
			$client = new SoapClient($params->get('url_webservice'));
        			
			if($mod == "SV1"){
				$arguments = array('getTermoCessaoUsoPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getTermoCessaoUsoPDF", $arguments ); 
			}else if($mod == "SV2"){
				$arguments = array('getTermoCooperacaoPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getTermoCooperacaoPDF", $arguments ); 
			}else if($mod == "SV3"){
				$arguments = array('getTermoParceriaPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getTermoParceriaPDF", $arguments ); 
			}else if($mod == "SV4"){
				$arguments = array('getTermoCompromissoPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getTermoCompromissoPDF", $arguments ); 
			}else if($mod == "SV5"){
				$arguments = array('getRelatorioContratacaoDiretaPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getRelatorioContratacaoDiretaPDF", $arguments ); 
			}else if($mod == "SV6"){
				$arguments = array('getRelacaoVeiculosTRF5PDF' => array('arg0' => $id));
				$result = $client->__soapCall("getRelacaoVeiculosTRF5PDF", $arguments ); 
			}else if($mod == "SV7"){
				$arguments = array('getRelacaoVeiculosSecoesSubSecoesPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getRelacaoVeiculosSecoesSubSecoesPDF", $arguments ); 
			}else if($mod == "SV8"){
				$arguments = array('getPosicaoPatrimonialPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getPosicaoPatrimonialPDF", $arguments ); 
			}else if($mod == "SV9"){
				$arguments = array('getTermosDoacaoPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getTermosDoacaoPDF", $arguments ); 
			}else if($mod == "SV10"){
				$arguments = array('getAnexosConvenio' => array('arg0' => $id));
				$result = $client->__soapCall("getAnexosConvenio", $arguments ); 
			}else if($mod == "SV11"){
				$arguments = array('getAnexosConvenioAditivos' => array('arg0' => $id));
				$result = $client->__soapCall("getAnexosConvenioAditivos", $arguments ); 
			}else if($mod == "SV12"){
				$arguments = array('getTermoCessaoUsoPDFAditivo' => array('arg0' => $id));
				$result = $client->__soapCall("getTermoCessaoUsoPDFAditivo", $arguments ); 
			}else if($mod == "SV13"){
				$arguments = array('getTermoCooperacaoPDFAditivo' => array('arg0' => $id));
				$result = $client->__soapCall("getTermoCooperacaoPDFAditivo", $arguments ); 
			}else if($mod == "SV14"){
				$arguments = array('getTermoParceriaPDFAditivo' => array('arg0' => $id));
				$result = $client->__soapCall("getTermoParceriaPDFAditivo", $arguments ); 
			}else if($mod == "SV15"){
				$arguments = array('getTermoCompromissoPDFAditivo' => array('arg0' => $id));
				$result = $client->__soapCall("getTermoCompromissoPDFAditivo", $arguments ); 
			}else if($mod == "SV16"){
				$arguments = array('getDistribuicaoOrcamentariaPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getDistribuicaoOrcamentariaPDF", $arguments ); 
			}else if($mod == "SV17"){
				$arguments = array('getDemonstrativoGestaoOrcamentariaPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getDemonstrativoGestaoOrcamentariaPDF", $arguments ); 
			}else if($mod == "SV18"){
				$arguments = array('getRelatorioDemonstrativoGestaoOrcamentariaPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getRelatorioDemonstrativoGestaoOrcamentariaPDF", $arguments ); 
			}else if($mod == "SV19"){
				$arguments = array('getAtasRegistroPrecosPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getAtasRegistroPrecosPDF", $arguments ); 
			}else if($mod == "SV20"){
				$arguments = array('getRelatorioDetalhamentoFolhaPagamentoPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getRelatorioDetalhamentoFolhaPagamentoPDF", $arguments ); 
			}else if($mod == "SV21"){
				$arguments = array('getLimitacaoEmpenhoMovimentacaoFinanceiraPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getLimitacaoEmpenhoMovimentacaoFinanceiraPDF", $arguments ); 
			}else if($mod == "SV22"){
				$arguments = array('getGovernancaGestaoPessoasTcuPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getGovernancaGestaoPessoasTcuPDF", $arguments ); 
			}else if($mod == "SV23"){
				$arguments = array('getDistribuicaoServidoresCargosComissaoPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getDistribuicaoServidoresCargosComissaoPDF", $arguments ); 
			}else if($mod == "SV24"){
				$arguments = array('getEditaisEliminacaoPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getEditaisEliminacaoPDF", $arguments ); 
			}else if($mod == "SV25"){
				$arguments = array('getMuralGabDesembargadorPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getMuralGabDesembargadorPDF", $arguments ); 
			}else if($mod == "SV26"){ 
				$arguments = array('getRevistaArgumentoPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getRevistaArgumentoPDF", $arguments ); 
			}else if($mod == "SV27"){ 
				$arguments = array('getBoletinsAdministrativosPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getBoletinsAdministrativosPDF", $arguments ); 
			}else if($mod == "SV28"){ 
				$arguments = array('getConcursosServidoresPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getConcursosServidoresPDF", $arguments ); 
			}else if($mod == "SV29"){ 
				$arguments = array('getConcursosNomeacoesPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getConcursosNomeacoesPDF", $arguments ); 
			}else if($mod == "SV30"){ 
				$arguments = array('getGabineteBoletinsPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getGabineteBoletinsPDF", $arguments ); 
			}else if($mod == "SV31"){ 
				$arguments = array('getGabineteRevistasPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getGabineteRevistasPDF", $arguments ); 
			}else if($mod == "SV32"){ 
				$arguments = array('getNovaAquisicaoLivrosPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getNovaAquisicaoLivrosPDF", $arguments ); 
			}else if($mod == "SV33"){ 
				$arguments = array('getRevistaArgumentoPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getRevistaArgumentoPDF", $arguments ); 
			}else if($mod == "SV34"){ 
				$arguments = array('getJulgadosEscolhidosPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getJulgadosEscolhidosPDF", $arguments ); 
			}else if($mod == "SV35"){ 
				$arguments = array('getEstatisticaCorregedoriaPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getEstatisticaCorregedoriaPDF", $arguments ); 
			}else if($mod == "SV36"){ 
				$arguments = array('getNovaAquisicaoPeriodicoPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getNovaAquisicaoPeriodicoPDF", $arguments ); 
			}else if($mod == "SV37"){ 
				$arguments = array('getEstatisticaProcessuaisSegundoGrauPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getEstatisticaProcessuaisSegundoGrauPDF", $arguments ); 
			}else if($mod == "SV38"){ 
				$arguments = array('getEstatisticaProcessuaisPrimeiroGrauVaraPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getEstatisticaProcessuaisPrimeiroGrauVaraPDF", $arguments ); 
			}else if($mod == "SV39"){ 
				$arguments = array('getEstatisticaProcessuaisPrimeiroGrauVaraPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getEstatisticaProcessuaisPrimeiroGrauVaraPDF", $arguments ); 
			}else if($mod == "SV40"){ 
				$arguments = array('getRevistaEsmafePDF' => array('arg0' => $id));
				$result = $client->__soapCall("getRevistaEsmafePDF", $arguments ); 
			}else if($mod == "SV41"){ 
				$arguments = array('getManualAdvogadoPjePDF' => array('arg0' => $id));
				$result = $client->__soapCall("getManualAdvogadoPjePDF", $arguments ); 
			}else if($mod == "SV42"){ 
				$arguments = array('getManualMagistradoPjePDF' => array('arg0' => $id));
				$result = $client->__soapCall("getManualMagistradoPjePDF", $arguments ); 
			}else if($mod == "SV43"){ 
				$arguments = array('getManualServidorPjePDF' => array('arg0' => $id));
				$result = $client->__soapCall("getManualServidorPjePDF", $arguments ); 
			}else if($mod == "SV44"){ 
				$arguments = array('getNormaAtoPjePDF' => array('arg0' => $id));
				$result = $client->__soapCall("getNormaAtoPjePDF", $arguments ); 
			}else if($mod == "SV45"){ 
				$arguments = array('getNormaLeiPjePDF' => array('arg0' => $id));
				$result = $client->__soapCall("getNormaLeiPjePDF", $arguments ); 
			}else if($mod == "SV46"){ 
				$arguments = array('getNormaPortariaPjePDF' => array('arg0' => $id));
				$result = $client->__soapCall("getNormaPortariaPjePDF", $arguments ); 
			}else if($mod == "SV47"){ 
				$arguments = array('getNormaProvimentoPjePDF' => array('arg0' => $id));
				$result = $client->__soapCall("getNormaProvimentoPjePDF", $arguments ); 
			}else if($mod == "SV48"){ 
				$arguments = array('getNormaResolucaoPjePDF' => array('arg0' => $id));
				$result = $client->__soapCall("getNormaResolucaoPjePDF", $arguments ); 
			}else if($mod == "SV49"){ 
				$arguments = array('getProducaoIntelectualDesembargadorPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getProducaoIntelectualDesembargadorPDF", $arguments ); 
			}else if($mod == "SV50"){ 
				$arguments = array('getLegislacaoInstitucionalPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getLegislacaoInstitucionalPDF", $arguments ); 
			}else if($mod == "SV51"){ 
				$arguments = array('getLicitacaoPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getLicitacaoPDF", $arguments ); 
			}else if($mod == "SV52"){ 
				$arguments = array('getInformacoesComplementaresPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getInformacoesComplementaresPDF", $arguments ); 
			}else if($mod == "SV53"){ 
				$arguments = array('getDecisoesCorregedoriaPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getDecisoesCorregedoriaPDF", $arguments ); 
			}else if($mod == "SV54"){ 
				$arguments = array('getCorregedoriaAtosAdministrativosPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getCorregedoriaAtosAdministrativosPDF", $arguments ); 
			}else if($mod == "SV55"){ 
				$arguments = array('getCorregedoriaDecisoesPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getCorregedoriaDecisoesPDF", $arguments ); 
			}else if($mod == "SV56"){ 
				$arguments = array('getCorregedoriaDecisoesPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getCorregedoriaDecisoesPDF", $arguments ); 
			}else if($mod == "SV57"){ 
				$arguments = array('getCurriculoMagistradoPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getCurriculoMagistradoPDF", $arguments ); 
			}else if($mod == "SV58"){ 
				$arguments = array('getBoletimDemandasRepetitivasPDF' => array('arg0' => $id));
				$result = $client->__soapCall("getBoletimDemandasRepetitivasPDF", $arguments ); 
			}

			
			$dados["lista"] = $result;
			$dados["niveis"] = $niveis;
			
		} catch (Exception $e) {
			echo "Erro ao consumir WebService!";
		}
		return $dados;
  }    

}