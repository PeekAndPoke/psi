<?php
/**
 * Created by gerk on 30.11.17 06:03
 */

namespace PeekAndPoke\Component\Psi\Psi\Str;

use PHPUnit\Framework\TestCase;

/**
 *
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class WithoutAccentsTest extends TestCase
{
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

            // some manual cases
            ['Dragoş', 'Dragos'],
            ['Ärmel', 'Aermel'],
            ['Blüte', 'Bluete'],
            ['Straße', 'Strasse'],
            ['passé', 'passe'],
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
