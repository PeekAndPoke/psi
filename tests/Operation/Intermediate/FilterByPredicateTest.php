<?php
/**
 * Created by gerk on 29.11.17 08:30
 */

namespace PeekAndPoke\Component\Psi\Operation\Intermediate;

use PeekAndPoke\Component\Psi\Psi;
use PeekAndPoke\Component\Psi\Psi\Str\IsStartingWith;
use PeekAndPoke\Component\Psi\Stubs\UnitTestPsiObject;
use PHPUnit\Framework\TestCase;

/**
 *
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class FilterByPredicateTest extends TestCase
{
    public function testSubject1()
    {
        $input = [
            $edgar = new UnitTestPsiObject('Edgar', 3),
            $karla = new UnitTestPsiObject('Karla', 4),
            $karsten = new UnitTestPsiObject('Karsten', 38),
            $alexandru = new UnitTestPsiObject('Alexandru', 31),
        ];

        $result = Psi::it($input)
            ->filterBy(
                function (UnitTestPsiObject $o) { return $o->getName(); },
                new IsStartingWith('K')
            )
            ->toArray();

        $this->assertSame([$karla, $karsten], $result);
    }

    public function testSubject2()
    {
        $input = [
            $edgar = new UnitTestPsiObject('Edgar', 3),
            $karla = new UnitTestPsiObject('Karla', 4),
            $karsten = new UnitTestPsiObject('Karsten', 38),
            $alexandru = new UnitTestPsiObject('Alexandru', 31),
        ];

        $result = Psi::it($input)
            ->filterBy(
                function (UnitTestPsiObject $o) { return $o->getAge(); },
                new Psi\IsLessThan(18)
            )
            ->toArray();

        $this->assertSame([$edgar, $karla], $result);
    }
}
