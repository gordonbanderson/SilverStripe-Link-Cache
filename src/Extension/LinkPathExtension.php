<?php declare(strict_types = 1);

namespace Suilven\SilverStripeLinkCache\Extension;

use SilverStripe\ORM\DataExtension;

class LinkPathExtension extends DataExtension
{
    private static $db = [
        'LinkPath' => 'Text',
        'LinkDepth' => 'Int',
    ];

    private static $indexes = [
        'LinkPathIndex' => ['LinkPath'],
    ];

    public function onBeforeWrite(): void
    {
        parent::onBeforeWrite();

        // @todo Make this more efficient
        $link = $this->owner->Link();

        if (\is_null($link)) {
            return;
        }

        $splits = \explode('/', $link);

        \array_pop($splits);
        \array_pop($splits);
        $path = \implode('/', $splits);
        $this->owner->LinkPath = $path . '/';
        $this->owner->LinkDepth = \sizeof($splits) - 1;
    }


    /** @return string the link */
    public function calculateLink(): string
    {
        $parentPath = $this->owner->LinkPath;
        // exit condition
        if (!\is_null($this->owner->ParentID)) {
            if (empty($this->owner->LinkPath)) {
                $parentPath = $this->owner->Parent()->calculateLink() . '/' . $this->owner->URLSegment;
                $this->owner->LinkPath = $parentPath;
            }
        }

        return $parentPath;
    }


    /** @return string the link to this page without database traversal */
    public function CachedLink(): string
    {
        return $this->owner->LinkPath . $this->owner->URLSegment . '/';
    }
}
