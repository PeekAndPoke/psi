<?php
/**
 * File was created 06.05.2015 21:00
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\Intermediate\Functional;

/**
 * MapOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class MapOperation extends AbstractBinaryFunctionalOperation
{
    /**
     * {@inheritdoc}
     */
    public function apply($input, $index, &$useItem, &$canContinue)
    {
        $useItem     = true;
        $canContinue = true;

        return $this->function->apply($input, $index);
    }
}
