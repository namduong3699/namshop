<?php 
	namespace App\Http\Controller;

	class HomeController extends Controller {
		public function index() {
			return view('index', [
				
			])
		}

		public function about() {
			return view('about', [
				'title' => 'Page about'
			]);
		}
	}
?>