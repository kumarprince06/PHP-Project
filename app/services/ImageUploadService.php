<?php 

class ImageUploadService{

    private $imageUploadRepository;
    public function __construct()
    {
        $this->imageUploadRepository = new ImageUploadRepository;
    }

    public function uploadImage($id, $imageData){
        return $this->imageUploadRepository->uploadImage($id, $imageData);
    }


}