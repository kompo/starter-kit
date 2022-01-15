<?php

namespace App\Kompo\Dashboard;

use Kompo\View;

class DashboardView extends View
{
	public function render()
	{
		return [
			_Html('Welcome to your kompo dashboard!')->class('font-black text-2xl text-gray-700 my-8 p-4 bg-white border border-gray-200 rounded-lg'),
		];
	}
}
