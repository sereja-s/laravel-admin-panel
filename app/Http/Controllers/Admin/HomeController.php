<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function index()
	{
		// в переменной сохраним кол-во всех постов(статей) в БД
		$posts_count = Post::all()->count();
		// в переменной сохраним кол-во всех категорий в БД
		$categories_count = Category::all()->count();

		// эти переменные передадим на страничку по адресу: admin.home.index (здесь- view/admin/home/index.blade.php) 
		return view('admin.home.index', [
			'posts_count' => $posts_count,
			'categories_count' => $categories_count,
		]);
	}
}
