<?php
$this->setWrap(NULL);
?>
<style>
#city-select-map a {
	margin-right: 10px;
}
#city-select-map strong {
	margin-right: 20px;
}
#city-select-map ul {
	overflow: hidden;
	margin-bottom: 0;
}
#city-select-map li {
	list-style:none;
	float:left;
}
#city-select-map li strong {
	line-height: 20px;
    padding-bottom: 8px;
    padding-top: 8px;
	display:block;
	float:left;
	width:40px;
}
#city-select-map .tab-pane {
	padding:10px 20px;
	background-color:#eee;
	margin:10px;
}
</style>


		
<div id="city-select-map" class="modal hide fade" style="display:none;width:830px;">
	<div class="modal-header text-right">
		<button type="button" class="btn " data-dismiss="modal" aria-hidden="true">关闭</button>
	</div>
	<div class="modal-body">
<p><a href="#" class="city-item" data-city-code="">不限</a></p>
<p>
	<strong>热门城市:</strong>
	<a href="#" class="city-item" data-city-code="110000">北京</a>
	<a href="#" class="city-item" data-city-code="310000">上海</a>
	<a href="#" class="city-item" data-city-code="440100">广州</a>
	<a href="#" class="city-item" data-city-code="440300">深圳</a>
	<a href="#" class="city-item" data-city-code="420100">武汉</a>
	<a href="#" class="city-item" data-city-code="320100">南京</a>
	<a href="#" class="city-item" data-city-code="120000">天津</a>
	<a href="#" class="city-item" data-city-code="330100">杭州</a>
</p>
<?php
$provinceList = array(
	'A	-	G' => array(340000=>'安徽', 350000=>'福建', 620000=>'甘肃', 440000=>'广东', 450000=>'广西', 520000=> '贵州'),
	'H	-	J' => array(
		130000=>'河北',
		230000=>'黑龙江',
		460000=>'海南',
		410000=>'河南',
		420000=>'湖北',
		430000=>'湖南',
		220000=>'吉林',
		320000=>'江苏',
		360000=>'江西'
	),
	'L	-	S' => array(
		210000=>'辽宁',
		150000=>'内蒙',
		640000=>'宁夏',
		630000=>'青海',
		140000=>'山西',
		510000=>'四川',
		610000=>'陕西',
		370000=>'山东'
	),
	'T	-	Z' => array(
		650000=>'新疆',
		540000=>'西藏',
		530000=>'云南',
		330000=>'浙江'
	)
);


?>
<p><strong>所有省份:</strong></p>
<?php foreach ($provinceList as $key => $list):?>
<ul class="nav nav-tabs">
	<li>
		<strong><?php echo $key;?></strong>
	</li>
	<?php foreach ($list as $cityCode => $name):?>
	<li>
		<a href="#province-<?php echo $cityCode;?>" data-toggle="tab"><?php echo $name;?></a>
	</li>
	<?php endforeach;?>
</ul>

<div class="tab-content">
	<?php foreach ($list as $cityCode => $name):?>
	<div class="tab-pane" id="province-<?php echo $cityCode;?>">
		<?php foreach ($cityTree[$cityCode]['child'] as $cityItem):?>
			<a href="#" class="city-item" data-city-code="<?php echo $cityItem['code'];?>"><?php echo $cityItem['name'];?></a>
		<?php endforeach;?>
	</div>
	<?php endforeach;?>
</div>
<?php endforeach;?>

</div>		
</div>

<script type="text/javascript">
selectCity = function (fieldQuery, fieldValueQuery) {
	$('#city-select-map').modal('show');
	selectCity.fieldQuery = fieldQuery;
	selectCity.fieldValueQuery = fieldValueQuery;
};
selectCity.select = function () {
	var $this = $(this); 
	$(selectCity.fieldQuery).val($this.html());
	$(selectCity.fieldValueQuery).val($this.attr('data-city-code'));
	$('#city-select-map').modal('hide');
};
$('.city-item').click(selectCity.select);
</script>