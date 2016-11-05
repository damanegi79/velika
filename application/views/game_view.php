<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

                    <!-- video_player -->
                    <div class="video_player">
                        
                        <p class="date_con"><?= $date ?></p>
                        
                        <div class="player_360" style="background-color:#000">
                            <?Php if( $this->agent->is_mobile()) : ?>
                                <?Php if( $this->agent->platform() == 'Android') : ?>
                                    <style type="text/css">
                                        #gameCon{position:relative;width:100%;height:100%;background-color:#000;margin:0px}
                                        #videoCon{width:100%;height:100%;position:absolute;top:0;left:0;display:none}
                                        #canvas3d{width:100%;height:100%;position:absolute;top:0;left:0;}
                                        #gameCanvas{width:100%;height:100%;background-color:transparent;position:relative}
                                        #fullscreen_btn{position:absolute;bottom:10px;right:10px;background-color:transparent}
                                        .guide_txt{color:#fff;text-align:center}
                                    </style>
                                    <script type="text/javascript">var sourcePath = "<?= $video_list->game_path ?>/";</script>
                                    <script type="text/javascript" src="https://code.createjs.com/createjs-2015.11.26.min.js"></script>
                                    <script type="text/javascript" src="/assets/js/greensock/TweenMax.min.js"></script>
                                    <script type="text/javascript" src="/assets/js/greensock/plugins/CSSPlugin.min.js"></script>
                                    <script type="text/javascript" src="/assets/js/Three.js"></script>
                                    <script type="text/javascript" src="/assets/js/deviceOrientationControls.js"></script>
                                    <script type="text/javascript" src="/assets/js/common.js"></script>
                                    <script type="text/javascript" src="/assets/game/video3d.js"></script>
                                    <script type="text/javascript" src="/assets/game/player.js"></script>
                                    <script type="text/javascript" src="/assets/game/main_mobile.js"></script>
                                    <script type="text/javascript">

                                        var gameCanvas, stage, exportRoot;
                                        var gameData;
                                        var gameAudio;
                                        var fullSize;
                                        

                                        resizeWindow();

                                        $(function ()
                                        {
                                            gameCanvas = $("#gameCanvas")[0];
                                            images = images||{};
                                            var loader = new createjs.LoadQueue(false);
                                            loader.addEventListener("fileload", handleFileLoad);
                                            loader.addEventListener("complete", handleComplete);
                                            loader.loadManifest(lib.properties.manifest);

                                            $(document).bind("webkitfullscreenchange mozfullscreenchange fullscreenchange", function (e)
                                            {
                                                if(document.fullScreen || document.mozFullScreen || document.webkitIsFullScreen)
                                                {
                                                    $("#gameCon").css({position:"fixed", width:"100%", height:"100%", "z-index":9999999, top:0, left:0});
                                                    $("html, body").css({overflow:"hidden"});
                                                    fullSize = true;
                                                }
                                                else
                                                {
                                                    $("#gameCon").css({position:"", width:"", height:"", "z-index":""});
                                                    $("html, body").css({overflow:""}); 
                                                    fullSize = false;
                                                }
                                                $(window).resize();
                                            });

                                            $(window).bind("resize", function ()
                                            {
                                                if(fullSize)
                                                {
                                                    var per =  $(window).width() / 1920;
                                                    $("#canvas3d").css({height:1080*per, top:($(window).height() - (1080*per))/2});
                                                    $("#gameCanvas").css({height:1080*per, top:($(window).height() - (1080*per))/2});
                                                }
                                                else
                                                {
                                                    $("#canvas3d").css({height:"", top:""});
                                                    $("#gameCanvas").css({height:"", top:""});
                                                }
                                            });
                                        });

                                        function handleFileLoad(evt) 
                                        {
                                            if (evt.item.type == "image") 
                                            { 
                                                images[evt.item.id] = evt.result; 
                                            }
                                        }

                                        function handleComplete(evt) 
                                        {
                                            exportRoot = new lib.main_mobile();
                                            stage = new createjs.Stage(gameCanvas);	
                                            stage.addChild(exportRoot);
                                            stage.update();
                                            createjs.Ticker.setFPS(lib.properties.fps);
                                            createjs.Ticker.addEventListener("tick", stage);
                                            loadGameData();
                                        }

                                        function loadGameData()
                                        {
                                            var loader = new createjs.XMLLoader( new createjs.LoadItem().set({src:sourcePath+"xml/data_mobile.xml?"+Math.random()*1000}) );
                                            loader.addEventListener("complete", gameDataLoadComp);
                                            loader.load();
                                        }

                                        function gameDataLoadComp(e)
                                        {
                                            gameData = $( new DOMParser().parseFromString(e.target._rawResult, "text/xml") );
                                            exportRoot.initGame();
                                        }

                                    </script>

                                    <div id="gameCon">
                                        <video id="videoCon" src="" preload="none"></video>
                                        <div id="canvas3d"></div>
                                        <canvas id="gameCanvas" width="1920" height="1080"></canvas>
                                    </div>
                                <?Php else : ?>
                                    <style type="text/css">
                                        .player_360{display:table}
                                        .guide_txt{color:#fff;text-align:center;display:table-cell;vertical-align:middle;font-size:18px}
                                    </style>
                                    <p class="guide_txt">지원하지 않는 단말기입니다.</p>
                                <?Php endif; ?>
                                
                                
                            <?Php else : ?>
                                
                                <div id="flashContent">
                                    <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="100%" height="100%" id="main" align="middle">
                                        <param name="movie" value="/assets/game/main.swf" />
                                        <param name="quality" value="high" />
                                        <param name="bgcolor" value="#000000" />
                                        <param name="play" value="true" />
                                        <param name="loop" value="true" />
                                        <param name="wmode" value="window" />
                                        <param name="scale" value="showall" />
                                        <param name="menu" value="true" />
                                        <param name="devicefont" value="false" />
                                        <param name="salign" value="" />
                                        <param name="allowScriptAccess" value="sameDomain" />
                                        <param name="allowFullScreen" value="true" />
                                        <param name="flashVars" value="sourcePath=<?=$video_list->game_path?>/" />
                                        <param name="base" value="." />
                                        <!--[if !IE]>-->
                                        <object type="application/x-shockwave-flash" data="/assets/game/main.swf" width="100%" height="100%">
                                            <param name="movie" value="/assets/game/main.swf" />
                                            <param name="quality" value="high" />
                                            <param name="bgcolor" value="#000000" />
                                            <param name="play" value="true" />
                                            <param name="loop" value="true" />
                                            <param name="wmode" value="window" />
                                            <param name="scale" value="showall" />
                                            <param name="menu" value="true" />
                                            <param name="devicefont" value="false" />
                                            <param name="salign" value="" />
                                            <param name="allowScriptAccess" value="sameDomain" />
                                            <param name="allowFullScreen" value="true" />
                                            <param name="flashVars" value="sourcePath=<?=$video_list->game_path?>/" />
                                            <param name="base" value="." />
                                        <!--<![endif]-->
                                            <a href="http://www.adobe.com/go/getflash">
                                                <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
                                            </a>
                                        <!--[if !IE]>-->
                                        </object>
                                        <!--<![endif]-->
                                    </object>
                                </div>
                            
                            <?Php endIf; ?> 
                            
                            
                        </div>
                        
                        <div class="info_con">
                            <h4 class="title">
                               <?= $video_list->videoTitle ?> 
                            </h4>
                            <p class="text">
                               <?= nl2br($video_list->decsribe) ?> 
                            </p>
                            
                            <div class="info">
                                <dl>
                                    <dt>Category</dt>
                                    <dd><?= strtoupper($cate) ?></dd>
                                </dl>
                                <dl>
                                    <dt>Grade</dt>
                                    <dd>All</dd>
                                </dl>
                            </div>
                            
                            <div class="count_con"><?= number_format($count) ?> </div>
                        </div>
                        
                    </div>
                    <!-- //video_player -->