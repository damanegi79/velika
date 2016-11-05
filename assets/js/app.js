(function ($){


    


    var velika = velika || function ()
    {
        var pageAr = ["home", "about", "service", "gallery1", "gallery2", "contact", "qna"];
        var currentPage = "";
        var firstFlag = true;



        function loadPage()
        {
            var html = "";
            $.get("/html/"+currentPage+".html", function ( data )
            {
                if(firstFlag)
                {
                    $("#content").append(data);
                    firstFlag = false;
                }
                else
                {
                    
                }
                velika[currentPage].init();

            });
        }


        $(function ()
        {
            currentPage = location.hash;
            if(currentPage == "") currentPage = "home";

            $(window).on("hashchange", function ( e )
            {
                currentPage = location.hash;
                loadPage();
            });
            loadPage();
        });




        return{
            
            gotoPage : function ( id )
            {
                location.href = "#"+id;
            }
        };
    };


    // 홈 클래스
    velika.home = (function ()
    {
        var timer;


        return{
            init : function ()
            {
                $(".rotator > div:gt(0)").hide();
                timer = setInterval(function() { 
                  $('.rotator > div:first')
                    .fadeOut(4000)
                    .next()
                    .fadeIn(4000)
                    .end()
                    .appendTo('.rotator');
                },  5000);
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