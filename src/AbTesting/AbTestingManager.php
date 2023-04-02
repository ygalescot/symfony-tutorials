<?php

namespace App\AbTesting;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AbTestingManager
{
    public const ALLOWED_AB_TEST_VALUES = ['a', 'b'];

    // Available AB tests
    public const PRODUCT_CARD_AB_TEST = 'ab_test_product_card';

    // Enabled AB tests
    /** @var string[] */
    public const ENABLED_AB_TESTS = [
        // Add your enabled AB test here
        self::PRODUCT_CARD_AB_TEST,
    ];

    private const COOKIE_LIFETIME = 7 * 24 * 3600; // 7 days in seconds

    /**
     * @var ParameterBag
     */
    private $abTestsBag;

    public function __construct()
    {
        $this->abTestsBag = new ParameterBag();
    }

    public function registerAbTestsValues(Request $request): void
    {
        foreach ($this->getEnabledAbTests() as $abTestName) {
            $value = $request->cookies->get($abTestName);

            if (is_string($value)) {
                $value = strtolower($value);
            }

            // Check that the AB test incoming value is allowed
            if (in_array($value, self::ALLOWED_AB_TEST_VALUES)) {
                $this->abTestsBag->set($abTestName, $value);

                continue;
            }

            $this->setRandomAbTestValue($abTestName);
        }
    }

    public function createAbTestsCookies(Response $response): void
    {
        foreach ($this->abTestsBag->all() as $abTestName => $value) {
            $cookie = Cookie::create(
                $abTestName,
                $value,
                time() + self::COOKIE_LIFETIME
            );

            $response->headers->setCookie($cookie);
        }
    }

    public function getAbTestValue(string $abTestName): string
    {
        // Fallback to value "a" by default which is the original value
        return $this->abTestsBag->get($abTestName, 'a');
    }

    public function getAllAbTestsValues(): array
    {
        return $this->abTestsBag->all();
    }

    protected function getEnabledAbTests(): array
    {
        return self::ENABLED_AB_TESTS;
    }

    private function setRandomAbTestValue(string $abTestName): void
    {
        $randomIndex = mt_rand(0, 100) <= 50 ? 0 : 1;

        $this->abTestsBag->set($abTestName, self::ALLOWED_AB_TEST_VALUES[$randomIndex]);
    }
}
