<?php

namespace Tests\Unit;

use App\Crawler;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class CrawlerTest extends TestCase
{
    /** @var Crawler */
    private $crawler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->crawler = new Crawler();
    }

    public static function provideAttributeXPathData(): array
    {
        return [
            [
                'meta[http-equiv="content-type"]',
                'descendant-or-self::meta[translate(@http-equiv, "ABCDEFGHJIKLMNOPQRSTUVWXYZ", "abcdefghjiklmnopqrstuvwxyz") = \'content-type\']',
            ],
            [
                'link[rel=icon]',
                'descendant-or-self::link[translate(@rel, "ABCDEFGHJIKLMNOPQRSTUVWXYZ", "abcdefghjiklmnopqrstuvwxyz") = \'icon\']',
            ],
            [
                'link[rel=icon], link[rel="shortcut icon"]',
                'descendant-or-self::link[translate(@rel, "ABCDEFGHJIKLMNOPQRSTUVWXYZ", "abcdefghjiklmnopqrstuvwxyz") = \'icon\'] | descendant-or-self::link[translate(@rel, "ABCDEFGHJIKLMNOPQRSTUVWXYZ", "abcdefghjiklmnopqrstuvwxyz") = \'shortcut icon\']',
            ],
        ];
    }

    #[DataProvider('provideAttributeXPathData')]
    public function testCreateCaseInsensitiveAttributeXPath(string $selector, string $expected): void
    {
        $this->assertEquals($expected, $this->crawler->createCaseInsensitiveAttributeXPath($selector));
    }
}
