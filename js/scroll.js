jQuery( document ).ready(function($) {
    var offset = 250;
    $(window).scroll(function(){
        if ($(this).scrollTop() > offset)
        {
            $('.controll').css({
                'left':'0'
            });
            $('.pic_socialshare.fixed').css({
                'left':'0'
            });
        }
        else
        {
            $('.controll').css({
                'left':'-100%'
            });
            $('.pic_socialshare.fixed').css({
                'left':'-100%'
            });
        }
    });
    $('.controll').click(function(){

        if($('.pic_socialshare.fixed').is(':visible')){

            $('.controll').html('<i title="open share" class="fa fa-share"></i>');
            $('.pic_socialshare.fixed').hide();

        } else{

            $('.controll').html('<i title="close share" class="fa fa-times"></i>');
            $('.pic_socialshare.fixed').show();
        }

    });
});