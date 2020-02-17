(function($) {


  /*********************************************
     * Ações de acessibilidade (topo da página)  *
     * (zoom in/out, reset e alto contraste)     *
     *********************************************/

    // Tamanhos padrão de zoom para Firefox/Opera e demais navegadores, respectivamente.
    var currFFOPZoom = 12.5;
    var currZoom = 100;

    // Identifica Firefox 1.0+
    var isFirefox = typeof InstallTrigger !== 'undefined';

    // Identifica Opera 8.0+ (UA detection to detect Blink/v8-powered Opera)
    var isOpera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;

    // Identifica IE6+
    var isIE = /*@cc_on!@*/false || !!document.documentMode;

    /* 
     * Cria um cookie com o nome, o valor e a data de expiração em dias passados.
     * Caso um cookie com o mesmo nome já exista, ele é atualizado.
     */
    function createCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*3000));
        var expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";path=/;" + expires;
    }

    /*
     * Resgata um cookie com o nome passado, caso ele exista 
     */
    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1);
            if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
        }
        return "";
    }

    /* Aumenta o zoom */
    $('.btnFontMais').on('click',function(){
        if (isFirefox || isOpera || isIE){ 
            // Zoom in específico para Firefox, Opera e IE
            currFFOPZoom = (currFFOPZoom + 1 >= 17.5) ? 17.5 : currFFOPZoom + 1;
            document.body.style.fontSize = currFFOPZoom+"px";
        } else {
            // Zoom in para os demais navegadores
            var step = 2;
            currZoom += (currZoom >= 110) ? 0 : step;
            $('body').css('zoom', ' ' + currZoom + '%');
        }
        createCookie("trf5-zoom-FFOP", currFFOPZoom, 1000);
        createCookie("trf5-zoom-CHSA", currZoom, 1000);
        ajustarTamanhoBlocosNotícias();
    });

    /* Diminui o zoom */
    $('.btnFontMenos').on('click',function(){
        if (isFirefox || isOpera || isIE){   
            // Zoom out específico para Firefox, Opera e IE
            currFFOPZoom = (currFFOPZoom - 1) <= 7.5 ? 7.5 : (currFFOPZoom - 1);
            document.body.style.fontSize = currFFOPZoom+"px";
        } else {
            // Zoom out para os demais navegadores
            var step = 2;
            currZoom -= (currZoom <= 90) ? 0 : step;
            $('body').css('zoom', ' ' + currZoom + '%');
        }
        createCookie("trf5-zoom-FFOP", currFFOPZoom, 1000);
        createCookie("trf5-zoom-CHSA", currZoom, 1000);
        ajustarTamanhoBlocosNotícias();
    });

    /* Reseta o zoom e o alto contraste para os valores padrão */
    $('.btnVoltarNormal').on('click',function(){
      if (isFirefox || isOpera || isIE){
          // Zoom padrão para Firefox, Opera e IE
          currFFOPZoom = 12.5;
          document.body.style.fontSize = currFFOPZoom+"px";
      } else {
          // Zoom padrão para os demais navegadores
          currZoom = 100;
          $('body').css('zoom', ' ' + currZoom + '%');
      }
      createCookie("trf5-zoom-FFOP", currFFOPZoom, 1000);
      createCookie("trf5-zoom-CHSA", currZoom, 1000);

      // Desabilita o css de alto contraste e troca as imagens para sua versão normal
      var highContrastStyleSheet = $('link[href$="style_altocontraste.css"]');
      createCookie("trf5-altocontraste", "false", 1000);
      if (highContrastStyleSheet.length != 0) {
          $(highContrastStyleSheet).prop('disabled', true);
          $(highContrastStyleSheet).remove();
      
          // Troca as imagens para sua versão sem alto contraste
          var images = document.getElementsByTagName('img'); 
          for(var i = 0; i < images.length; i++) {
              images[i].src = images[i].src.replace("4LT0_", "");
          }
      }

  });

  
  function habilitarDaltonismo() {
    $('html').addClass('habilitarDaltonismo');
  }

  function voltarNormal() {
    $('html').removeClass('habilitarDaltonismo');
  }

  $('.btnDaltonismo').on('click', habilitarDaltonismo);
  $('.btnVoltarNormal').on('click', voltarNormal);

})(jQuery);