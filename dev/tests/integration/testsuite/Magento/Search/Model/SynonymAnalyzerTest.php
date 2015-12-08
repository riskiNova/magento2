<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Search\Model;

/**
 * @magentoDataFixture Magento/Search/_files/SynonymReader.php
 * @magentoDbIsolation disabled
 */
class SynonymAnalyzerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\Search\Model\SynonymAnalyzer
     */
    private $synAnalyzer;

    protected function setUp()
    {
        $objectManager = \Magento\TestFramework\Helper\Bootstrap::getObjectManager();
        $this->synAnalyzer = $objectManager->get('Magento\Search\Model\SynonymAnalyzer');
    }

    /**
     * Data provider for the test
     *
     * @return array
     */
    public static function loadGetSynonymsForPhraseDataProvider()
    {
        return [
            'withSynonyms' => [
                'phrase' => 'Elizabeth is the English queen.',
                'expectedResult' => [['elizabeth'],['is'],['the'],['british', 'english'],['queen', 'monarch']]
            ],
            'noSynonyms' => [
                'phrase' => 'This sentence has no synonyms',
                'expectedResult' => [['this'], ['sentence'], ['has'], ['no'], ['synonyms']]
            ],
            'specialCharacters' => [
                'phrase' => '~tilde`backtic! exclamation@  at#hash\$dollar%percent^carat&ampersand*star(leftparan'
                    . ')rightparan_underscore+plus=equal{leftcurly}rightcurly[leftbracket]rightbracket:colon'
                    . '"doublequote\'singlequote,comma  space.period<leftangle>rightangle?questionmark\\backslash'
                    . '/forwardslash   tab;semicolon',
                'expectedResult' => [
                    ['tilde'],
                    ['backtic'],
                    ['exclamation'],
                    ['at'],
                    ['hash'],
                    ['dollar'],
                    ['percent'],
                    ['carat'],
                    ['ampersand'],
                    ['star'],
                    ['leftparan'],
                    ['rightparan'],
                    ['underscore'],
                    ['plus'],
                    ['equal'],
                    ['leftcurly'],
                    ['rightcurly'],
                    ['leftbracket'],
                    ['rightbracket'],
                    ['colon'],
                    ['doublequote'],
                    ['singlequote'],
                    ['comma'],
                    ['space'],
                    ['period'],
                    ['leftangle'],
                    ['rightangle'],
                    ['questionmark'],
                    ['backslash'],
                    ['forwardslash'],
                    ['tab'],
                    ['semicolon']
                ]
            ],
            'oneMoreTest' => [
                'phrase' => 'schlicht',
                'expectedResult' => [['schlicht', 'natürlich']]]
        ];
    }

    /**
     * @param string $phrase
     * @param array $expectedResult
     * @dataProvider loadGetSynonymsForPhraseDataProvider
     */
    public function testGetSynonymsForPhrase($phrase, $expectedResult)
    {
        $synonyms = $this->synAnalyzer->getSynonymsForPhrase($phrase);
        $this->assertEquals($expectedResult, $synonyms);
    }
}
