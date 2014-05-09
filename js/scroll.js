jQuery( document ).ready(function($) {
    var offset = 250,
        controll = $('.controll'),
        picSocialShareFixed = $('.pic_socialshare.fixed');
    
    $(window).scroll(function(){
        if ($(this).scrollTop() > offset)
        {
            controll.css({
                'left':'0'
            });
            picSocialShareFixed.css({
                'left':'0'
            });
        }
        else
        {
            controll.css({
                'left':'-100%'
            });
            picSocialShareFixed.css({
                'left':'-100%'
            });
        }
    });
    controll.click(function(){

        if(picSocialShareFixed.is(':visible')){

            controll.html('<i title="open share" class="fa fa-share"></i>');
            picSocialShareFixed.hide();

        } else{

            controll.html('<i title="close share" class="fa fa-times"></i>');
            picSocialShareFixed.show();
        }

    });
});
