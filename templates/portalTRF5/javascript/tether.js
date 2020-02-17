$(document).ready(function(){
    var y = $(window).scrollTop(); 
    $(window).scrollTop(y+1);
    $(window).scrollTop(y-1);
    
    // $( ".box .icone" ).each(function( index ) {
    //     new Tether({
    //         element: $(this),
    //         target: $(this).parent(),        
    //         attachment: 'center middle',
    //         targetAttachment: 'top middle',
    //     });
    // });
    
    $( ".main_box_branco .icone" ).each(function( index ) {
        new Tether({
            element: $(this),
            target: $(this).parent(),
            attachment: 'center middle',
            targetAttachment: 'top middle',
        });
    });
    
    if($('.consultapin').length && $('.consulta').length){
        var consulta_t = new Tether({
            element: $('.consulta'),
            target: $('.consultapin'),
            attachment: 'top left',
            targetAttachment: 'top left',
        });
    }
    
    // var t1 = new Tether({
    //     element: $('.titulo_links_footer'),
    //     target: $('.links.h72.c4'),
    //     attachment: 'center middle',
    //     targetAttachment: 'top middle',
    // });

    $(document).click(function(event){
        if(!$(event.target).hasClass('list-inline-item')){
            var y = $(window).scrollTop(); 
            $(window).scrollTop(y+1); 
            setTimeout(function(){$(window).scrollTop(y); },1);       
        }
    });
     
});


