<?php
namespace ACNS\Parser\Test;

use ACNS\Parser\Parser;
use ACNS\Parser\Result;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    public function setUp()
    {
        $this->sampleDir = dirname(__FILE__) . '/sample_notices';
        $this->notice = file_get_contents($this->sampleDir . '/echelon.xml');
    }
    public function testParseEchelon()
    {
        $parser = new Parser($this->notice);
        $result = $parser->parse();

        $this->assertInstanceOf(Result::class, $result);

        $this->assertTrue($result->processed);
        $this->assertEquals('1.2.3.4', $result->ip_address);
        $this->assertEquals('55876', $result->port);
        $this->assertEquals('2018-01-25T16:37:11Z', $result->timestamp);
        $this->assertEquals('The.Last.Ship.S04E03.HDTV.x264-LOL[eztv].mkv', $result->filename);
        $this->assertEquals('BitTorrent', $result->type);
    }

    public function testParseEchelonFailsOnInvalidNotice()
    {
        $parser = new Parser('asdfasdfasdf');
        $result = $parser->parse();

        $this->assertInstanceOf(Result::class, $result);
        $this->assertFalse($result->processed);
    }
}
