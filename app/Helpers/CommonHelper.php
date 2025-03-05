<?php 
namespace App\Helpers;

use Illuminate\Support\Facades\Http;


class CommonHelper{

    public static function saveImageFromDataImage($data){
        // Check if the data is a valid base64 image
        if (preg_match('/^data:image\/(\w+);base64,/', $data, $matches)) {
            $imageType = $matches[1]; // Get the image type (e.g., jpeg, png, gif)
            $imageData = substr($data, strpos($data, ',') + 1); // Extract base64 data
            $imageData = base64_decode($imageData); // Decode the base64 string

            if ($imageData === false) {
                echo json_encode(['error' => 'Invalid image data.']);
                exit;
            }

            // Generate a unique file name
            $fileName = uniqid() . '.' . $imageType;
            $filePath = 'uploads/' . $fileName;

            // Save the image to the uploads directory
            if (!is_dir('uploads')) {
                mkdir('uploads', 0777, true); // Create the directory if it doesn't exist
            }

            if (file_put_contents($filePath, $imageData)) {
                return $fileName;
                // return json_encode(['success' => true, 'fileName' => $fileName]);
            } else {
                return false;
                // return json_encode(['error' => 'Failed to save image.']);
            }
        } else {
            return false;
            // return json_encode(['error' => 'Invalid image format.']);
        }
    }
}