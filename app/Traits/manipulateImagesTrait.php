<?php

namespace App\Traits;

trait manipulateImagesTrait {

    public  function store_image($image, $folder)
    {
        // Get extension of image
        $extension = $image->getClientOriginalExtension();

        // Create the name of image by merging time with extension
        $name = time() . '.' . $extension;

        // Store image
        $image->move(public_path() . '/uploads/', $name);

        return $name;
    }



    public function update_image($newImage, $folder, $lastImage): string
    {
        // Get extension of image
        $extension = $newImage->getClientOriginalExtension();

        // Create the name of image by merging time with extension
        $name = time() . '.' . $extension;

        // Store image
        $newImage->move("build/assets/img/$folder", $name);

        // Delete old image
        if(is_file(public_path("build/assets/img/$folder/$lastImage")))
            unlink(public_path("build/assets/img/$folder/$lastImage"));

        return $name;
    }



    public function get_image($image_name, $folder): ?string
    {
        // Get path of image
        $imagePath = public_path("build/assets/img/$folder/$image_name");

        // Get data of image
        if (is_file($imagePath))
            return $imagePath;
        else
            return null;
    }

    public function delete_image($image_name, $folder): bool
    {
        // Get path of image
        $image_path = public_path("build/assets/img/$folder/$image_name");

        if (is_file($image_path)) {
            unlink($image_path);
            return true;
        }

        return false;
    }
}
