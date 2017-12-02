<?php
/**
 * File was created 07.05.2015 07:51
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi;

use PeekAndPoke\Component\Psi\Stubs\UnitTestPsiObject;
use PHPUnit\Framework\TestCase;

/**
 * PsiHighLevelObjectTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class PsiHighLevelObjectTest extends TestCase
{
    /**
     * @param array $input
     * @param array $expectedOutput
     * @param bool  $expectMatch
     *
     * @throws \PeekAndPoke\Component\Psi\Exception\PsiException
     *
     * @dataProvider provideTestWithNoOperation
     */
    public function testWithNoOperation($input, $expectedOutput, $expectMatch)
    {
        $result = Psi::it($input)->toArray();

        if ($expectMatch) {
            $this->assertSame($expectedOutput, $result);
        } else {
            $this->assertNotSame($expectedOutput, $result);
        }
    }

    /**
     * @return array
     */
    public function provideTestWithNoOperation()
    {
        return [
            [
                [],
                [],
                true,
            ],
            [
                [1],
                [1],
                true,
            ],
            [
                [0],
                [1],
                false,
            ],
            [
                [1, 2],
                [1, 2],
                true,
            ],
            [
                [1, 2],
                [2, 1],
                false,
            ],
        ];
    }

    ////  TERMINAL OPERATIONS  /////////////////////////////////////////////////////////////////////////////////////////

    public function testGetYoungestPersonsName()
    {
        $input = [
            new UnitTestPsiObject('Karl', 50),
            new UnitTestPsiObject($expected = 'Edgar', 10),
            new UnitTestPsiObject('Heidi', 52),
        ];

        $result = Psi::it($input)
            ->usort(function (UnitTestPsiObject $a, UnitTestPsiObject $b) { return $a->getAge() > $b->getAge(); })
            ->map(function (UnitTestPsiObject $a) { return $a->getName(); })
            ->getFirst();

        $this->assertSame($expected, $result);
    }

    public function testGetYoungestPersonsNameReversed()
    {
        $input = [
            new UnitTestPsiObject('Karl', 50),
            new UnitTestPsiObject($expected = 'Edgar', 10),
            new UnitTestPsiObject('Heidi', 52),
        ];

        $result = Psi::it($input)
            ->usort(function (UnitTestPsiObject $a, UnitTestPsiObject $b) { return $a->getAge() > $b->getAge(); })
            ->map(function (UnitTestPsiObject $a) { return $a->getName(); })
            ->reverse()
            ->getLast();

        $this->assertSame($expected, $result);
    }

    public function testGetOldestPerson()
    {
        $input = [
            new UnitTestPsiObject('Karl', 50),
            new UnitTestPsiObject('Edgar', 10),
            $expected = new UnitTestPsiObject('Heidi', 52),
        ];

        $result = Psi::it($input)
            ->usort(function (UnitTestPsiObject $a, UnitTestPsiObject $b) { return $a->getAge() < $b->getAge(); })
            ->getFirst();

        $this->assertSame($expected, $result);
    }

    public function testGetSummedUpPersonAges()
    {
        $input = [
            new UnitTestPsiObject('Karl', 50),
            new UnitTestPsiObject('Edgar', 10),
            new UnitTestPsiObject('Heidi', 52),
        ];

        $result = Psi::it($input)
            ->map(function (UnitTestPsiObject $a) { return $a->getAge(); })
            ->sum();

        $this->assertSame(50 + 10 + 52, $result);
    }

    public function testGetAverageAge()
    {
        $input = [
            new UnitTestPsiObject('Karl', 50),
            new UnitTestPsiObject('Edgar', 10),
            new UnitTestPsiObject('Heidi', 52),
        ];

        $result = Psi::it($input)
            ->map(function (UnitTestPsiObject $a) { return $a->getAge(); })
            ->avg();

        $this->assertSame((50 + 10 + 52) / 3, $result);
    }

    public function testManipulateEachPerson()
    {
        $input = [
            $karl = new UnitTestPsiObject('Karl', 50),
            $edgar = new UnitTestPsiObject('Edgar', 10),
            $heidi = new UnitTestPsiObject('Heidi', 52),
        ];

        Psi::it($input)
            ->each(function (UnitTestPsiObject $a) { $a->incAge(1); })
            ->collect();

        $this->assertEquals(50 + 1, $karl->getAge());
        $this->assertEquals(10 + 1, $edgar->getAge());
        $this->assertEquals(52 + 1, $heidi->getAge());
    }

    public function testManipulateEachPersonWithIndex()
    {
        $input = [
            $karl = new UnitTestPsiObject('Karl', 50),
            $edgar = new UnitTestPsiObject('Edgar', 10),
            $heidi = new UnitTestPsiObject('Heidi', 52),
        ];

        Psi::it($input)
            ->each(function (UnitTestPsiObject $a, $idx) { $a->incAge($idx); })
            ->collect();

        $this->assertEquals(50 + 0, $karl->getAge());
        $this->assertEquals(10 + 1, $edgar->getAge());
        $this->assertEquals(52 + 2, $heidi->getAge());
    }

    ////  TEST SCENARIOS  //////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Test that filtering works
     */
    public function testScenario001()
    {
        $input = [
            $karl = new UnitTestPsiObject('Karl', 50),
            $edgar = new UnitTestPsiObject('Edgar', 10),
            $heidi = new UnitTestPsiObject('Heidi', 52),
        ];

        $expected = [$heidi];

        $result = Psi::it($input)
            ->filter(function (UnitTestPsiObject $i) { return $i->getAge() > 50; })
            ->toArray();

        $this->assertSame($expected, $result);
    }


    /**
     * Test that filtering by key works as well
     */
    public function testScenario002()
    {
        $input = [
            $karl = new UnitTestPsiObject('Karl', 50),
            $edgar = new UnitTestPsiObject('Edgar', 10),
            $heidi = new UnitTestPsiObject('Heidi', 52),
        ];

        $expected = [$karl];

        $result = Psi::it($input)
            ->filterKey(function ($k) { return $k === 0; })
            ->toArray();

        $this->assertSame($expected, $result);
    }

    /**
     * Test that filtering by key and value works as well
     */
    public function testScenario004()
    {
        $input = [
            $karl = new UnitTestPsiObject('Karl', 50),
            $edgar = new UnitTestPsiObject('Edgar', 10),
            $heidi = new UnitTestPsiObject('Heidi', 52),
        ];

        $expected = [$karl, $heidi];

        $result = Psi::it($input)
            ->filter(function (UnitTestPsiObject $v, $k) { return $v->getName() === 'Karl' || $k > 1; })
            ->toArray();

        $this->assertSame($expected, $result);
    }
}
