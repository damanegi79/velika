<script type="text/javascript">
$(function ()
{
	$("select[name='cate_slt']").bind("change", function ( e )
	{
		if($(this).find("option:selected").text() == "INTERACTION")
		{
			$(".game-tr").css({display:"table-row"});
			$(".pass-tr").css({display:"none"});
		}
		else
		{
			$(".game-tr").css({display:"none"});
			$(".pass-tr").css({display:"table-row"});
		}
	});
	$("select[name='cate_slt']").trigger("change");

	$("#enter_btn").bind("click", function ( e )
	{
		if($("#sub_cate_txt").val() == "")
		{
			alert("서브 카테고리를 입력하세요.");
			$("#sub_cate_txt").focus();
			return;
		}
		
		if($("#title_txt").val() == "")
		{
			alert("제목을 입력하세요.");
			$("#title_txt").focus();
			return;
		}
		
		if($("#desc_txt").val() == "")
		{
			alert("내용을 입력하세요.");
			$("#desc_txt").focus();
			return;
		}
		
		for(var i = 0; i<$("input[id*='video_path']").length; i++)
		{
			if($("select[name='cate_slt'] option:selected").text() != "INTERACTION")
			{
				if($("input[id*='video_path']").eq(i).val() == "")
				{
					alert("동영상경로를 입력하세요.");
					$("input[id*='video_path']").eq(i).focus();
					return;
				}
			}
		}
		
		if($("#game_path").val() == "")
		{
			if($("select[name='cate_slt'] option:selected").text() == "INTERACTION")
			{
				alert("게임경로를 입력하세요.");
				$("#game_path").focus();
				return;
			}
		}
		
		 
		if($("#upload_file").val())
		{
			$('#upload_form').append($("#upload_file"));
			$("#upload_con").html('<input class="form-control" id="upload_file" name="userfile" type="file">');
			$('#upload_form').ajaxForm({success: function(data)
			{
				
				if(data)
				{
					$("#thumb_path").val(data);
					$("#upload_video").submit();
				}
				else 
				{
					alert("파일 업로드 실패");
				}
				$('#upload_form').empty();
			}});
			$('#upload_form').submit();
		}
		else 
		{
			alert("썸네일을 첨부하세요.");
			return;
		}


		
	});
});

</script>


		<!-- page-wrapper -->
		<div id="page-wrapper">
			
			<!-- //Page Heading -->
            <div class="container-fluid">
				
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           	VIDEO 관리
                        </h1>
                    </div>
                </div>
				<!-- //Page Heading -->
				
				<form id="upload_video" action="/admin/video_upload" method="POST">
                <div class="row text-center" style="position:relative;">
                    <div class="col-lg-10">
                        <div class="list_con">
                            <table class="table table-bordered table-hover">
                            	<colgroup>
                            		<col width="10%">
                            		<col width="">
                            	</colgroup>
                                <tbody>
                                	 <tr>
                                    	<th class="text-center" style="vertical-align:middle">카테고리</th>
                                        <td class="text-left">
                                        	<select	name="cate_slt" class="form-control" style="width:200px">
							                    <option value="entertainment" selected>ENTERTAINMENT</option>
							                    <option value="music">MUSIC</option>
							                    <option value="interaction">INTERACTION</option>
							                    <option value="sports">SPORTS</option>
												<option value="travel">TRAVEL</option>
												<option value="drama">DRAMA</option>	
							                </select>	
										</td>
                                    </tr>
									<tr>
                                    	<th class="text-center" style="vertical-align:middle">서브 카테고리</th>
                                        <td class="text-left">
											<input class="form-control" id="sub_cate_txt" name="sub_cate_txt" type="text" style="width:100%">
										</td>
                                    </tr>
                                    <tr>
                                    	<th class="text-center" style="vertical-align:middle">제목</th>
                                        <td class="text-left">
											<input class="form-control" id="title_txt" name="title_txt" type="text" style="width:100%">
										</td>
                                    </tr>
                                     <tr>
                                    	<th class="text-center" style="vertical-align:middle">내용</th>
                                        <td class="text-left">
                                        	<textarea class="form-control" name="desc_txt" id="desc_txt" style="width:100%;height:100px"></textarea>
									   </td>
                                    </tr>
									 <tr>
                                    	<th class="text-center" style="vertical-align:middle">썸네일</th>
                                        <td class="text-left">
                                        	<div class="col-lg-3" id="upload_con" style="padding-left:0">
                								<input class="form-control" id="upload_file" name="userfile" type="file">
                                        	</div>
                                        	<span><font color="#ff0000">썸네일 사이즈 372 * 210</font></span>
                                        </td>
                                    </tr>
									<tr class="game-tr" style="display:none">
                                    	<th class="text-center" style="vertical-align:middle">게임 경로</th>
                                        <td class="text-left">
                                        	<div class="col-lg-3" id="upload_con2" style="padding-left:0">
												<input class="form-control" id="game_path" name="game_path" type="text" style="width:100%">
                                        	</div>
                                        </td>
                                    </tr>
									<tr class="pass-tr" style="display:none">
                                    	<th class="text-center" style="vertical-align:middle">동영상 경로(2160)</th>
                                        <td class="text-left">
											<input class="form-control" id="video_path_2160" name="video_path_2160" type="text" style="width:100%">
										</td>
                                    </tr>
									<tr class="pass-tr" style="display:none">
                                    	<th class="text-center" style="vertical-align:middle">동영상 경로(1080)</th>
                                        <td class="text-left">
											<input class="form-control" id="video_path_1080" name="video_path_1080" type="text" style="width:100%">
										</td>
                                    </tr>
									<tr class="pass-tr" style="display:none">
                                    	<th class="text-center" style="vertical-align:middle">동영상 경로(720)</th>
                                        <td class="text-left">
											<input class="form-control" id="video_path_720" name="video_path_720" type="text" style="width:100%">
										</td>
                                    </tr>
									<tr class="pass-tr" style="display:none">
                                    	<th class="text-center" style="vertical-align:middle">동영상 경로(540)</th>
                                        <td class="text-left">
											<input class="form-control" id="video_path_540" name="video_path_540" type="text" style="width:100%">
										</td>
                                    </tr>
									<tr class="pass-tr" style="display:none">
                                    	<th class="text-center" style="vertical-align:middle">동영상 경로(480)</th>
                                        <td class="text-left">
											<input class="form-control" id="video_path_480" name="video_path_480" type="text" style="width:100%">
										</td>
                                    </tr>
									<tr class="pass-tr" style="display:none">
                                    	<th class="text-center" style="vertical-align:middle">동영상 경로(360)</th>
                                        <td class="text-left">
											<input class="form-control" id="video_path_360" name="video_path_360" type="text" style="width:100%">
										</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
				<input type="hidden" id="thumb_path" name="thumb_path">
                </form>
				
				<form id="upload_form" action="/admin/upload_file" method="post" enctype="multipart/form-data" style="display:none"></form>  
                
                <div class="row text-center" style="position:relative;">
                	<div class="col-lg-10">
                		<button type="button" id="enter_btn" class="btn btn-primary" style="width:80px">작성완료</button>
                	   <a href="/admin/video" type="button" class="ml10 btn btn-danger" style="width:80px">취소</a>
					</div>
                </div>
                  

            </div>
           <!-- //Page Heading -->
        </div>
        <!-- //page-wrapper -->