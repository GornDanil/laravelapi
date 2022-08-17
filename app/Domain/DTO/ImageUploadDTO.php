<?php

namespace App\Domain\DTO;

use Illuminate\Http\UploadedFile;
use phpDocumentor\Reflection\File;

/**
 * Class Search
 *
 * @package App\Domain\DTO
 */
class ImageUploadDTO extends DTO
{
    /** @var UploadedFile */
    public UploadedFile $filename;


}
