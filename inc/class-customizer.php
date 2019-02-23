<?php
/**
 * Decorador de WP_Customize_Manager.
 * Otorga métodos de mayor nivel con soporte incluído para localización.
 *
 * @package Chopan_2019;
 */

namespace Chopan_2019;

/**
 * Facilita el uso de WP_Customize_Manager en sitios con localización.
 */
class Customizer {
	/**
	 * Instancia del objeto
	 *
	 * @var static
	 */
	protected static $instance;

	/**
	 * Instancia del customizador de WP
	 *
	 * @var WP_Customize_Manager
	 */
	protected static $customizer;

	/**
	 * Listado de lenguajes habilitados en el sitio (locales)
	 *
	 * @var array
	 */
	protected $languages;

	/**
	 * Locale actual del sitio
	 *
	 * @var string
	 */
	protected $current_lang;

	/**
	 * Indica si el sitio actual es multilenguaje
	 *
	 * @var boolean
	 */
	protected $is_multilang = false;

	/**
	 * Inicializar la clase
	 */
	protected function __construct() {
		if ( function_exists( 'pll_the_languages' ) ) {
			$this->languages    = pll_languages_list( array( 'fields' => 'locale' ) );
			$this->current_lang = pll_current_language( 'locale' );
			$default_lang       = pll_default_language( 'locale' );
		} else {
			$this->languages    = array( get_locale() );
			$this->current_lang = get_locale();
			$default_lang       = get_locale();
		}
		if ( count( $this->languages ) > 1 && $this->current_lang !== $default_lang ) {
			$this->is_multilang = true;
		}
		$this->load_language_names();
	}

	/**
	 * Obtener instancia del objeto
	 *
	 * @return static Instancia del objeto
	 */
	public static function get_instance() {
		if ( ! static::$instance ) {
			$class            = get_called_class();
			static::$instance = new $class();
		}
		return static::$instance;
	}

	/**
	 * Inicializar el plugin
	 *
	 * @param \WP_Customize_Manager $customizer Instancia del customizer de WordPress.
	 * @return void
	 */
	public function init( \WP_Customize_Manager $customizer ) {
		static::$customizer = $customizer;
		do_action_ref_array( 'chopan_customize_init', array( $this ) );
	}

	/**
	 * Obtener la instancia de WP_Customize_Manager
	 *
	 * @return WP_Customize_Manager
	 */
	public function get_customizer() {
		return static::$customizer;
	}

	/**
	 * Obtener el nombre de una opción
	 *
	 * @param string $name Nombre de la opción.
	 * @param string $lang Idioma en que se desea obtener. Por defecto es el actual.
	 * @return string      Nombre de la opción, localizada si corresponde.
	 */
	public function get_id( $name, $lang = '' ) {
		if ( empty( $lang ) ) {
			$lang = $this->current_lang;
		}
		return "{$name}[{$lang}]";
	}

	/**
	 * Obtener el lenguaje actual del sitio
	 *
	 * @return string "Locale" del sitio
	 */
	public function get_current_lang() {
		return $this->current_lang;
	}

	/**
	 * Obtener los idiomas activados en el sitio
	 *
	 * @return array Lista de locales activados en el sitio
	 */
	public function get_languages() {
		return $this->languages;
	}

	/**
	 * Obtener el etiquetado para una sección o control
	 *
	 * @param string $label Etiquetado del campo.
	 * @param string $lang  Idioma que añadir. Si es vacío, se usa el default.
	 * @return string       Etiquetado del campo. Si no es multilenguaje, retorna tal cual. Si es, se añade [{$NOMBRE_DEL_IDIOMA}].
	 */
	public function get_label( $label, $lang = '' ) {
		if ( $this->is_multilang ) {
			/* translators: %1: etiqueta del campo; %2: nombre del idioma */
			return sprintf( _x( '%1$s [%2$s]', 'formato etiquetado de campos del customizer', 'chopan_2019' ), $label, $this->get_language_name( $lang ) );
		} else {
			return $label;
		}
	}

