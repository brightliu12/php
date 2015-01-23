<?php
$this->setWrap ( '_Layout/Index' );
?>
<div class="row">
	<div class="span2">
		<div data-spy="affix" data-offset-top="180">
			<table class="table table-hover table-bordered" style="width: 139px;">
				<tr>
					<td><a href="<?php $this->url('job/index/search');?>">我的工作机会</a></td>
				</tr>
				<tr>
					<td><a href="<?php $this->url('job/apply/search');?>">职位申请</a></td>
				</tr>
				<tr>
					<td><a href="<?php $this->url('content/collect/search', 'type=job');?>">职位收藏</a></td>
				</tr>
				<tr>
					<td><a href="<?php $this->url('content/subscribe/search', 'type=job');?>">我的搜索器</a></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="span10">
		<?=$this->childHtml; ?>
	</div>
</div>
