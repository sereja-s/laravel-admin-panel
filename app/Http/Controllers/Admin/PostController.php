<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
	/**
	 * Метод показывает все статьи отсортированные по дате
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$posts = Post::orderBy('created_at', 'DESC')->get();

		return view('admin.post.index', [
			'posts' => $posts
		]);
	}

	/**
	 * Метод передаёт все категории на страницу создания статей (для формирования выпадающего списка категорий)
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$categories = Category::orderBy('created_at', 'DESC')->get();

		return view('admin.post.create', [
			'categories' => $categories
		]);
	}

	/**
	 * Метод для создания новой статьи
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$post = new Post();

		$post->title = $request->title;
		$post->img = $request->img;
		$post->text = $request->text;
		$post->cat_id = $request->cat_id;
		// сохраняем полученные из формы данные
		$post->save();

		return redirect()->back()->withSuccess('Статья была успешно добавлена!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Post  $post
	 * @return \Illuminate\Http\Response
	 */
	public function show(Post $post)
	{
		//
	}

	/**
	 * Метод показывает форму для редактирования статьи
	 *
	 * @param  \App\Models\Post  $post
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Post $post)
	{
		$categories = Category::orderBy('created_at', 'DESC')->get();

		return view('admin.post.edit', [
			'categories' => $categories,
			'post' => $post,
		]);
	}

	/**
	 * Метод принимает и сохраняет данные, полученные из формы при обновлении(редактировании) статьи
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Post  $post
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Post $post)
	{
		$post->title = $request->title;
		$post->img = $request->img;
		$post->text = $request->text;
		$post->cat_id = $request->cat_id;
		$post->save();

		return redirect()->back()->withSuccess('Статья была успешно обновлена!');
	}

	/**
	 * Метод для удаления статей
	 *
	 * @param  \App\Models\Post  $post
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Post $post)
	{
		$post->delete();
		return redirect()->back()->withSuccess('Статья была успешно удалена!');
	}
}
