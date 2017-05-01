<?php


/*
 * This file is part of Laravel Stripe.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Stripe;

use InvalidArgumentException;

class StripeFactory
{
    /**
     * Make a new Stripe client.
     *
     * @param array $config
     *
     * @return \BrianFaust\Stripe\Stripe
     */
    public function make(array $config)
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    protected function getConfig(array $config)
    {
        $keys = ['key'];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing configuration key [$key].");
            }
        }

        return array_only($config, ['key']);
    }

    /**
     * Get the Stripe client.
     *
     * @param array $auth
     *
     * @return \BrianFaust\Stripe\Stripe
     */
    protected function getClient(array $auth)
    {
        return new Stripe($auth['key']);
    }
}
