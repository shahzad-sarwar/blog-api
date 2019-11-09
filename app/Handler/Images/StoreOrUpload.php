<?php

namespace App\Handler\Images;

use Illuminate\Support\Facades\Storage;

class StoreOrUpload
{
	public function addOrUpdate($model, $dir)
	{
		$storage = Storage::disk(env('STORAGE_DISK'));

		if($storage->exists($model->image)) {
			$storage->delete($model->image);
		}

		$name = time().'.' . explode('/', explode(':', substr(request()->image, 0, strpos(request()->image, ';')))[1])[1];
		$image = request()->image;
		$key = $dir . '/' . str_random(8) . $name;
		$storage->put($key, file_get_contents($image));
		$model->image = $key;
	}
}