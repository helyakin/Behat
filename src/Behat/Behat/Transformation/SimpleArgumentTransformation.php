<?php

/*
 * This file is part of the Behat.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Behat\Behat\Transformation;

use Behat\Behat\Definition\Call\DefinitionCall;
use Behat\Testwork\Call\CallCenter;

/**
 * Represents a simple self-contained transformation capable of changing a single argument.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
interface SimpleArgumentTransformation extends Transformation
{
    /**
     * Checks if transformation supports given pattern.
     *
     * @param string $pattern
     *
     * @return bool
     */
    public static function supportsPatternAndMethod($pattern, \ReflectionMethod $method);

    /**
     * Returns transformation priority.
     *
     * @return int
     */
    public function getPriority();

    /**
     * Checks if transformation supports argument.
     *
     * @param int|string $argumentIndex
     * @param mixed      $argumentArgumentValue
     *
     * @return bool
     */
    public function supportsDefinitionAndArgument(DefinitionCall $definitionCall, $argumentIndex, $argumentArgumentValue);

    /**
     * Transforms argument value using transformation and returns a new one.
     *
     * @param int|string $argumentIndex
     * @param mixed      $argumentValue
     *
     * @return mixed
     */
    public function transformArgument(CallCenter $callCenter, DefinitionCall $definitionCall, $argumentIndex, $argumentValue);
}
