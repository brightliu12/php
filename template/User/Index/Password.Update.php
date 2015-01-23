<style type="text/css">
.password{border:1px solid #f5f5f5;margin-bottom:300px;margin-top:50px}
.password-form{margin-top:40px;color:#666666}
.password-notice{padding:20px 0px 30px 200px}
.password-form .submit{margin-left:15px;font-size:16px}
.password-label{font-size:18px}
.password-title{background-color:#f5f5f5;padding:5px 0px 5px 8px;font-weight:normal;margin:0px}
.password-control{padding-left:150px}
</style>
<div class="password">
	<h2 class="password-title">修改密码</h2>
	<form id="password-update-form" class="form-horizontal password-form" method="post" action="<?php $this->url('user/index/password',array('step'=>'update'));?>">
		<div class="control-group password-control">
			<label class="control-label password-label">注册邮箱:</label>
			<div class="controls">
					<?php echo $data['email'];?>
			</div>
		</div>
		<div class="control-group password-control">
			<label class="control-label password-label">新密码:</label>
			<div class="controls">
				<input type="password" name="password"  placeholder="请输入新密码" />
				<script type="data">
				{
				errorMsg : '请输入6-20位密码',
				rules:['require', 'password']
				}
				</script>
				<span class="vform-help help-inline"></span>
			</div>
		</div>
		<div class="control-group password-control">
			<label class="control-label password-label">确认密码:</label>
			<div class="controls">
				<input type="password"  name="comfirm_password" placeholder=确认密码 />
				<script type="data">
				{
				errorMsg : '请再输入一次密码',
				rules:['require', {v:'comfirm', target:'[name=password]', errorMsg:'密码重复输入不正确'}]
				}
				</script>
				<span class="vform-help help-inline"></span>
			</div>
		</div>
		<div class="control-group password-control">
			<div class="controls">
				<label class="control-label password-label"></label>
				<input type="hidden" name="eid" value="<?=$data['_id'];?>" />
				<input class="btn btn-large span2"  type="submit"  value="提交" />
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('#password-update-form').vForm({
		success:function(data){
			if(data.isValid){
				window.location.href = '<?php $this->url('user/index/password',array('step'=>'success'));?>';
			}
		}
	});
})
</script>
