<?php

namespace App\TwigExtensions;

use Twig\TwigFilter;
use Twig\Extension\AbstractExtension;




class MyCustomExtensions extends AbstractExtension
{


    public function getFilters()
    {
        return [
            new TwigFilter('defaultmage', [$this,'defaultImage']),
        ];
        
    }

    public function defaultImage(string $path):string
    {
        if(strlen(trim($path)) == 0) {

            return 'as.jpg';

        }
        return $path;

    }

    
}