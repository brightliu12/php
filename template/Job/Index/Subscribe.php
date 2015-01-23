<style type="text/css">
.for-center{text-align:center;margin:50px 0px;width:100%}
.for-width{width:200px}
.for-submit{text-align:center}
.for-cursor{cursor:pointer}
form{margin-bottom:50px}
.left-content{border:1px solid #cccccc;text-align:center;color:#666666}
.job-content{border:1px solid #cccccc;padding:10px;margin-bottom:10px}
.apply-note{margin:20px 0px;padding:20px 20px;border-bottom:1px solid #cccccc}
p.for-color{color:#666666;text-align:center;margin:0px}
.for-yellow{color:#EE7D42}
form #searchCondition{margin-top:20px;display:none}
</style>
<div class="row">
		<div class="span2">
			<div class="left-content">
				<h3 class="text-info">职位搜索</h3>
				<div class="my-exp">
					<h5><a href="<?php $this->url('job/index/index');?>">我的工作机会</a></h5>
					<p>(100)销售代表</p>
					<p>(100)销售经理</p>
					<p>(100)市场推广</p>
					<h5><a href="<?php $this->url('job/offer/apply');?>">申请记录</a></h5>
					<h5><a href="<?php $this->url('job/collect/index');?>">(2)职位收藏</a></h5>
				</div>
				<div class="my-search">
					<h5><a href="#">我的搜索器</a></h5>
				</div>
			</div>		
		</div>
		<div class="span10" style="border:1px solid #cccccc;width:758px;padding:10px 10px;margin-bottom:120px">
			<ul class="nav nav-tabs">
				<li class="active">
				<a data-toggle="tab" href="#">我的搜索器</a>
				</li>
				<li class="">
				<a href="<?php $this->url('resume/index/show');?>">我的简历</a>
				</li>
			</ul>
			<div class="apply-note">
				<p><i class="icon-hand-right"></i>&nbsp;&nbsp;&nbsp;&nbsp;我们将定期为您推荐合适您的职位，您还可以一键退订。</p>
			</div>			
			<div class="recommend-job">
				<?php if($data):;?>
					<?php foreach ($data as $item):?>
		
				<div class="job-content">
					<div class="row-fluid">					
						<div class="span9"><h5><strong><a href=""  class="text-info"><?php foreach ($item['content'] as $content){echo $content.' ';} ?></a></strong></h5></div>
						 <div class="span1"><h5><a class="text-success" href="">退订</a></h5></div>
						<div class="span1"><h5 class="text-success"><span>修改</span></h5></div>
						<div class="span1"><h5><a class="text-success" href="<?php $this->url('job/subscribe/delete',array('id'=>(string)$item['_id']));?>">删除</a></h5></div>
					</div>
					<div class="row-fluid">					
						<div class="span4"><p>创建于：2012年1月1日</p></div>
						<div class="span8"><?php $contents = array_filter($item['content']);foreach ($contents as $content){echo $content.'+';}; ?></div>
					</div>
				</div>
				<?php endforeach;?>
			<?php endif;?>
				<button class="btn btn-large" type="button" id="addCondition">+ 新增搜索器</button>
				    <form class="form-horizontal" id="searchCondition" style="display: none">
					    <div class="control-group">
					    	<label class="control-label"><font class="for-red">*</font>关键字</label>
						    <div class="controls">
						    	<input type="text" placeholder="请输入关键字" name="title" />
						    </div>
					    </div>
					    <div class="control-group">
					    	<label class="control-label">工作城市</label>
						    <input class="span2 city-select-input" type="text" placeholder="选择城市" onclick="selectCity();" />
							<input name="city" type="hidden" class="city-select-input-value" />
					    </div>
					    <div class="control-group">
					    	<label class="control-label">工作年限</label>
						    <div class="controls">
						    	<select name="experience">
						    		<option value=""></option>
									<option value="1-2年">1-2年</option>
									<option value="3-5年">3-5年</option>
									<option value="6-10年">6-10年</option>
									<option value="10年以上">10年以上</option>
								</select>
						    </div>
					    </div>
					    <div class="control-group">
					    	<label class="control-label">学历要求</label>
						    <div class="controls">
						    	<select name="education">
						    		<option value=""></option>
									<option value="本科">本科</option>
									<option value="大专">大专</option>
								</select>
						    </div>
					    </div>
					    <div class="control-group">
					    	<label class="control-label">工作类型</label>
						    <div class="controls">
						    	<select name="type">
									<option value="全职">全职</option>
									<option value="兼职">兼职</option>
								</select>
						    </div>
					    </div>
					    <div class="control-group">
					    	<label class="control-label"><font class="for-yellow">搜索器名称</font></label>
						    <div class="controls">
						    	<input name="name" type="text" placeholder="未命名" />
						    </div>
					    </div>
					    <div class="control-group">
						    <div class="controls">
						    	<input type="submit" class="btn btn-large" value="保存" />
						    </div>
					    </div>
					</form>
			</div>
		</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#addCondition').click(function(){
			$('#searchCondition').slideDown();
		});
	})
</script>

