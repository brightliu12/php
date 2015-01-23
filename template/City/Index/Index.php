<?php
$this->setWrap(NULL);
?>
<style type="text/css">
	h4.index-city-title{color:#B38C4B;}
	.index-main-city-l{display:inline-block;zoom:1;*display:inline;width:370px;vertical-align:top;margin-bottom: 10px;}
	.index-main-city a,.index-main-city a:active,.index-main-city a:hover{color:#666666}
	.index-main-city-l a{padding-left:10px}
	.index-provices{padding-bottom:20px}
	.index-provices a{padding-left:20px}
	a.city-name{padding-left:10px;white-space: nowrap}
	.provice{margin:10px 0px}
</style>
<h4 class="index-city-title">主要城市:</h4>
<div id="index-main-city">
<div class="index-main-city">
	<div class="index-main-city-l">
		<span>A</span><a href="#">安康</a>
	</div>
	<div class="index-main-city-l">
		<span>L</span><a href="#">廊坊</a><a href="#">临汾</a><a href="#">兰州</a><a href="#">洛阳</a></div>
</div>

<div class="index-main-city">
	<div class="index-main-city-l">
		<span>B</span><a href="#"><strong>北京</strong></a></div>
	<div class="index-main-city-l">
		<span>M</span><a href="#">绵阳</a>
	</div>
</div>

<div class="index-main-city">
	<div class="index-main-city-l">
		<span>C</span><a href="#">长春</a><a href="#">成都</a><a href="#">常熟</a><a href="#">常州</a><a href="#">常德</a><a href="#">重庆</a>	</div>
	<div class="index-main-city-l">
		<span>N</span><a href="#">南京</a><a href="#">宁波</a><a href="#">南昌</a><a href="#">南通</a><a href="#">南宁</a>
	</div>
</div>

<div class="index-main-city">
	<div class="index-main-city-l">
		<span>D</span><a href="#">大连</a><a href="#">东莞</a><a href="#">丹东</a><a href="#">大庆</a>
	</div>
	<div class="index-main-city-l">
		<span>Q</span><a href="#">青岛</a><a href="#">泉州</a><a href="#">秦皇岛</a><a href="#">清远</a>
	</div>
</div>

<div class="index-main-city">
	<div class="index-main-city-l">
		<span>E</span><a href="#">鄂尔多斯</a></div>
	<div class="index-main-city-l">
		<span>S</span><a href="#"><strong>上海</strong></a><a href="#"><strong>深圳</strong></a><a href="#">沈阳</a><a href="#">石家庄</a><a href="#">苏州</a><a href="#">三亚</a><a href="#">绍兴</a><a href="#">汕头</a><a href="#">顺德</a>
	</div>
</div>

<div class="index-main-city">
	<div class="index-main-city-l">
		<span>F</span><a href="#">福州</a><a href="#">佛山</a><a href="#">抚顺</a>
	</div>
	<div class="index-main-city-l">
		<span>T</span><a href="#">天津</a><a href="#">太原</a><a href="#">台州</a><a href="#">唐山</a><a href="#">秦州</a><a href="#">铁岭</a>
	</div>
</div>

<div class="index-main-city">
	<div class="index-main-city-l">
		<span>G</span><a href="#"><strong>广州</strong></a><a href="#">贵阳</a><a href="#">赣州</a>	</div>
	<div class="index-main-city-l">
		<span>W</span><a href="#">武汉</a><a href="#">无锡</a><a href="#">温州</a><a href="#">乌鲁木齐</a><a href="#">芜湖</a><a href="#">威海</a>
	</div>
</div>

<div class="index-main-city">
	<div class="index-main-city-l">
		<span>H</span><a href="#">哈尔滨</a><a href="#">杭州</a><a href="#">合肥</a><a href="#">海口</a><a href="#">呼和浩特</a><a href="#">惠州</a><a href="#">衡阳</a><a href="#">淮安</a><a href="#">湖州</a><a href="#">邯郸</a>
	</div>
	<div class="index-main-city-l">
		<span>X</span><a href="#">西安</a><a href="#">夏天</a><a href="#">徐州</a><a href="#">襄阳</a><a href="#">湘潭</a><a href="#">威海</a>
	</div>
</div>

<div class="index-main-city">
	<div class="index-main-city-l">
		<span>J</span><a href="#">济南</a><a href="#">嘉兴</a><a href="#">金华</a><a href="#">吉林</a><a href="#">江门</a><a href="#">荆州</a><a href="#">江阴</a><a href="#">济宁</a><a href="#">九江</a>
	</div>
	<div class="index-main-city-l">
		<span>Y</span><a href="#">烟台</a><a href="#">扬州</a><a href="#">宜昌</a><a href="#">盐城</a><a href="#">义乌</a><a href="#">营口</a><a href="#">银川</a>
	</div>
</div>

<div class="index-main-city">
	<div class="index-main-city-l">
		<span>K</span><a href="#">昆明</a><a href="#">昆山</a></div>
	<div class="index-main-city-l">
		<span>Z</span><a href="#">漳州</a><a href="#">郑州</a><a href="#">中山</a><a href="#">珠海</a><a href="#">镇江</a><a href="#">株洲</a><a href="#">肇庆</a><a href="#">张家港</a><a href="#">淄博</a><a href="#">湛江</a>
	</div>
</div>
</div>
<?php $citys = require PATH_CACHE.'city.php';?>
<h4 class="index-city-title">所有省份:</h4>
<div class="index-provices index-main-city" id="provice">
	<div class="provice">
		<span>A-G</span>
		<?php foreach ($citys as $key=>$value):?>
		<?php if(in_array($key, array('a','b','c','d','e','f','g'))):;?>
			<?php foreach ($value as $provice):?>
			<a href="#" class="provice-name"><?php echo $provice['city']['name'];?></a>
				<div class="child-citys" style="display: none">
				<?php foreach ($provice['child'] as $child):?>
				<a href="" class="city-name"><?=$child['name'];?></a>
				<?php endforeach;?>
				</div>
			<?php endforeach;?>
		<?php endif; endforeach;?>
	</div>
	<div class="provice">
		<span>H-J</span>
		<?php foreach ($citys as $key=>$value):?>
		<?php if(in_array($key, array('h','i','j'))):;?>
			<?php foreach ($value as $provice):?>
			<a href="#" class="provice-name"><?php echo $provice['city']['name'];?></a>
				<div class="child-citys" style="display: none">
				<?php foreach ($provice['child'] as $child):?>
				<a href="" class="city-name"><?=$child['name'];?></a>
				<?php endforeach;?>
				</div>
			<?php endforeach;?>
		<?php endif; endforeach;?>
	</div>
	<div class="provice">
		<span>L-S</span>
		<?php foreach ($citys as $key=>$value):?>
		<?php if(in_array($key, array('l','m','n','o','p','q','r','s'))):;?>
			<?php foreach ($value as $provice):?>
			<a href="#" class="provice-name"><?php echo $provice['city']['name'];?></a>
				<div class="child-citys" style="display: none">
				<?php foreach ($provice['child'] as $child):?>
				<a href="" class="city-name"><?=$child['name'];?></a>
				<?php endforeach;?>
				</div>
			<?php endforeach;?>
		<?php endif; endforeach;?>
	</div>
	<div class="provice">
		<span>T-Z</span>
		<?php foreach ($citys as $key=>$value):?>
		<?php if(in_array($key, array('t','u','v','w','x','y','z'))):;?>
			<?php foreach ($value as $provice):?>
			<a href="#" class="provice-name"><?php echo $provice['city']['name'];?></a>
				<div class="child-citys" style="display: none">
				<?php foreach ($provice['child'] as $child):?>
				<a href="" class="city-name"><?=$child['name'];?></a>
				<?php endforeach;?>
				</div>
			<?php endforeach;?>
		<?php endif; endforeach;?>
	</div>
	
</div>
		
<script type="text/javascript">
	$('.provice').find('a.provice-name').each(function(){
		var $this = $(this);
		var child_citys = $this.next();
		var city_name = child_citys.html();	
		$this.popover({'content':city_name,'html':true});
	});
	$('#index-main-city a').click(function(){
		var $this = $(this);
		var content = $this.text();
		$('#city-close').trigger("click");
		$('#city').html(content);
	});
	
</script>
