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

        $link = $this->owner->Link();

        if (\is_null($link)) {
            return;
        }

        $splits = \explode('/', $link);
        error_log('PRE POP:' . print_r($splits, true));

        \array_pop($splits);
        \array_pop($splits);
        error_log('POST POP:' . print_r($splits, true));
        $path = \implode('/', $splits);
        $this->owner->LinkPath = $path . '/';
    }


    public function calculateLink()
    {
      //  \error_log('CALCULATING PARENT PATH FOR [' . $this->owner->ID . ']' . $this->owner->Link());
        $parentPath = $this->owner->LinkPath;
        // exit condition
        if (!\is_null($this->owner->ParentID)) {
            if (empty($this->owner->LinkPath)) {
                $parentPath = $this->owner->Parent()->calculateLink() . '/' . $this->owner->URLSegment;
                ;
                \error_log('Parent path: ' . $parentPath . ', LINK=' . $this->owner->Parent()->Link());
                $this->owner->LinkPath = $parentPath;
               // error_log('LINK PATH: ' . $this->owner->LinkPath);
            }
        } else {
            \error_log('-------------');
        }

        return $parentPath;
    }
}
