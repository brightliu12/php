<?php
$this->setWrap ( '_Layout/Index' );
?>
<style>
.step{position: relative;margin:40px 0 80px 0;}
.step .badge{font-size:24px;width:18px;height:28px;border-radius: 18px;
    padding:4px 9px;line-height:28px;text-align:center;margin-bottom:5px;}
.step .step-item {position: absolute; top:-8px;}
.step .step1{left:-1%;}
.step .step2{left:32%;}
.step .step3{left:65%;}
.step .step4{left:98%;}
.badge-success {
    background-color: #5EB95E;
}
.main-form .control-label {text-align:right;padding-right:10px;}
</style>
<div style="border:solid 1px #ccc;border-radius: 8px;">
	
	<div style="padding:50px;border-bottom:dashed 1px #ccc;">
		<h2 style="color:blue">恭喜您！注册成功！</h2>
		<p>我们已向您的邮箱发送一封激活邮件，请您及时激活，确保我们为您提供更多的服务。</p>
	</div>
	
	<div style="padding:50px;">
		<p><strong>还等什么？赶快填写简历吧，有活干，辛勤的忙碌，意味着一个可期待的未来。</strong>
			<a href="<?php $this->url('openApi/importProfile/renren');?>" class="pull-right btn">从人人导入</a>
		</p>
		
		<?=$this->childHtml; ?>
	</div>
</div>