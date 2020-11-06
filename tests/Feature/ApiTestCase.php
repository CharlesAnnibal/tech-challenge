<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

abstract class ApiTestCase extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        print_r("SET UP TESTING");
        parent::setUp();
    }

    protected function tearDown(): void
    {
        print_r("SET UP TEARDOWN");
        parent::tearDown();
    }
}
