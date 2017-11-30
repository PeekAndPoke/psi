<?php
/**
 * Created by gerk on 29.11.17 16:52
 */

namespace PeekAndPoke\Component\Psi;

use PeekAndPoke\Component\Psi\Psi\IsGreaterThan;
use PHPUnit\Framework\TestCase;

/**
 *
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class PsiInputsTest extends TestCase
{
    public function testWithInput()
    {
        $this->assertSame(
            [3, 4],
            Psi::it([1, 2])
                ->filter(new IsGreaterThan(2))
                ->withInputs([3, 4])
                ->toArray()
        );
    }
}
