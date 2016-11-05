<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    
        <script id="videoListTemp" type="text/x-jquery-tmpl">
            <li class="element-item ${category}" data-category="${category}" data-id="${id}">
                    <a href="/video?cate=${category}&id=${id}">
                    <div class="thum_con">
                        <img src="${thumbPath}" alt="${videoTitle}" />
                        <span class="bl"></span>
                    </div>
                    <div class="text_con">
                        <h4>[${subCategory}] ${videoTitle}</h4>
                        <p>${viewCount}</p>
                    </div>
                </a>
            </li>
        </script> 
        
        <script type="text/javascript">
        
            $(function ()
            {
                UI.initVideoList(8, "<?= $cate ?>", 4);
                $(window).bind("resize", resizeWindow);
                
            });
            
            function resizeWindow(e)
            {
                var per = $(".player_360").width()/920;
                $(".player_360").css({height:508*per});  
            }
           
        </script>
        <section class="content">
            
            <!-- videos -->    
            <div class="videos">
                <!-- player_content -->
                <div class="player_content">
                    
                    <!-- search_con -->
                    <div class="search_con">
                        <form action="/vr360" method="GET">
                            <input name="keyword" type="text">
                            <button class="color_trans_btn" onClick="" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <!-- //search_con -->
                    
                    <?php
                        if($video_list->category != 'interaction')
                        {
                            $this->load->view('player_view');
                        }
                        else
                        {
                            $this->load->view('game_view');
                        }
                    ?>
                    
                </div>
                <!-- //player_content -->
                
                <!-- video_list -->
                <div class="video_list">
                    
                    <h4 class="title_con">
                        <?= strtoupper($cate) ?> <span>Related Content Videos</span>  
                    </h4>
                    
                    <ul id="videoList">
                        
                    </ul>  
                      
                </div>
                <!-- //video_list -->
                
                <!-- more_btn -->
                <div class="more_btn" data-rol="video-more">
                    <a class="color_trans_btn" href="javascript:"><span class="blind">More</span></a>
                </div>
                <!-- //more_btn -->
                
            </div>
            <!-- //videos -->    
        </section>
        
        
        
