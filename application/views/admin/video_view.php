<script type="text/javascript">
$(function ()
{
	$(".list_con input[type='checkbox']").bind("change", function ( e )
	{
		
		if($(this).is(".chk_all"))
		{
			if( $(this).is(":checked") )	$(".chk_item").prop('checked', true);
			else 							$(".chk_item").prop('checked', false);
		}
		else
		{
			if(! $(this).is(":checked") )	$(".chk_all").prop('checked', false);
		}
	});

	$("#delete_btn").bind("click", function ( e )
	{
		if($(".chk_item:checked").length == 0)
		{
			alert("삭제할 리스트를 선택하세요.");
		}
		else
		{
			if(confirm("선택한 리스트를 삭제 하시겠습니까?"))
			{
				$("#delete_form").submit();
			}
		}
	});


	$("#sort_up_btn").bind("click", function ()
	{
		if($(".chk_item:checked").length == 0)
		{
			alert("위로 이동할 리스트를 선택하세요.");
		}
		else if($(".chk_item:checked").length > 1)
		{
			alert("위로 이동할 리스트를 한개만 선택하세요.");
		}
		else
		{
			$("#sort_from").append('<input type="hidden" name="arrow" value="up">');
			$("#sort_from").append('<input type="hidden" name="prev" value="/admin/video<?= '?cate='.$cate.'&per_page='.$page; ?>">');

			$(".list_con input[type='checkbox']").each( function ( i )
			{
				if( $(this).is(":checked") )
				{
					$("#sort_from").append('<input type="hidden" name="chk_id" value="'+ $(this).val() +'">');
					$("#sort_from").append('<input type="hidden" name="chk_num" value="'+ $(this).attr("view-num") +'">');
					$("#sort_from").submit();
				}
			});
		}
	});

	$("#sort_down_btn").bind("click", function ()
	{
		if($(".chk_item:checked").length == 0)
		{
			alert("아래로 이동할 리스트를 선택하세요.");
		}
		else if($(".chk_item:checked").length > 1)
		{
			alert("아래로 이동할 리스트를 한개만 선택하세요.");
		}
		else
		{
			$("#sort_from").append('<input type="hidden" name="arrow" value="down">');
			$("#sort_from").append('<input type="hidden" name="prev" value="/admin/video<?= '?cate='.$cate.'&per_page='.$page; ?>">');
			
			$(".list_con input[type='checkbox']").each( function ( i )
			{
				if( $(this).is(":checked") )
				{
					$("#sort_from").append('<input type="hidden" name="chk_id" value="'+ $(this).val() +'">');
					$("#sort_from").append('<input type="hidden" name="chk_num" value="'+ $(this).attr("view-num") +'">');
					$("#sort_from").submit();
				}
			});
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
				
				 <div class="row" style="position:relative;">
                	<div class="col-lg-8" style="margin:10px 0">
                	 	<a href="javascript:" id="delete_btn" class="btn btn-sm btn-danger" style="float:left;"type="button">삭제</a>
						<a href="javascript:" id="sort_up_btn" class="btn btn-sm btn-warning ml10" style="float:left;"type="button">위로 이동</a>
						<a href="javascript:" id="sort_down_btn" class="btn btn-sm btn-warning ml10" style="float:left;"type="button">아래로 이동</a>
	                	<select	id="cate_slt" class="form-control" style="width:200px;float:right">
		                    <option value="all" <?Php if($cate == "all"){ echo 'selected'; }?>>ALL</option>
		                    <option value="entertainment" <?Php if($cate == "entertainment"){ echo 'selected'; }?>>ENTERTAINMENT</option>
		                    <option value="music" <?Php if($cate == "music"){ echo 'selected'; }?>>MUSIC</option>
		                    <option value="interaction" <?Php if($cate == "interaction"){ echo 'selected'; }?>>INTERACTION</option>
		                    <option value="sports" <?Php if($cate == "sports"){ echo 'selected'; }?>>SPORTS</option>
							<option value="travel" <?Php if($cate == "travel"){ echo 'selected'; }?>>TRAVEL</option>
							<option value="drama" <?Php if($cate == "drama"){ echo 'selected'; }?>>DRAMA</option>	
		                </select>
	                </div>
                </div>
				
				
				<form id="delete_form" action="/admin/video_delete" method="POST">
                <div class="row text-center" style="position:relative;">
                    <div class="col-lg-8">
                        <div class="list_con">
                            <table class="table table-bordered table-hover">
                            	<colgroup>
                            		<col width="5%">
                            		<col width="8%">
                            		<col width="10%">
									<col width="12%">
                            		<col width="">
                            		<col width="15%">
									<col width="10%">
                            	</colgroup>
                                <thead>
                                    <tr>
                                    	<th class="text-center"><input class="chk_all" type="checkbox"></th>
                                        <th class="text-center">No.</th>
										<th class="text-center">분류</th>
										<th class="text-center">썸네일</th>
                                        <th class="text-center">타이틀</th>
                                        <th class="text-center">등록일</th>
										<th class="text-center">시청수</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php $i=1; ?>
                                	<?php foreach ($video_list as $list):?>
                                	
                                	<tr>
                                    	<td><input class="chk_item" type="checkbox" name="chk_list[]" value="<?= $list->id ?>" view-num="<?= $list->viewNum ?>"></td>
                                        <td><?= ($pageTotal - ($i + $page)) + 1 ?></td>
										<td><?= $list->category ?></td>
										<td><a href="/admin/video_detail?<?='cate='.$cate.'&per_page='.$page.'&id='.$list->id; ?>"><img src="<?= $list->thumbPath ?>" width="100" /></a></td>
										<td style="text-align:left"><a href="/admin/video_detail?<?='cate='.$cate.'&per_page='.$page.'&id='.$list->id; ?>"><?= $list->videoTitle ?></a></td>
										<td><?= $list->date ?></td>
										<td>
											<?Php 
												if(empty($list->viewCount)) echo "0"; 
											   	else 						echo $list->viewCount;
										    ?>
										</td>
                                    </tr>
                                		
                                	<?php $i++; ?>
                                	<?php endforeach;?>
                                	
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                 <input type="hidden" name="prev" value="/admin/video<?= '?cate='.$cate.'&per_page='.$page ?>">
                </form>
				
				<div class="row text-center" style="position:relative;">
                	<div class="col-lg-8" <?php if($pagination ==""){ echo'style="height:80px"';}?>>
	                    <nav>
	                    	<?= $pagination ?>
					   </nav>
					   <a href="/admin/video_write" style="position:absolute;right:20px;top:20px;" type="button" class="btn btn-primary">작성하기</a>
				   </div>
                </div>
                  

            </div>
           <!-- //Page Heading -->
        </div>
        <!-- //page-wrapper -->

		<form id="sort_from" action="/admin/video_sort" method="POST" style="display:none">

		</form>