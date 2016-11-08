<!DOCTYPE html>
<html lang="ko">
<head>
<title>VELIKA - 관리자</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="blac">
<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/assets/css/admin.css" />
<script type="text/javascript" src="/assets/js/jquery.js"></script>
<script type="text/javascript" src="/assets/js/jquery.form.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="/assets/js/jquery.placeholder.js"></script>
<script type="text/javascript" src="/assets/js/greensock/TweenMax.min.js"></script>
<script type="text/javascript" src="/assets/js/greensock/plugins/CSSPlugin.min.js"></script>
<script type="text/javascript" src="/assets/js/modernizr-1.5.min.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/external/ckeditor/ckeditor.js"></script>

<style>
.al{text-align:left }
.ac{text-align:center }
.ar{text-align:right }
.vt{vertical-align:top }

.mt2{margin-top:2px }
.mt4{margin-top:4px }
.mt5{margin-top:5px }
.mt6{margin-top:6px }
.mt8{margin-top:8px }
.mt10{margin-top:10px }
.mt15{margin-top:15px }
.mt20{margin-top:20px }
.mt25{margin-top:25px }
.mt30{margin-top:30px }

.ml2{margin-left:2px }
.ml4{margin-left:4px }
.ml5{margin-left:5px }
.ml8{margin-left:8px }
.ml10{margin-left:10px }
.ml15{margin-left:15px }
.ml20{margin-left:20px }
.ml25{margin-left:25px }
.ml30{margin-left:30px }
form{display:inline}
</style>

<script type="text/javascript">

</script>
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/admin">VELIKA 관리자</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Administrator <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/" target="_blank"><i class="fa fa-fw fa-power-off"></i> 사이트 바로가기</a>
                        </li>
                        <li>
                            <a href="/admin"><i class="fa fa-fw fa-power-off"></i>로그아웃</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li <?Php if(strpos($this->uri->segment(2), "gallery") !== false){ echo 'class="active"';}?>>
                        <a href="/admin/gallery">GALLERY 관리</a>
                    </li>
                    <li <?Php if(strpos($this->uri->segment(2), "qna") !== false){ echo 'class="active"';}?>>
                        <a href="/admin/qna">Q&amp;A 관리</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>