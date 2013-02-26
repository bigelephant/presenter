<?php namespace BigElephant\Presenter\View;

use BigElephant\Presenter\PresentableInterface;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\View\Environment as BaseEnvironment;
use Illuminate\View\View;

class Environment extends BaseEnvironment {

	/**
	 * Get a evaluated view contents for the given view.
	 *
	 * @param  string  $view
	 * @param  array   $data
	 * @return Illuminate\View\View
	 */
	public function make($view, array $data = array())
	{
		$data = $this->makePresentable($data);

		return parent::make($view, $data);
	}

	/**
	 * Turn any PresenatableInterface'd objects into Presenters
	 *
	 * @param  array $data
	 * @return array $data
	 */
	protected function makePresentable(array $data)
	{
		foreach ($data AS $key => $value)
		{
			if ($value instanceof PresentableInterface)
			{
				$data[$key] = $value->getPresenter();
			}
			else if ($value instanceof Collection || $value instanceof Paginator)
			{
				foreach ($value AS $k => $v)
				{
					if ($v instanceof PresentableInterface)
					{
						$data[$key][$k] = $v->getPresenter();
					}
				}
			}
		}

		return $data;
	}
}
