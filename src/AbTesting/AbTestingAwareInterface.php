<?php

namespace App\AbTesting;

interface AbTestingAwareInterface
{
    public function setAbTestingManager(AbTestingManager $abTestingManager): void;

    public function getAbTestingManager(): AbTestingManager;

    public function getAbTestValue(string $abTestName): string;
}
