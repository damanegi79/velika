(function ($){


    


    var velika = velika || function ()
    {
        var pageAr = ["home", "about", "service", "gallery1", "gallery2", "contact", "qna"];
        var currentPage = "";
        var firstFlag = true;



        function loadPage()
        {
            var html = "";
            var url = currentPage.replace("#", "");
            $.get("/html/"+url+".html?"+(Math.random()*999999999), function ( data )
            {
                if(firstFlag)
                {
                    $("#content").append(data);
                    firstFlag = false;
                }
                else
                {
                    
                }
                velika[url].init();

            });
        }
        
        
        function initSound()
        {
            console.log("사운드 작업");
        }


        $(function ()
        {
            currentPage = location.hash;
            
            if(currentPage == "") currentPage = "#home";
            $(window).on("hashchange", function ( e )
            {
                currentPage = location.hash;
                loadPage();
            });
            loadPage();
            
            initSound();
        });




        return{
            
            gotoPage : function ( id )
            {
                console.log("!!!"+id);
                location.href = "#"+id;
            }
        };
    };


    // 홈 클래스
    velika.home = (function ()
    {
        var timer;
        var selectNum = 0;


        function setMainVisual()
        {
            $(".rotator > div:gt(0)").hide();
            TweenMax.to($(".rotator > div").eq(0).find(">div"), 1, {delay:4.5, opacity:0});
            TweenMax.to($(".main_visual > div > span"), 0, {scaleX:1.2, scaleY:1.2});
            $(".main_visual > div:gt(0)").hide();

            timer = setInterval(function ()
            {
                changeVisual();
            }, 5000);
        }

        function changeVisual()
        {
            if(selectNum == $('.main_visual > div').length) selectNum = 0;
            var outTarget = $('.main_visual > div').eq(selectNum);
            var inTarget = outTarget.next();
            if(inTarget.length == 0) inTarget = $('.main_visual > div').eq(0);
            var inType = inTarget.attr("data-animation");
            outTarget.show().css({"z-index":0});
            inTarget.show().css({"z-index":1, opacity:0});
            
            switch(inType)
            {
                case "scaleDown" :
                    TweenMax.to(inTarget, 0, {scaleX:1.1, scaleY:1.1});  
                    TweenMax.to(inTarget, 4.95, {scaleX:1, scaleY:1, onComplete:motionEnd});      
                break;
                case "scaleUp" :
                    TweenMax.to(inTarget, 0, {scaleX:0.9, scaleY:0.9});  
                    TweenMax.to(inTarget, 4.95, {scaleX:1, scaleY:1, onComplete:motionEnd});      
                break;
                case "moveLeft" :
                    TweenMax.to(inTarget, 0, {x:-$(window).width()*0.1});  
                    TweenMax.to(inTarget, 4.95, {x:0, onComplete:motionEnd});      
                break;
                case "moveRight" :
                    TweenMax.to(inTarget, 0, {x:$(window).width()*0.1});  
                    TweenMax.to(inTarget, 4.95, {x:0, onComplete:motionEnd});      
                break;
                case "moveDown" :
                    TweenMax.to(inTarget, 0, {y:-$(window).height()*0.1});  
                    TweenMax.to(inTarget, 4.95, {y:0, onComplete:motionEnd});      
                break;
                case "moveUp" :
                    TweenMax.to(inTarget, 0, {y:$(window).height()*0.1});  
                    TweenMax.to(inTarget, 4.95, {y:0, onComplete:motionEnd});      
                break;
            }

            TweenMax.to(inTarget, 2, {opacity:1});

            var typo = $(".rotator > div").eq(selectNum).next();
            if(typo.length == 0) typo = $('.rotator > div').eq(0);
            typo.show()
            typo.find(">div").css({opacity:0});
            var typoType = typo.attr("data-animation");
            switch(typoType)
            {
                case "scaleDown" :
                    TweenMax.to(typo.find(">div"), 0, {scaleX:1.2, scaleY:1.2});  
                    TweenMax.to(typo.find(">div"), 4, {scaleX:1, scaleY:1});      
                break;
                case "scaleUp" :
                    TweenMax.to(typo.find(">div"), 0, {scaleX:0.8, scaleY:0.8});  
                    TweenMax.to(typo.find(">div"), 4, {scaleX:1, scaleY:1});      
                break;
                case "moveLeft" :
                    TweenMax.to(typo.find(">div"), 0, {x:-$(window).width()*0.1});  
                    TweenMax.to(typo.find(">div"), 4, {x:0});      
                break;
                case "moveRight" :
                    TweenMax.to(typo.find(">div"), 0, {x:$(window).width()*0.1});  
                    TweenMax.to(typo.find(">div"), 4, {x:0});      
                break;
                case "moveDown" :
                    TweenMax.to(typo.find(">div"), 0, {y:-$(window).height()*0.1});  
                    TweenMax.to(typo.find(">div"), 4, {y:0});      
                break;
                case "moveUp" :
                    TweenMax.to(typo.find(">div"), 0, {y:$(window).height()*0.1});  
                    TweenMax.to(typo.find(">div"), 4, {y:0});      
                break;
            }
            TweenMax.to(typo.find(">div"), 2, {delay:0.8, opacity:1});
            TweenMax.to(typo.find(">div"), 0.5, {delay:4.5, opacity:0});
            

            function motionEnd()
            {
                outTarget.hide();
                typo.hide();
                selectNum++;
            }
        }


        return{
            init : function ()
            {
                setMainVisual();
                
            },
            dispos : function ()
            {
                clearInterval(timer);
            }
        };
    })();

    window.Velika = velika;

})(jQuery);

var velika = new Velika();