<?php

class CreateFile
{
    public $file;
    function __construct($file) 
    {
        $this->file = $file;
    }
    public function CreateFile() 
    {
        if(!file_exists($this->file))
        {
            touch($this->file);
            @chmod($this->file, 0777);
        }
        else
        {
            unlink($this->file);
            touch($this->file);
            @chmod($this->file, 0777);
        }      
    }
}