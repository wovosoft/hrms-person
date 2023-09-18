<?php

namespace Wovosoft\HrmsPerson\Actions;


interface ActionInterface
{
    public function create(array $data);

    public function update(array $data);

    public function delete();
}
