<?php

declare(strict_types=1);

namespace BVP\BoatraceScraper\Scrapers;

use BVP\Converter\Converter;
use Carbon\CarbonInterface;

/**
 * @author shimomo
 */
class StadiumScraper extends BaseScraper implements StadiumScraperInterface
{
    /**
     * @param  \Carbon\CarbonInterface  $raceDate
     * @return array
     */
    public function scrape(CarbonInterface $raceDate): array
    {
        $response = [];

        $scraperFormat = '%s/owpc/pc/race/index?hd=%s';
        $scraperUrl = sprintf($scraperFormat, $this->baseUrl, $raceDate->format('Ymd'));
        $scraper = $this->httpBrowser->request('GET', $scraperUrl);

        $response = [];
        $scraper = $scraper->filter('.table1')->eq(0);
        $scraper = $scraper->filter('table tbody td.is-arrow1.is-fBold.is-fs15');
        $scraper->each(function ($element) use (&$response) {
            $stadiumName = str_replace('>', '', $element->filter('a')->filter('img')->attr('alt'));
            $stadiumId = Converter::convertToStadiumNumber($stadiumName);
            $response[$stadiumId] = $stadiumName;
        });

        return $response;
    }

    /**
     * @param  \Carbon\CarbonInterface  $raceDate
     * @return array
     */
    public function scrapeIds(CarbonInterface $raceDate): array
    {
        return array_keys($this->scrape($raceDate));
    }

    /**
     * @param  \Carbon\CarbonInterface  $raceDate
     * @return array
     */
    public function scrapeNames(CarbonInterface $raceDate): array
    {
        return array_values($this->scrape($raceDate));
    }
}
