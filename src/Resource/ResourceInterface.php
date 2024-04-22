<?php

namespace App\Resource;

interface ResourceInterface
{
    public function create(?ResourceDataInterface $data = null);

    public function update(ResourceDataInterface $data);

    public function list(?ResourceOptionsInterface $options = null);

    public function delete(ResourceDataInterface $data);

    public function open(ResourceOptionsInterface $options);
}