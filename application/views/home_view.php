<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

        <script type="text/javascript">
            
            $(function ()
            {
               $(".banner_list li").each(function ( i )
               {
                   $(this).bind("mouseover", function ( e )
                   {
                       TweenMax.to($(this).find(".bind_box"), 0.6, {opacity:0.4});
                   });
                   
                   $(this).bind("mouseout", function ( e )
                   {
                       TweenMax.to($(this).find(".bind_box"), 0.6, {opacity:0});
                   });
                   
               });

               var swiper = new Swiper('.swiper-container', {
                    pagination: '.swiper-pagination',
                    nextButton: '.swiper-next',
                    prevButton: '.swiper-prev',
                    paginationClickable: true,
                    autoplay:3000,
                    autoplayStopOnLast:true,
                    autoplayDisableOnInteraction: false,
                    loop: true
                });
               
               $(".swiper-slide").click(function ( e )
               {
                   location.href = $(this).attr("data-link");
               });
            });
            
        </script>
        
        
        <section class="content">
            <!-- main -->    
            <div class="main">
                
                <!-- top_visual -->
                <div class="top_visual swiper-container-horizontal">
                    <div class="visual_set swiper-container">
                        <div class="swiper-wrapper">
                            <?php foreach($main_list as $list): ?>
                                <div class="swiper-slide" style="background-image:url(<?= $list->thumbPath; ?>)" data-link="<?= $list->linkPath; ?>"></div>
                            <?php endforeach; ?>
                        </div> 
                    </div>

                    <a class="swiper-prev" href="javascript:"><img src="/assets/images/main/btn_prev.png" alt="next" ></a>
                    <a class="swiper-next" href="javascript:"><img src="/assets/images/main/btn_next.png" alt="next" ></a>

                    <div class="swiper-pagination"></div>
                    
                </div>
                <!-- //top_visual -->
                
                <!-- vr_title -->
                <div class="vr_title">
                    <img src="/assets/images/main/deco_title.png" alt="360 VR" />
                </div>
                <!-- //vr_title -->
                
                <!-- banner_list -->
                <div class="banner_list">
                    <ul>
                        <li>
                            <a href="/vr360?sort=entertainment">
                                <div class="img_con">
                                    <img src="/assets/images/main/list_img1.png" alt="entertainment" />
                                    <span class="bind_box"></span>
                                </div>
                                <p class="title">ENTERTAINMENT</p>
                            </a>
                        </li>
                        <li>
                            <a href="/vr360?sort=music">
                                <div class="img_con">
                                    <img src="/assets/images/main/list_img2.png" alt="music" />
                                    <span class="bind_box"></span>
                                </div>
                                <p class="title">MUSIC</p>
                            </a>
                        </li>
                        <li>
                            <a href="/vr360?sort=drama">
                                <div class="img_con">
                                    <img src="/assets/images/main/list_img3.png" alt="drama" />
                                    <span class="bind_box"></span>
                                </div>
                                <p class="title">DRAMA</p>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- //banner_list -->
                
                <!-- banner_list -->
                <div class="banner_list">
                    <ul>
                        <li>
                            <a href="/vr360?sort=sports">
                                <div class="img_con">
                                    <img src="/assets/images/main/list_img4.png" alt="sports" />
                                    <span class="bind_box"></span>
                                </div>
                                <p class="title">SPORTS</p>
                            </a>
                        </li>
                        <li>
                            <a href="/vr360?sort=travel">
                                <div class="img_con">
                                    <img src="/assets/images/main/list_img5.png" alt="travel" />
                                    <span class="bind_box"></span>
                                </div>
                                <p class="title">TRAVEL</p>
                            </a>
                        </li>
                        <li>
                            <a href="/vr360?sort=interaction">
                                <div class="img_con">
                                    <img src="/assets/images/main/list_img6.png" alt="interaction" />
                                    <span class="bind_box"></span>
                                </div>
                                <p class="title">INTERACTION</p>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- //banner_list -->
                
            </div>
            <!-- //main -->    
        </section>
        
        
        
