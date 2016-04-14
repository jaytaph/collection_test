<?php

namespace Pmc\Collection;

interface CollectionInterface extends \Countable {

    function addItem($key = null, $item);
    function getItems();
    function hasItem($key);
    function removeItem($key);

}
