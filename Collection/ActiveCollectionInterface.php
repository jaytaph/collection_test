<?php

namespace Pmc\Collection;

interface ActiveCollectionInterface extends CollectionInterface {

    const SEEK_SET = 1;       // Seek from the start of the collection
    const SEEK_CUR = 2;       // Seek from current position in the collection
    const SEEK_END = 3;       // Seek from the end of the collection

    function getActiveItem();
    function isActive($item);

    function setActiveByKey($key);
    function setActiveByItem($activeItem);
    function seekActive($offset, $mode = self::SEEK_SET);

}
