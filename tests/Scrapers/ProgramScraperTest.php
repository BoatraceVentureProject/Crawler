<?php

declare(strict_types=1);

namespace BVP\BoatraceScraper\Tests\Scrapers;

use BVP\BoatraceScraper\Scrapers\ProgramScraper;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use Symfony\Component\BrowserKit\HttpBrowser;

/**
 * @author shimomo
 */
final class ProgramScraperTest extends TestCase
{
    /**
     * @var \BVP\BoatraceScraper\Scrapers\ProgramScraper
     */
    protected ProgramScraper $scraper;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->scraper = new ProgramScraper(
            new HttpBrowser()
        );
    }

    /**
     * @param  array  $arguments
     * @param  array  $expected
     * @return void
     */
    #[DataProviderExternal(ProgramScraperDataProvider::class, 'scrapeProvider')]
    public function testScrape(array $arguments, array $expected): void
    {
        $this->assertSame($expected, $this->scraper->scrape(...$arguments));
    }
}