	/**
	 * Cargar los nombres de idiomas.
	 *
	 * @return void
	 */
	private function load_language_names() {
		if ( function_exists( 'PLL' ) ) {
			$languages            = PLL()->model->get_languages_list();
			$this->language_names = wp_list_pluck( $languages, 'name', 'locale' );
		} else {
			if ( ! function_exists( 'wp_get_available_translations' ) ) {
				require_once ABSPATH . 'wp-admin/includes/translation-install.php';
			}
			$languages            = wp_get_available_translations();
			$this->language_names = array(
				$this->default_lang => $languages[ $this->default_lang ]['native_name'],
			);
		}
	}

	/**
	 * Obtener el nombre "humano" de un lenguaje
	 *
	 * @param string $lang Locale del lenguaje.
	 * @return string      Nombre del lenguaje en idioma local "Español", "English"
	 */
	private function get_language_name( $lang = '' ) {
		if ( ! $lang ) {
			$lang = $this->current_lang;
		}
		return isset( $this->language_names[ $lang ] ) ? $this->language_names[ $lang ] : '';
	}

	/**
	 * Añadir una nueva sección al customizer
	 *
	 * @param string $id  ID de la sección.
	 * @param array  $args Parámetros de la sección.
	 * @return void
	 */
	protected function add_section( $id, $args = array() ) {
		$this->proxy_customizer( 'add_section', $id, $args );
	}

	/**
	 * Añadir un setting
	 *
	 * @param string $id  ID del setting.
	 * @param array  $args Parámetros del setting.
	 * @return void
	 */
	protected function add_setting( $id, $args = array() ) {
		$this->proxy_customizer( 'add_setting', $id, $args );
	}

	/**
	 * Añadir un control
	 *
	 * @param string $id  ID del control.
	 * @param array  $args Parámetros del control.
	 * @return void
	 */
	protected function add_control( $id, $args = array() ) {
		$this->proxy_customizer( 'add_control', $id, $args );
	}

	/**
	 * Añadir un partial para refresco selectivo
	 *
	 * @param string $id  ID del partial.
	 * @param array  $args Parámetros para el partial.
	 * @return void
	 */
	protected function add_partial( $id, $args = array() ) {
		$lang_id = $this->get_id( $id );
		$this->get_customizer()->selective_refresh->add_partial( $lang_id, $args );
	}

	/**
	 * Obtener un dato de customización del tema
	 *
	 * @param string $key     ID del setting.
	 * @param string $default Valor predeterminado (se usa en caso de que no exista el valor custom).
	 * @param string $lang    Idioma en el que obtener el dato.
	 * @return mixed          Dato de personalización del tema
	 */
	public function get_theme_custom( $key, $default = '', $lang = '' ) {
		$data           = get_theme_mod( $key );
		if ( ! $lang ) {
			$lang = $this->get_current_lang();
		}
		if ( isset( $data[ $lang ] ) ) {
			$localized_data = $data[ $lang ];
		} else {
			$localized_data = null;
		}
		if ( empty( $localized_data ) && ! empty( $default ) ) {
			$localized_data = $default;
		}
		/**
		 * Filtrar la información de personalización del tema
		 *
		 * Permite que un plugin o tema pueda modificar los valores. También serviría
		 * en caso de que alguien cambie el idioma default del sitio.
		 */
		$localized_data = apply_filters( 'chopan_theme_data', $localized_data, $key, $default, $lang, $data );
		return $localized_data;
	}

	/**
	 * Invocar métodos en WP_Customize_Manager según idiomas activos
	 *
	 * @param string $method Nombre del método que se debe invocar.
	 * @param string $id     Parámetro "$id" para la función.
	 * @param mixed  $args    Parámetros "$args" con que se invoca la función.
	 * @return mixed         Respuesta desde el método invocado
	 */
	private function proxy_customizer( $method, $id, $args = array() ) {
		$section       = '';
		$original_args = $args;

		// loopear sobre idiomas disponibles.
		foreach ( $this->languages as $lang ) {
			$lang_id = $this->get_id( $id, $lang );
			if ( isset( $original_args['section'] ) ) {
				$args['section'] = $this->get_id( $original_args['section'], $lang );
			}
			if ( isset( $original_args['title'] ) ) {
				$args['title'] = $this->get_label( $original_args['title'], $lang );
			}
			if ( isset( $original_args['label'] ) ) {
				$args['label'] = $this->get_label( $original_args['label'], $lang );
			}
			$result = $this->get_customizer()->{$method}( $lang_id, $args );
		}
	}
}
