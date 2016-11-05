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
				
				 <div class="row" style="position:relative;">
                	<div class="col-lg-8" style="margin:10px 0">
                	 	<a href="javascript:" id="delete_btn" class="btn btn-sm btn-danger" style="float:left;"type="button">삭제</a>
	                </div>
                </div>
				
				<form id="delete_form" action="/admin/main_delete" method="POST">
                <div class="row text-center" style="position:relative;">
                    <div class="col-lg-8">
                        <div class="list_con">
                            <table class="table table-bordered table-hover">
                            	<colgroup>
                            		<col width="5%">
                            		<col width="8%">
									<col width="15%">
                            		<col width="">
                            		<col width="20%">
                            	</colgroup>
                                <thead>
                                    <tr>
                                    	<th class="text-center"><input class="chk_all" type="checkbox"></th>
                                        <th class="text-center">No.</th>
										<th class="text-center">썸네일</th>
                                        <th class="text-center">링크</th>
                                        <th class="text-center">등록일</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php $i=1; ?>
                                	<?php foreach ($main_list as $list):?>
                                	
                                	<tr>
                                    	<td><input class="chk_item" type="checkbox" name="chk_list[]" value="<?= $list->id ?>"></td>
                                        <td><?= ($pageTotal - ($i + $page)) + 1 ?></td>
										<td><img src="<?= $list->thumbPath ?>" width="100" /></td>
										<td style="text-align:left"><a href="<?= $list->linkPath ?>" target="_blank"><?= $list->linkPath ?></a></td>
										<td><?= $list->date ?></td>
                                    </tr>
									
                                	<?php $i++; ?>
                                	<?php endforeach;?>
                                	
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                 <input type="hidden" name="prev" value="/admin/main<?= '?per_page='.$page ?>">
                </form>
				
				<div class="row text-center" style="position:relative;">
                	<div class="col-lg-8" <?php if($pagination ==""){ echo'style="height:80px"';}?>>
	                    <nav>
	                    	<?= $pagination ?>
					   </nav>
					   <a href="/admin/main_write" style="position:absolute;right:20px;top:20px;" type="button" class="btn btn-primary">작성하기</a>
				   </div>
                </div>
                  

            </div>
           <!-- //Page Heading -->
        </div>
        <!-- //page-wrapper -->