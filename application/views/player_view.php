<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

                    <!-- video_player -->
                    <div class="video_player">
                        
                        <p class="date_con"><?= $date ?></p>
                        
                        <div class="player_360" style="background-color:#000">
                            <?Php if($this->agent->is_mobile() || $this->agent->is_browser('Chrome')) : ?>
                                <?Php if(!$this->agent->is_mobile()) : ?>
                                <link rel="stylesheet" type="text/css" href="/assets/css/player.css" />
                                <?Php else : ?>
                                <link rel="stylesheet" type="text/css" href="/assets/css/playerM.css" />
                                <?Php endIf; ?>
                                <script src="/assets/js/player.js"></script>
                                <script src="/assets/js/video3d.js"></script>
                                <script src="/assets/js/Three.js"></script>
                                <script src="/assets/js/deviceOrientationControls.js"></script>
                                <script type="text/javascript">
                                   resizeWindow();
                                    $(function ()
                                    {
                                        var videoList = new Array();
                                        videoList[0] = "<?= $video_list->videoPath_2160 ?>";
                                        videoList[1] = "<?= $video_list->videoPath_1080 ?>";
                                        videoList[2] = "<?= $video_list->videoPath_720 ?>";
                                        videoList[3] = "<?= $video_list->videoPath_540 ?>";
                                        videoList[4] = "<?= $video_list->videoPath_480 ?>";
                                        videoList[5] = "<?= $video_list->videoPath_360 ?>";
                                        
                                        var player = new VideoPlayer($("#videoPlayer"), $("#videoController"),  $("#canvasCon"), videoList);	
                                    });
                                    
                                </script>
                                
                                <div id="videoPlayer">
		
                                    <!-- videoCon -->
                                    <video id="videoCon" src="" preload="none"> </video>
                                    <!-- //videoCon -->
                                    
                                    <!-- canvasCon -->
                                    <div id="canvasCon"></div>
                                    <!-- //canvasCon -->
                                    
                                    
                                    <?Php if(!$this->agent->is_mobile()) : ?>
                                    <!-- videoController -->
                                    <div id="videoController">
                                        <div class="controll">
                                            <div class="seek_con">
                                                <div class="seek_bar">
                                                    <span class="bar_con"></span>
                                                    <button class="bar_btn"></button>
                                                </div>
                                            </div>
                                            <div class="button_con">
                                                
                                                <div class="btn_left">
                                                    <button class="play_btn"><img src="/assets/images/player/play_btn.png" alt="재생" /></button>
                                                    
                                                    <div class="volume_con">
                                                        <button class="volume_btn"><img src="/assets/images/player/volume_btn.png" alt="볼륨" /></button>
                                                        <div class="volume_bar">
                                                            <div class="bar_bg"></div>
                                                            <div class="bar_con"></div>
                                                            <button class="bar_btn"></button>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="time_con">
                                                        <p class="current_time">00:00</p>
                                                        <span class="line"></span>
                                                        <p class="end_time">00:00</p>
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="btn_right">
                                                    
                                                    <div class="quality_con">
                                                        <button class="quality_btn">1080 S</button>
                                                        <div class="quality_list">
                                                            <ul>
                                                                <li><a href="javascript:">2160 S</a></li>
                                                                <li><a href="javascript:">1080 S</a></li>
                                                                <li><a href="javascript:">720 S</a></li>
                                                                <li><a href="javascript:">540 S</a></li>
                                                                <li><a href="javascript:">480 S</a></li>
                                                                <li><a href="javascript:">360 S</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>	
                                                   
                                                    <button class="fullscreen_btn"><img src="/assets/images/player/all_btn.png" alt="전체화면" /></button>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- //videoController -->
                                    
                                    <!-- videoLoading -->
                                    <div id="videoLoading"><img src="/assets/images/player/loading.png" alt="로딩" /></div>
                                    <!-- //videoLoading -->
                                    
                                    <!-- videoMap -->
                                    <div id="videoMap">
                                        <div class="rader"><img src="/assets/images/player/rader.png" /></div>
                                    </div>
                                    <!-- //videoMap -->
                                    
                                    <?Php else :  ?>
                                    
                                    
                                    <!-- videoController -->
                                    <div id="videoController">
                                        <div class="controll">
                                            
                                            <div class="seek_con">
                                                <div class="seek_bar">
                                                    <span class="bar_con"></span>
                                                    <button class="bar_btn"></button>
                                                </div>
                                            </div>
                                            
                                            <div class="button_con">
                                                
                                                <div class="time_con">
                                                    <p class="current_time">00:00</p>
                                                    <span class="line"></span>
                                                    <p class="end_time">00:00</p>
                                                </div>
                                                
                                                <button class="fullscreen_btn"><img src="/assets/images/player/all_btn.png" alt="전체화면" /></button>
                                                
                                            </div>
                                        </div>
                                        <!-- videoLoading -->
                                        <div id="videoLoading"><img src="/assets/images/player/loading.png" alt="로딩" /></div>
                                        <!-- //videoLoading -->
                                    
                                        <button class="play_btn play_btn_m"><img src="/assets/images/player/play_btn_m.png" alt="재생" /></button>
                                        
                                    </div>
                                    <!-- //videoController -->
                                    
                                    
                                    
                                    
                                    
                                    <?Php endif; ?>
                                    
                                </div>
                                
                                
                            <?Php else : ?>
                                
                                <div id="flashContent">
                                    <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="100%" height="100%" id="videoPlayer" align="middle">
                                        <param name="movie" value="/assets/flash/videoPlayer.swf" />
                                        <param name="quality" value="high" />
                                        <param name="bgcolor" value="#000000" />
                                        <param name="play" value="true" />
                                        <param name="loop" value="true" />
                                        <param name="wmode" value="window" />
                                        <param name="scale" value="showall" />
                                        <param name="menu" value="true" />
                                        <param name="devicefont" value="false" />
                                        <param name="salign" value="" />
                                        <param name="allowScriptAccess" value="always" />
                                        <param name="allowFullScreen" value="true" />
                                        <param name="flashVars" value="videoPath2160=<?= $video_list->videoPath_2160 ?>&videoPath1080=<?= $video_list->videoPath_1080 ?>&videoPath720=<?= $video_list->videoPath_720 ?>&videoPath540=<?= $video_list->videoPath_540 ?>&videoPath480=<?= $video_list->videoPath_480 ?>&videoPath360=<?= $video_list->videoPath_360 ?>" />
                                        
                                        <!--[if !IE]>-->
                                        <object type="application/x-shockwave-flash" data="/assets/flash/videoPlayer.swf" width="100%" height="100%">
                                            <param name="movie" value="/assets/flash/videoPlayer.swf" />
                                            <param name="quality" value="high" />
                                            <param name="bgcolor" value="#000000" />
                                            <param name="play" value="true" />
                                            <param name="loop" value="true" />
                                            <param name="wmode" value="window" />
                                            <param name="scale" value="showall" />
                                            <param name="menu" value="true" />
                                            <param name="devicefont" value="false" />
                                            <param name="salign" value="" />
                                            <param name="allowScriptAccess" value="always" />
                                            <param name="allowFullScreen" value="true" />
                                            <param name="flashVars" value="videoPath2160=<?= $video_list->videoPath_2160 ?>&videoPath1080=<?= $video_list->videoPath_1080 ?>&videoPath720=<?= $video_list->videoPath_720 ?>&videoPath540=<?= $video_list->videoPath_540 ?>&videoPath480=<?= $video_list->videoPath_480 ?>&videoPath360=<?= $video_list->videoPath_360 ?>" />
                                        <!--<![endif]-->
                                            <a href="http://www.adobe.com/go/getflash">
                                                <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Adobe Flash Player 가져오기" />
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