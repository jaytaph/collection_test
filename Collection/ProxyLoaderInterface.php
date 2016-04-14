<?php

namespace Pmc\Collection;

interface ProxyLoaderInterface
{
    public function fetchAll();
    public function fetchById($id);
}
