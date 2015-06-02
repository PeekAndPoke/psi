<?php
/**
 * File was created 06.05.2015 21:05
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Functions\Unary;

use PeekAndPoke\Component\Psi\Interfaces\Functions\UnaryFunctionInterface;

/**
 * UnaryFunction
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class UnaryClosure implements UnaryFunctionInterface
{
    /** @var \Closure */
    private $function;

    /**
     * @param \Closure $function
     */
    public function __construct(\Closure $function)
    {
        $this->function = $function;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke($input)
    {
        /** @noinspection PhpMethodParametersCountMismatchInspection */
        /** @noinspection PhpMethodParametersCountMismatchInspection */
        /** @noinspection PhpVoidFunctionResultUsedInspection */
        return $this->function->__invoke($input);
    }
}
