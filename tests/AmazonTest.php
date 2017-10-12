<?php

namespace GoetasWebservices\XML\XSDReader\Tests;

use GoetasWebservices\XML\XSDReader\Schema\Element\Element;

class AmazonTest extends BaseTest
{

    /**
     * Test that a referenced Xsd file is found when the base-path contains " " (space-character).
     *
     * Covers the issue described in {@link https://github.com/goetas/xsd-reader/pull/10 PR #10}.
     */
    public function testChoiceIsSet()
    {
        $schemaXsd = __DIR__ . DIRECTORY_SEPARATOR . 'amazon' . DIRECTORY_SEPARATOR . 'amzn-envelope.xsd';

        $schema = $this->reader->readFile($schemaXsd);

        /** @var Element $element */
        $element = $schema->getElement('Product');

        /** @var Element $subElement */
        foreach ($element->getType()->getElements() as $subElement) {
            if ($subElement->getName() == 'ProductData') {
                $this->assertTrue($subElement->getType()->isChoice());
            }
        }
    }

}