<?php

class ModTabsHelper {

  private function getDadosTeste() {
    return [
      [
        'ano' => '2018', 
        'Titulo' => 'Teste 01'
      ],
      [
        'ano' => '2018', 
        'Titulo' => 'Teste 02'
      ]
    ];
  }

  public function getDadosWebService($params) {

    // $url = 'http://10.81.252.18:8087/WSSarh/sarh?wsdl';

    // try {

    //   $client = new SoapClient($url);

    //   $client->getUltimasNoticias();

    // } catch(Exception $e) {
    //   die($e->getMessage());
    // }

    $dados = [
      'titulo_tab_1' => $params->get('titulo_tab_1'),
      'titulo_tab_2' => $params->get('titulo_tab_2'),
      'titulo_tab_3' => $params->get('titulo_tab_3'),
      'titulo_box_1' => $params->get('titulo_box_1'),
      'titulo_box_2' => $params->get('titulo_box_2'),
      'titulo_box_3' => $params->get('titulo_box_3'),
      'dados' => self::getDadosTeste(),
    ];

    return $dados;

  }    

}