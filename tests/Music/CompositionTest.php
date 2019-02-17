<?php declare(strict_types=1);

namespace tests\Music;

use Club\Music\Composition;
use Club\Music\Genre;
use PHPUnit\Framework\TestCase;

/**
 * Class CompositionTest
 */
class CompositionTest extends TestCase
{
    public function testCreation(): void
    {
        $genre = Genre::rnb();
        $composition = new Composition('some name', $genre);

        self::assertSame($genre, $composition->getGenre());
        self::assertSame('some name', $composition->getTitle());
    }
}