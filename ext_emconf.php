<?php

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


$EM_CONF[$_EXTKEY] = [
    'title'          => 'CHF Bib',
    'description'    => 'Generic or annotated bibliographies in TYPO3 as part of the CHF',
    'category'       => 'misc',
    'author'         => 'Jonatan Jalle Steller',
    'author_email'   => 'jonatan.steller@adwmainz.de',
    'author_company' => 'Academy of Sciences and Literature Mainz',
    'state'          => 'beta',
    'version'        => '0.5.0',
    'constraints'    => [
        'depends'   => [
            'typo3' => '12.0.0-12.4.99',
            'php'   => '8.1.0-8.2.99'
        ],
        'conflicts' => [
        ],
        'suggests'  => [
        ],
    ],
    'autoload'       => [
        'psr-4' => [
           'Digicademy\\CHFBib\\' => 'Classes/'
        ]
     ]
];

?>