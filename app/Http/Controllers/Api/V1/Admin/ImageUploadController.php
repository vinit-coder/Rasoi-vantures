<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function uploadImage(Request $request)
	{
 		$validated = $request->validate( [
    	'image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048'
 		]);
 		 if(!$validated){


    		return response(['message'=> 'error', 'status'=>500]);
    	}
 		
		 $uploadFolder = 'users';
		 $image = $request->file('image');
		 $image_uploaded_path = $image->store($uploadFolder, 'public');
		 $uploadedImageResponse = array(
		    'image_name' => basename($image_uploaded_path),
		    'image_url' => Storage::disk('public')->url($image_uploaded_path),
		    'mime' => $image->getClientMimeType()
		 );
		 return response(['message'=>'File Uploaded Successfully', 'success'=>  200, $uploadedImageResponse]);
		}
	}
