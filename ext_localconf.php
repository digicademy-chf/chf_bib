<?php

# This file is part of the extension DA Bib for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


// Prevent script from being called directly
defined( 'TYPO3' ) or die();

// Register content for this extension
( function( $extKey='da_bib' ) {

    // Backend customisation
    $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets'] = [
        'da_bib' => 'EXT:' . $extKey . '/Configuration/RTE/DABib.yaml'
    ];

} )();

?>
