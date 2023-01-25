<?php

namespace LaunchDarkly\SharedTest\Tests;

use LaunchDarkly\SharedTest\DatabaseFeatureRequesterTestBase;
use LaunchDarkly\Subsystems\FeatureRequester;

class DatabaseFeatureRequesterTestBaseTest extends DatabaseFeatureRequesterTestBase
{
    const DEFAULT_PREFIX = 'defaultprefix';

    protected function clearExistingData(?string $prefix): void
    {
        FakeDatabase::$data[$this->actualPrefix($prefix)] = [ 'features' => [], 'segments' => [] ];
    }

    protected function makeRequester(?string $prefix): FeatureRequester
    {
        return new FakeDatabaseFeatureRequester($this->actualPrefix($prefix));
    }

    protected function putSerializedItem(
        ?string $prefix,
        string $namespace,
        string $key,
        int $version,
        string $json): void
    {
        FakeDatabase::putSerializedItem($this->actualPrefix($prefix), $namespace, $key, $json);
    }

    private function actualPrefix(?string $prefix): string
    {
        return ($prefix === null || $prefix === '') ? self::DEFAULT_PREFIX : $prefix;
    }
}
