<?php
// 关闭布局
$this->setWrap ( NULL );
?>
<style>
input.span7, textarea.span7, .uneditable-input.span7{width: 526px;}
input.span2, textarea.span2, .uneditable-input.span2{width:126px}
.span3 {width: 220px;}
.span5 {width: 380px;}
.span2 {width: 140px;}
</style>
<form id="form-saveSearch" class="form-horizontal" method="POST"
	action="<?php $this->url('job/subscribe/add');?>" style="margin: 20px;">
	<div class="controls controls-row">
		<input class="span7" name="title" type="text" placeholder="职位搜索"
			<?php if (@ $title) {echo "value='$title'";}?> />
		<input id="city-select-input-subscribe" name="city_name" <?php if (@ $city_name) {echo "value='$city_name'";}?> class="span2" type="text" placeholder="选择城市" onclick="selectCity('#city-select-input-subscribe', '#city-select-value-subscribe');" />
		<input id="city-select-value-subscribe" name="city" <?php if (@ $city) {echo "value='$city'";}?> type="hidden" />
	</div>
	<div class="controls controls-row" id="searchAdvance">
		<select class="span3" name="type">
				<option value="">工作类型</option>
				<option value="全部" <?php if ($type == '全部') echo 'selected="selected"';?>>全部</option>
				<option value="全职" <?php if ($type == '全职') echo 'selected="selected"';?>>全职</option>
				<option value="兼职" <?php if ($type == '兼职') echo 'selected="selected"';?>>兼职</option>
			</select> <select name="experience" class="span3">
				<option <?php if (! $experience) echo 'selected="selected"';?>>工作年限</option>
				<option value="全部" <?php if ($experience == '全部') echo 'selected="selected"';?>>全部</option>
				<option value="应届生" <?php if ($experience == '应届生') echo 'selected="selected"';?>>应届生</option>
				<option value="1-3年" <?php if ($experience == '1-3年') echo 'selected="selected"';?>>1-3年</option>
				<option value="3-5年" <?php if ($experience == '3-5年') echo 'selected="selected"';?>>3-5年</option>
				<option value="5-10年" <?php if ($experience == '5-10年') echo 'selected="selected"';?>>5-10年</option>
				<option value="大于10年" <?php if ($experience == '大于10年') echo 'selected="selected"';?>>大于10年</option>
			</select>
			<select class="span3"  name="salary">
				<option <?php if (! $salary) echo 'selected="selected"';?>>薪资</option>
				<option value="0" <?php if ($salary == '0') echo 'selected="selected"';?>>不限</option>
				<option value="低于1000" <?php if ($salary == '低于1000') echo 'selected="selected"';?>>低于1000</option>
				<option value="1000-3000" <?php if ($salary == '1000-3000') echo 'selected="selected"';?>>1000-3000</option>
				<option value="3000-6000" <?php if ($salary == '3000-6000') echo 'selected="selected"';?>>3000-6000</option>
				<option value="6000-10000" <?php if ($salary == '6000-10000') echo 'selected="selected"';?>>6000-10000</option>
				<option value="10000以上" <?php if ($salary == '10000以上') echo 'selected="selected"';?>>10000以上</option>
			</select>
	</div>
	<div class="controls controls-row"></div>
	<div class="controls controls-row">
		<span class="span5 control-group" style="margin: 0;"> <input
			name="name" type="text" placeholder="请输入搜索器名称"
			<?php if (@ $name) {echo "value='$name'";}?> /> <script type="data">{errorMsg : '请输入搜索器名称', successMsg: '', rules:['require']}</script>
			<span class="vform-help help-inline"></span>
		</span> <input type="submit" class="btn btn-primary span2"
			value=" 保 存 " /> <a href="#" target="_blank" class="span2 btn-small js-show">查看搜索结果</a>
	</div>
</form>
<p class="text-success hide text-center" id="tip-saveSearch"></p>
<script>
$('#form-saveSearch').vForm({
	success: function (result) {
		var reload = "<?php echo @ $_GET['reload'];?>";
		if (result.isValid) {
			var $top = $('#tip-saveSearch');
			$top.html('添加成功!');
			$top.fadeIn("slow",function(){
				$('#modal').modal('hide');
				window.location.reload(true);
// 				if (reload.length) {
// 					window.location.reload(true);
// 				}
		 	});
		} else if (result.errorType == 'noLogin') {
			login();
		}
	}
});
$('a.js-show').click(function() {
	var params = $('#form-saveSearch').serialize();
	$(this).attr('href', '<?php $this->url('job/index/search')?>' + '&' + params);
	return true;
});
</script>