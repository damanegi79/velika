<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

        <script type="text/javascript">
            $(function ()
            {
                UI.initVideoList(12, "<?= $sort ?>", 3);
                
                var focusFlag = false;
                
                $(".search_con button").bind("click", function ( e )
                {
                    clickSearch();
                });
                
                $(window).bind("keyup", function ( e )
                {
                    if(e.keyCode == 13 && focusFlag == true)
                    {
                        clickSearch();
                    }
                });
                
                $(".search_con input[type='text']").bind("focusin", function (e)
                {
                    focusFlag = true;
                });
                
                $(".search_con input[type='text']").bind("focusout", function (e)
                {
                    focusFlag = false;
                });
                
                function clickSearch()
                {
                    if($(".search_con input[type='text']").val() != "")
                    {
                        var txt = $(".search_con input[type='text']").val();
                        UI.searchVideoList(encodeURIComponent (txt) );
                    }
                    else
                    {
                        alert("검색어를 입력해주세요.");   
                        $(".search_con input[type='text']").focus(); 
                    }
                }
                  
            });
        </script>
        
        
        <section class="content">
            
            <!-- vr360 -->    
            <div class="vr360">
                <!-- video_content -->
                <div class="video_content">
                    
                    <!-- list_top -->
                    <div class="list_top">
                        <!-- search_con -->
                        <div class="search_con">
                            <input type="text">
                            <button class="color_trans_btn" onClick="" type="button"><i class="fa fa-search"></i></button>
                        </div>
                        <!-- //search_con -->
                        <!-- sort_menu -->
                        <div class="sort_menu" data-role="video-sort">
                            <ul>
                                <span class="m1">
                                    <li <?Php if($sort == ""){ echo 'class="on"';} ?> data-filter="*">
                                        <a href="javascript:">All</a>
                                    </li>
                                    <li <?Php if($sort == "entertainment"){ echo 'class="on"';} ?> data-filter="entertainment">
                                        <a href="javascript:">Entertainment</a>
                                    </li>
                                    <li <?Php if($sort == "music"){ echo 'class="on"';} ?> data-filter="music">
                                        <a href="javascript:">Music</a>
                                    </li>
                                    <li <?Php if($sort == "interaction"){ echo 'class="on"';} ?> data-filter="interaction">
                                        <a href="javascript:">Interaction</a>
                                    </li>
                                </span>
                                <span class="m2">
                                    <li <?Php if($sort == "sports"){ echo 'class="on"';} ?> data-filter="sports">
                                        <a href="javascript:">Sports</a>
                                    </li>
                                    <li <?Php if($sort == "travel"){ echo 'class="on"';} ?> data-filter="travel">
                                        <a href="javascript:">Travel</a>
                                    </li>
                                    <li <?Php if($sort == "drama"){ echo 'class="on"';} ?> data-filter="drama">
                                        <a href="javascript:">Drama</a>
                                    </li>
                                </span>
                            </ul>
                        </div>
                        <!-- //sort_menu -->
                    </div>
                    <!-- //list_top -->
                    
                    <!-- video_list -->
                    <div class="video_list">
                        <ul id="videoList">
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
                        </ul>
                        <p class="empty_txt" data-role="empty-text">리스트가 없습니다.</p>
                    </div>
                    <!-- //video_list -->
                    
                    <!-- more_btn -->
                    <div class="more_btn" data-rol="video-more">
                        <a class="color_trans_btn" href="javascript:"><span class="blind">More</span></a>
                    </div>
                    <!-- //more_btn -->
                    
                </div>
                <!-- //video_content -->
            </div>
            <!-- //vr360 -->    
        </section>
        
        
        
