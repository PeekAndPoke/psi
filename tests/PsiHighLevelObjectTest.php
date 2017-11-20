<?php
/**
 * File was created 07.05.2015 07:51
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi;

/**
 * PsiHighLevelObjectTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class PsiHighLevelObjectTest extends AbstractPsiTest
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
        $result = Psi::it($input)->collect();

        if ($expectMatch) {
            $this->assertPsiCollectOutputMatches($expectedOutput, $result);
        } else {
            $this->assertPsiCollectOutputDoesNotMatches($expectedOutput, $result);
        }
    }

    /**
     * @return array
     */
    public function provideTestWithNoOperation()
    {
        return [
            [
                [],                 [],             true
            ],
            [
                [1],                [1],            true
            ],
            [
                [0],                [1],            false
            ],
            [
                [1, 2],             [1, 2],         true
            ],
            [
                [1, 2],             [2, 1],         false
            ],
        ];
    }

    ////  TERMINAL OPERATIONS  /////////////////////////////////////////////////////////////////////////////////////////

    public function testGetYoungestPersonsName()
    {
        $input = [
            new PsiTestObject('Karl', 50),
            new PsiTestObject($expected = 'Edgar', 10),
            new PsiTestObject('Heidi', 52),
        ];

        $result = Psi::it($input)
            ->usort(function (PsiTestObject $a, PsiTestObject $b) { return $a->getAge() > $b->getAge(); })
            ->map(function (PsiTestObject $a) { return $a->getName(); })
            ->getFirst();

        $this->assertSame($expected, $result);
    }

    public function testGetOldestPerson()
    {
        $input = [
            new PsiTestObject('Karl', 50),
            new PsiTestObject('Edgar', 10),
            $expected = new PsiTestObject('Heidi', 52),
        ];

        $result = Psi::it($input)
            ->usort(function (PsiTestObject $a, PsiTestObject $b) { return $a->getAge() < $b->getAge(); })
            ->getFirst();

        $this->assertSame($expected, $result);
    }

    public function testGetSummedUpPersonAges()
    {
        $input = [
            new PsiTestObject('Karl', 50),
            new PsiTestObject('Edgar', 10),
            new PsiTestObject('Heidi', 52),
        ];

        $result = Psi::it($input)
            ->map(function (PsiTestObject $a) { return $a->getAge(); })
            ->sum();

        $this->assertSame(50 + 10 + 52, $result);
    }

    public function testGetAverageAge()
    {
        $input = [
            new PsiTestObject('Karl', 50),
            new PsiTestObject('Edgar', 10),
            new PsiTestObject('Heidi', 52),
        ];

        $result = Psi::it($input)
            ->map(function (PsiTestObject $a) { return $a->getAge(); })
            ->avg();

        $this->assertSame((50 + 10 + 52) / 3, $result);
    }

    public function testManipulateEachPerson()
    {
        $input = [
            $karl  = new PsiTestObject('Karl', 50),
            $edgar = new PsiTestObject('Edgar', 10),
            $heidi = new PsiTestObject('Heidi', 52),
        ];

        Psi::it($input)
            ->each(function (PsiTestObject $a) { $a->incAge(1); })
            ->collect();

        $this->assertEquals(50 + 1, $karl->getAge());
        $this->assertEquals(10 + 1, $edgar->getAge());
        $this->assertEquals(52 + 1, $heidi->getAge());
    }

    public function testManipulateEachPersonWithIndex()
    {
        $input = [
            $karl  = new PsiTestObject('Karl', 50),
            $edgar = new PsiTestObject('Edgar', 10),
            $heidi = new PsiTestObject('Heidi', 52),
        ];

        Psi::it($input)
            ->each(function (PsiTestObject $a, $idx) { $a->incAge($idx); })
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
            $karl  = new PsiTestObject('Karl', 50),
            $edgar = new PsiTestObject('Edgar', 10),
            $heidi = new PsiTestObject('Heidi', 52),
        ];

        $expected = [$heidi];

        $result = Psi::it($input)
            ->filter(function (PsiTestObject $i) { return $i->getAge() > 50; })
            ->collect();

        $this->assertPsiCollectOutputMatches($expected, $result);
    }


    /**
     * Test that filtering by key works as well
     */
    public function testScenario002()
    {
        $input = [
            $karl  = new PsiTestObject('Karl', 50),
            $edgar = new PsiTestObject('Edgar', 10),
            $heidi = new PsiTestObject('Heidi', 52),
        ];

        $expected = [$karl];

        $result = Psi::it($input)
                     ->filterKey(function ($k) { return $k === 0; })
                     ->collect();

        $this->assertPsiCollectOutputMatches($expected, $result);
    }

    /**
     * Test that filtering by key and value works as well
     */
    public function testScenario004()
    {
        $input = [
            $karl  = new PsiTestObject('Karl', 50),
            $edgar = new PsiTestObject('Edgar', 10),
            $heidi = new PsiTestObject('Heidi', 52),
        ];

        $expected = [$karl, $heidi];

        $result = Psi::it($input)
                     ->filterValueKey(function (PsiTestObject $v, $k) { return $v->getName() === 'Karl' || $k > 1; })
                     ->collect();

        $this->assertPsiCollectOutputMatches($expected, $result);
    }
