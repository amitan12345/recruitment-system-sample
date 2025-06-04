<?php

namespace Modules\Job\Tests\Unit\Domain\ValueObjects;

use Modules\Job\Domain\ValueObjects\JobTitle;
use PHPUnit\Framework\TestCase;

class JobTitleTest extends TestCase
{
    public function test_if_title_is_empty_is_invalid(): void
    {
        $result = JobTitle::validate('');
        $this->assertFalse($result, 'Expected empty title to be invalid');
    }

    public function test_if_title_exceeds_max_length_is_invalid(): void
    {
        $longTitle = str_repeat('a', 256);
        $result = JobTitle::validate($longTitle);
        $this->assertFalse($result, 'Expected title longer than 255 characters to be invalid');
    }

    public function test_if_title_is_valid(): void
    {
        $validTitle = 'Software Engineer';
        $result = JobTitle::validate($validTitle);
        $this->assertTrue($result, 'Expected valid title to be valid');
    }

    public function test_if_invalid_title_throws_exception(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new JobTitle(''); // Should throw exception for empty title
    }
}
