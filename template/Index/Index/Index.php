<?php
use User\Model\U;
$this->setWrap('_Layout/Html');
?>
<style type="text/css">
.container-index{width:100%;position:relative;}
.container-bg{background-color:#310000;position:absolute;right:22%;top:15px;opacity:0.7}
.container-bg p.title{border-bottom:1px solid #ffffff;padding:10px 0px;font-size: 18px;margin:0px 10px}
.index-login-form{margin:20px;width:220px}
.container-bg a{padding-right:10px;text-decoration:underline}
.otherlogin{padding:0px 10px 20px 20px}
.index-login-other{padding-left:20px}
.job-search {margin-top: 20px;}
.job-search .controls-row {margin: 10px 0;}
.citymodal-top{height:20px;line-height:20px;background-color:#FF9721}
.index-show-botton{margin:20px 0px}
.index-show-botton a{padding:0px}
.index-show-botton-special a{padding:0px 10px}
.index-show-botton-special{padding-bottom:30px}
.dimensional_code{position:absolute;right:5%;top:15px;}
.index-main-show{background: url(img/index_head.png) no-repeat scroll center center transparent; height: 350px; margin-top: 3px;}
.slide{margin:0 auto;text-align:center;}
.carousel-inner{margin-top:20px}
.carousel-inner img{min-width:100%}
</style>
    <div id="myCarousel" class="carousel slide">
    <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <!-- Carousel items -->
    <div class="carousel-inner">
    <div class="active item"><img src="/img/slide/slide1.png" /></div>
    <div class="item"><img src="/img/slide/slide2.png" /></div>
    <div class="item"><img src="/img/slide/slide1.png" /></div>
    </div>
    <!-- Carousel nav -->
    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div>
<script type="text/javascript">
$('#myCarousel').carousel({

    })
</script>
<div class="index-main-show">
	<div class="container-index">
		  <div class="container-bg">
		  	  <p class="title white">
		  	  		个人登录
		  	  		<span class="pull-right" style="padding:0px 15px 8px 0px;"><wb:follow-button uid="3263735830" type="gray_1" width="67" height="24" ></wb:follow-button></span>
		  	  	</p>
		  	  <?php $U = new U();
if (!$U->isLogin()) :
				?>
			  <form id="index-login-form" class="form-horizontal index-login-form" method="post" action="<?php $this->url('user/index/login'); ?>">
				  <div class="control-group" style="margin-bottom:10px">
					<div class="controls">
					  <input type="text" name="email" placeholder="请输入邮箱地址" />
					  <script type="data">
					 {
					errorMsg : '请输入注册邮箱地址', successMsg : '该邮件地址可以使用',
					rules:[
					'require', {v:'email', errorMsg:'邮件格式错误'},
					{v:'ajax', url: '<?php $this->url('user/index/ValidateEmail', array('isExisted' => 1)); ?>', errorMsg:'该邮件地址未注册过'}]
					}
					</script>
					  <span class="vform-help help-inline"></span>
					</div>
				 </div>
				  <div class="control-group" style="margin-bottom:0px">
					  <div class="controls">
					  	<input type="password" name="password" placeholder="请输入密码" />
					 	 <script type="data"> { errorMsg : '请输入6-20位密码', rules:['require', 'password'] }</script>
					  	<span class="vform-help help-inline"></span>
					  </div>
				  </div>
				  <div class="control-group" style="margin:0px;width:220px">
				  	<span class="pull-left"><a class="white" href="<?php $this->url('user/index/password');?>">忘记密码?</a></span>
				  	<p class="pull-right index-login-right"><a href="javascript:void(0);" class="white" onclick="login();return false">注册>></a></p>
				  </div>
				  <div class="control-group">
				  	<div class="controls">
				  		<input style="width:220px;font-size:16px;" class="btn btn-warning" type="submit" value="登录" />
				  	</div>
				  </div>
			  </form>
				<div style="margin-top: 0px;">
					<p class="white index-login-other">您还可以用以下方式登录：</p>
					<div class="otherlogin">
						<a class="weibo" href="<?php echo OpenApi\Renren::loginUrl(); ?>"><img style="width:107;height:18px" src="img/renren_login_small.png"></a>
						<a class="renren" href="<?php echo OpenApi\Weibo::loginUrl(); ?>"><img style="" src="img/weibo_login_small.png"></a>
					</div>
				</div>
				<?php else :
	$nickname = $U->getNickName();
				?>
				<div class="index-login-form white" style="width:225px">
					<p>你好！欢迎来到有活网！</p>
					<p><?=$nickname; ?></p>
<!-- 					<div class="index-show-botton">
						<a href="<?php $this->url('job/index/search'); ?>"><button class="btn btn-inverse" type="button">我的工作机会</button></a>
						<a href="<?php $this->url('resume/index/show'); ?>"><button class="btn btn-inverse" type="button">我的个人简历</button></a>
					</div> -->
					<div class="index-show-botton index-show-botton-special">
						<!--  <wb:follow-button uid="3263735830" type="gray_1" width="67" height="24" ></wb:follow-button>-->
						<script type="text/javascript" charset="utf-8">
						(function(){
						var p = [], w=130, h=24,
						lk = {
						url:''||location.href, /*喜欢的URL(不含如分页等无关参数)*/
						title:''||document.title, /*喜欢标题(可选)*/
						description:'', /*喜欢简介(可选)*/
						image:'' /*喜欢相关图片的路径(可选)*/
						};
						for(var i in lk){
						p.push(i + '=' + encodeURIComponent(lk[i]||''));
						}
						document.write('<iframe scrolling="no" frameborder="0" allowtransparency="true" src="http://www.connect.renren.com/like/v2?'+p.join('&')+'" style="width:'+w+'px;height:'+h+'px;"></iframe>');
						})();
						</script>
					</div>
				</div>
				<?php endif; ?>
		 </div>
		 <div class="dimensional_code"><img src="/img/dimensional_code.png"></div>
	</div>
</div>
<script type="text/javascript">
	$('#index-login-form').vForm({
		success: function (data) {
			if(data.isValid){
				window.location.href="<?php $this->url('job/index/search'); ?>";
			}
		}
	});
</script>
<div id="main" class="container">
	<div class="job-search">
		<form class="form-inline" method="get"
			action="<?php $this->url('job/index/search'); ?>">
			<div class="row">
			<div class="span9">
				<input type="hidden" name="module" value="job" />
				<input type="hidden" name="controller" value="index" />
				<input type="hidden" name="action" value="search" />
				<input id="city-select-value" name="city" <?php if (@ $city) {echo "value='$city'";}?> type="hidden" />
				<div class="controls controls-row">
					<input name="title" class="span7" type="text" placeholder="搜索关键字">
					<input id="city-select-input" name="city_name" class="span2" <?php if (@ $city_name) {echo "value='$city_name'";}?> type="text" placeholder="选择城市" onclick="selectCity('#city-select-input', '#city-select-value');" />
				</div>
				<div class="controls controls-row">
					<select class="span3" name="type">
					<option value="">工作类型</option>
					<option value="全部" <?php if ($type == '全部') echo 'selected="selected"';?>>全部</option>
					<option value="全职" <?php if ($type == '全职') echo 'selected="selected"';?>>全职</option>
					<option value="兼职" <?php if ($type == '兼职') echo 'selected="selected"';?>>兼职</option>
				</select> <select name="experience" class="span3">
					<option <?php if (! $experience) echo 'selected="selected"';?> value="">工作年限</option>
					<option value="全部" <?php if ($experience == '全部') echo 'selected="selected"';?>>全部</option>
					<option value="应届生" <?php if ($experience == '应届生') echo 'selected="selected"';?>>应届生</option>
					<option value="1-3年" <?php if ($experience == '1-3年') echo 'selected="selected"';?>>1-3年</option>
					<option value="3-5年" <?php if ($experience == '3-5年') echo 'selected="selected"';?>>3-5年</option>
					<option value="5-10年" <?php if ($experience == '5-10年') echo 'selected="selected"';?>>5-10年</option>
					<option value="大于10年" <?php if ($experience == '大于10年') echo 'selected="selected"';?>>大于10年</option>
				</select>
				<select class="span3"  name="salary">
					<option <?php if (! $salary) echo 'selected="selected"';?> value="">薪资</option>
					<option value="0" <?php if ($salary == '0') echo 'selected="selected"';?>>不限</option>
					<option value="低于1000" <?php if ($salary == '低于1000') echo 'selected="selected"';?>>低于1000</option>
					<option value="1000-3000" <?php if ($salary == '1000-3000') echo 'selected="selected"';?>>1000-3000</option>
					<option value="3000-6000" <?php if ($salary == '3000-6000') echo 'selected="selected"';?>>3000-6000</option>
					<option value="6000-10000" <?php if ($salary == '6000-10000') echo 'selected="selected"';?>>6000-10000</option>
					<option value="10000以上" <?php if ($salary == '10000以上') echo 'selected="selected"';?>>10000以上</option>
				</select>
				</div>
				</div>
				<div class="span3">
					<div class="controls controls-row">
					<input type="submit" class="span3 btn btn-danger" value="搜索" />
					</div>
				</div>
			</div>
		</form>
	</div>

	<hr />
</div>
<script>
$.get('<?php $this->url('city/index/select')?>', function(data){
	$('body').append(data);
});
</script>
