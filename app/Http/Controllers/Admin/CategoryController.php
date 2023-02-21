<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	/**
	 * Показ всех категорий
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// в переменную сохраним все категории
		$categories = Category::orderBy('created_at', 'desc')->get();

		// переменую передаём на страницу показа всех категорий
		return view('admin.category.index', [
			'categories' => $categories
		]);
	}

	/**
	 * Метод отвечает за вывод формы создания(добавления) категорий
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.category.create');
	}

	/**
	 * Метод создания категорий
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$new_category = new Category();

		// новой категории присвоим название, которое приходит из соответствующей формы методом POST
		$new_category->title = $request->title;
		// сохраним это название
		$new_category->save();

		return redirect()->back()->withSuccess('Категория была успешно добавлена!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function show(Category $category)
	{
		//
	}

	/**
	 * Метод отвечает за вывод формы редактирования категорий
	 *
	 * @param  \App\Models\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Category $category)
	{
		return view('admin.category.edit', [
			'category' => $category
		]);
	}

	/**
	 * Метод для обновления(редактирования) категорий
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Category $category)
	{
		$category->title = $request->title;
		$category->save();

		return redirect()->back()->withSuccess('Категория была успешно обновлена!');
	}

	/**
	 * Метод удаления категорий
	 *
	 * @param  \App\Models\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Category $category)
	{
		$category->delete();
		return redirect()->back()->withSuccess('Категория была успешно удалена!');
	}
}
