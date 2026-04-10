<?php

class AppHelper
{
    private PDO $Db;
    private array $Container = [];

    public function __construct(PDO $db)
    {
        $this->Db = $db;
    }

    public function pdo(): PDO
    {
        return $this->Db;
    }

    public function set(string $var, mixed $val): void
    {
        $this->Container[$var] = $val;
    }

    public function get(string $var): mixed
    {
        return $this->Container[$var] ?? null;
    }

    public function includeFile(string $file, bool $asfile = false, bool $once = false): ?string
    {
        $pdo = $this->pdo();
        $APP = &$this;
        $file = $this->cleanDirectory(__DIR__ . '/' . $file);

        if (!file_exists($file)) {
            error_log("AppHelper::includeFile - File not found: " . $file);
            return null;
        }

        if ($asfile) {
            return $file;
        }
        if ($once) {
            include_once($file);
        } else {
            include($file);
        }
        return null;
    }

    public function cleanDirectory(string $dir): string
    {
        $dir = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $dir);
        $dir = preg_replace('/' . preg_quote(DIRECTORY_SEPARATOR, '/') . '{2,}/', DIRECTORY_SEPARATOR, $dir);
        return $dir;
    }
}
