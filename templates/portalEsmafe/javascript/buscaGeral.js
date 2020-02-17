(function($) {
 
  var $inputPesquisaHomeWeb =  $('.inputPesquisaHomeWeb');

  $inputPesquisaHomeWeb.on('keypress', function(e) {
  if (e.which === 13) {
      e.preventDefault();
      location.assign('/joomla/index.php/pesquisa?q=' + $inputPesquisaHomeWeb.val());
    }
  });
  
   var $inputPesquisaHome =  $('.inputPesquisaHome');
	  $inputPesquisaHome.on('keypress', function(e) {
	  if (e.which === 13) {
		  e.preventDefault();
		  location.assign('/joomla/index.php/pesquisa?q=' + $inputPesquisaHome.val());
		}
	  });
})(jQuery);