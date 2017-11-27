<?php
/**
 * Created by gerk on 27.11.17 06:24
 */

namespace PeekAndPoke\Component\Psi;

use PHPUnit\Framework\TestCase;

/**
 *
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class PsiOptionsTest extends TestCase
{
    public function testDefaultOptions()
    {
        $psi = Psi::it([]);

        $this->assertFalse($psi->getOptions()->isPreserveKeysOfMultipleInputs());

        $this->assertInstanceOf(DefaultPsiFactory::class, $psi->getOptions()->getFactory());
    }

    public function testPreserveKeysOfMultipleInputs()
    {
        $psi = Psi::it([])->preserveKeysOfMultipleInputs();

        $this->assertTrue($psi->getOptions()->isPreserveKeysOfMultipleInputs());

        $psi = Psi::it([])->preserveKeysOfMultipleInputs(false);

        $this->assertFalse($psi->getOptions()->isPreserveKeysOfMultipleInputs());
    }

    public function testUseFactory()
    {
        $psi = Psi::it([])
            ->useFactory($factory = new DefaultPsiFactory());

        $this->assertSame($factory, $psi->getOptions()->getFactory());
    }
}
