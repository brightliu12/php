<style type="text/css">
.password{border:1px solid #f5f5f5;margin-bottom:300px;margin-top:50px}
.password-form{margin-top:80px;color:#666666}
.password-notice{padding:20px 0px 30px 200px}
.password-form .submit{margin-left:15px;font-size:16px}
.password-label{font-size:18px}
.password-title{background-color:#f5f5f5;padding:5px 0px 5px 8px;font-weight:normal;margin:0px}
</style>
<div class="password">
	<h2 class="password-title">找回密码</h2>
	<form id="password-form" class="form-horizontal password-form" method="post" action="<?php $this->url('user/index/password');?>">
		<div class="control-group" style="padding-left:150px">
			<label class="control-label password-label">注册邮箱:</label>
			<div class="controls">
				<input type="text"  placeholder="Email"  name="email" />
				<script type="data">
				{
				errorMsg : '请输入注册邮箱地址', successMsg : '输入正确',
				rules:[
				'require', {v:'email', errorMsg:'邮件格式错误'},
				{v:'ajax', url: '<?php $this->url('user/index/validateEmail',array('isExisted'=>1));?>', errorMsg:'该邮件地址未注册过'}]
				}
				</script>
				<input class="btn btn-danger submit span2" style="color:#ffffff"  type="submit"  value="找回密码" /><br><br>
				<span class="vform-help help-inline" style="padding-left:100px;"></span>
			</div>
		</div>
		<p class="password-notice">请填写邮箱，系统会将密码重置链接发送到您的邮箱中。</p>
	</form>
</div>
<script type="text/javascript">
	$('#password-form').vForm({
		success:function(data){
			if(data.isValid){
				window.location.href = '<?php $this->url('user/index/password',array('step'=>'sendSuccess'));?>';
			}
		}
	});
</script>