<?php
$this->setWrap('Job/Layout');
?>
<style>
.controls-row {
	margin-bottom: 10px;
}
#factor_list{padding-right:95px}
#job-list li {margin:40px 0 50px 0;list-style:none;border-bottom:dotted 1px #ccc;}
.job-info span {margin-right:30px;}
</style>
<div style="border: solid 1px #ccc; border-radius: 3px; margin-bottom: 20px;">
	<form id="form-search" class="form-horizontal" method="get"
		action="<?php $this->url('job/index/search'); ?>" style="margin: 20px;">
		<input type="hidden" name="module" value="job" /> <input type="hidden"
			name="controller" value="index" /> <input type="hidden" name="action"
			value="search" />
		<div class="controls controls-row">
			<input class="span7" name="title" type="text" placeholder="职位搜索" <?php if (@$title) {
	echo "value='$title'";
} ?>/>
			<input id="city-select-input" name="city_name" class="span2" <?php if (@$city_name) {
	echo "value='$city_name'";
} ?> type="text" placeholder="选择城市" onclick="selectCity('#city-select-input', '#city-select-value');" />
			<input id="city-select-value" name="city" <?php if (@$city) {
	echo "value='$city'";
} ?> type="hidden" />
		</div>
		<div class="controls controls-row hide" id="searchAdvance">
			<select class="span3" name="type">
				<option value="">工作类型</option>
				<option value="全部" <?php if ($type == '全部')
	echo 'selected="selected"'; ?>>全部</option>
				<option value="全职" <?php if ($type == '全职')
	echo 'selected="selected"'; ?>>全职</option>
				<option value="兼职" <?php if ($type == '兼职')
	echo 'selected="selected"'; ?>>兼职</option>
			</select> <select name="experience" class="span3">
				<option <?php if (!$experience)
	echo 'selected="selected"'; ?> value="">工作年限</option>
				<option value="全部" <?php if ($experience == '全部')
	echo 'selected="selected"'; ?>>全部</option>
				<option value="应届生" <?php if ($experience == '应届生')
	echo 'selected="selected"'; ?>>应届生</option>
				<option value="1-3年" <?php if ($experience == '1-3年')
	echo 'selected="selected"'; ?>>1-3年</option>
				<option value="3-5年" <?php if ($experience == '3-5年')
	echo 'selected="selected"'; ?>>3-5年</option>
				<option value="5-10年" <?php if ($experience == '5-10年')
	echo 'selected="selected"'; ?>>5-10年</option>
				<option value="大于10年" <?php if ($experience == '大于10年')
	echo 'selected="selected"'; ?>>大于10年</option>
			</select>
			<select class="span3"  name="salary">
				<option <?php if (!$salary)
	echo 'selected="selected"'; ?> value="">薪资</option>
				<option value="0" <?php if ($salary == '0')
	echo 'selected="selected"'; ?>>不限</option>
				<option value="低于1000" <?php if ($salary == '低于1000')
	echo 'selected="selected"'; ?>>低于1000</option>
				<option value="1000-3000" <?php if ($salary == '1000-3000')
	echo 'selected="selected"'; ?>>1000-3000</option>
				<option value="3000-6000" <?php if ($salary == '3000-6000')
	echo 'selected="selected"'; ?>>3000-6000</option>
				<option value="6000-10000" <?php if ($salary == '6000-10000')
	echo 'selected="selected"'; ?>>6000-10000</option>
				<option value="10000以上" <?php if ($salary == '10000以上')
	echo 'selected="selected"'; ?>>10000以上</option>
			</select>
		</div>
		<div class="controls controls-row">
			<div class="span2"></div>
			<input type="submit" class="btn btn-primary span2 job-search-icon" value=" 搜 索 "   style="float:left"/>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="#" class="btn span2"
				onclick="$('#searchAdvance').toggle();">更多搜索条件</a>
		</div>


		<div class="controls controls-row" id="search_factor" style="display:none">
			<span>搜索条件：</span>
			<?php
				$search_title=@$title?$title.'+':null;
				$search_city_name=@$city_name?$city_name.'+':null;
				$search_type=@$type?$type.'+':null;
				$search_experience=@$experience?$experience.'+':null;
				$search_salary=@$salary?$salary.'+':null;
			?>
			<span id="factor_list" class="span2" style="float:none"><?php echo rtrim($search_title.$search_city_name.$search_type.$search_experience.$search_salary,'+')?></span>
			<a href="#" class="btn" id="js-saveSearch" style="float:none">保存为搜索器</a>
		</div>
	</form>
	<div style="padding-left:16px;border-top: solid 1px #ccc; border-bottom: solid 1px #ccc; height: 40px; line-height: 40px; background-color: #FAFAFA; background-image: linear-gradient(to bottom, #FFFFFF, #F2F2F2); background-repeat: repeat-x;">
		<strong>推荐职位</strong>
	</div>

	<ul style="margin:16px;" id="job-list">
