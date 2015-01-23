<style type="text/css">
.for-center{text-align:center;margin:50px 0px;width:100%}
.for-width{width:200px}
.for-submit{text-align:center}
.for-cursor{cursor:pointer}
form{margin-bottom:50px}
.left-content{border:1px solid #cccccc;text-align:center;color:#666666}
.job-content{border-bottom:1px dotted #cccccc;padding:20px 0px}
</style>
<div class="row">
		<div class="span2">
			<div class="left-content">
				<h3 class="text-info">职位搜索</h3>
				<div class="my-exp">
					<h5 class="nav-selected"><a href="#">我的工作机会</a></h5>
<!-- 					<p>(100)销售代表</p> -->
<!-- 					<p>(100)销售经理</p> -->
<!-- 					<p>(100)市场推广</p> -->
					<h5><a href="<?php $this->url('job/offer/apply'); ?>">职位申请</a></h5>
					<h5><a href="<?php $this->url('job/collect/index'); ?>">职位收藏</a></h5>
				</div>
				<div class="my-search">
					<h5><a href="<?php $this->url('job/subscribe/index'); ?>">我的搜索器</a></h5>
				</div>
			</div>		
		</div>
		<div class="span10" style="border:1px solid #cccccc;width:758px;padding:10px 10px;margin-bottom:120px">
			<ul class="nav nav-tabs">
				<li class="active">
				<a data-toggle="tab" href="#">我的工作机会</a>
				</li>
				<li class="">
				<a href="<?php $this->url('resume/index/show'); ?>">我的简历</a>
				</li>
			</ul>
			
			<br><br>
			<form id="selectform" class="form-horizontal" method="get" action="job.php">
				<div class="control-group">
					<input class="input-xxlarge" name="title" type="text" placeholder="职位搜索" style="width:500px" />
					<input class="span2 city-select-input" type="text" placeholder="上海" onclick="selectCity();" />
					<input name="city" type="hidden" class="city-select-input-value" />
				</div>
				<div id="searchCondition" style="display:none">
					<div class="control-group">
						<select class="for-width" name="type">
							<option value="">工作类型</option>
							<option value="全职">全职</option>
							<option value="兼职">兼职</option>
						</select> 
						<select name="experience" class="for-width">
							<option value="">经验</option>
							<option value="1-2年">1-2年</option>
							<option value="3-5年">3-5年</option>
							<option value="6-10年">6-10年</option>
							<option value="10年以上">10年以上</option>
						</select>
						<select class="span2" name="education">
							<option value="">学历</option>
							<option value="本科">本科</option>
							<option value="大专">大专</option>
						</select>
					</div>
				</div>
				<div class="for-submit">
				<input type="submit" class="btn btn-large" type="button" value="搜索" />
				<span class="for-cursor" id="addCondition">更多搜索条件<i class="icon-download-alt">&nbsp;</i></span>&nbsp;&nbsp;&nbsp;
				<span class="for-cursor" id="saveAsSearch">保存为搜索器</span>
				</div>
			</form>
			<script type="text/javascript">
				$(document).ready(function(){
					$('#saveAsSearch').click(function(){
						var data = $('#selectform').serialize();
						$.post("<?php $this->url('job/subscribe/add'); ?>",data,
								function(data){
									if(data.flag){
										showSubscribeModal();
									}
								},"json")
					})
				});
				function showSubscribeModal(){
					$('#subscribeModal').modal({backdrop:false});
				}
			</script>
			<div class="navbar">
			  <div class="navbar-inner">
			    <a class="brand" href="#" style="padding:18px 20px;font-size:20px">推荐职位</a>
			  </div>
			</div>
			<div class="recommend-job">
				<?php if ($data) : ?>
					<?php foreach ($data as $item) : ?>
				<div class="job-content row-fluid">
					<div class="span10">
					<div class="row-fluid">					
						<div class="span6"><h5 class="text-info" style="width:190px;white-space:nowrap;overflow:hidden;" title="<?=$item['title']; ?>"><?=$item['title']; ?>...</h5></div>
						<div class="span6"><h5 class="text-info"><?=$item['employer']; ?></h5></div>
					</div>
					<div class="row-fluid">					
						<div class="span3">地点：<?=$item['city']; ?> |</div>
						<div class="span2">学历：<?=$item['education']; ?> |</div>
						<div class="span3">工作经验：<?=$item['experience']; ?> |</div>
						<div class="span3">月薪：<?=$item['salary']; ?></div>
					</div>
					<p><?=$item['jobfirstclass']; ?> <?=$item['jobsecondclass']; ?></p>
					</div>
					<div class="span2"><a href="<?php $this->url('job/collect/add', array('typeId' => (string) $item['_id'], 'type' => 'job')); ?>"><button class="btn btn-large" type="button">收&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;藏</button></a></div>
				</div>
				<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
</div>
<div id="subscribeModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">保存成功</h3>
  </div>
  <div class="modal-body">
    <p>您已经成功保存一个匹配条件到<font style="font-size:20px;color:#FF9900">我的搜索器</font></p>
    <div style="margin:20px 0px">
    	<button class="btn btn-warning" type="button">查看匹配信息</button>
    	<a href="<?php $this->url('job/subscribe/index');?>" style="padding-left: 20px"><button class="btn btn-warning" type="button">查看我的搜索器</button></a>
    </div>
  </div>
  <div class="modal-footer">
   		<form class="form-horizontal regform" method="post" action="">
			<div class="control-group">
				<label id="send" class="control-label" style="font-size: 18px"><strong>匹配信息转发>></strong></label>
				<div id="sendForm" class="controls" style="display:none;text-align:center">
					<input type="text" name="email" placeholder="请输入邮箱地址" />
					<script type="data">
								{
									errorMsg : '请输入邮箱地址', successMsg : '该邮件地址可以使用',
									rules:['require', {v:'email', errorMsg:'邮件格式错误'}]
										
								}</script>
					
					<input type="submit" class="btn btn-primary" value="发送">
					<span class="vform-help help-inline"></span>
				</div>
			</div>
		</form>
  </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#addCondition').click(function(){
			$('#searchCondition').slideDown();
		});
		$('#send').click(function(){
			$('#sendForm').show();
		})
	})
</script>
