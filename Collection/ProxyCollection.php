<?php

namespace Pmc\Collection;

class ActiveProxyCollection extends ActiveCollection implements ActiveCollectionInterface, ProxyCollectionInterface {

    /** @var ProxyLoaderInterface The actual loader for items */
    protected $loader = null;

    /** @var bool True when all items have been loaded */
    protected $allLoaded = false;

    /** @var bool False when all items have been loaded */
    protected $loaded = array();

    /**
     * Sets the loader to load the actual items
     *
     * @param ProxyLoaderInterface $loader
     */
    function setLoader(ProxyLoaderInterface $loader) {
        $this->loader = $loader;
    }

    /**
     * Resets the proxy so all items are reloaded
     *
     * @param ProxyLoaderInterface $loader
     */
    function resetItems()
    {
        $this->loaded = array();
        $this->allLoaded = false;

        // Remove items
        $this->items = array();
    }

    /**
     * @inheritdoc
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        if (! $this->allLoaded) {
            if (! $this->loader) {
                throw new \LogicException(sprintf('Proxy collections should call setLoader first'));
            }
            $this->loader->fetchAll();
            $this->allLoaded = true;
        }

        return parent::getIterator();
    }


    /**
     * @return array
     */
    function getItems() {
        if (! $this->allLoaded) {
            if (! $this->loader) {
                throw new \LogicException(sprintf('Proxy collections should call setLoader first'));
            }
            $this->loader->fetchAll();
            $this->allLoaded = true;
        }

        return $this->items;
    }

    /**
     * @param mixed $key
     * @return mixed
     */
    function getItem($key) {
        if (! $this->allLoaded || isset($this->loaded[$key])) {
            if (! $this->loader) {
                throw new \LogicException(sprintf('Proxy collections should call setLoader first'));
            }
            $this->loader->fetchById($key);
            $this->loaded[$key] = true;
        }
        return $this->items[$key];
    }

    /**
     * @param mixed $key
     * @return bool
     */
    function hasItem($key) {
        if (! $this->allLoaded || isset($this->loaded[$key])) {
            if (! $this->loader) {
                throw new \LogicException(sprintf('Proxy collections should call setLoader first'));
            }
            $this->loader->fetchById($key);
            $this->loaded[$key] = true;
        }

        return isset($this->items[$key]);
    }

    /**
     * @param mixed $key
     */
    function removeItem($key)
    {
        // removing an item means the collection is not completely loaded anymore
        if (isset($this->loaded[$key])) {
            unset($this->loaded[$key]);
            $this->allLoaded = false;
        }

        parent::removeItem($key);
    }


}
