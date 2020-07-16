<?php declare(strict_types = 1);

namespace Suilven\SilverStripeLinkCache\Extension;

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

class LinkPathExtension {
    private static $db = [
        'LinkPath' => 'Text'
    ];

    private static $indexes = [
        'LinkPathIndex' => ['LinkPath'],
    ];
}