<?php
foreach ($data as $item) :
		?>
		<li>
			<div class="row" style="margin-bottom: 20px">
				<div class="span3" style="overflow:hidden;white-space:nowrap;" title="<?=$item['title']; ?>">
					<a href="<?php $this->url('job/index/show', 'id=' . $item['_id']) ?>"><?=$item['title']; ?></a>
				</div>
				<div class="span3" style="overflow:hidden;white-space:nowrap;margin-left:50px;" title="<?=$item['employer']; ?>">
					<?=$item['employer']; ?>
				</div>
				<div class="span2 text-right"><button class="btn btn-small js-collect" data-jid="<?php echo $item['_id']; ?>"> 收 藏 </button></div>
			</div>
			<p class="job-info">
				<span>地点：<?=$item['city']; ?></span>
				<span>类型：<?=$item['type']; ?></span>
				<span>工作经验：<?=$item['experience']; ?></span>
				<span>薪资：<?=$item['salary']; ?></span>
			</p>
		</li>
		<?php endforeach; ?>
	</ul>

	<div class="pagination" style="margin-left:20px;">
		<ul>
			<?php if ($page > 1) : ?>
			<li><a
				href="<?php $this->url(NULL, array('page' => ($page - 1))); ?>">Prev</a></li>
			<?php endif; ?>

			<?php
$pageRange = 10;
if ($pageRange > $pageCount) {
	$pageStart = 1;
	$pageEnd = $pageCount;
} elseif ($page <= ($pageRange / 2)) {
	$pageStart = 1;
	$pageEnd = $pageRange + 1;
} elseif (($pageCount - $page) <= ($pageRange / 2)) {
	$pageStart = $pageCount - $pageRange - 1;
	$pageEnd = $pageCount;
} else {
	$pageStart = $page - ($pageRange / 2);
	$pageEnd = $page + ($pageRange / 2);
}
			?>

			<?php for ($p = $pageStart; $p <= $pageEnd; $p++) : ?>
			<?php if ($p != $page) : ?>
			<li><a href="<?php $this->url(NULL, array('page' => $p)); ?>"><?php echo $p; ?></a></li>
			<?php else : ?>
			<li class="active"><a href="#"><?php echo $p; ?></a></li>
			<?php endif; ?>
			<?php endfor; ?>

			<?php if ($page < $pageCount) : ?>
			<li><a
				href="<?php $this->url(NULL, array('page' => ($page + 1))); ?>">Next</a></li>
			<?php endif; ?>
		</ul>
	</div>
</div>
<script type="text/javascript">
	var searchList = $('#factor_list').text();
	if(searchList != ''){
		$('#search_factor').css('display','block');
	}
$.get('<?php $this->url('city/index/select') ?>', function(data){
	$('body').append(data);
});

$('#js-saveSearch').click(function() {
	if (! checkLogin()) {
		return false;
	}
	var params = '';
	$.each($("#form-search").serializeArray(), function(i, field) {
		switch (field.name) {
			case 'module':
			case 'controller':
			case 'action':
			return true;
		}
		params += '&' + field.name + '=' + field.value;
	});

	$('#modal').modal({
		backdrop: 'static',
		remote: '<?php $this->url('job/subscribe/add'); ?>' + params
	});
});

$('.js-collect').click(function () {
	if (! checkLogin()) {
		return false;
	}
	var $this = $(this);
	if ($this.data('submiting')) {
		return false;
	}
	$this.data('submiting', true);
	$.get('<?php $this->url('content/collect/add', 'type=job') ?>', {cid : $this.attr('data-jid')}, function (result) {
		if (result.isValid) {
			$this.addClass('disabled').html('已收藏').off();
		} else if (result.errorType == 'noLogin') {
			login();
		}
		$this.data('submiting', undefined);
	}, 'json');
	return false;
});
</script>