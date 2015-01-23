<style type="text/css">
.for-center{text-align:center;margin:50px 0px;width:100%}
.for-width{width:200px}
.for-submit{text-align:center}
.for-cursor{cursor:pointer}
form{margin-bottom:50px}
.left-content{border:1px solid #cccccc;text-align:center;color:#666666}
.job-content{border-bottom:1px dotted #cccccc;padding:20px 0px}
.apply-note{margin:20px 0px;padding:20px 20px;border-bottom:1px solid #cccccc}
p.for-color{color:#666666;text-align:center;margin:0px}
</style>
<div class="row">
		<div class="span2">
			<div class="left-content">
				<h3 class="text-info">职位搜索</h3>
				<div class="my-exp">
					<h5><a href="<?php $this->url('job/index/index');?>">我的工作机会</a></h5>
<!-- 					<p>(100)销售代表</p> -->
<!-- 					<p>(100)销售经理</p> -->
<!-- 					<p>(100)市场推广</p> -->
					<h5><a href="<?php $this->url('job/offer/apply');?>">申请记录</a></h5>
					<h5 class="nav-selected"><a href="#">职位收藏</a></h5>
				</div>
				<div class="my-search">
					<h5><a href="<?php $this->url('job/subscribe/index');?>">我的搜索器</a></h5>
				</div>
			</div>		
		</div>
		<div class="span10" style="border:1px solid #cccccc;width:758px;padding:10px 10px;margin-bottom:120px">
			<ul class="nav nav-tabs">
				<li class="active">
				<a data-toggle="tab" href="#">职位收藏</a>
				</li>
				<li class="">
				<a href="<?php $this->url('resume/index/show');?>">我的简历</a>
				</li>
			</ul>
			<?php if($data):?>
			<div class="apply-note">
				<p>共收藏了 <?php echo count($data); ?> 个职位</p>
			</div>			
			<div class="recommend-job">
				<?php foreach ($data as $item):?>
				<div class="job-content">
					<div class="row-fluid">					
						<div class="span4"><h5 style="width:190px;white-space:nowrap;overflow:hidden;" title="<?=$item['title'];?>"><a href="<?php $this->url('job/index/show',array('id'=>(string)$item['_id']));?>"  class="text-info"><?=$item['title'];?>...</a></h5></div>
						<div class="span5"><h5 class="text-info"><?=$item['employer'];?></h5></div>
						<div class="span3"><h5 class="text-success">申请时间：</h5></div>
					</div>
					<p><?=$item['jobfirstclass'];?> <?=$item['jobsecondclass'];?></p>
					<p class="for-color"><font style="font-size:22px">未申请</font> 共 <font style="font-size:22px;color:#7CB41F">2</font> 人投递 <span class="pull-right">申请该职位 | <a href="<?php $this->url('job/collect/delete',array('type'=>'job','typeId'=>(string)$item['_id']));?>">删除</a></span></p>
				</div>
				<?php endforeach;?>
			</div>
			<?php endif;?>
		</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#addCondition').click(function(){
			$('#searchCondition').slideDown();
		});
	})
</script>

<div class="row-fluid">
	
</div>
