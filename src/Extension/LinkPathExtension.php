<?php declare(strict_types = 1);

namespace Suilven\SilverStripeLinkCache\Extension;

use SilverStripe\ORM\DataExtension;

class LinkPathExtension extends DataExtension
{
    private static $db = [
        'LinkPath' => 'Text',
    ];

    private static $indexes = [
        'LinkPathIndex' => ['LinkPath'],
    ];
}
