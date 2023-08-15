<?php

namespace App\Twig\Runtime;

use Twig\Extension\RuntimeExtensionInterface;

class AppExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct()
    {
        // Inject dependencies if needed
    }

    public function pluralize(int $pinSize, string $singular, ?string $plural = null): string
    {
        return $pinSize . ' ' . ($pinSize !== 1 ? ($plural ?? $singular . 's' ) : $singular);
       
    }

    public function truncate(string $value, ?int $size = 10, ?string $end = '...')
    {
        $result = '';
        if($size < sizeof(str_split($value)))
        {
            for($i = 0 ; $i < $size ; $i++)
            {
                $result .= $value[$i];
            }
            $result .= $end;
        }else
        {
            $result = $value;
        }
        return $result;
    }
}