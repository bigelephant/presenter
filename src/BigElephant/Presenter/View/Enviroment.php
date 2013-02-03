<?php namespace BigElephant\Presenter\View;

use BigElephant\Presenter\PresentableInterface;
use Illuminate\Support\Collection;
use Illuminate\View\Environment as BaseEnvironment;
use Illuminate\View\View;

class Environment extends BaseEnvironment {

	public function make($view, array $data = array())
	{
		$data = $this->makePresentable($data);

		return parent::make($view, $data);
	}

	protected function makePresentable(array $data)
	{
		foreach ($data AS $key => $value)
		{
			if ($value instanceof PresentableInterface)
			{
				$data[$key] = $value->getPresenter();
			}
			else if ($value instanceof Collection)
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