//
//    /**
//     * Test the combination of multiple intermediate operators and their execution order
//     */
//    public function testScenario100()
//    {
//        $input    = [1, 10, 2, 9, 3, 8, 4, 7, 5, 6];
//        $expected = [11, 91, 31, 71, 51];
//
//        $result = Psi::it($input)
//            ->map(function ($i)    { return $i * 10; })
//            ->filter(function ($i) { return $i % 20; })
//            ->map(function ($i)    { return $i + 1;  })
//            ->collect();
//
//        $this->assertPsiCollectOutputMatches($expected, $result);
//    }
//
//    /**
//     * Test the combination of multiple intermediate operators and their execution order once more
//     */
//    public function testScenario101()
//    {
//        $input    = [1, 10, 2, 9, 3, 8, 4, 7, 5, 6];
//        $expected = [11, 19, 13, 17, 15];
//
//        $result = Psi::it($input)
//                     ->map(function ($i)    { return $i * 1; })
//                     ->filter(function ($i) { return $i % 2; })
//                     ->map(function ($i)    { return $i + 10;  })
//                     ->collect();
//
//        $this->assertPsiCollectOutputMatches($expected, $result);
//    }
//
//    /**
//     * Test continuation after intermediate operation
//     */
//    public function testScenario102()
//    {
//        $input    = [1, 10, 2, 9, 3, 8, 4, 7, 5, 6];
//        $expected = [2, 20];
//
//        $result = Psi::it($input)
//            ->map(function ($i)      { return $i * 2;  })
//            ->anyMatch(function ($i) { return $i >= 20; })
//            ->collect();
//
//        $this->assertPsiCollectOutputMatches($expected, $result);
//    }
//
//    /**
//     * Test continuation after intermediate operation with different execution order
//     */
//    public function testScenario103()
//    {
//        $input    = [1, 10, 2, 9, 3, 8, 4, 7, 5, 6];
//        $expected = [2, 20];
//
//        $result = Psi::it($input)
//            ->anyMatch(function ($i) { return $i >= 10; })
//            ->map(function ($i)      { return $i * 2;   })
//            ->collect();
//
//        $this->assertPsiCollectOutputMatches($expected, $result);
//
//    }
//    /**
//     * Test the combination of intermediate and full set operators and their execution order
//     */
//    public function testScenario104()
//    {
//        $input    = [1, 1, 10, 10, 2, 2, 9, 9, 15, 3, 3];
//        $expected = [10, 1];
//
//        $result = Psi::it($input)
//            ->anyMatch(function ($i) { return $i >= 15; })  // removes the last two [3, 3]
//            ->map(function ($i)      { return $i * 2;   })  // multiple all by 2
//            ->unique()
//            ->anyMatch(function ($i) { return $i >= 15; })  // removes all after [10 * 2, 10 * 2]
//            ->map(function ($i)      { return $i / 2;   })  // divide by 2
//            ->rsort()
//            ->collect();
//
//        $this->assertPsiCollectOutputMatches($expected, $result);
//    }
}
