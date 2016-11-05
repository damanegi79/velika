
<!DOCTYPE html>
<html lang="ko">
<head>
<title>DOORIBUN - 관리자</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="blac">
<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/assets/css/admin.css" />
<link rel="stylesheet" type="text/css" href="/assets/font-awesome/css/font-awesome.min.css" />
<script type="text/javascript" src="/assets/js/jquery.js"></script>
<script type="text/javascript" src="/assets/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="/assets/js/jquery.placeholder.js"></script>
<script type="text/javascript" src="/assets/js/greensock/TweenMax.min.js"></script>
<script type="text/javascript" src="/assets/js/greensock/plugins/CSSPlugin.min.js"></script>
<script type="text/javascript" src="/assets/js/modernizr-1.5.min.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/js/common.js"></script>
<script type="text/javascript">
<?php if(isset($errorMsg)):?>
alert("<?=$errorMsg?>");
window.history.back();
<?php endif;?>
</script>
</head>
<body style="background-color:#fff;overflow-x:hidden">
    <div id="wrapr" style="text-align:center">
    	<div class="row">
			<div class="col-md-12 center login-header">
				<h1>DOORIBUN 로그인</h1>
			</div>
		</div>
        <div class="row">
           <div class="well col-md-5 center login-box" style="float:none;margin:30px auto 0 auto;width:500px">
			<div class="alert alert-info">
				관리자 아이디와 패스워드를 입력 해주세요.
			</div>
			<form class="form-horizontal" action="/admin/login_check" method="post">
			<fieldset>
				<div class="input-group input-group-lg">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
				<input type="text" class="form-control" name="loginId" placeholder="ID">
				</div>
				<div class="clearfix"></div><br>
				<div class="input-group input-group-lg">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
				<input type="password" class="form-control" name="loginPass" placeholder="Password">
				</div>
				<div class="clearfix"></div>
				<div class="clearfix"></div>
				<p class="center" style="margin-top:10px">
				<button type="submit" class="btn btn-primary">Login</button>
				</p>
			</fieldset>
			</form>
			</div>
         </div>
                 
    </div>
    <!-- /#wrapper -->
   
</body>
</html>