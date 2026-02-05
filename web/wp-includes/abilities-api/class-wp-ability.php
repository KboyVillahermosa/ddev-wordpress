<?php
/**
 * Abilities API: WP_Ability class
 *
 * @package WordPress
 * @subpackage Abilities_API
 * @since 6.9.0
 */

declare( strict_types = 1 );

/**
 * Core class used for interacting with individual abilities.
 *
 * @since 6.9.0
 */
class WP_Ability {

	/**
	 * Unique identifier for the ability.
	 *
	 * @since 6.9.0
	 * @var string
	 */
	protected $name;

	/**
	 * Human-readable label for the ability.
	 *
	 * @since 6.9.0
	 * @var string
	 */
	protected $label;

	/**
	 * Description of what the ability does.
	 *
	 * @since 6.9.0
	 * @var string
	 */
	protected $description;

	/**
	 * The category slug this ability belongs to.
	 *
	 * @since 6.9.0
	 * @var string
	 */
	protected $category;

	/**
	 * Callback used to execute the ability.
	 *
	 * @since 6.9.0
	 * @var callable
	 */
	protected $execute_callback;

	/**
	 * Callback used to check permissions for the ability.
	 *
	 * @since 6.9.0
	 * @var callable
	 */
	protected $permission_callback;

	/**
	 * JSON Schema for validating and documenting ability input.
	 *
	 * @since 6.9.0
	 * @var array<string, mixed>
	 */
	protected $input_schema = array();

	/**
	 * JSON Schema for documenting ability output.
	 *
	 * @since 6.9.0
	 * @var array<string, mixed>
	 */
	protected $output_schema = array();

	/**
	 * Additional metadata for the ability.
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
	 * @param string               $name Unique identifier for the ability.
	 * @param array<string, mixed> $args Associate array of arguments for the ability.
	 */
	public function __construct( string $name, array $args ) {
		$this->name                = $name;
		$this->label               = $args['label'] ?? '';
		$this->description         = $args['description'] ?? '';
		$this->category            = $args['category'] ?? '';
		$this->execute_callback    = $args['execute_callback'] ?? null;
		$this->permission_callback = $args['permission_callback'] ?? null;
		$this->input_schema        = $args['input_schema'] ?? array();
		$this->output_schema       = $args['output_schema'] ?? array();
		$this->meta                = $args['meta'] ?? array();
	}

	/**
	 * Executes the ability.
	 *
	 * @since 6.9.0
	 *
	 * @param mixed $input Input data for the ability.
	 * @return mixed|WP_Error Result of the execution or WP_Error on failure.
	 */
	public function execute( $input = null ) {
		if ( ! is_callable( $this->execute_callback ) ) {
			return new WP_Error(
				'ability_execute_callback_invalid',
				__( 'The execution callback for this ability is not callable.' )
			);
		}

		return call_user_func( $this->execute_callback, $input );
	}

	/**
	 * Checks permissions for the ability.
	 *
	 * @since 6.9.0
	 *
	 * @param mixed $input Input data for the ability.
	 * @return bool|WP_Error True if permitted, false or WP_Error otherwise.
	 */
	public function check_permissions( $input = null ) {
		if ( ! is_callable( $this->permission_callback ) ) {
			return new WP_Error(
				'ability_permission_callback_invalid',
				__( 'The permission callback for this ability is not callable.' )
			);
		}

		return call_user_func( $this->permission_callback, $input );
	}

	/**
	 * Validates input data against the ability's schema.
	 *
	 * @since 6.9.0
	 *
	 * @param mixed $input Input data to validate.
	 * @return true|WP_Error True on success, WP_Error on failure.
	 */
	public function validate_input( $input ) {
		if ( empty( $this->input_schema ) ) {
			return true;
		}

		// Use the WordPress REST API schema validator.
		$is_valid = rest_validate_value_from_schema( $input, $this->input_schema, 'input' );

		if ( is_wp_error( $is_valid ) ) {
			return $is_valid;
		}

		if ( ! $is_valid ) {
			return new WP_Error(
				'ability_invalid_input',
				__( 'The provided input does not match the required schema.' )
			);
		}

		return true;
	}

	/**
	 * Normalizes input data against the ability's schema.
	 *
	 * @since 6.9.0
	 *
	 * @param mixed $input Input data to normalize.
	 * @return mixed Normalized input data.
	 */
	public function normalize_input( $input ) {
		if ( empty( $this->input_schema ) ) {
			return $input;
		}

		// Use the WordPress REST API schema sanitizer.
		return rest_sanitize_value_from_schema( $input, $this->input_schema, 'input' );
	}

	/**
	 * Retrieves the ability name.
	 *
	 * @since 6.9.0
	 *
	 * @return string Ability name.
	 */
	public function get_name(): string {
		return $this->name;
	}

	/**
	 * Retrieves the ability label.
	 *
	 * @since 6.9.0
	 *
	 * @return string Ability label.
	 */
	public function get_label(): string {
		return $this->label;
	}

	/**
	 * Retrieves the ability description.
	 *
	 * @since 6.9.0
	 *
	 * @return string Ability description.
	 */
	public function get_description(): string {
		return $this->description;
	}

	/**
	 * Retrieves the ability category.
	 *
	 * @since 6.9.0
	 *
	 * @return string Ability category slug.
	 */
	public function get_category(): string {
		return $this->category;
	}

	/**
	 * Retrieves the ability input schema.
	 *
	 * @since 6.9.0
	 *
	 * @return array<string, mixed> Input schema.
	 */
	public function get_input_schema(): array {
		return $this->input_schema;
	}

	/**
	 * Retrieves the ability output schema.
	 *
	 * @since 6.9.0
	 *
	 * @return array<string, mixed> Output schema.
	 */
	public function get_output_schema(): array {
		return $this->output_schema;
	}

	/**
	 * Retrieves the ability metadata.
	 *
	 * @since 6.9.0
	 *
	 * @return array<string, mixed> Ability metadata.
	 */
	public function get_meta(): array {
		return $this->meta;
	}

	/**
	 * Retrieves a specific metadata item.
	 *
	 * @since 6.9.0
	 *
	 * @param string $key Meta key.
	 * @return mixed|null Meta value, or null if not set.
	 */
	public function get_meta_item( string $key ) {
		return $this->meta[ $key ] ?? null;
	}
}
