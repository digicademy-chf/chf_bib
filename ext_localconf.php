<?php

# This file is part of the extension CHF Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


// Prevent script from being called directly
defined( 'TYPO3' ) or die();

// Register content for this extension
( function( $extKey='chf_bib' ) {

    // Backend customisation
    $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets'] = [
        'chf_bib' => 'EXT:' . $extKey . '/Configuration/RTE/CHFBib.yaml'
    ];

} )();

?>
