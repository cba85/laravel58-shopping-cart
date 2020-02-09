<?php
namespace App\Support\Storage;

use App\Support\Storage\Contracts\StorageInterface;
use Countable;
use Session;

class SessionStorage implements StorageInterface, Countable
{
    protected $bucket;

    public function __construct($bucket = "cart")
    {
        if (!Session::has($bucket)) {
            Session::put($bucket, []);
        }

        $this->bucket = $bucket;
    }

    public function set($index, $value)
    {
        Session::put("{$this->bucket}.{$index}", $value);
    }

    public function exists($index)
    {
        return Session::has($this->bucket);
    }

    public function get($index)
    {
        if (!$this->exists($index)) {
            return null;
        }

        return Session::get("{$this->bucket}.{$index}");
    }

    public function all()
    {
        return Session::get($this->bucket);
    }

    public function unset($index)
    {
        if ($this->exists($index)) {
            Session::forget("{$this->bucket}.{$index}");
        }
    }

    public function clear()
    {
        Session::forget("{$this->bucket}");
    }

    public function count()
    {
        return count($this->all());
    }
}
