<?php 

namespace App\Kompo\Menus;

use Kompo\Menu;

class DashboardSidebar extends Menu
{
	/*
	|
	| This is an example Sidebar to get you started. Feel free to modify it or even delete it...
	|
	*/

	public $order = 1;
	public $class = 'bg-gradient-to-b from-gray-900 to-gray-700 text-gray-100 w-full sm:w-60 overflow-y-auto';

	public function render()
	{
		return [
			$this->section(
				$this->sectionTitle('Demos'),
				$this->mainLink('Ready to pull modules')->icon('download')->href('https://kompo.io/examples'),
				$this->mainLink('Elements API')->icon('view-list')->href('https://kompo.io/elements-api'),
			),
			$this->section(
				$this->sectionTitle('Support'),
				$this->mainLink('Documentation')->icon('document-text')->href('https://kompo.io/docs'),
				$this->mainLink('Sponsor')->icon('heart')->href('https://github.com/sponsors/kompo'),
			),
		];
	}

	/*
	|--------------------------------------------------------------------------
	| Useful Sidebar Elements
	|--------------------------------------------------------------------------
	|
	| Below is a list of elements extracted to build the final sidebar. 
	| Feel free to modify the methods to match your prefered way of komposing a sidebar.
	|
	*/

	protected function section(...$rows)
	{
		return _Rows($rows)
			->class('my-4');
	}

	protected function sectionTitle($label)
	{
		return _Html($label)
			->class('text-xs font-bold uppercase mb-2 pl-3 text-gray-400');
	}

	protected function mainLink($label)
	{
		return _Link($label)->class('text-sm lg:text-base py-2 px-3');
	}
}