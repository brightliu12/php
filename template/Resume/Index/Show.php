<style type="text/css">
.left-content{border:1px solid #cccccc;text-align:center;color:#666666}

input[type="text"] {margin-bottom:0px;}
.form-horizontal .controls{margin-left:0px;}
.form-horizontal .control-label{text-align:left;font-weight:bold;margin-bottom:0px;width: 130px;padding:10px 0px;}
.form-horizontal .control-field{border-left:1px solid #dddddd;float:left;min-height:40px;width:200px;}
.form-horizontal .control-group{ margin:0px}
.table tbody tr.error > td,.table tbody tr.success > td{background:none}
.help-inline{padding-left:80px;}
.form-horizontal td{padding:0px 8px}
.form-horizontal input,.form-horizontal select,.form-horizontal textarea{margin:8px 0px 0px 10px;display:none}
 .navbar-inner{border-left:none;border-right:none;border-color:#cccccc}
 #main-operate .navbar .brand{font-weight:bold;color:#000000}
 .replace-input{margin:0;text-align:center;width:200px;display:block;margin-top:10px;height:10px}
.vform-help {height:0;line-height:0px;padding:0;width:200px;text-align:center}
</style>

<div class="row">
		<div class="span2">
			<div class="left-content" data-spy="affix" data-offset-top="180">
				<div style="width: 139px">
				<h3 class="text-info" id="username"><?php echo @$data['info']['name'];?></h3>
				<div class="my-exp">
					<p><font class="for-red">*</font>个人信息<?php if (@ $data['info'] &&count($data['info']) == count(array_filter($data['info']))):;?><i id="left-info" class="icon-ok"></i><?php else :;?><i id="left-info" class="icon-remove"></i><?php endif;?></p>
					<p><font class="for-red">*</font>联系资料<?php if (@ $data['contact'] &&count($data['contact']) == count(array_filter($data['contact']))):;?><i id="left-contact" class="icon-ok"></i><?php else :;?><i id="left-contact" class="icon-remove"></i><?php endif;?></p>
					<p><font class="for-red">*</font>求职意向<?php if (@ $data['job'] &&count($data['job']) == count(array_filter($data['job']))):;?><i id="left-job" class="icon-ok"></i><?php else :;?><i id="left-job" class="icon-remove"></i><?php endif;?></p>
					<p><font class="for-red">*</font>教育经历<?php if (@ $data['edu'] &&count($data['edu']) == count(array_filter($data['edu']))):;?><i id="left-edu" class="icon-ok"></i><?php else :;?><i id="left-edu" class="icon-remove"></i><?php endif;?></p>
					<p><font class="for-red">*</font>工作经验<?php if (@ $data['exp'] && count($data['exp']) == count(array_filter($data['exp']))):;?><i id="left-exp" class="icon-ok"></i><?php else :;?><i id="left-exp" class="icon-remove"></i><?php endif;?></p>
				</div>
				<div class="my-search">
<!-- 					<button class="btn" type="button">预览</button> -->
				</div>
				</div>
			</div>
		</div>
		<div class="span10" style="border:1px solid #cccccc;width:758px;padding:10px 0px;">
			<ul class="nav nav-tabs">
				<li class="">
				<a href="<?php $this->url('job/index/search'); ?>">我的工作机会</a>
				</li>
				<li class="active">
				<a data-toggle="tab" href="#">填写简历</a>
				</li>
			</ul>
			<div id="main-operate">
				<div class="navbar">
				  <div class="navbar-inner">
				    <a class="brand" href="#">个人信息</a>
				    <button class="btn btn-small pull-right forbind" type="button" id="btn-info">修改</button>
				    <button class="btn btn-inverse btn-small pull-right" id="cancel-info" type="button" style="display:none;margin-right:10px">取消</button>
				  </div>
				</div>
				<form id='form-info' class="form-horizontal" method='post' action="<?php $this->url('resume/index/update',array('form-type'=>'info')); ?>">
					<table class="table table-bordered">
						<tr>
							<td>
								<div class="control-group">
									<div class="controls">
										<label class="control-label"> 姓名:</label>
										<div class="control-field">
											<span class="replace-input"><?php echo @$data['info']['name'];?></span>
											<input  type="text" value="<?php echo @$data['info']['name'];?>" name="name" />
											<script type="data">
										{
										errorMsg : '请输入正确的姓名',
										rules:[  {v:'string',gte:2,lte:10, errorMsg:'姓名为2-10个字符'}]
										}
									</script>
											<div class="vform-help help-inline"></div>
										</div>
									</div>
								</div>
							</td>
							<td>
								<div class="control-group">
									<div class="controls">
									<label class="control-label"> 性别:</label>
									<div class="control-field">
										<span class="replace-input"><?php if(isset($data['info']['sex'])){echo $data['info']['sex'] == 'man' ?'男':'女';} ;?></span>
										<select  name="sex" >
											<option value="man">男</option>
											<option value="woman">女</option>
										</select>
										<script type="data">
										{
										errorMsg : '请选择性别',
										rules:[  {v:'list',type:'sex', errorMsg:'性别格式错误'}]
										}
										</script>
										<span class="vform-help help-inline"></span>
									</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
 								<div class="control-group">
 									<div class="controls">
 									<label class="control-label"> 教育程度:</label>
 									<div class="control-field">
 										<span class="replace-input"><?php echo @$data['info']['edu'];?></span>
										<input  type="text" value="<?php //echo @$data['info']['edu'];?>" name="edu"  />
 										<script type="data">
 										{
 										errorMsg : '请输入教育程度',
 										rules:[  {v:'string',gte:2,lte:10, errorMsg:'教育为2-10个字符'}]
 										}
 										</script>
 										<span class="vform-help help-inline"></span>
 									</div>
 									</div>
 								</div>

							</td>
							<td>
								<div class="control-group">
									<div class="controls">
									<label class="control-label"> 工作年限:</label>
									<div class="control-field">
										<span class="replace-input"><?php echo @$data['info']['work_exp'];?></span>
										<select  name="work_exp" >
											<option value="一年以下">一年以下</option>
											<option value="一年到两年">一年到两年</option>
											<option value="两年到三年">两年到三年</option>
											<option value="三年到四年">三年到四年</option>
											<option value="四年到五年">四年到五年</option>
											<option value="五年以上">五年以上</option>
										</select>
										<script type="data">
										{
										errorMsg : '请选择工作年限',
										rules:[  {v:'string',gte:2,lte:10, errorMsg:'工作年限格式错误'}]
										}
									</script>
										<span class="vform-help help-inline"></span>
									</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="control-group">
									<div class="controls">
									<label class="control-label"> 居住地:</label>
									<div class="control-field">
										<span class="replace-input"><?php echo @$data['info']['live_city'];?></span>
										<input  type="text" value="<?php echo @$data['info']['live_city'];?>" name="live_city"  />
										<script type="data">
										{
										errorMsg : '请输入居住地名',
										rules:[  {v:'string',gte:2,lte:10, errorMsg:'居住地为2-10个字符'}]
										}
										</script>
										<span class="vform-help help-inline"></span>
									</div>
									</div>
								</div>
							</td>
							<td>&nbsp;<input type="hidden" name="rid" value="<?=$data['_id'];?>" /></td>
						</tr>
					</table>
				</form>
				<div class="navbar">
				  <div class="navbar-inner">
				    <a class="brand" href="#">联系资料</a>
				     <button class="btn btn-small pull-right forbind" type="button" id="btn-contact">修改</button>
				     <button class="btn btn-small btn-inverse pull-right" id="cancel-contact" type="button" style="display:none;margin-right:10px">取消</button>
				  </div>
				</div>
				<form id='form-contact' class="form-horizontal" method='post' action="<?php $this->url('resume/index/update',array('form-type'=>'contact')); ?>">
					<table class="table table-bordered">
						<tr>
							<td>
								<div class="control-group">
									<div class="controls">
									<label class="control-label"> 电子邮箱:</label>
									<div class="control-field">
										<span class="replace-input"><?php echo @$data['contact']['email'];?></span>
										<input  type="text" value="<?php echo @$data['contact']['email'];?>" name="email" />
										<script type="data">
										{
										errorMsg : '请输入邮箱',
										rules:[
									 	{v:'email', errorMsg:'邮箱格式错误'},
										]
										}
									</script>
										<span class="vform-help help-inline"></span>
									</div>
									</div>
								</div>
							</td>
							<td>
								<div class="control-group">
									<div class="controls">
									<label class="control-label"> 手机号码:</label>
									<div class="control-field">
										<span class="replace-input"><?php echo @$data['contact']['phone'];?></span>
										<input type="text" value="<?php echo @$data['contact']['phone'];?>" name="phone" />
										<script type="data">
										{
										errorMsg : '请输入手机号',
										rules:[  {v:'string',gte:11,lte:11, errorMsg:'手机号码为11位'}]
										}
										</script>
										<span class="vform-help help-inline"></span>
										<input type="hidden" name="rid" value="<?=$data['_id'];?>" />
										</div>
									</div>
								</div>
							</td>
						</tr>
					</table>
				</form>
				<div class="navbar">
				  <div class="navbar-inner">
				    <a class="brand" href="#">求职意向</a>
				    <button class="btn btn-small pull-right forbind" type="button" id="btn-job">修改</button>
				    <button class="btn btn-inverse btn-small pull-right" id="cancel-job" type="button" style="display:none;margin-right:10px">取消</button>
				  </div>
				</div>
				<form id='form-job' class="form-horizontal" method='post' action="<?php $this->url('resume/index/update',array('form-type'=>'job')); ?>">
					<table class="table table-bordered">
						<tr>
							<td>
								<div class="control-group">
									<div class="controls">
									<label class="control-label"> 求职状态:</label>
									<div class="control-field">
										<span class="replace-input"><?php echo @$data['job']['status'];?></span>
										<select name="status">
											<option value="不想找工作">目前不想找工作</option>
											<option value="想找工作">想找工作</option>
										</select>
										<script type="data">
										{
										errorMsg : '请选择求职状态',
										rules:[ ]
										}
										</script>
										<span class="vform-help help-inline"></span>
									</div>
									</div>
								</div>
							</td>
							<td>
								<div class="control-group">
									<div class="controls">
									<label class="control-label"> 求职类型:</label>
									<div class="control-field">
										<span class="replace-input"><?php echo @$data['job']['type'];?></span>
										<select name="type">
											<option value="全职">全职</option>
											<option value="兼职">兼职</option>
										</select>
										<script type="data">
										{
										errorMsg : '请输入求职类型',
										rules:[ ]
										}
										</script>
										<span class="vform-help help-inline"></span>
										<input type="hidden" name="rid" value="<?=$data['_id'];?>" />
									</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="control-group">
									<div class="controls">
										<label class="control-label"> 期望行业:</label>
										<div class="control-field">
											<span class="replace-input"><?php echo @$data['job']['expect_industry'];?></span>
											<input type="text" value="<?php echo @$data['job']['expect_industry'];?>" name="expect_industry" />
											<script type="data">
										{
										errorMsg : '请输入期望行业',
										rules:[  {v:'string',gte:2,lte:10, errorMsg:'行业名为2-10个字符'}]
										}
										</script>
											<span class="vform-help help-inline"></span>
										</div>
									</div>
								</div>
							</td>
							<td>
								<div class="control-group">
									<div class="controls">
										<label class="control-label"> 期望薪资:</label>
										<div class="control-field">
											<span class="replace-input"><?php echo @$data['job']['expect_salary'];?></span>
											<select name="expect_salary">
												<option value="1000以下">1000以下</option>
												<option value="1000元-2000元">1000元-2000元</option>
												<option value="2001元-3000元">2001元-3000元</option>
												<option value="3001元-4000元">3001元-4000元</option>
												<option value="4001元-5000元">4001元-5000元</option>
												<option value="5001元-6000元">5001元-6000元</option>
												<option value="6001元-7000元">6001元-7000元</option>
												<option value="7001元-8000元">7001元-8000元</option>
												<option value="8001元-10000元">8001元-10000元</option>
												<option value="10000元以上">10000元以上</option>
											</select>
											<script type="data">
											{
											errorMsg : '请选择薪资',
											rules:[  {v:'string',gte:2,lte:20, errorMsg:'薪资格式错误'}]
											}
											</script>
											<span class="vform-help help-inline"></span>
										</div>
									</div>
								</div>
							</td>
						</tr>
					</table>
				</form>
				<div class="navbar">
				  <div class="navbar-inner">
				    <a class="brand" href="#">教育经历</a>
				    <button class="btn btn-small pull-right forbind" type="button" id="btn-edu">修改</button>
				    <button class="btn btn-inverse btn-small pull-right" id="cancel-edu" type="button" style="display:none;margin-right:10px">取消</button>
				  </div>
				</div>
				<form id='form-edu' class="form-horizontal" method='post' action="<?php $this->url('resume/index/update',array('form-type'=>'edu')); ?>">
					<table class="table table-bordered">
						<tr>
							<td>
								<div class="control-group">
									<div class="controls">
										<label class="control-label"> 开始时间:</label>
										<div class="control-field">
											<span class="replace-input"><?php echo isset($data['edu']) && $data['edu']['start_time'] != null ? date('Y-m',$data['edu']['start_time']->sec):'';?></span>
											<input type="text" placeholder="1970-01" value="<?php echo isset($data['edu']['start_time']) && $data['edu']['start_time'] != null ? date('Y-m',$data['edu']['start_time']->sec):'';?>" name="start_time" />
											<script type="data">
											{
											errorMsg : '请填写开始时间',
											rules:[  {v:'string',gte:7,lte:7, errorMsg:'时间格式为1970-01'}]
											}
											</script>
											<span class="vform-help help-inline"></span>
										</div>
									</div>
								</div>
							</td>
							<td>
								<div class="control-group">
									<div class="controls">
										<label class="control-label"> 毕业时间:</label>
										<div class="control-field">
											<span class="replace-input"><?php echo isset($data['edu']['end_time']) && $data['edu']['end_time'] != null ? date('Y-m',$data['edu']['end_time']->sec):'';?></span>
											<input type="text" placeholder="1970-01" value="<?php echo isset($data['edu']) && $data['edu']['end_time'] != null ? date('Y-m',$data['edu']['end_time']->sec):'';?>" name="end_time" />
											<script type="data">
											{
											errorMsg : '请填写毕业时间',
											rules:[  {v:'string',gte:7,lte:7, errorMsg:'时间格式为1970-01'}]
											}
											</script>
											<span class="vform-help help-inline"></span>
											<input type="hidden" name="rid" value="<?=$data['_id'];?>" />
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="control-group">
									<div class="controls">
										<label class="control-label"> 毕业学校:</label>
										<div class="control-field">
											<span class="replace-input"><?php echo @$data['edu']['school'];?></span>
											<input type="text" value="<?php echo @$data['edu']['school'];?>" name="school" />
											<script type="data">
											{
											errorMsg : '请输入毕业学校',
											rules:[  {v:'string',gte:2,lte:10, errorMsg:'学校名为2-10个字符'}]
											}
											</script>
											<span class="vform-help help-inline"></span>
										</div>
									</div>
								</div>
							</td>
							<td>
								<div class="control-group">
									<div class="controls">
										<label class="control-label"> 所属专业:</label>
										<div class="control-field">
											<span class="replace-input"><?php echo @$data['edu']['major'];?></span>
											<input type="text" value="<?php echo @$data['edu']['major'];?>" name="major" />
											<script type="data">
											{
											errorMsg : '请输入所属专业',
											rules:[  {v:'string',gte:2,lte:10, errorMsg:'专业名为2-10个字符'}]
											}
											</script>
											<span class="vform-help help-inline"></span>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="control-group">
									<div class="controls">
										<label class="control-label"> 学历:</label>
										<div class="control-field">
											<span class="replace-input"><?php echo @$data['edu']['type'];?></span>
											<select name="type">
												<option value="本科">本科</option>
												<option value="专科">专科</option>
											</select>
											<script type="data">
											{
											errorMsg : '请输入教育程度',
											rules:[  {v:'string',gte:2,lte:10, errorMsg:'学历为2-10个字符'}]
											}
											</script>
											<span class="vform-help help-inline"></span>
										</div>
									</div>
								</div>
							</td>
							<td>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<div class="control-group">
									<div class="controls">
										<label class="control-label"> 描述:</label>
										<div class="control-field">
											<span class="replace-input" style="text-align: left;text-indent:20px"><?php echo @$data['edu']['describe'];?></span>
											<textarea name="describe" style="width: 580px"><?=@$data['edu']['describe'];?></textarea>
											<script type="data">
											{
											errorMsg : '请输入描述信息',
											rules:[  {v:'string',gte:2,lte:50, errorMsg:'描述信息为2-50个字符'}]
											}
											</script>
											<span class="vform-help help-inline" style="width: 580px"></span>
											<input type="hidden" name="rid" value="<?=$data['_id'];?>" />
										</div>
									</div>
								</div>
							</td>
						</tr>
					</table>
				</form>
				<div class="navbar">
				  <div class="navbar-inner">
				    <a class="brand" href="#">工作经验</a>
				    <button class="btn btn-small pull-right forbind" type="button" id="btn-exp">修改</button>
				    <button class="btn btn-inverse btn-small pull-right" id="cancel-exp" type="button" style="display:none;margin-right:10px">取消</button>
				  </div>
				</div>
				<form id='form-exp' class="form-horizontal" method='post' action="<?php $this->url('resume/index/update',array('form-type'=>'exp')); ?>">
					<table class="table table-bordered">
						<tr>
							<td>
								<div class="control-group">
									<div class="controls">
										<label class="control-label"> 入职时间:</label>
										<div class="control-field">
											<span class="replace-input"><?php echo isset($data['exp']['start_time']) && $data['exp']['start_time'] != null ? date('Y-m',$data['exp']['start_time']->sec):'';?></span>
											<input type="text" placeholder="1970-01" value="<?php echo isset($data['exp']['start_time']) && $data['exp']['start_time'] != null ? date('Y-m',$data['exp']['start_time']->sec):'';?>" name="start_time" />
											<script type="data">
											{
											errorMsg : '请填写入职时间',
											rules:[  {v:'string',gte:7,lte:7, errorMsg:'时间格式为1970-01'}]
											}
											</script>
											<span class="vform-help help-inline"></span>
										</div>
									</div>
								</div>
							</td>
							<td>
								<div class="control-group">
									<div class="controls">
										<label class="control-label"> 离职时间:</label>
										<div class="control-field">
											<span class="replace-input"><?php echo isset($data['exp']['end_time']) && $data['exp']['end_time'] != null ?date('Y-m',$data['exp']['end_time']->sec):'';?></span>
											<input type="text" placeholder="1970-01" value="<?php echo isset($data['exp']['end_time']) && $data['exp']['end_time'] != null ?date('Y-m',$data['exp']['end_time']->sec):'';?>" name="end_time" />
											<script type="data">
											{
											errorMsg : '请填写离职时间',
											rules:[  {v:'string',gte:7,lte:7, errorMsg:'时间格式为1970-01'}]
											}
											</script>
											<span class="vform-help help-inline"></span>
											<input type="hidden" name="rid" value="<?=$data['_id'];?>" />
										</div>
									</div>

								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="control-group">
									<div class="controls">
										<label class="control-label"> 公司名:</label>
										<div class="control-field">
											<span class="replace-input"><?php echo @$data['exp']['company'];?></span>
											<input type="text" value="<?php echo @$data['exp']['company'];?>" name="company" />
											<script type="data">
											{
											errorMsg : '请输入公司名',
											rules:[  {v:'string',gte:2,lte:10, errorMsg:'公司名为2-10个字符'}]
											}
											</script>
											<span class="vform-help help-inline"></span>
										</div>
									</div>
								</div>
							</td>
							<td>

							</td>
						</tr>
						<tr>
							<td colspan="2">
								<div class="control-group">
									<div class="controls">
										<label class="control-label"> 描述:</label>
										<div class="control-field">
											<span class="replace-input" style="text-align: left;text-indent:20px"><?php echo @$data['exp']['describe'];?></span>
											<textarea name="describe" style="width: 580px"><?php echo @$data['exp']['describe'];?></textarea>
											<script type="data">
											{
											errorMsg : '请输入描述信息',
											rules:[  {v:'string',gte:2,lte:50, errorMsg:'描述信息为2-50个字符'}]
											}
											</script>
											<span class="vform-help help-inline" style="width: 580px"></span>
										</div>
									</div>
								</div>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
</div>
<script src="js/vform.js"></script>
<script type="text/javascript">
<?php
// FIXME::描述字段是文本域，不是文本框，文本域放一整行
?>
//遍历绑定
var forBind = ['info','contact','edu','exp','job'];
$.each(forBind,function(index,value){
	operateForm(value);
})
function operateForm(target) {
	var btn = $('#btn-' + target),
		table = $('#table-' + target),
		cancel_btn = $('#cancel-'+target),
		left_icon = $('#left-' + target),
		form = $('#form-' + target);	//类似： #form-info
	btn.click(function() {
		var $this = $(this);
		if ($this.html() == '保存') {
			form.data('vForm').submit();
		} else {
			$this.addClass('btn-primary');
			cancel_btn.show();
			$this.html('保存');
			form.find("input[type=text],select,textarea").each(function(){
				$field = $(this);
				$field.show();
				$field.prev().hide();
			});
		}
	});
	form.vForm({
	 success: function (data) {
	     if(data.isValid){
	         // FIXME::查看DHTML手册，reload还是有可能缓存的
	         // FIXME::多测试各种浏览器，看是否保存表单之后能否回到原来地方
	         //提交成功以后执行保存按钮点击时间操作

	         var isfull = true;
	    	 form.find("input[type=text],select,textarea").each(function(){
					$field = $(this);
					if($field.attr('name') == 'name' ){
						$('#username').html($field.val());
					}
					$field.hide();
					if(this.tagName == 'SELECT'){
						var checkText=$field.find("option:selected").text();
						$field.prev().html(checkText).show();
					}else{
						$field.prev().html($field.val()).show();
					}
					$field.nextAll('.vform-help').html('');	//取消验证后的提示文字
					$field.parentsUntil().removeClass('success error');//取消验证后的颜色变化
					if($field.val().length == 0){
						isfull = false;
					}
				});
		    	//改变左边的icon
				if (isfull) {
					left_icon.addClass('icon-ok').removeClass('icon-remove');
				}

				btn.html('修改').removeClass('btn-primary');
				cancel_btn.hide();
	     }
	 }
	});
	cancel_btn.click(function(){
		form.find("input[type=text],select,textarea").each(function(){
			$field = $(this);
			if(this.tagName == 'SELECT'){
				var checkText=$field.find("option:selected").text();
				$field.prev().show();
			}else{
				$field.prev().show();
			}
			$field.hide();
			$field.nextAll('.vform-help').html('');	//取消验证后的提示文字
			$field.parentsUntil().removeClass('success error');//取消验证后的颜色变化
		});
		btn.html('修改').removeClass('btn-primary');
		$(this).hide();
	})
}

</script>
