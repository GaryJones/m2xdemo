<?php

// Options retrieval function

function vp_pf_option($key, $default = null)
{
	if( !function_exists( 'vp_option' ) )
		return $default;

	return vp_option( VP_PF_OPTION_KEY . '.' . $key, $default );
}

/**
 * EOF
 */