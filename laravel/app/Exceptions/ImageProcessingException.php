<?php


namespace App\Exceptions;

use Exception;

class ImageProcessingException extends Exception
{
    protected $message = 'Image could not be resized to the desired size.';
}

