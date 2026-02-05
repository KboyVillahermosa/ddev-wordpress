<?php
/**
 * Abilities API: WP_Ability_Categories_Registry class
 *
 * @package WordPress
 * @subpackage Abilities_API
 * @since 6.9.0
 */

declare( strict_types = 1 );

/**
 * Core class used for managing registered ability categories.
 *
 * @since 6.9.0
 */
class WP_Ability_Categories_Registry {

	/**
	 * Registered ability categories.
	 *
	 * @since 6.9.0
	 * @var array<string, WP_Ability_Category>
	 */
	protected $registered_categories = array();

	/**
	 * Container for the main instance of the class.
	 *
	 * @since 6.9.0
	 * @var WP_Ability_Categories_Registry|null
	 */
	private static $instance = null;

	/**
	 * Utility method to retrieve the main instance of the class.
	 *
	 * @since 6.9.0
	 *
	 * @return WP_Ability_Categories_Registry Main instance.
	 */
	public static function get_instance(): WP_Ability_Categories_Registry {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Registers an ability category.
	 *
	 * @since 6.9.0
	 *
	 * @param string               $slug Category slug.
	 * @param array<string, mixed> $args Associate array of arguments for the category.
	 * @return WP_Ability_Category|null Registered category instance, or null on failure.
	 */
	public function register( string $slug, array $args ): ?WP_Ability_Category {
		if ( empty( $slug ) || $this->is_registered( $slug ) ) {
			return null;
		}

		$category = new WP_Ability_Category( $slug, $args );
		$this->registered_categories[ $slug ] = $category;

		return $category;
	}

	/**
	 * Unregisters an ability category.
	 *
	 * @since 6.9.0
	 *
	 * @param string $slug Category slug.
	 * @return WP_Ability_Category|null Unregistered category instance, or null on failure.
	 */
	public function unregister( string $slug ): ?WP_Ability_Category {
		if ( ! $this->is_registered( $slug ) ) {
			return null;
		}

		$category = $this->registered_categories[ $slug ];
		unset( $this->registered_categories[ $slug ] );

		return $category;
	}

	/**
	 * Checks if an ability category is registered.
	 *
	 * @since 6.9.0
	 *
	 * @param string $slug Category slug.
	 * @return bool True if registered, false otherwise.
	 */
	public function is_registered( string $slug ): bool {
		return isset( $this->registered_categories[ $slug ] );
	}

	/**
	 * Retrieves a registered ability category.
	 *
	 * @since 6.9.0
	 *
	 * @param string $slug Category slug.
	 * @return WP_Ability_Category|null Category instance, or null if not found.
	 */
	public function get_registered( string $slug ): ?WP_Ability_Category {
		return $this->registered_categories[ $slug ] ?? null;
	}

	/**
	 * Retrieves all registered ability categories.
	 *
	 * @since 6.9.0
	 *
	 * @return WP_Ability_Category[] Array of category instances.
	 */
	public function get_all_registered(): array {
		return array_values( $this->registered_categories );
	}
}
