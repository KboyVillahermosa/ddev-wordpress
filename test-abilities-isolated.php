<?php
define('ABSPATH', __DIR__ . '/web/');
define('WPINC', 'wp-includes');

require_once 'web/wp-includes/abilities-api/class-wp-ability-category.php';
require_once 'web/wp-includes/abilities-api/class-wp-ability-categories-registry.php';
require_once 'web/wp-includes/abilities-api/class-wp-ability.php';
require_once 'web/wp-includes/abilities-api/class-wp-abilities-registry.php';

if ( class_exists( 'WP_Abilities_Registry' ) && class_exists( 'WP_Ability' ) ) {
    echo "SUCCESS: Abilities API classes restored and loaded.\n";
    
    $registry = WP_Abilities_Registry::get_instance();
    if ( $registry ) {
        echo "Registry instance retrieved.\n";
        
        $registry->register('test/ability', [
            'label' => 'Test Ability',
            'description' => 'A test ability',
            'category' => 'test-cat'
        ]);
        
        if ($registry->is_registered('test/ability')) {
            echo "Ability registration works.\n";
            $ability = $registry->get_registered('test/ability');
            echo "Ability label: " . $ability->get_label() . "\n";
        }
    }
} else {
    echo "FAILURE: Classes not found.\n";
}
