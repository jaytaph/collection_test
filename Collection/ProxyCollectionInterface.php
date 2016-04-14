<?php

namespace Pmc\Collection;

interface ProxyCollectionInterface {

    function setLoader(ProxyLoaderInterface $loader);
    function resetItems();

}
