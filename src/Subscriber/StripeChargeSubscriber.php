<?php

declare(strict_types=1);

/*
 * This file is part of the Serendipity HQ Stripe Bundle.
 *
 * Copyright (c) Adamo Aerendir Crespi <aerendir@serendipityhq.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SerendipityHQ\Bundle\StripeBundle\Subscriber;

use SerendipityHQ\Bundle\StripeBundle\Event\StripeChargeCreateEvent;
use Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher;
use Symfony\Components\EventDispatcher\EventDispatcherInterface;

/**
 * Manages Charges on Stripe.
 */
final class StripeChargeSubscriber extends AbstractStripeSubscriber
{
    public static function getSubscribedEvents(): array
    {
        return [
            StripeChargeCreateEvent::CREATE => 'onChargeCreate',
        ];
    }

    /**
     * @param $eventName
     * @param ContainerAwareEventDispatcher|EventDispatcherInterface $dispatcher
     */
    public function onChargeCreate(StripeChargeCreateEvent $event, $eventName, EventDispatcherInterface $dispatcher): void
    {
        $localCharge = $event->getLocalCharge();

        $result = $this->getStripeManager()->createCharge($localCharge);

        // Check if something went wrong
        if (false === $result) {
            // Stop progation
            $event->setStopReason($this->getStripeManager()->getError())->stopPropagation();

            // Dispatch a failed event
            $dispatcher->dispatch($event, StripeChargeCreateEvent::FAILED);

            // exit
            return;
        }

        $dispatcher->dispatch($event, StripeChargeCreateEvent::CREATED);
    }
}
