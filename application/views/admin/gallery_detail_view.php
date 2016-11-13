<script type="text/javascript">
$(function ()
{
	

	$("#modify_btn").bind("click", function ( e )
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
			$("#title_txt").focus();
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
			$("#upload_con").html('<input class="form-control" id="upload_file" name="userfile" name="userfile" type="file">');
			$('#upload_form').ajaxForm({success: function(data)
			{
			     if(data)
			     {
				    $("#thumb_path").val(data);
					$("#modify_form").submit();
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
			$("#modify_form").submit();
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
				
				<form id="modify_form" action="/admin/gallery_modify" method="POST">
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
							                    <option value="1" <?php if($gallery_list->category == '1') echo 'selected'; ?>>GALLERY1</option>
							                    <option value="2" <?php if($gallery_list->category == '2') echo 'selected'; ?>>GALLERY2</option>
							                </select>	
										</td>
                                    </tr>
                                    <tr>
                                    	<th class="text-center" style="vertical-align:middle">타이틀</th>
                                        <td class="text-left">
											<input class="form-control" id="title_txt" name="title_txt" type="text" style="width:100%" value="<?= $gallery_list->title ?>">
										</td>
                                    </tr>
									<tr>
                                    	<th class="text-center" style="vertical-align:middle">서브 타이틀</th>
                                        <td class="text-left">
											<input class="form-control" id="sub_title_txt" name="sub_title_txt" type="text" style="width:100%" value="<?= $gallery_list->subTitle ?>">
										</td>
                                    </tr>
									<tr>
                                    	<th class="text-center" style="vertical-align:middle">썸네일</th>
                                        <td class="text-left">
											<div class="col-lg-2" style="padding-left:0">
                                        		<img src="<?= $gallery_list->thumbPath ?>" style="width:100px;height:auto;border:solid 1px #c6c6c6" />
                                        	</div>
                                        	<div class="col-lg-3" id="upload_con" style="padding-left:0">
                								<input class="form-control" id="upload_file" name="userfile" name="userfile" type="file">
                                        	</div>
                                        	<span><font color="#ff0000">썸네일 사이즈 600 * 400</font></span>
                                        </td>
                                    </tr>
									<tr>
                                    	<th class="text-center" style="vertical-align:middle">내용</th>
                                        <td class="text-left">
                                        	<textarea class="form-control" name="editor" id="editor" style="width:100%;height:100px"><?= $gallery_list->content ?></textarea>
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
				<input type="hidden" id="thumb_path" name="thumb_path" value="<?=$gallery_list->thumbPath ?>">
				<input type="hidden" name="id" value="<?= $gallery_list->id ?>">
				<input type="hidden" name="prev" value="/admin/gallery<?= '?cate='.$cate.'&per_page='.$page.'&id='.$gallery_list->id ?>">
                </form>
				
				<form id="upload_form" action="/admin/upload_file" method="post" enctype="multipart/form-data" style="display:none"></form> 
                
				<div class="row text-center" style="position:relative;">
                	<div class="col-lg-12">
                		<button type="button" id="modify_btn" class="btn btn-warning" style="width:80px">수정하기</button>
                		
                		<form id="delete_form" action="/admin/gallery_delete" method="POST">
                			<input name="chk_list[]" type="hidden" value="<?= $gallery_list->id ?>">
                			<input type="hidden" name="prev" value="/admin/gallery<?= '?cate='.$cate.'&per_page='.$page ?>">
                			<button type="submit" id="delete_btn" class="ml10 btn btn-danger" style="width:80px">삭제하기</button>
                		</form>
                	    <a href="/admin/gallery?<?= 'cate='.$cate.'&per_page='.$page ?>" type="button" class="ml10 btn btn-primary" style="width:80px">리스트</a>
					</div>
                </div>
				
                  

            </div>
           <!-- //Page Heading -->
        </div>
        <!-- //page-wrapper -->