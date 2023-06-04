<?php

/*
 * This file is part of the Behat.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Behat\Testwork\Call\Handler\Exception;

use Behat\Testwork\Call\Handler\ExceptionHandler;

/**
 * Handles method not found exceptions.
 *
 * @see ExceptionHandler
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
abstract class MethodNotFoundHandler implements ExceptionHandler
{
    public const PATTERN = '/^Call to undefined method ([^:]+)::([^\)]+)\(\)$/';

    /**
     * {@inheritdoc}
     */
    final public function supportsException($exception)
    {
        if (!$exception instanceof \Error) {
            return false;
        }

        return null !== $this->extractNonExistentCallable($exception);
    }

    /**
     * {@inheritdoc}
     */
    final public function handleException($exception)
    {
        $this->handleNonExistentMethod($this->extractNonExistentCallable($exception));

        return $exception;
    }

    /**
     * Override to handle non-existent method.
     */
    abstract public function handleNonExistentMethod(array $callable);

    /**
     * Extract callable from exception.
     *
     * @return null|array
     */
    private function extractNonExistentCallable(\Error $exception)
    {
        if (1 === preg_match(self::PATTERN, $exception->getMessage(), $matches)) {
            return [$matches[1], $matches[2]];
        }

        return null;
    }
}
