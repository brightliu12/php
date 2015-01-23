<?php
$this->setWrap ( 'Job/Layout' );
?>
<style>
.controls-row {
	margin-bottom: 10px;
}

#job-list li {
	margin: 20px 0 50px 0;
	list-style: none;
	border-bottom: dotted 1px #ccc;
}

.job-info span {
	margin-right: 30px;
}
</style>
<div style="border: solid 1px #ccc; border-radius: 3px; margin-bottom: 20px;">
	<div style="padding-left: 16px; border-bottom: solid 1px #ccc; height: 40px; line-height: 40px; background-color: #FAFAFA; background-image: linear-gradient(to bottom, #FFFFFF, #F2F2F2); background-repeat: repeat-x;">
		<strong>我的搜索器</strong>
	</div>

	<ul style="margin: 16px;" id="job-list">
		<?php
		foreach ( $data as $item ) :
		?>
		<div class="row" style="padding:10px 30px;color:red">
			我们会定期为您推荐合适您的职位，您还可以一键退订！
		</div>
		<li>
			<div class="row" style="margin-bottom: 20px">
				<div class="span5" style="overflow: hidden; white-space: nowrap;"
					title="<?=$item['name'];?>">
					<?=$item['name'];?>
				</div>
				<div class="span2">
					<a href="<?php $this->url('job/subscribe/result', 'id=' . $item['_id']);?>" target="_blank" class="btn btn-small js-result">查看搜索结果</a>
				</div>
<!-- 				<div class="span1">
					<a href="#" class="btn btn-small js-edit" data-id="<?php echo $item['_id'];?>">修 改</a>
				</div> -->
				<div class="span1" style="margin-left:0px">
					<a href="<?php $this->url('job/subscribe/delete', 'id=' . $item['_id']);?>" class="btn btn-small js-delete" data-id="<?php echo $item['_id'];?>">删 除</a>
				</div>
			</div>
			<p class="job-info">
				<span>关键字：<?=@ $item['title'];?></span>
				<span>地点：<?=@ $item['city'];?></span>
				<span>学历：<?=@ $item['education'];?></span>
				<span>工作经验：<?=@ $item['experience'];?></span>
			</p>
		</li>
		<?php endforeach;?>
	</ul>
	<?php if(empty($item)):?>
	<div class="row" style="padding:20px 50px;color:red">
		暂未保存搜索条件，您可以点击去搜索,将搜索内容保存为搜索器,系统会自动收录在我的搜索器中！
	</div>
	<?php endif;?>
	<div class="row" style="padding-left:20px;">
		<a href="<?php $this->url('job/index/search');?>" class="btn span2">去搜索</a>
<!-- 		<a href="#" class="btn span2" id="js-saveSearch">去搜索</a> -->
	</div>
	<div class="pagination" style="margin-left: 20px;">
		<ul>
			<?php if ($page > 1):?>
			<li><a href="<?php $this->url(NULL, array('page' => ($page - 1)));?>">Prev</a></li>
			<?php endif;?>

			<?php
			$pageRange = 10;
			if ($pageRange > $pageCount) {
				$pageStart = 1;
				$pageEnd = $pageCount;
			} elseif ($page <= ($pageRange / 2)) {
				$pageStart = 1;
				$pageEnd = $pageRange + 1;
			} elseif (($pageCount - $page) <= ($pageRange / 2)) {
				$pageStart = $pageCount - $pageRange - 1;
				$pageEnd = $pageCount;
			} else {
				$pageStart = $page - ($pageRange / 2);
				$pageEnd = $page + ($pageRange / 2);
			}
			?>

			<?php for ($p = $pageStart; $p <= $pageEnd; $p++):?>
			<?php if ($p != $page):?>
			<li><a href="<?php $this->url(NULL, array('page' => $p));?>"><?php echo $p;?></a></li>
			<?php else:?>
			<li class="active"><a href="#"><?php echo $p;?></a></li>
			<?php endif;?>
			<?php endfor;?>

			<?php if ($page < $pageCount):?>
			<li><a href="<?php $this->url(NULL, array('page' => ($page + 1)));?>">Next</a></li>
			<?php endif;?>
		</ul>
	</div>
</div>
<script>
$.get('<?php $this->url('city/index/select')?>', function(data){
	$('body').append(data);
});

$('.js-edit').click(function() {
	var id = $(this).attr('data-id');
	$('#modal').modal({
		backdrop: 'static',
		remote: '<?php $this->url('job/subscribe/add');?>' + '&reload=1$&id=' + id
	});
});
$('#js-saveSearch').click(function() {
	$('#modal').modal({
		backdrop: 'static',
		remote: '<?php $this->url('job/subscribe/add');?>' + '&reload=1'
	});
});
</script>