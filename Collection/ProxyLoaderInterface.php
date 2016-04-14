<?php

namespace Pmc\Collection;

interface ProxyLoaderInterface {

    function fetchAll();
    function fetchById($id);

}
