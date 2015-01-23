<?php
use User\Model\U;
use Content\Model\Subscribe;
$this->setWrap ( '_Layout/Index' );
?>
<div class="row">
	<?php
	$U = new U();
	if ($U->isLogin()):
		$uid = $U->getUserId();
		$mSubscribe = new Subscribe();
		$searchSubscribeList = $mSubscribe->findByUid($uid);
	?>
	<div class="span2">

		<div data-spy="affix" data-offset-top="180">
			<table class="table table-hover table-bordered">
				<tr>
					<td>
						<a href="<?php $this->url('job/index/search');?>">我的工作机会</a>
						<?php if ($searchSubscribeList):?>
						<style>
						.nav-subscribe {margin:0;padding-left:5px;padding-top:10px;border-top:dotted 1px #ccc;}
						.nav-subscribe li{list-style:none;line-height:24px;}
						</style>
						<ul class="nav-subscribe">
						<?php foreach ($searchSubscribeList as $item):?>
							<li><a href="<?php $this->url('job/subscribe/result', 'id=' . $item['_id'])?>"><?php echo $item['name'];?></a></li>
						<?php endforeach;?>
						</ul>
						<?php endif;?>
					</td>
				</tr>
				<tr>
					<td><a href="<?php $this->url('job/apply/search');?>">职位申请</a></td>
				</tr>
				<tr>
					<td><a href="<?php $this->url('content/collect/search', 'type=job');?>">职位收藏</a></td>
				</tr>
				<tr>
					<td><a href="<?php $this->url('job/subscribe/search');?>">我的搜索器</a></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="span10">
		<?=$this->childHtml; ?>
	</div>
	<?php else:?>
	<div class="span12">
		<?=$this->childHtml; ?>
	</div>
	<?php endif;?>
</div>
