<?php
$this->setWrap ( '_Layout/Html' );
?>
<style type="text/css">
.top-collection{display:block}
</style>
 <iframe src="<?php //echo $joburl?>http://www.baidu.com" width="100%" height="500px" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
 <script type="text/javascript">
$('.js-collect').click(function () {
	if (! checkLogin()) {
		return false;
	}
	var $this = $(this);
	if ($this.data('submiting')) {
		return false;
	}
	$this.data('submiting', true);
	$.get('<?php $this->url('content/collect/add', 'type=job')?>', {cid : $this.attr('data-jid')}, function (result) {
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