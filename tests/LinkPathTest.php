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
        $ids = [80];
        foreach ($ids as $pageID) {
            $page = $this->objFromFixture(SiteTree::class, 'sitetree' . $pageID);
            \error_log('LINK: ' . $page->Link());
            $link = $page->Parent()->Link();
            \error_log('PARENT LINK: ' . $link);
            \error_log('LINK PATH: ' . $page->LinkPath);

            $this->assertEquals($link, $page->LinkPath);
        }
    }
}
