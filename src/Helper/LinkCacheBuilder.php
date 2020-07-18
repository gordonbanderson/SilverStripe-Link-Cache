<?php declare(strict_types = 1);

/**
 * Created by PhpStorm.
 * User: gordon
 * Date: 25/3/2561
 * Time: 17:01 น.
 */

namespace Suilven\SilverStripeLinkCache\Task;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\ORM\DataObject;

class LinkCacheBuilder
{
    public function rebuildCache(): void
    {
        // @todo Stage
        $this->rebuildCacheForChildrenOfPages([0]);
    }


    /** @param array<int> $pageIDs */
    private function rebuildCacheForChildrenOfPages(array $pageIDs): void
    {
        $childIDs = [];
        foreach ($pageIDs as $pageID) {
            $parent = DataObject::get_by_id(SiteTree::class, $pageID);
            $children = SiteTree::get()->filter(['ParentID' => $pageID]);
            foreach ($children as $child) {
                $child->LinkPath = !is_null($parent) ? $parent->LinkPath . $child->URLSegment . '/' : '/' . $child->URLSegment . '/';
                $splits = \explode('/', $child->LinkPath);
                $child->LinkDepth = \sizeof($splits);
                $child->write();
                $childIDs[] = $child->ID;
            }

            $this->rebuildCacheForChildrenOfPages($childIDs);
        }


    }
}
