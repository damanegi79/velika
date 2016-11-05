<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
        <script type="text/javascript">
           $(function ()
           {
               var lat = "37.5593313";
               var lon = "126.9193644";
               var mapOptions = {
                        zoom: 17, 
                        zoomControl:true,
                        zoomControlOptions: {
                            style:google.maps.ZoomControlStyle.DEFAULT
                        },
                        center: new google.maps.LatLng(lat, lon),
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        scrollwheel: true,
                }
                
                var map = new google.maps.Map(document.getElementById("g_map"), mapOptions);
                
                var content = '<h4>큐플랜</h4>\
                                <p class="addr">서울특별시 마포구 연남로1길 70, 성원빌딩 5층</p>\
                                <p class="tel">TEL : <a href="tel://+82-33-435-4962">+82-2-325-3926</a></p>';
                var infowindow = new google.maps.InfoWindow({
                    content: content
                });

                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(lat, lon),
                    map: map,
                    title: '큐플랜'
                });
                infowindow.open(map, marker);
           });
            

        </script>

        <section class="content">
            
            <!-- contact -->
            <div class="contact">
                
                <!-- contact_top -->
                <div class="contact_top">
                    <div class="ci_con">
                        <img src="/assets/images/contact/q_logo.png" alt="Q PLAN" />
                    </div>
                    
                    <div class="com_list">
                        <ul>
                            <li><span><img src="/assets/images/contact/com_img1.png" alt="" /></span></li>
                            <li><span><img src="/assets/images/contact/com_img2.png" alt="" /></span></li>
                            <li><span><img src="/assets/images/contact/com_img3.png" alt="" /></span></li>
                            <li><span><img src="/assets/images/contact/com_img4.png" alt="" /></span></li>
                        </ul>
                    </div>
                    
                    <div class="txt_con">
                        (주) 큐플랜은 미래 생활 변화에 의문을 가지고 디지털 콘텐츠 환경을 제공하는<br />
                        종합 매체 컨설팅을 지향하는 회사입니다.<br />
                        Cross-Media-Communication을 통해 고객의 요구에 적합한 방향을 설정하여<br />
                        양질의 콘텐츠 서비스와 창의적인 콘텐츠 제작, 프로모션을 제공합니다.
                    </div>
                    
                </div>
                <!-- //contact_top -->
                <!-- map_container -->
                <div class="map_container">
                    <div id="g_map"></div>
                </div>
                <!-- //map_container -->
                
            </div>
            <!-- //contact -->
        </section>
        
        
        
