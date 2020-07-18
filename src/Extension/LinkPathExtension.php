<?php declare(strict_types = 1);

namespace Suilven\SilverStripeLinkCache\Extension;

use SilverStripe\ORM\DataExtension;

/**
 * Class LinkPathExtension
 *
 * @package Suilven\SilverStripeLinkCache\Extension
 *
 * phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
 * @property string $LinkPath
 * @property int $LinkDepth
 * @property \SilverStripe\CMS\Model\SiteTree $owner
 */
class LinkPathExtension extends DataExtension
{
    /** @var array<string,string> */
    private static $db = [
        'LinkPath' => 'Text',
        'LinkDepth' => 'Int',
    ];

    /** @var array<string,array<string>> */
    private static $indexes = [
        'LinkPathIndex' => ['LinkPath'],
    ];

    public function onBeforeWrite(): void
    {
        parent::onBeforeWrite();

        // @todo Make this more efficient
        $link = $this->owner->Link();

        if ($link === '') {
            return;
        }

        $splits = \explode('/', $link);

        \array_pop($splits);
        \array_pop($splits);
        $path = \implode('/', $splits);
        $this->getOwner()->LinkPath = $path . '/';
        $this->getOwner()->LinkDepth = \sizeof($splits) - 1;
    }


    /** @return string the link */
    public function calculateLink(): string
    {
        $parentPath = $this->getOwner()->LinkPath;
        // exit condition
        if ($this->owner->ParentID !== 0) {
            if (\is_null($this->getOwner()->LinkPath) || $this->getOwner()->LinkPath === '') {
                $parentPath = $this->getOwner()->Parent()->calculateLink() . '/' . $this->getOwner()->URLSegment;
                $this->getOwner()->LinkPath = $parentPath;
            }
        }

        return $parentPath;
    }


    /** @return string the link to this page without database traversal */
    public function CachedLink(): string
    {
        return $this->getOwner()->LinkPath . $this->getOwner()->URLSegment . '/';
    }
}
