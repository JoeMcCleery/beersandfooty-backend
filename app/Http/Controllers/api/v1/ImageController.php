<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class ImageController extends Controller
{
    public function uploadImage(Request $request) {
        $data = $request->imageData;
        if($data) {
            $imageData = str_replace(array('data:image/png;base64,', 'data:image/jpg;base64,', 'data:image/jpeg;base64,', 'data:image/gif;base64,', ' '), array('', '', '', '', '+'), $data);
            if(preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $imageData)) {
                $extension = '.'.explode('/', mime_content_type($data))[1];
                $fileName = 'uploads/'.hash('md5', $data);
                $url = '';
                if(file_exists(storage_path('app/public/'.$fileName.'-resized'.$extension))) {
                    $url = url('storage/'.$fileName.'-resized'.$extension);
                } else {
                    $imageData = str_replace(array('data:image/png;base64,', 'data:image/jpg;base64,', 'data:image/jpeg;base64,', 'data:image/gif;base64,', ' '), array('', '', '', '', '+'), $data);
                    $image_resize = Image::make(base64_decode($imageData));
                    $image_resize = $this->resizeImage($image_resize, 512);
                    $image_resize->save(storage_path('app/public/'.$fileName.'-resized'.$extension));
                    $url = url('storage/'.$fileName.'-resized'.$extension);
                }
                return [
                    'success' => true,
                    'url' => $url
                ];
            }
            return [
                'success' => false,
                'message' => 'image data is not in the correct format!'
            ];
        }
        return [
            'success' => false,
            'message' => 'no image data!'
        ];
    }

    private function resizeImage($image, $requiredSize) {
        $width = $image->width();
        $height = $image->height();

        // Check if image resize is required or not
        if ($requiredSize >= $width && $requiredSize >= $height) return $image;

        $newWidth = 0;
        $newHeight = 0;

        $aspectRatio = $width/$height;
        if ($aspectRatio >= 1.0) {
            $newWidth = $requiredSize;
            $newHeight = $requiredSize / $aspectRatio;
        } else {
            $newWidth = $requiredSize * $aspectRatio;
            $newHeight = $requiredSize;
        }

        $image->resize($newWidth, $newHeight);
        return $image;
    }
}
