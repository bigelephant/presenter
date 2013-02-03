<?php namespace BigElephant\Presenter;

interface PresentableInterface {

	/**
	 * Return a created presenter.
	 *
	 * @return BigElephant\Presenter\Presenter
	 */
	public function getPresenter();
}