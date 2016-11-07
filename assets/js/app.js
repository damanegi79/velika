(function ($){

    var velika = velika || function ()
    {
        var pageAr = ["home", "about", "services", "gallery1", "gallery2", "contact", "qna"];
        var currentPage = "";
        var oldPage = "";
        var firstFlag = true;
        var footer = null;

        function loadFooter()
        {
            $.get("/html/footer.html?"+(Math.random()*999999999), function ( data )
            {
                footer = $(data);
                loadPage();
            });
        }

        function loadPage()
        {
            var html = "";
            var url = currentPage.replace("#", "");
            $.get("/html/"+url+".html?"+(Math.random()*999999999), function ( data )
            {
                var page = $(data);

                if(url != "home")
                {
                    page.append(footer);    
                }

                if(firstFlag)
                {
                    $("#content").append(page);
                    firstFlag = false;
                }
                else
                {
                    var outPage = $("#content>article");
                    var oldUrl = oldPage.replace("#", "");
                    if(velika[oldUrl]) velika[oldUrl].dispos();
                    outPage.remove();
                    $("#content").append(page);
                }

                if(velika[url]) velika[url].init();

                

                oldPage = currentPage;
            });
        }
        
        
        function initSound()
        {
           

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


            $('#home').css({'height':($(window).height())+'px'});
            $(window).resize(function(){
                $('#home').css({'height':($(window).height())+'px'});

                //Navigation		
                $('ul.slimmenu').on('click',function(){
                    var width = $(window).width(); 
                    if ((width <= 800)){ 
                        $(this).slideToggle(); 
                    }	
                });
            });

            $('ul.slimmenu').slimmenu(
            {
                resizeWidth: '800',
                collapserTitle: '',
                easingEffect:'easeInOutQuint',
                animSpeed:'medium',
                indentChildren: true,
                childrenIndenter: '&raquo;'
            });

            loadFooter();
            initSound();
        });

        $(window).load(function() {
            $("#status").fadeOut();
            $("#preloader").delay(350).fadeOut("slow");
        }) 




        return{
            
            gotoPage : function ( id )
            {
                //console.log("!!!"+id);
                location.href = "#"+id;
            },

            showGalleryModal : function ( id )
            {
                $("#gallery_layer").show();
                $("#gallery_overay").scrollTop(0);
                TweenMax.to($("#gallery_overay"), 0, {y:$(window).height()});
                TweenMax.to($("#gallery_overay"), 1, {y:0, ease:Expo.easeInOut});
                TweenMax.to($("#gallery_layer .contents_close"), 0, {y:-200});
                TweenMax.to($("#gallery_layer .contents_close"), 1, {delay:0.3, y:0, ease:Expo.easeInOut});
                
            },
            hideGalleryModal : function ()
            {
                $("#gallery_layer").hide();
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


    // about 클래스
    velika.about = (function ()
    {

        return {

            init : function ()
            {
                $("#owl-about").owlCarousel({
 
                    navigation : false, 
                    singleItem:true,
                    autoPlay:6000,
                    transitionStyle: "fade",
                    addClassActive: true,
                });
 
                $("#owl-family").owlCarousel({

                    itemsCustom : [
                        [0, 2],
                        [450, 2],
                        [600, 3],
                        [700, 4],
                        [900, 7]
                    ],
                    navigation : false
                });
            },

            dispos : function ()
            {
                 $("#owl-about").trigger('remove.owl.carousel', 0);
                 $("#owl-family").trigger('remove.owl.carousel', 0);
            }
        }
    })();


    // service 클래스
    velika.service = (function ()
    {
        return {

            init : function ()
            {

            },

            dispos : function ()
            {
                
            }
        }
    })();

    // gallery1 클래스
    velika.gallery1 = (function ()
    {
        return {

            init : function ()
            {

            },

            dispos : function ()
            {
                
            }
        }
    })();

    // gallery2 클래스
    velika.gallery2 = (function ()
    {
        return {

            init : function ()
            {

            },

            dispos : function ()
            {
                
            }
        }
    })();

    // contact 클래스
    velika.contact = (function ()
    {
        
        function initGmap()
        {
            var Y_point			= 37.4885180;		// Y 좌표
            var X_point			= 126.9971806;		// X 좌표
            var zoomLevel		= 18;						// 지도의 확대 레벨 : 숫자가 클수록 확대정도가 큼
            var markerTitle		= "벨리카";				// 현재 위치 마커에 마우스를 오버을때 나타나는 정보

            var myLatlng = new google.maps.LatLng(Y_point, X_point);
            var mapOptions = {
                zoom: zoomLevel,
                center: myLatlng,
                scrollwheel: false,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);

            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: markerTitle
            });

            var infowindow = new google.maps.InfoWindow({
                maxWidth: markerMaxWidth
            });

            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map, marker);
            });
        }


        return {

            init : function ()
            {
                initGmap();
            },

            dispos : function ()
            {
                
            }
        }
    })();

    // qna 클래스
    velika.qna = (function ()
    {
        return {

            init : function ()
            {

            },

            dispos : function ()
            {
                
            }
        }
    })();



    window.Velika = velika;

})(jQuery);

var velika = new Velika();