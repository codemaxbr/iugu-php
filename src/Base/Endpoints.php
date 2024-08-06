<?php

namespace Codemax\Base;

interface Endpoints
{
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function get($id);
    public function search(array $filters);
    public function all();
    public function loadEndpoints();
}