<?php

namespace Pmc\Collection;

interface ProxyCollectionInterface
{
    public function setLoader(ProxyLoaderInterface $loader);
    public function resetItems();
}
