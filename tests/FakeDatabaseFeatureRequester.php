<?php

namespace LaunchDarkly\SharedTest\Tests;

use LaunchDarkly\Impl\Model\FeatureFlag;
use LaunchDarkly\Impl\Model\Segment;
use LaunchDarkly\Subsystems\FeatureRequester;

class FakeDatabaseFeatureRequester implements FeatureRequester
{
    private $prefix;

    public function __construct($prefix)
    {
        $this->prefix = $prefix;
    }

    public function getFeature(string $key): ?FeatureFlag
    {
        $json = FakeDatabase::getItem($this->prefix, 'features', $key);
        if ($json) {
            $flag = FeatureFlag::decode($json);
            return $flag->isDeleted() ? null : $flag;
        }
        return null;
    }

    public function getSegment(string $key): ?Segment
    {
        $json = FakeDatabase::getItem($this->prefix, 'segments', $key);
        if ($json) {
            $segment = Segment::decode($json);
            return $segment->isDeleted() ? null : $segment;
        }
        return null;
    }

    public function getAllFeatures(): array
    {
        $jsonList = FakeDatabase::getAllItems($this->prefix, 'features');
        $itemsOut = [];
        foreach ($jsonList as $json) {
            $flag = FeatureFlag::decode($json);
            if ($flag && !$flag->isDeleted()) {
                $itemsOut[$flag->getKey()] = $flag;
            }
        }
        return $itemsOut;
    }
}
