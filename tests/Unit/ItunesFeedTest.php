<?php

namespace Tests\Unit;

use App\Modules\ItunesFeed;
use InvalidArgumentException;
use Tests\TestCase;

class ItunesFeedTest extends TestCase
{
    public const FEED_ITUNES_NOUVELLE_ECOLE = "https://podcasts.apple.com/fr/podcast/nouvelle-%C3%A9cole/id1126434008";
    public const FEED_REAL_NOUVELLE_ECOLE = "https://feeds.acast.com/public/shows/5aa93c3d02e6c30d742dd776";

    /** @test */
    public function get_from_invalid_url_should_fail()
    {
        $this->expectException(InvalidArgumentException::class);
        ItunesFeed::getFeedFrom("invalid-url");
    }

    /** @test */
    public function get_from_not_itunes_url_should_fail()
    {
        $this->expectException(InvalidArgumentException::class);
        ItunesFeed::getFeedFrom(self::FEED_REAL_NOUVELLE_ECOLE);
    }

    /** @test */
    public function get_from_not_itunes_url_should_success()
    {
        $result = ItunesFeed::getFeedFrom(self::FEED_ITUNES_NOUVELLE_ECOLE.'?query=random');
        $this->assertEquals(self::FEED_REAL_NOUVELLE_ECOLE, $result);
    }
}
