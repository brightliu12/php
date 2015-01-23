<!DOCTYPE html>
<html lang="zh-cn" xmlns:wb=“http://open.weibo.com/wb”>
<head>
<title>有活</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="wb:webmaster" content="a95d25d9e23b560b" />
<meta property="qc:admins" content="101142177761231750576375" />
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen" />
<!-- <link href="css/bootstrap-test.css" rel="stylesheet" media="screen" /> -->
<link href="css/docs.css" rel="stylesheet" media="screen" />
<link href="css/global.css" rel="stylesheet" media="screen" />
<link href="css/bootstrap-responsive.min.css" rel="stylesheet" media="screen" />
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--[if lte IE 6]>
<link href="css/bootstrap-ie6.min.css" rel="stylesheet" media="screen" />
<link href="css/ie.css" rel="stylesheet" media="screen" />
<link href="css/ie6.css" rel="stylesheet" media="screen" />
<script type="text/javascript" src="js/bootstrap-ie.js"></script>
<script type="text/javascript">
	$.bootstrapIE6(el)
</script>
<![endif]-->

<script src="js/global.js"></script>
<script src="js/vform.js"></script>
<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
<style>
#nav .container {width:960px;}
.index-welcome{font-size:20px}
.navbar-text{line-height:85px}

</style>
</head>
<body>
 <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container top-nav" id="top-nav">
        	<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
			</button>
          <a class="navbar-brand" href="<?php $this->url();?>"><img class="logo" src="img/new_logo.png" width="100" height="90" /></a>
          <div class="nav-collapse collapse">
	            <ul class="nav">
	          		<script src="<?php $this->url('index/index/top', array('id' => @$_GET['id']));?>"></script>
	            </ul>
			</div>
		</div>
    </div>
</div>

	<?=$this->childHtml; ?>
	<div id="footer">
		 <div class="container">
			<ul class="footer-links">
<!-- 				<li><a href="#">关于我们</a></li> -->
<!-- 				<li class="muted">-</li> -->
<!-- 				<li><a href="#">服务承诺</a></li> -->
<!-- 				<li class="muted">-</li> -->
<!-- 				<li><a href="#">隐私保密</a></li> -->
<!-- 				<li class="muted">-</li> -->
<!-- 				<li><a href="http://weibo.com/u/3263735830" target="_blank">有活微博</a></li> -->
<!-- 				<li class="muted">-</li> -->
<!-- 				<li><a href="#">信息来源网站</a></li> -->
			</ul>
			<p>上海有活信息科技有限公司 2013</p>
		</div>
	</div>
	<div id="modal" class="modal hide fade" style="width:830px;">
		<div class="modal-header text-right">
	    	<button type="button" class="btn " data-dismiss="modal" aria-hidden="true">关闭</button>
	  	</div>
		<div class="modal-body"></div>
	</div>
	<script type="text/javascript">
		// 去掉模态对话框缓存
		$('#modal').on('hidden', function (e) {
			$(this).data('modal', false);
		});
	</script>
</body>
</html>
