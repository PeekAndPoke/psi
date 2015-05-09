<?php
/**
 * File was created 06.05.2015 22:18
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\Intermediate\Functional;

/**
 * EachOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class EachOperation extends AbstractBinaryFunctionalOperation
{
    /**
     * {@inheritdoc}
     */
    public function apply($input, $index, &$useItem, &$canContinue = true)
    {
        $useItem     = true;
        $canContinue = true;

        $this->function->apply($input, $index);

        // return the input unmodified
        return $input;
    }
}
