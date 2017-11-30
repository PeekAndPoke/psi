<?php
/**
 * Created by gerk on 30.11.17 06:03
 */

namespace PeekAndPoke\Component\Psi\Psi\Str;

use PeekAndPoke\Component\Psi\Stubs\UnitTestToString;
use PHPUnit\Framework\TestCase;

/**
 *
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class WithoutAccentsTest extends TestCase
{
    public function testWarmUp()
    {
        // this is just for the code coverage
        WithoutAccents::setupUtf8Map();
        WithoutAccents::setupIsoMap();

        $this->assertNotEmpty(WithoutAccents::getUtf8Map());
    }

    /**
     * @param $input
     * @param $expected
     *
     * @dataProvider provide
     */
    public function testSubject($input, $expected)
    {
        $subject = new WithoutAccents();

        $result = $subject->__invoke($input);

        $this->assertSame($expected, $result);
    }

    public function provide()
    {
        $cases = [
            // nothing to replace
            ['a', 'a'],
            ['Arm', 'Arm'],
            [' Arm', ' Arm'],
            [' Arm ', ' Arm '],
            ['Arm /-*(){}[]\\|', 'Arm /-*(){}[]\\|'],
            [' Arm /-*(){}[]\\| ', ' Arm /-*(){}[]\\| '],

            // some manual cases UTF-8
            ['Dragoş', 'Dragos'],
            ['Ärmel', 'Aermel'],
            ['Blüte', 'Bluete'],
            ['Straße', 'Strasse'],
            ['passé', 'passe'],

            // at least one case in ISO
            [chr(hexdec('c4')), 'A'],

            // negative cases
            [new UnitTestToString('passé'), null],
        ];

        // try all UTF-8 accents
        $utf8map = WithoutAccents::getUtf8Map();

        foreach ($utf8map as $from => $to) {

            $cases[] = [$from, $to];
            $cases[] = ['A' . $from . 'b', 'A' . $to . 'b'];
        }

        return $cases;
    }
}
