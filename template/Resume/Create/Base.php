<?php
$this->setWrap ( 'Resume/Create/Layout' );
?>
<div class="step">
	<div class="progress">
		<div class="bar bar-success" style="width: 0%;"></div>
		<div class="step-item step1">
			<span class="badge badge-success">1</span>
			<p style="margin-left: -12px">个人信息</p>
		</div>
		<div class="step-item step2">
			<span class="badge">2</span>
			<p style="margin-left: 1px">教育</p>
		</div>
		<div class="step-item step3">
			<span class="badge">3</span>
			<p style="margin-left: 2px">工作</p>
		</div>
		<div class="step-item step4">
			<span class="badge">4</span>
			<p style="margin-left: 3px">完成</p>
		</div>
	</div>
</div>
<hr style="border-width: 2px 0; border-color: #999; margin: 10px 0;" />
<div class="main-form">

	<p style="margin: 40px 0;">
		<strong style="color: blue">请填写个人信息</strong>
		<!-- (<span style="color:red;margin:0 5px;">*</span>为必填写)</p>  -->
	
	
	<form class="form-horizontal" method='post'
		action="<?php $this->url('resume/index/update',array('form-type'=>'info')); ?>">

		<div class="control-group">
			<label class="control-label"> 姓名:</label>
			<div class="controls">
				<input type="text" value="<?php echo @$data['info']['name'];?>"
					name="name" />
				<script type="data">
				{
					errorMsg : '请输入正确的姓名',
					rules:[  {v:'string',gte:2,lte:10, errorMsg:'姓名为2-10个字符'}]
				} 
			</script>
				<div class="vform-help help-inline"></div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label"> 性别:</label>
			<div class="controls">
				<select name="sex">
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
		<div class="control-group">
			<label class="control-label"> 教育程度:</label>
			<div class="controls">
				<input type="text" value="<?php //echo @$data['info']['edu'];?>"
					name="edu" />
				<script type="data"> 
 				{ 
 					errorMsg : '请输入教育程度', 
 					rules:[  {v:'string',gte:2,lte:10, errorMsg:'教育为2-10个字符'}] 
 				}  
 			</script>
				<span class="vform-help help-inline"></span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label"> 工作年限:</label>
			<div class="controls">
				<select name="work_exp">
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
		<div class="control-group">
			<label class="control-label"> 居住地:</label>
			<div class="controls">
				<input type="text" value="<?php echo @$data['info']['live_city'];?>"
					name="live_city" />
				<script type="data">
				{
					errorMsg : '请输入居住地名',
					rules:[  {v:'string',gte:2,lte:10, errorMsg:'居住地为2-10个字符'}]
				} 
			</script>
				<span class="vform-help help-inline"></span>
			</div>
		</div>
		<div class="control-group">
			<div class="controls text-center">
				<input type="submit" class="btn btn-large" value=" 保存并下一步 " />
			</div>
		</div>
	</form>
	<script>
$('.main-form form').vForm({
	success: function (data) {
		if(data.isValid){
			location.href = "<?php $this->url('resume/create/edu');?>";
		}
	}
});
</script>

</div>