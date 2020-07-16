<?php declare(strict_types = 1);

/**
 * Created by PhpStorm.
 * User: gordon
 * Date: 25/3/2561
 * Time: 17:01 น.
 */

namespace Suilven\SilverStripeLinkCache\Task;

use League\CLImate\CLImate;
use Psr\SimpleCache\CacheInterface;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Control\Director;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Dev\BuildTask;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;
use SilverStripe\Security\Security;
use SilverStripe\SiteConfig\SiteConfig;
use Suilven\FreeTextSearch\Factory\BulkIndexerFactory;
use Suilven\FreeTextSearch\Helper\BulkIndexingHelper;
use Suilven\FreeTextSearch\Indexes;

class LinkCacheBuilder {
    public function rebuildCache()
    {
        // create handles to cache objects
        /** @var CacheInterface $linksCache */
        $linksCache = Injector::inst()->get(CacheInterface::class . '.links-cache-link');

        /** @var CacheInterface $linksDepthCache */
        $linksDepthCache = Injector::inst()->get(CacheInterface::class . '.links-cache-depth');

        // clear existing caches
        $linksCache->clear();
        $linksDepthCache->clear();

        $root = DataObject::get_by_id(SiteTree::class, 1);
        error_log($root->Title);
    }
}
