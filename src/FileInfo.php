<?php

namespace Dcolsay\Drive;

// array:8 [
//     "dirname" => "files/BIC"
//     "basename" => "240215115698_201806_M_DEF_6_XML_response.zip"
//     "filename" => "240215115698_201806_M_DEF_6_XML_response"
//   ]
class FileInfo
{
    public string $name;

    public int $size;

    public string $mimeType;


    public static function makeFromArray(array $attributes)
    {
        dd($attributes);
    }
}
