<?php declare(strict_types = 1);

namespace Suilven\SilverStripeLinkCache\Task;

use SilverStripe\Dev\BuildTask;

// phpcs:disable SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter

/**
 * Class RebuildLinkCacheTask
 *
 * @package Suilven\SilverStripeLinkCache\Task
 */
class RebuildLinkCacheTask extends BuildTask
{

    protected $title = 'Rebuild Link Cache';

    protected $description = 'Rebuild SiteTree Link Cache';

    protected $enabled = true;

    /** @var string */
    private static $segment = 'rebuild-link-cache';




    /**
     * Implement this method in the task subclass to
     * execute via the TaskRunner
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ReturnTypeHint.MissingAnyTypeHint
     * @param \SilverStripe\Control\HTTPRequest $request
     * @return \SilverStripe\Control\HTTPResponse|void
     */
    public function run($request)
    {
        $helper = new LinkCacheBuilder();
        $helper->rebuildCache();
    }
}
