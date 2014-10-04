<?php

class App_Cache
{

    private $cache_dir = '/var/www/html/incash/tmp';
    private $last_used_id = null;

    public function __construct($options=array())
    {
        $this->cache_dir = empty($options['cache_dir']) ? $this->cache_dir : $options['cache_dir'];
    }

    public function load($id)
    {
        $this->last_used_id = $id;

        $safeId = base64_encode($id);
        $file = rtrim($this->cache_dir, '/') . '/App_Cache/' . $safeId;

        if (!file_exists($file)) {
            return false;
        }

        $serData = file_get_contents($file);
        if (!$serData) {
            return false;
        }

        $data = unserialize($serData);
        if (!$data) {
            return false;
        }

        return $data;
    }

    public function save($data, $id=null)
    {
        if (is_null($id)) {
            $id = $this->last_used_id;
            if (is_null($id)) {
                throw new Exception('Cache Id must not be null');
            }
        }

        $serData = serialize($data);
        return $this->put_contents($id, $serData);
    }

    private function put_contents($id, $data)
    {
        $safeId = base64_encode($id);

        $dir = rtrim($this->cache_dir, '/') . '/App_Cache/';
        $file = $dir . $safeId;


        $ret = file_put_contents($file, $data);
        if (!$ret) {
            if (!is_dir($dir)) {
                if (!mkdir($dir)) {
                    throw new Exception("unable to write to cache dir {$this->cache_dir}");
                } else {
                    // try again
                    return file_put_contents($file, $data);
                }
            } else {
                return false;
            }
        }
        return true;
    }

}