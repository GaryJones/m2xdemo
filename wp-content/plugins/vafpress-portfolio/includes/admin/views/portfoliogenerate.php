<style type="text/css">
	dl dt {
		background:#eee;
		float:left;
		font-weight:bold;
		margin-right:10px;
		padding:5px;
		width:150px;
	}
	dl dd {
		margin:2px 0;
		padding:5px 0;
	}
	.vp-pf-percentage{
		position: absolute;
		width: 100%;
		left: 0;
		line-height: 2em;
	}
	.vp-portfolio-generate{
		padding: 10px 20px 15px 20px;
	}
	.vp-pf-progressbar * {
		-webkit-box-sizing: content-box !important;
		-moz-box-sizing: content-box !important;
		-ms-box-sizing: content-box !important;
		box-sizing: content-box !important;
	}
	.vp-js-portfolio-generate{
		width: 100px;
	}
</style>
<div class="vp-field vp-portfolio-generate">
	<div class="vp-pf-progressbar" style="text-align: center;">
		<span class="vp-pf-percentage" style="position: absolute;">0%</span>
	</div>
	<dl>
		<dt>Status</dt>
		<dd class="vp-js-status">-</dd>

		<dt>Total</dt>
		<dd class="vp-pf-total"><?php echo $portfolio_count; ?></dd>

		<dt>Success</dt>
		<dd class="vp-pf-success">0</dd>

		<dt>Failed</dt>
		<dd class="vp-pf-failed">0</dd>
	</dl>
	<input class="vp-js-portfolio-generate vp-button button button-primary" type="button" value="<?php _e('Regenerate', 'vp_textdomain') ?>" />
	<span style="margin-left: 10px;">
		<span class="vp-field-loader vp-js-loader" style="display: none;"><img src="<?php VP_Util_Res::img_out('ajax-loader.gif', ''); ?>" style="vertical-align: middle;"></span>
	</span>
</div>