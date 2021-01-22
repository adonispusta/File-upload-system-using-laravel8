<?php

namespace App\Models;

use App\Services\Uploader\StorageManager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
      'name' ,'user_id', 'size' , 'type' , 'is_private'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function download()
    {
        return resolve(StorageManager::class)->getFile($this->name , $this->type , $this->is_private);
    }

    public function delete()
    {
       resolve(StorageManager::class)->deleteFile($this->name , $this->type , $this->is_private);

       parent::delete();
    }
}
