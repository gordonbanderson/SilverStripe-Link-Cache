<?php declare(strict_types = 1);

namespace Suilven\ManticoreSearch\Tests;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Dev\SapphireTest;

class LinkPathTest extends SapphireTest
{
    protected static $fixture_file = 'tests/sitetree.yml';

    public function testArbitraryPages(): void
    {
        \error_log('================');
        $ids = [80, 9, 2, 1];
        foreach ($ids as $pageID) {
            $page = $this->objFromFixture(SiteTree::class, 'sitetree' . $pageID);
            $parentLink = $page->Parent()->Link();

            $this->assertEquals($parentLink, $page->LinkPath);
            $this->assertEquals($page->Link(), $page->CachedLink());
        }
    }
}
