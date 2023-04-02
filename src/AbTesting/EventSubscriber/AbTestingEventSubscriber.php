<?php

namespace App\AbTesting\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\KernelEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use App\AbTesting\AbTestingManager;

class AbTestingEventSubscriber implements EventSubscriberInterface
{
    /** @var AbTestingManager */
    private $abTestingManager;

    public function __construct(AbTestingManager $abTestingManager)
    {
        $this->abTestingManager = $abTestingManager;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
            KernelEvents::RESPONSE => 'onKernelResponse',
        ];
    }

    public function onKernelRequest(KernelEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $this->abTestingManager->registerAbTestsValues($event->getRequest());
    }

    public function onKernelResponse(ResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $this->abTestingManager->createAbTestsCookies($event->getResponse());
    }
}
