<?php 

namespace App\Kompo\Menus;

use Kompo\Menu;

class Navbar extends Menu
{
	/*
	|
	| This is an example Navbar to get you started. Feel free to modify it or even delete it...
	|
	*/

	public $fixed = true;
	public $class = 'px-4 bg-white border-b border-gray-200';

	public function render()
	{
		return [
			_SidebarToggler(), //Only displays on smaller screens

			_Link('KOMPO')->class('font-black py-4')->href('home'),
			
			auth()->check() ? 
				
				_AuthMenu()->href('dashboard')
					->submenu(
						_Link('Logout')->class('px-4 py-2 border border-gray-200')
							->selfPost('logout')->redirect()
					) : 
				
				_Flex(
					_Link('Login')->href('login'),
					_Link('Register')->href('register'),
				)->class('space-x-4'),
		];
	}

	public function logout()
	{
		\Auth::guard()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->to('/');
	}
}