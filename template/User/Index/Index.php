<?php
$this->setWrap ( NULL );
?>
<style type="text/css">
 .forget-password{padding-right:45px}
</style>
<ul class="nav nav-tabs">
	<li class="active"><a href="#login-tab" data-toggle="tab">登录</a></li>
	<li><a href="#reg-tab" data-toggle="tab">注册</a></li>
</ul>
<div class="tab-content">
	<div class="tab-pane fade in active" id="login-tab">
		<form id="login-form" class="form-horizontal" method="post"
			action="<?php $this->url('user/index/login');?>">
			<div class="control-group">
				<label class="control-label"> * 邮箱:</label>
				<div class="controls">
					<input type="text" name="email" placeholder="请输入邮箱地址" />
					<script type="data">
					{
						errorMsg : '请输入注册邮箱地址', successMsg : '该邮件地址可以使用',
						rules:[
							'require', {v:'email', errorMsg:'邮件格式错误'},
							{v:'ajax', url: '<?=url('user/index/ValidateEmail', 'isExisted=1')?>', errorMsg:'该邮件地址未注册过'}]
					}</script>
					<span class="vform-help help-inline"></span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"> * 密码:</label>
				<div class="controls">
					<input type="password" name="password" placeholder="请输入密码" />
					<script type="data">
								{
									errorMsg : '请输入6-20位密码',
									rules:['require', 'password']
								}</script>
					<span class="vform-help help-inline"></span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"></label>
				<div class="controls">
					<a href="<?php $this->url('user/index/password');?>" class="forget-password">忘记密码了吗？</a>
					<input type="submit" class="btn model-submit" value="登录" />
				</div>
			</div>
		</form>
	</div>
	<div class="tab-pane fade" id="reg-tab">
		<form id="reg-form" class="form-horizontal" method="post"
			action="<?php $this->url('user/index/reg');?>">
			<div class="control-group">
				<label class="control-label"> * 邮箱:</label>
				<div class="controls">
					<input type="text" name="email" placeholder="请输入邮箱地址" />
					<script type="data">
								{
									errorMsg : '请输入注册邮箱地址', successMsg : '该邮件地址可以使用',
									rules:[
										'require', {v:'email', errorMsg:'邮件格式错误'},
										{v:'ajax', url: '<?=url('user/index/ValidateEmail', 'isExisted=0')?>', errorMsg:'该邮件地址已注册过'}]
								}</script>
					<span class="vform-help help-inline"></span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"> * 密码:</label>
				<div class="controls">
					<input type="password" name="password" placeholder="请输入密码" />
					<script type="data">
								{
									errorMsg : '请输入6-20位密码',
									rules:['require', 'password']
								}</script>
					<span class="vform-help help-inline"></span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"> * 确认密码:</label>
				<div class="controls">
					<input type="password" name="comfirm_password"
						placeholder="请再输入一次密码" />
					<script type="data">
						{
							errorMsg : '请再输入一次密码',
							rules:['require', {v:'comfirm', target:'[name=password]', errorMsg:'密码重复输入不正确'}]
						}
					</script>
					<span class="vform-help help-inline"></span>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<input type="submit" class="btn model-submit" value="注册" />
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
$('#login-form').vForm({
	success: function (data) {
		if(data.isValid){
			window.location.reload(true);
		}
	}
});
$('#reg-form').vForm({
	success: function (data) {
		if(data.isValid){
			window.location.href = "<?php $this->url('resume/create/base')?>";
		}
	}
});
</script>
<hr />
<h3>或使用以下方法登录</h3>
<div class="row">
	<div class="span3">
		<a
			href="<?php echo \OpenApi\Renren::loginUrl(@ $_SERVER['HTTP_REFERER']);?>"><img
			src="img/renren_login.png" style="height: 48px;" /></a>
	</div>
	<div class="span3">
		<a
			href="<?php echo \OpenApi\Weibo::loginUrl(@ $_SERVER['HTTP_REFERER']);?>"><img
			src="img/weibo_login.png" style="height: 48px;" /></a>
	</div>
</div>