<?php

namespace LaunchDarkly\SharedTest\Tests;

class FakeDatabase
{
    public static $data = [];

    public static function getItem(string $prefix, string $namespace, string $key): ?array
    {
        $dataSet = self::$data[$prefix] ?? null;
        if ($dataSet) {
            $items = $dataSet[$namespace] ?? null;
            if ($items) {
                $json = $items[$key] ?? null;
                return $json ? json_decode($json, true) : null;
            }
        }
        return null;
    }

    /**
     * @return array<<string>,mixed>
     */
    public static function getAllItems(string $prefix, string $namespace): array
    {
        $itemsOut = [];
        $dataSet = self::$data[$prefix] ?? [];
        $items = $dataSet[$namespace] ?? [];
        foreach ($items as $key => $json) {
            $itemsOut[$key] = json_decode($json, true);
        }
        return $itemsOut;
    }

    public static function putSerializedItem(string $prefix, string $namespace, string $key, string $json): void
    {
        if (!isset(self::$data[$prefix])) {
            self::$data[$prefix] = [];
        }
        if (!isset(self::$data[$prefix][$namespace])) {
            self::$data[$prefix][$namespace] = [];
        }
        self::$data[$prefix][$namespace][$key] = $json;
    }
}
