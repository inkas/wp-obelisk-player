<?php

/**
 * @package   Obelisk Player
 */

namespace Includes;

class Helper
{
    public static function PascalToSnake($string)
    {
        return ltrim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $string)), '_');
    }
}
