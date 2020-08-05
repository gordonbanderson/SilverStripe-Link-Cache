<?php declare(strict_types = 1);

namespace Suilven\SilverStripeLinkCache\Tests;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Dev\SapphireTest;
use Suilven\SilverStripeLinkCache\Task\RebuildLinkCacheTask;

class RebuildLinkCacheTaskTest extends SapphireTest
{
   // protected static $fixture_file = 'tests/sitetree.yml';

    public function testRebuildCache(): void
    {
        $links = [];
        $depths = [];
        foreach (SiteTree::get() as $page) {
            $links[$page->ID] = $page->LinkPath;
            $depths[$page->ID] = $page->LinkDepth;


        }
        $task = new RebuildLinkCacheTask();
        $task->run(null);

        foreach (SiteTree::get() as $page) {
            $this->assertEquals($links[$page->ID], $page->LinkPath);
            $this->assertEquals($depths[$page->ID], $page->LinkDepth);
        }

    }
}
