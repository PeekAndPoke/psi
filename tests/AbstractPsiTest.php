<?php
/**
 * File was created 07.05.2015 07:55
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi;

use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
abstract class AbstractPsiTest extends TestCase
{
    /**
     * @param array     $expected
     * @param \Iterator $resultIt
     */
    protected function assertPsiCollectOutputMatches($expected, $resultIt)
    {
        $result = iterator_to_array($resultIt);

        // tests for same elements
        $this->assertEquals($expected, $result);
    }

    /**
     * @param array     $expected
     * @param \Iterator $resultIt
     */
    protected function assertPsiCollectOutputDoesNotMatches($expected, $resultIt)
    {
        $result = iterator_to_array($resultIt);

        // tests for same elements
        $this->assertNotEquals($expected, $result);
    }
}
