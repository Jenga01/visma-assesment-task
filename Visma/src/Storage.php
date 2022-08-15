<?php
declare(strict_types=1);

namespace App;

class Storage
{
    private string $filename;

    /**
     *
     */
    public function __construct()
    {
        $this->filename = __DIR__ . '/../var/storage.php';
    }

    /**
     * @param string $key
     * @return array|null
     */
    public function read(string $key): ?array
    {
        $contents = file_get_contents($this->filename);

        $unserialized = unserialize($contents);

        if ($unserialized === false) {
            return null;
        }

        return $unserialized[$key] ?? null;
    }

    /**
     * @param string $key
     * @param array $value
     * @return void
     */
    public function write(string $key, array $value): void
    {
        $contents = file_get_contents($this->filename);
        $unserialized = unserialize($contents);
        $unserialized[$key] = $value;
        $serialized = serialize($unserialized);
        file_put_contents($this->filename, $serialized);
    }

    public function remove(string $key): void
    {
        $contents = file_get_contents($this->filename);
        $unserialized = unserialize($contents);

        if (isset($unserialized[$key])) {
            unset($unserialized[$key]);
            $serialized = serialize($unserialized);
            file_put_contents($this->filename, $serialized);
        }
    }
}
