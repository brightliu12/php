<?php
$this->setWrap ( 'Job/Layout' );
?>
<style>
.controls-row {
	margin-bottom: 10px;
}

#job-list li {margin:40px 0 50px 0;list-style:none;border-bottom:dotted 1px #ccc;}
.job-info span {margin-right:30px;}
</style>
<div
	style="border: solid 1px #ccc; border-radius: 3px; margin-bottom: 20px;">

	<div
		style="padding-left:16px; border-bottom: solid 1px #ccc; height: 40px; line-height: 40px; background-color: #FAFAFA; background-image: linear-gradient(to bottom, #FFFFFF, #F2F2F2); background-repeat: repeat-x;">
		<strong>职位申请记录</strong>
	</div>

	<ul style="margin:16px;" id="job-list">
		<?php
		foreach ( $data as $row ) :
		$item = $row['job'];
		?>
		<li>
			<div class="row" style="margin-bottom: 20px">
				<div class="span3" style="overflow:hidden;white-space:nowrap;" title="<?=$item['title'];?>">
					<a href="<?php $this->url('job/index/show', 'id=' . $item['_id'])?>"><?=$item['title'];?></a>
				</div>
				<div class="span3" style="overflow:hidden;white-space:nowrap;margin-left:50px;" title="<?=$item['employer'];?>">
					<?=$item['employer'];?>
				</div>
				<div class="span3 text-right" style="font-size:12px;">申请时间：<?php echo date('Y-m-d H:i:s', $row['applyTime']->sec);?></div>
			</div>
			<p class="job-info">
				<span>地点：<?=$item['city'];?></span>
				<span>学历：<?=$item['education'];?></span>
				<span>工作经验：<?=$item['experience'];?></span>
				<span>月薪：<?=$item['salary'];?></span>
			</p>
		</li>
		<?php endforeach;?>
	</ul>
	
	<div class="pagination" style="margin-left:20px;">
		<ul>
			<?php if ($page > 1):?>
			<li><a
				href="<?php $this->url(NULL, array('page' => ($page - 1)));?>">Prev</a></li>
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
			<li><a
				href="<?php $this->url(NULL, array('page' => ($page + 1)));?>">Next</a></li>
			<?php endif;?>
		</ul>
	</div>
</div>
<script>
$('.js-collect').click(function () {
	if (! checkLogin()) {
		return false;
	}
	var $this = $(this);
	if ($this.data('submiting')) {
		return false;
	}
	$this.data('submiting', true);
	$.get('<?php $this->url('content/collect/add', 'type=job')?>', {cid : $this.attr('data-jid')}, function (result) {
		if (result.isValid) {
			$this.addClass('disabled').html('已收藏').off();
		} else if (result.errorType == 'noLogin') {
			login();
		}
		$this.data('submiting', undefined);
	}, 'json');
	return false;
});
</script>