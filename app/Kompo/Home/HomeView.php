<?php

namespace App\Kompo\Home;

use Kompo\View;

class HomeView extends View
{
	public $class = 'max-w-4xl mx-auto text-gray-700';

	public function komponents()
	{
		return [
			_Html('Welcome to Kompo!')->class('font-black text-2xl my-8'),
			_Rows(
				$this->homeCard('Documentation', 'document-text', 'Read the complete docs on kompo.io. We\'ve put in a LOT of effort writing it to make it as easy to understand as possible.')
					->href('https://kompo.io/docs'),
				$this->homeCard('Elements API', 'view-list', 'Browse the full list of usable Elements and their available methods. They come in different base styles too!')
					->href('https://kompo.io/elements-api'),
				$this->homeCard('Ready to pull modules', 'download', 'Search for prebuilt ready-to-pull modules in Kompo\'s online library. This is the biggest time saver of all!')
					->href('https://kompo.io/examples'),
				$this->homeCard('Sponsor', 'heart', 'Kompo\'s adventure has just begun. Please consider sponsoring so we can allocate more resources on the project.')
					->href('https://github.com/sponsors/kompo'),
			)->class('grid grid-cols-1 md:grid-cols-2 bg-white border border-gray-200 rounded-lg'),
		];
	}

	protected function homeCard($title, $icon, $description)
	{
		return _Rows(
			_Html($title)->class('text-xl mb-2 uppercase font-bold'),
			_Html($description)->class('text-sm text-gray-400'),
		)->class('p-4')
		->icon(
			_Svg($icon)->class('text-3xl text-gray-300 mr-2')
		);
	}
}
