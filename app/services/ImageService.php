<?php

class ImageService
{

    private $imageRepository;
    public function __construct()
    {
        $this->imageRepository = new ImageRepository;
    }

    public function uploadImage($id, $imageData)
    {
        return $this->imageRepository->uploadImage($id, $imageData);
    }

    public function getImagesByProductId($id)
    {
        return $this->imageRepository->getimagesByProductId($id);
    }

    public function deleteImage($productId, $id)
    {
        return $this->imageRepository->deleteImage($productId, $id);
    }
}
