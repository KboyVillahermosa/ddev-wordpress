<?php
/**
 * Abilities API: WP_Abilities_Registry class
 *
 * @package WordPress
 * @subpackage Abilities_API
 * @since 6.9.0
 */

declare( strict_types = 1 );

/**
 * Core class used for managing registered abilities.
 *
 * @since 6.9.0
 */
class WP_Abilities_Registry {

	/**
	 * Registered abilities.
	 *
	 * @since 6.9.0
	 * @var array<string, WP_Ability>
	 */
	protected $registered_abilities = array();

	/**
	 * Container for the main instance of the class.
	 *
	 * @since 6.9.0
	 * @var WP_Abilities_Registry|null
	 */
	private static $instance = null;

	/**
	 * Utility method to retrieve the main instance of the class.
	 *
	 * @since 6.9.0
	 *
	 * @return WP_Abilities_Registry Main instance.
	 */
	public static function get_instance(): WP_Abilities_Registry {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Registers an ability.
	 *
	 * @since 6.9.0
	 *
	 * @param string               $name Ability name.
	 * @param array<string, mixed> $args Associate array of arguments for the ability.
	 * @return WP_Ability|null Registered ability instance, or null on failure.
	 */
	public function register( string $name, array $args ): ?WP_Ability {
		if ( empty( $name ) || $this->is_registered( $name ) ) {
			return null;
		}

		// Allow custom ability classes.
		$ability_class = $args['ability_class'] ?? WP_Ability::class;
		
		if ( ! is_subclass_of( $ability_class, WP_Ability::class ) && $ability_class !== WP_Ability::class ) {
			return null;
		}

		$ability = new $ability_class( $name, $args );
		$this->registered_abilities[ $name ] = $ability;

		return $ability;
	}

	/**
	 * Unregisters an ability.
	 *
	 * @since 6.9.0
	 *
	 * @param string $name Ability name.
	 * @return WP_Ability|null Unregistered ability instance, or null on failure.
	 */
	public function unregister( string $name ): ?WP_Ability {
		if ( ! $this->is_registered( $name ) ) {
			return null;
		}

		$ability = $this->registered_abilities[ $name ];
		unset( $this->registered_abilities[ $name ] );

		return $ability;
	}

	/**
	 * Checks if an ability is registered.
	 *
	 * @since 6.9.0
	 *
	 * @param string $name Ability name.
	 * @return bool True if registered, false otherwise.
	 */
	public function is_registered( string $name ): bool {
		return isset( $this->registered_abilities[ $name ] );
	}

	/**
	 * Retrieves a registered ability.
	 *
	 * @since 6.9.0
	 *
	 * @param string $name Ability name.
	 * @return WP_Ability|null Ability instance, or null if not found.
	 */
	public function get_registered( string $name ): ?WP_Ability {
		return $this->registered_abilities[ $name ] ?? null;
	}

	/**
	 * Retrieves all registered abilities.
	 *
	 * @since 6.9.0
	 *
	 * @return WP_Ability[] Array of ability instances.
	 */
	public function get_all_registered(): array {
		return array_values( $this->registered_abilities );
	}
}
