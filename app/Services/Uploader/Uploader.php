<?php


namespace App\Services\Uploader;


use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\Flysystem\FileExistsException;

class Uploader
{

    private $request;
    private $storageManager;
    private $file;

    public function __construct(Request $request , StorageManager $storageManager)
    {
        $this->request = $request;
        $this->storageManager = $storageManager;
        $this->file = $request->file;
    }


    public function upload()
    {
        if ($this->fileExists()) throw new FileExistsException($this->getType() . DIRECTORY_SEPARATOR . $this->file->getClientOriginalName());

        $this->putFileIntoStorage();

        $this->putFileIntoDatabase();

    }

    private function putFileIntoDatabase()
    {
        $file = new File([
            'name' => $this->file->getClientOriginalName(),
            'user_id' => Auth::user()->id,
            'size' => $this->file->getSize(),
            'type' => $this->getType(),
            'is_private' => $this->isPrivate()
        ]);

        $file->save();

    }


    public function filePath()
    {
        return $this->getType() . DIRECTORY_SEPARATOR . $this->file->getClientOriginalName();
    }

    private function isPrivate()
    {
        return $this->request->has('is-private');
    }

    private function putFileIntoStorage()
    {
        $method = $this->request->has('is-private') ? 'putFileAsPrivate' : 'putFileAsPublic';
        $this->storageManager->$method($this->file->getClientOriginalName() , $this->file , $this->getType());
    }

    private function getType()
    {

        return [
           'image/jpeg' => 'image',
            'video/mp4' => 'video',
            'application' => 'zip'
    ][$this->file->getClientMimeType()];

    }


    private function fileExists(){
        return $this->storageManager->isFileExists($this->file->getClientOriginalName() ,$this->getType() , $this->isPrivate());
    }


}