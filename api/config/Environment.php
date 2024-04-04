<?php

class Environment
{
    private static $envData = [];

    public static function loadEnv(string $path = '.env'): void
    {
        if (file_exists($path)) {
            $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                list($name, $value) = explode('=', $line, 2);
                self::$envData[$name] = $value;
            }
        }
    }

    public static function get(string $name): ?string
    {
        return isset(self::$envData[$name]) ? self::$envData[$name] : null;
    }
}
