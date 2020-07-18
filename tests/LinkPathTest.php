<?php declare(strict_types = 1);

namespace Suilven\SilverStripeLinkCache\Tests;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Dev\SapphireTest;

class LinkPathTest extends SapphireTest
{
    protected static $fixture_file = 'tests/sitetree.yml';

    public function testArbitraryPages(): void
    {
        \error_log('================');
        $ids = [80 => 3, 9 => 2, 2 => 1, 1 => 0];
        foreach ($ids as $pageID => $depth) {
            $page = $this->objFromFixture(SiteTree::class, 'sitetree' . $pageID);
            $parentLink = $page->Parent()->Link();

            $this->assertEquals($parentLink, $page->LinkPath);
            $this->assertEquals($page->Link(), $page->CachedLink());
            \error_log($page->Link());
            $this->assertEquals($depth, $page->LinkDepth);
        }
    }
}
