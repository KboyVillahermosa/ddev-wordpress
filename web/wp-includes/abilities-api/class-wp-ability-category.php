<?php
/**
 * Abilities API: WP_Ability_Category class
 *
 * @package WordPress
 * @subpackage Abilities_API
 * @since 6.9.0
 */

declare( strict_types = 1 );

/**
 * Core class used for interacting with ability categories.
 *
 * @since 6.9.0
 */
class WP_Ability_Category {

	/**
	 * Unique identifier for the category.
	 *
	 * @since 6.9.0
	 * @var string
	 */
	protected $slug;

	/**
	 * Human-readable label for the category.
	 *
	 * @since 6.9.0
	 * @var string
	 */
	protected $label;

	/**
	 * Description of what abilities in this category do.
	 *
	 * @since 6.9.0
	 * @var string
	 */
	protected $description;

	/**
	 * Additional metadata for the category.
	 *
	 * @since 6.9.0
	 * @var array<string, mixed>
	 */
	protected $meta = array();

	/**
	 * Constructor.
	 *
	 * @since 6.9.0
	 *
	 * @param string               $slug Unique identifier for the category.
	 * @param array<string, mixed> $args Associate array of arguments for the category.
	 */
	public function __construct( string $slug, array $args ) {
		$this->slug        = $slug;
		$this->label       = $args['label'] ?? '';
		$this->description = $args['description'] ?? '';
		$this->meta        = $args['meta'] ?? array();
	}

	/**
	 * Retrieves the category slug.
	 *
	 * @since 6.9.0
	 *
	 * @return string Category slug.
	 */
	public function get_slug(): string {
		return $this->slug;
	}

	/**
	 * Retrieves the category label.
	 *
	 * @since 6.9.0
	 *
	 * @return string Category label.
	 */
	public function get_label(): string {
		return $this->label;
	}

	/**
	 * Retrieves the category description.
	 *
	 * @since 6.9.0
	 *
	 * @return string Category description.
	 */
	public function get_description(): string {
		return $this->description;
	}

	/**
	 * Retrieves the category metadata.
	 *
	 * @since 6.9.0
	 *
	 * @return array<string, mixed> Category metadata.
	 */
	public function get_meta(): array {
		return $this->meta;
	}
}
