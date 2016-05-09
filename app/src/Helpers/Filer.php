<?php

namespace Market\Helpers;

class Filer
{
    protected $name;

    public function __construct($fileName)
    {
        $this->name = $fileName;
    }

    public function read($lines = null, $reverse = false)
    {
        $content = file_get_contents($this->name);
        $temp = explode("\n", $content);
        unset($temp[count($temp) - 1]);

        if ($reverse) {
            $temp = array_reverse($temp);
        }

        if ($lines) {
          $temp = array_slice($temp, 0, $lines);
        }

        return $temp;
    }

    public function write($content)
    {
        return file_put_contents($this->name, $content, FILE_APPEND);
    }
}
