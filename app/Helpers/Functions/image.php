<?php

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


/**
 * Check If File Exist
 * $imgNotFoundWidth Default Width = 400
 * $imgNotFoundWidth = [128, 400, 628 , 1024]
 */
function getImage($file, $imgNotFoundWidth = 470)
{
    if (file_exists(public_path() . '/storage/' . $file)) { // File If Exist
        return asset('storage/' . $file);
    } else {

        return asset("dashboard/images/errors/404-error-" . $imgNotFoundWidth . "px.webp");
    }
}


function checkFile(string $path)
{

    if (file_exists(public_path() . '/' . $path)) { // File If Exist
        return true;
    } else {
        return false;
    }
}






/**
 * Images Ext
 */
// function imagesExtensions($array = true)
// {
//     $items = ['DOC', 'DOCX', 'ODT', 'PDF', 'XLS', 'XLSX', 'PPT', 'PPTX', 'TXT', 'EXE', 'RAR', 'ZIP', 'AI'];
//     if ($array == true) {
//         // UPPER CASE
//         return $items;
//     } else {
//         return implode(',', $items);
//     }
// }



function interventionImageAccept($array = true)
{
    $items = ['JPG', 'JPEG', 'PNG', 'TIFF', 'JFIF', 'PJPEG', 'PJP','WEBP', 'BMP', 'TIF', 'TIFF'];
    if ($array == true) {
        // UPPER CASE
        return $items;
    } else {
        return implode(',', $items);
    }
}

function processFileName($oldFileName, $separator = '-')
{
    $fileName = $oldFileName;
    // This Characters We Will Removed From File Name
    $listOfCharactersToRemoveFromFileName = [' ', '!', '`', '~', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '-', '+', '=', '{', '}', '[', ']', '\\', '|', '\'', '"', ';', ':', '/', '?', '>', '.', '<', ',', '–', '—'];
    // Loop And Check If Isset This Char In File Name
    foreach ($listOfCharactersToRemoveFromFileName as $key) {
        $fileName =  str_replace($key, $separator, $fileName);
    }
    // After Remove Characters And Set $separator Explode Name And Loop
    $explodeNameAfterRemoveCharacters = explode($separator, $fileName);
    $fileNameParts = []; // Empty Array To Set New Name
    foreach ($explodeNameAfterRemoveCharacters as $part) {
        // After Explode And Loop This  $separator will change to null value
        // Here In If check if value = null no set in $fileNameParts
        if ($part != null) {
            array_push($fileNameParts, $part);
        }
    }
    return $fileName = implode($separator, $fileNameParts) . $separator . time();
}

// Using In App\Helpers\File.php
if (!function_exists("imageStream")) {

    function imageStream(string $tmpPath, string $uploadToPath, string $fileName, string $size, string $sizeSeparator = '*')
    {

        $width   = explode($sizeSeparator, $size)[0]; // Width
        $heigth  = explode($sizeSeparator, $size)[1]; // Heigth
        $quality = isset(explode($sizeSeparator, $size)[2]) ? explode($sizeSeparator, $size)[2] : 100; // Quality

        $makeImage = Image::make($tmpPath)->resize(intval($width), intval($heigth))->stream(null, $quality);
        Storage::disk('local')->put($uploadToPath . $fileName, $makeImage);

        // $makeImage->save(storage_path("app/" . $uploadToPath . $fileName), $quality);
    }
}






/**
 * Create Random Name
 * 1- If Random Name For File,Image..... Set IN Params $file = 'jpg' Or 'pdf' Or .....
 * v2
 */
function randomName($file = null)
{
    if ($file !== null) {
        $file = '.' . str_replace('.', '', $file);
    }
    return time() . '_' . rand(10000, 5000000000) . $file;
}
