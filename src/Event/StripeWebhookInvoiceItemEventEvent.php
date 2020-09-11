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

namespace SerendipityHQ\Bundle\StripeBundle\Event;

/**
 * Dispatched when a invoiceitem.* event has been received by the webhook endpoint.
 *
 * @author Adamo Crespi <hello@aerendir.me>
 */
final class StripeWebhookInvoiceItemEventEvent extends AbstractStripeWebhookEventEvent
{
    /**
     * Occurs whenever an invoice item is created.
     *
     * @var string
     *
     * @see https://stripe.com/docs/api#event_types-invoiceitem.created
     */
    const CREATED = 'stripe.webhook.invoiceitem.created';

    /**
     * Occurs whenever an invoice item is deleted.
     *
     * @var string
     *
     * @see https://stripe.com/docs/api#event_types-invoiceitem.deleted
     */
    const DELETED = 'stripe.webhook.invoiceitem.deleted';

    /**
     * Occurs whenever an invoice item is updated.
     *
     * @var string
     *
     * @see https://stripe.com/docs/api#event_types-invoiceitem.updated
     */
    const UPDATED = 'stripe.webhook.invoiceitem.updated';
}
