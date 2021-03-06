<script type="text/javascript">
$(function ()
{

	$("#enter_btn").bind("click", function ( e )
	{
		
		if($("#title_txt").val() == "")
		{
			alert("타이틀을 입력하세요.");
			$("#title_txt").focus();
			return;
		}

		if($("#sub_title_txt").val() == "")
		{
			alert("서브타이틀을 입력하세요.");
			$("#sub_title_txt").focus();
			return;
		}
		
		
		
		 
		if($("#upload_file").val())
		{
			if(CKEDITOR.instances.editor.getData() == "")
			{
				alert("내용을 입력하세요.");
				return;		
			}
			$('#upload_form').append($("#upload_file"));
			$("#upload_con").html('<input class="form-control" id="upload_file" name="userfile" type="file">');
			$('#upload_form').ajaxForm({success: function(data)
			{
				
				if(data)
				{
					$("#editor").val(CKEDITOR.instances.editor.getData());
					$("#thumb_path").val(data);
					$("#upload_gallery").submit();
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
                           	GALLERY 관리
                        </h1>
                    </div>
                </div>
				<!-- //Page Heading -->
				
				<form id="upload_gallery" action="/admin/gallery_upload" method="POST">
                <div class="row text-center" style="position:relative;">
                    <div class="col-lg-12">
                        <div class="list_con">
                            <table class="table table-bordered table-hover">
                            	<colgroup>
                            		<col width="15%">
                            		<col width="">
                            	</colgroup>
                                <tbody>
                                	 <tr>
                                    	<th class="text-center" style="vertical-align:middle">카테고리</th>
                                        <td class="text-left">
                                        	<select	name="cate_slt" class="form-control" style="width:200px">
							                    <option value="1" <?php if($cate == '1') echo 'selected'; ?>>GALLERY1</option>
							                    <option value="2" <?php if($cate == '2') echo 'selected'; ?>>GALLERY2</option>
							                </select>	
										</td>
                                    </tr>
                                    <tr>
                                    	<th class="text-center" style="vertical-align:middle">타이틀</th>
                                        <td class="text-left">
											<input class="form-control" id="title_txt" name="title_txt" type="text" style="width:100%">
										</td>
                                    </tr>
									<tr>
                                    	<th class="text-center" style="vertical-align:middle">서브 타이틀</th>
                                        <td class="text-left">
											<input class="form-control" id="sub_title_txt" name="sub_title_txt" type="text" style="width:100%">
										</td>
                                    </tr>
									<tr>
                                    	<th class="text-center" style="vertical-align:middle">썸네일</th>
                                        <td class="text-left">
                                        	<div class="col-lg-3" id="upload_con" style="padding-left:0">
                								<input class="form-control" id="upload_file" name="userfile" type="file">
                                        	</div>
                                        	<span><font color="#ff0000">썸네일 사이즈 600 * 400</font></span>
                                        </td>
                                    </tr>
                                     <tr>
                                    	<th class="text-center" style="vertical-align:middle">내용</th>
                                        <td class="text-left">
                                        	<textarea class="form-control" name="editor" id="editor" style="width:100%;height:100px"></textarea>
											<script>
												CKEDITOR.replace( 'editor' , {filebrowserImageUploadUrl:'/admin/upload_edit',height:400});
											</script> 
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
                	<div class="col-lg-12">
                		<button type="button" id="enter_btn" class="btn btn-primary" style="width:80px">작성완료</button>
                	   <a href="/admin/gallery" type="button" class="ml10 btn btn-danger" style="width:80px">취소</a>
					</div>
                </div>
                  

            </div>
           <!-- //Page Heading -->
        </div>
        <!-- //page-wrapper -->