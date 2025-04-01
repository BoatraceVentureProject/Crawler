<?php

declare(strict_types=1);

namespace BVP\BoatraceScraper\Scrapers;

use BVP\BoatraceScraper\ScraperContractInterface;
use Carbon\CarbonInterface;

/**
 * @author shimomo
 */
interface ResultScraperInterface extends ScraperContractInterface
{
    /**
     * @param  \Carbon\CarbonInterface  $carbonDate
     * @param  int                      $raceStadiumNumber
     * @param  int                      $raceCode
     * @return array
     */
    public function scrape(CarbonInterface $carbonDate, int $raceStadiumNumber, int $raceCode): array;
}
