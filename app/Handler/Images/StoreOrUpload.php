<?php

namespace App\Handler\Images;

use Illuminate\Support\Facades\Storage;

class StoreOrUpload
{
	public function addOrUpdate($model, $dir)
	{
		$name = time().'.' . explode('/', explode(':', substr(request()->image, 0, strpos(request()->image, ';')))[1])[1];
		$image = request()->image;
		$key = $dir . '/' . $name;
		Storage::disk('public')->put($key, file_get_contents($image));
		$model->image = $key;
	}
}