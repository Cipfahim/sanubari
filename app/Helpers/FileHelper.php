<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('upload')) {
    /**
     * Upload file to storage.
     *
     * @param $file
     * @param $folder
     * @param null $old
     * @return void
     */
    function upload($file, $folder, $disk, $old = null)
    {
        if (isset($file) && is_file($file)) {
            // Delete old file
            deleteFile($old);
            // Store new file and return path
            return $file->store($folder, $disk);
        } else {
            return $old;
        }
    }

}

if (!function_exists('getFileUrl')) {

    /**
     * Delete file from storage.
     *
     * @param $path
     * @return string
     */
    function getFileUrl($path): ?string
    {
        return isset($path) ? Storage::url($path) : null;
    }
}


if (!function_exists('deleteFile')) {

    /**
     * Delete file from storage.
     *
     * @param $path
     * @return bool
     */
    function deleteFile($path): bool
    {
        return Storage::exists($path) && Storage::delete($path);
    }
}
