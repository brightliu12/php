<style>
.job-info span {
	margin-right: 20px;
}
</style>
<div class="row">
	<div class="span8">
		<div
			style="border: solid 1px #ccc; border-radius: 3px; padding: 20px;">
			<div>
				<h4 class="text-info"><?php echo $title;?></h4>
			</div>
			<div class="row">
				<div class="span6">
					<p class="job-info">
						<span>地点：<?=$city?></span> <span>学历：<?=$education?></span> <span>工作经验：<?=$experience?></span>
						<span>月薪：<?=$salary?></span>
					</p>
					<p class="job-info"><?=$jobfirstclass?> <?=$jobsecondclass?></p>
				</div>
				<div class="span1 text-right" style="width: 90px;">
					<a target="_blank" href="<?php $this->url('job/apply/apply', 'id=' . $_id);?>" class="btn" type="button">立即申请</a>
					<br />
					<br />
					<button class="btn js-collect" data-jid="<?php echo $_id;?>" type="button">收藏职位</button>
				</div>
			</div>
		</div>
	</div>
	<div class="span4">
		<div style="border: solid 1px #ccc; border-radius: 3px; padding: 20px;">
			<h5>上海有活信息科技</h5>
			<div class="my-exp">
				<h5 class="other-job">该公司其他职位</h5>
				<p>
					<a href="">平面设计：上海有活信息科技</a>
				</p>
				<p>
					<a href="">淘宝美工：上海有活信息科技</a>
				</p>
				<p>
					<a href="">网页设计：上海有活信息科技</a>
				</p>
				<p>
					<a href="">php开发：上海有活信息科技</a>
				</p>
				<p>
					<a href="">java开发：上海有活信息科技</a>
				</p>
			</div>
		</div>
	</div>
</div>
<div class="">
<p>该职位来源于：<span class="red"><?=@$source;?></span></p>
<p><a href="<?=@$joburl; ?>"><?=@$joburl;?></a></p>
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
