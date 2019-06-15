<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Post;

class CollectionController extends Controller
{
    public function store(Request $request)
    {
    	$user = Auth::user();
    	return $user->collect($request->post_id);
    }
}
