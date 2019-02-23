<?php

namespace Chopan_2019;

class Theme_Customizer extends Customizer {
	public function init( \WP_Customize_Manager $customizer ) {
		parent::init( $customizer );
		$this->customize_front_page();
	}
	public function customize_front_page() {
		// discovering
		// defining
		// developing
		// $this->add_section(

		// )
		$customizer_instance = static::$instance;
		$this->add_section(
			'what_i_do', array(
				'title' => __( 'Sección "This is what I do"', 'facultades_2018' )
			)
		);
		foreach ( [
			'Discovering',
			'Defining',
			'Developing'
		] as $do ) {
			$key = sanitize_title_with_dashes( $do );
			$this->add_setting(
				"what_i_do__{$key}_title", array(
					'sanitize_callback' => 'sanitize_text_field'
				)
			);
			$this->add_control(
				"what_i_do__{$key}_title", array(
					'type'    => 'text',
					'label'   => "Título columna \"{$do}\"",
					'section' => 'what_i_do',
				)
			);
			$id = $this->get_id("what_i_do__{$key}_title");
			$this->add_partial(
				"what_i_do__{$key}_title", array(
					'selector' => ".wp-customize-{$key}__title",
					'settings' => [ $id ],
					'container_inclusive' => false,
					'render_callback' => function() use ( $key, $customizer_instance ) {
						echo sanitize_text_field( $customizer_instance->get_theme_custom( "what_i_do__{$key}__title" ) );
					}
				)
			);
			$this->add_setting(
				"what_i_do__{$key}_description", array(
					'sanitize_callback' => 'sanitize_textarea_field'
				)
			);
			$this->add_control(
				"what_i_do__{$key}_description", array(
					'type'    => 'textarea',
					'label'   => "Descripción columna \"{$do}\"",
					'section' => 'what_i_do',
				)
			);
		}
	}
}