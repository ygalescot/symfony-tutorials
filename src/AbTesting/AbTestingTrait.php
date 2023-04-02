<?php

namespace App\AbTesting;

trait AbTestingTrait
{
    /**
     * @var AbTestingManager
     *
     * Note: It's important to have a protected property in order to use it in Abstract classes
     */
    protected $abTestingManager;

    /**
     * @required
     *
     * Note: the required annotation is used by Symfony to force setting the service on container compilation
     */
    public function setAbTestingManager(AbTestingManager $abTestingManager): void
    {
        $this->abTestingManager = $abTestingManager;
    }

    public function getAbTestingManager(): AbTestingManager
    {
        return $this->abTestingManager;
    }

    public function getAbTestValue(string $abTestName): string
    {
        return $this->abTestingManager->getAbTestValue($abTestName);
    }
}
