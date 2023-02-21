<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	use HasFactory;

	public function category()
	{
		// реализуем связь статей с категориями (чтобы на странице со статьями выводилась категория к которой они принадлежат)
		return $this->belongsTo('App\Models\Category', 'cat_id');
	}
}
