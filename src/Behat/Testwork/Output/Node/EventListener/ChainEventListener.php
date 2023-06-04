<?php

/*
 * This file is part of the Behat.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Behat\Testwork\Output\Node\EventListener;

use Behat\Testwork\Event\Event;
use Behat\Testwork\Output\Formatter;

/**
 * Used to compose formatter event listeners.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class ChainEventListener implements EventListener, \Countable, \IteratorAggregate
{
    /**
     * @var EventListener[]
     */
    private $listeners;

    /**
     * Initializes collection.
     *
     * @param EventListener[] $listeners
     */
    public function __construct(array $listeners)
    {
        $this->listeners = $listeners;
    }

    /**
     * {@inheritdoc}
     */
    public function listenEvent(Formatter $formatter, Event $event, $eventName)
    {
        foreach ($this->listeners as $listener) {
            $listener->listenEvent($formatter, $event, $eventName);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function count(): int
    {
        return count($this->listeners);
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->listeners);
    }
}
