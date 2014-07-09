
jQuery.ready(function(){
    jQuery('div.twitter').each(function(){
        var tmessage = jQuery(this).find("p.message");
        var tuser = jQuery(this).find("p.twitter-username");

        if(tmessage.length != 0) {
            tmessage.html( Autolinker.link( tmessage.html() ) );
        }
        if(tuser.length != 0) {
            tuser.html( Autolinker.link( tuser.html() ) );
        }
    });


});


