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
}