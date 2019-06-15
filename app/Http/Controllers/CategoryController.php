<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\Category as categoryResource;

class CategoryController extends Controller
{
    public function index()
    {
    	$categories = Category::enabled()->withCount('posts')->orderBy('order')->get();
    	return categoryResource::collection($categories);
    }
}
