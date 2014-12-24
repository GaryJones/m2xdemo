<?php

class VP_Control_Field_PortfolioGenerate extends VP_Control_Field
{

	public function __construct()
	{
		parent::__construct();
	}
	
	public static function withArray($arr = array(), $class_name = null)
	{
		if(is_null($class_name))
			$instance = new self();
		else
			$instance = new $class_name;
		$instance->_basic_make($arr);
		return $instance;
	}

	public function render($is_compact = false)
	{
		// Setup Data
		$this->_setup_data();
		$this->add_data('portfolio_count', VP_PF_Portfolio::instance()->count());
		return VP_View::instance()->load('portfoliogenerate', $this->get_data());
	}

}

/**
 * EOF
 */