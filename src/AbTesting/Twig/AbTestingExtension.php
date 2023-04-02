<?php

namespace App\AbTesting\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use App\AbTesting\AbTestingManager;

class AbTestingExtension extends AbstractExtension
{
    /** @var AbTestingManager */
    private $abTestingManager;

    public function __construct(AbTestingManager $abTestingManager)
    {
        $this->abTestingManager = $abTestingManager;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('get_ab_test_value', [$this, 'getAbTestValue']),
        ];
    }

    public function getAbTestValue(string $abTestName): string
    {
        return $this->abTestingManager->getAbTestValue($abTestName);
    }
}
