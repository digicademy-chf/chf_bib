<?php
declare(strict_types=1);

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

// Backend customisation
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets'] = [
    'chf_bib' => 'EXT:chf_bib/Configuration/RTE/CHFBib.yaml',
];
