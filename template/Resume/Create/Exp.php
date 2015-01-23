<?php
$this->setWrap ( 'Resume/Create/Layout' );
?>
<div class="step">
	<div class="progress">
		<div class="bar bar-success" style="width: 66%;"></div>
		<div class="step-item step1">
			<span class="badge badge-success">1</span>
			<p style="margin-left: -12px">个人信息</p>
		</div>
		<div class="step-item step2">
			<span class="badge badge-success">2</span>
			<p style="margin-left: 1px">教育</p>
		</div>
		<div class="step-item step3">
			<span class="badge badge-success">3</span>
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
		<strong style="color: blue">请填写最近一份工作</strong>
		<!-- (<span style="color:red;margin:0 5px;">*</span>为必填写)</p>  -->


	<form class="form-horizontal" method='post'
		action="<?php $this->url('resume/index/update',array('form-type'=>'exp')); ?>">

		<div class="control-group">
			<label class="control-label"> 入职时间:</label>
			<div class="controls">
				<input type="text" placeholder="请填写入职时间" value="<?php echo isset($data['exp']['start_time']) && $data['exp']['start_time'] != null ? date('Y-m',$data['exp']['start_time']->sec):'';?>" name="start_time" />
				<script type="data">
					{
						errorMsg : '请填写入职时间',
						rules:[  {v:'string',gte:10,lte:10, errorMsg:'时间格式为2012-01-01'}]
					}
				</script>
				<span class="vform-help help-inline"></span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label"> 离职时间:</label>
			<div class="controls">
				<input type="text" placeholder="请填写离职时间" value="<?php echo isset($data['exp']['end_time']) && $data['exp']['end_time'] != null ?date('Y-m',$data['exp']['end_time']->sec):'';?>" name="end_time" />
				<script type="data">
					{
						errorMsg : '请填写离职时间',
						rules:[  {v:'string',gte:10,lte:10, errorMsg:'时间格式为2013-01-01'}]
					}
				</script>
				<span class="vform-help help-inline"></span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label"> 公司名:</label>
			<div class="controls">
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
		<div class="control-group">
			<label class="control-label"> 描述:</label>
			<div class="controls">
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
		<div class="control-group">
			<div class="controls text-center">
				<input type="submit" class="btn btn-large" value=" 保存并完成 " />
			</div>
		</div>
	</form>
	<script>
$('.main-form form').vForm({
	success: function (data) {
		if(data.isValid){
			location.href = "<?php echo @ $_SESSION ['regFrom'] ?: url();?>";
		}
	}
});
</script>

</div>