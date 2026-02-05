<?php
require_once 'web/wp-load.php';

if ( class_exists( 'WP_Abilities_Registry' ) && class_exists( 'WP_Ability' ) ) {
    echo "SUCCESS: Abilities API classes restored and loaded.\n";
    
    $registry = WP_Abilities_Registry::get_instance();
    if ( $registry ) {
        echo "Registry instance retrieved.\n";
    }
} else {
    echo "FAILURE: Classes not found.\n";
}
