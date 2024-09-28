<?php

namespace App\Models;

use App\Jobs\UploadGdrive;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function storeImage(UploadedFile $file, bool $uploadToDrive = false): string
    {
        $path = $file->store('uploads', 'public');
        if ($uploadToDrive) {
            UploadGdrive::dispatch(storage_path($path));
        }
        return $path;
    }
}
