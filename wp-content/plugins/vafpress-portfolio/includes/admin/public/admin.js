(function($){

	var $button   = $('.vp-js-portfolio-generate'),
	    $parent   = $button.parent(),
	    $status   = $parent.find('.vp-js-status'),
	    $s_status = $parent.find('.vp-pf-success'),
	    $f_status = $parent.find('.vp-pf-failed'),
	    $loader   = $parent.find('.vp-js-loader'),
	    ids       = vp_pf.ids.slice(0),
	    total     = ids.length,
	    count     = 0,
	    success   = 0,
	    failed    = 0,
	    status    = 'start',
	    data      = {action: 'vp_pf_process_portfolio'};

	function vp_pf_reset()
	{
		ids     = vp_pf.ids.slice(0);
		total   = ids.length;
		count   = 0;
		success = 0;
		failed  = 0;
		$status.html('-');
		$s_status.html('0');
		$f_status.html('0');
		$(".vp-pf-percentage").html('0%');
		$(".vp-pf-progressbar").progressbar( "value", 0 );
	}

	function vp_pf_ajax_process(id)
	{
		if( id === undefined )
			return;

		if( status === 'pause' )
		{
			ids.unshift(id);
			return;
		}

		// set id for ajax
		data.id = id;

		$status.html('Processing: #' + id);
		$.post(ajaxurl, data, function(response) {
			$loader.fadeOut(0);
			count++;
			switch(response.status)
			{
				case true:
					success++;
					break;
				case false:
					failed++;
					break;
			}
			$s_status.html(success);
			$f_status.html(failed);
			$(".vp-pf-progressbar").progressbar( "value", ( count / total ) * 100 );
			$(".vp-pf-percentage").html( Math.round( ( count / total ) * 1000 ) / 10 + "%" );

			if(total === (success + failed))
			{
				status = 'finish';
				$button.val('Generate');
				$status.html('Done!');
			}
			vp_pf_ajax_process(ids.shift());
		}, 'JSON');
	}

	$('.vp-pf-progressbar').progressbar({value: 0});

	$('.vp-js-portfolio-generate').on('click', function(e){
		e.preventDefault();

		switch(status){
			case 'pause':
				status = 'running';
				$button.val('Pause');
				vp_pf_ajax_process(ids.shift());
				break;
			case 'running':
				$button.val('Generate');
				status = 'pause';
				break;
			case 'start':
			case 'finish':
				status = 'running';
				$button.val('Pause');
				vp_pf_reset();
				vp_pf_ajax_process(ids.shift());
				break;
		}
	})

})(jQuery);