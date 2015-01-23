<?php
use User\Model\U;
// 关闭布局
$this->setWrap(NULL);
$u = new U();
?>
<?php
if ($u->isLogin()):
$nickname = $u->getNickName();
?>
document.write('<li class=""><a style="color:red" href="#"><?php echo $nickname;?></a> </li><li class=""><a class="red" href="<?php $this->url('user/index/logout')?>"><small class="red">退出</small></a> </li><li class=""><a href="<?php $this->url('job/index/search');?>">我的工作机会</a></li><li class=""><a class="white" href="<?php $this->url('resume/index/show');?>">我的简历</a></li><li class=""><a class="white" href="<?php $this->url();?>">有活首页</a></li><li class="top-collection"><a class=" js-collect" data-jid="<?php echo @$_GET['id'];;?>" href="#">收入有活</a></li>');
var IS_LOGIN = true;
<?php else:?>
var IS_LOGIN = false;
document.write('<li class="white index-welcome" style="padding-right:40px">您好！欢迎来到有活网！<button class="btn btn-danger" onclick="login();return false;" style="margin-top:-5px">注册</button></li>');
<?php endif;?>

function checkLogin() {
	if (! IS_LOGIN) {
		login();
		return false;
	}
	return true;
}

function login() {
	$('#modal').modal({
		backdrop: 'static',
		remote: '<?php $this->url('user/index/index');?>'
	});
}