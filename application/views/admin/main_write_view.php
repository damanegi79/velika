<script type="text/javascript">
$(function ()
{
	$("#enter_btn").bind("click", function ( e )
	{
		if($("#link_path").val() == "")
		{
			alert("링크를 입력하세요.");
			$("#link_path").focus();
			return;
		}
		
		 
		if($("#upload_file").val())
		{
			$('#upload_form').append($("#upload_file"));
			$("#upload_con").html('<input class="form-control" id="upload_file" name="userfile" name="userfile" type="file">');
			$('#upload_form').ajaxForm({success: function(data)
			{
			     if(data)
			     {
				    $("#thumb_path").val(data);
					$("#upload_mian").submit();
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
                           	메인페이지 관리
                        </h1>
                    </div>
                </div>
				<!-- //Page Heading -->
				
				<form id="upload_mian" action="/admin/main_upload" method="POST">
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
                                    	<th class="text-center" style="vertical-align:middle">썸네일</th>
                                        <td class="text-left">
                                        	<div class="col-lg-3" id="upload_con" style="padding-left:0">
                								<input class="form-control" id="upload_file" name="userfile" name="userfile" type="file">
                                        	</div>
                                        	<span><font color="#ff0000">썸네일 사이즈 1207 * 554</font></span>
                                        </td>
                                    </tr>
									<tr>
                                    	<th class="text-center" style="vertical-align:middle">링크</th>
                                        <td class="text-left">
											<input class="form-control" id="link_path" name="link_path" type="text" style="width:100%">
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
                	   <a href="/admin/main" type="button" class="ml10 btn btn-danger" style="width:80px">취소</a>
					</div>
                </div>
                  

            </div>
           <!-- //Page Heading -->
        </div>
        <!-- //page-wrapper -->