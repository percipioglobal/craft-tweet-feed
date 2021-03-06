<?php
/**
 * Tweet plugin for Craft CMS 3.x
 *
 * Get the latest tweets from a feed
 *
 * @link      https://percipio.london
 * @copyright Copyright (c) 2021 percipiolondon
 */

namespace percipiolondon\tweetfeed\variables;

use percipiolondon\tweetfeed\TweetFeed;

/**
 * @author    percipiolondon
 * @package   Tweet
 * @since     1.0.0
 */
class TweetVariable
{
    // Public Methods
    // =========================================================================

    /**
     * @param int $amount
     * @param mixed $fields
     * @param string $params
     * @return array
     */
    public function tweets(int $amount = 100, mixed $fields = null, string $params = ''): array
    {
        //The max_results expects a number between 5 and 100
        $count = $amount;

        if ($count && $count > 100) {
            $count = 100;
        }

        if ($count && $count < 5) {
            $count = 5;
        }

        $tweets = TweetFeed::$plugin->tweets->getTweets($count, $fields, $params);
        $tweets = array_key_exists('data', $tweets) ? $tweets['data'] : [];

        if ($amount && $amount < 5) {
            $tweets = array_slice($tweets, 0, $amount);
        }

        return $tweets;
    }
}
