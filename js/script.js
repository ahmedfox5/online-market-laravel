
var mobile = false;
var search = false;
var buttons_oppened = false;

function check_mobile(){
    if(window.innerWidth >= 767){
        mobile = false;
        $(".buttons").fadeIn();
        buttons_oppened = false;
        $(".buttons-button").removeClass("bactive");
    }else{
        mobile = true;
        $(".buttons").fadeOut();
        buttons_oppened = false;
        $(".buttons-button").removeClass("bactive");
    }

    /// edit search button
    if (!mobile){
        $('#search').css('left' ,'calc(100% - 50px)');
    }else {
        $('#search').css('left' ,'calc(100% - 120px)');
    }

}
check_mobile();
window.onresize = check_mobile;


// loading
var lCanvas = document.querySelector(".loading canvas");
var lctx = lCanvas.getContext("2d");
lCanvas.width = 100;
lCanvas.height = 100;
var lx = 0 ;
var ly = 0 ;
var x1 = lCanvas.width/2 ;
var y1 = lCanvas.height/2;

function lCdraw(x ,y){
    lctx.beginPath();
    lctx.fillStyle = "#3333ff";
    lctx.arc(x ,y ,3 ,0 ,Math.PI*2);
    lctx.fill();
}

function lCanimate(){
    requestAnimationFrame(lCanimate);
    lctx.fillStyle = "#00000005";
    lctx.fillRect(0,0,lCanvas.width ,lCanvas.height);
    lx -= 0.1;
    ly -= 0.1;
    var x2 = x1 + Math.sin(lx) * 30;
    var y2 = y1 + Math.cos(ly) * 30;
    lCdraw(x2 ,y2);
}
lCanimate();

$(document).ready(function(){
    $(".loading").fadeOut(300);
    $(".cont").delay(300).fadeIn(200);


    // nav

    $(".buttons-button").on("click" ,function(){
        if(!buttons_oppened && mobile){
            showNavButtons();
            buttons_oppened = true;
            $(this).addClass("bactive");

        }else{
            showNavButtons();
            buttons_oppened = false;
            $(this).removeClass("bactive");
        }
    });
    function showNavButtons(){
        if(!buttons_oppened){
            $(".buttons").fadeIn();
        }else{
            $(".buttons").fadeOut();
        }
    }


//    fixed buttons
    $('#goTop').fadeOut().on('click' ,function (){
        $('html,body').animate({
            scrollTop : 0
        } ,800);
    });
    window.onscroll = function (){
        if(window.scrollY > 100){
            $('#goTop').fadeIn();
            if (mobile){
                $('#search').css({'left' :'calc(100% - 50px)'});
            }
        }else {
            $('#goTop').fadeOut();
            if (mobile && !search){
                $('#search').css({'left' :'calc(100% - 120px)'});
            }
        }
    }

    let settingsButton = false;
    $('#slideSettings').hide();
    $('#settingsButton').on('click',function (){
        if (!settingsButton){
            settingsButton = true;
            $(this).css('background' ,'#007E33');
            $('#slideSettings').fadeIn();
        }else {
            settingsButton = false;
            $(this).css('background' ,'#00C851');
            $('#slideSettings').fadeOut();
        }
    });


    ///////search
    $('#search').on('click' ,function (){
        if (!search){
            search = true;
        }else {
            search = false;
        }
        $('#search i').toggleClass('fa-times');
        $('.search-cont').fadeToggle();
        $('#search').css({'left' :'calc(100% - 50px)'});
    });


    
    




//    comments
    $(".comments-title").on('click' ,function(){
        $('.the-comments').slideToggle();
        $('.angle-rotate').toggleClass('rotate180');
    });

    $('.closs-add-comment').on('click' , function(){
        $('.add-comment-cont').fadeOut();
    });

    $('.closs-update-comment').on('click' , function(){
        $('.update-comment-cont').fadeOut();
    });

    $('#add-comment').on('click' , function(){
        $('.add-comment-cont').fadeOut();
    });
    $('.add-comment-i').on('click' , function(){
        $('.add-comment-cont').fadeIn();
    });
    $('.nexpre').on('click' ,function(){
        $('.the-comments').slideUp();
        $('.angle-rotate').removeClass('rotate180');
    });


}); //// end of document ready




