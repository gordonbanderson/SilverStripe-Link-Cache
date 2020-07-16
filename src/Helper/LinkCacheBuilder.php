<?php declare(strict_types = 1);

/**
 * Created by PhpStorm.
 * User: gordon
 * Date: 25/3/2561
 * Time: 17:01 น.
 */

namespace Suilven\SilverStripeLinkCache\Task;

use Psr\SimpleCache\CacheInterface;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\ORM\DataObject;

class LinkCacheBuilder
{
    public function rebuildCache(): void
    {
        // create handles to cache objects
        /** @var \Psr\SimpleCache\CacheInterface $linksCache */
        $linksCache = Injector::inst()->get(CacheInterface::class . '.links-cache-link');

        /** @var \Psr\SimpleCache\CacheInterface $linksDepthCache */
        $linksDepthCache = Injector::inst()->get(CacheInterface::class . '.links-cache-depth');

        // clear existing caches
        $linksCache->clear();
        $linksDepthCache->clear();

        $root = DataObject::get_by_id(SiteTree::class, 1);
        \error_log($root->Title);
    }
}
