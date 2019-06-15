<?php 

namespace App\Services;
use App\Models\Post;

class PostService
{
	public function savePost($datas, $id = null)
	{
		$paths = [];
		if(!empty($datas['pictures']))
		{
			foreach($datas['pictures'] as $picture)
			{
				$paths[] = $picture->store('pictures');
			}
		}

		$oldPictures = $datas['old_pictures']??[];
		$paths = array_merge($paths, $oldPictures);

		if($id)
		{
			$post = Post::findOrFail($id);
			$post->update($datas);
			return $post->updatePictures($paths);
		}
		$post = Post::create($datas);
		return $post->updatePictures($paths);
	}
}
