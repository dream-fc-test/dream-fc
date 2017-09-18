<?php
require_once( dirname( __FILE__ ).'/inc/admin-base.php' );
require_once( dirname( __FILE__ ).'/inc/admin-root.php' );
require_once( dirname( __FILE__ ).'/inc/admin-fonttheme.php' );

class TypeSquare_Admin extends TypeSquare_Admin_Base {
	private static $instance;
	private static $text_domain;

	private function __construct(){}

	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			$c = __CLASS__;
			self::$instance = new $c();
		}
		return self::$instance;
	}

	public function add_hook() {
		self::$text_domain = TypeSquare_ST::text_domain();
		$root = TypeSquare_Admin_Root::get_instance();
		add_action( 'admin_menu',		array( $this, 'typesquare_setting_menu' ) );
		add_action( 'admin_menu',		array( $root, 'typesquare_post_metabox' ) );
		add_action( 'admin_init',		array( $this, 'typesquare_admin_init' ) );
		add_action( 'admin_notices', array( $root, 'typesquare_admin_notices' ) );
		add_action( 'save_post',		 array( $root, 'typesquare_save_post' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_theme_style' ) );
	}

	public function admin_theme_style() {
		wp_enqueue_style( 'ts-styles',  path_join( TS_PLUGIN_URL, 'inc/assets/admin.css' ) );
	}

	public function admin_theme_script( $position = false ) {
		wp_enqueue_script( 'ts-admin-react', path_join( TS_PLUGIN_URL, 'inc/app.js' ) , array( 'jquery' ), '1.0.0', $position );
	}

	public function typesquare_setting_menu() {
		$root = TypeSquare_Admin_Root::get_instance();
		$theme = TypeSquare_Admin_Fonttheme::get_instance();
		$hooks = array(
			add_menu_page(
				__( 'TypeSquare Webfonts', self::$text_domain ),
				__( 'TypeSquare Webfonts', self::$text_domain ),
				'administrator',
				self::MENU_ID,
				array( $root, 'typesquare_admin_menu' )
			),
		);

		$autho_param = $this->get_auth_params();
		if ( false !== $autho_param['typesquare_auth']['auth_status'] ) {
			$hooks[] = add_submenu_page(
					self::MENU_ID,
					__( 'カスタムフォントテーマ設定', self::$text_domain ),
					__( 'カスタムフォントテーマ', self::$text_domain ),
					'administrator',
					self::MENU_FONTTHEME,
					array( $theme, 'fonttheme_setting' )
				);
			$options = get_option( 'typesquare_custom_theme' );
			if (count($options['theme']) < self::FONT_THEME_MAX) {
				$hooks[] = add_submenu_page(
					self::MENU_ID,
					__( 'カスタムフォントテーマ設定', self::$text_domain ),
					__( 'カスタムフォントテーマ', self::$text_domain ),
					'administrator',
					self::MENU_FONTGEN,
					array( $theme, 'fonttheme_generator' )
				);
			}
		}
		foreach ( $hooks as $hook ) {
			add_action( $hook, array( $this, 'admin_theme_script' ) );
		}
	}

	public function typesquare_admin_init() {
		if ( isset( $_POST[ self::MENU_ID ] ) && $_POST[ self::MENU_ID ] ) {
			$nonce_key = TypeSquare_ST::OPTION_NAME;
			if ( isset( $_POST['typesquare_auth'] ) && $_POST['typesquare_auth'] ) {
				if ( check_admin_referer( $nonce_key , self::MENU_ID ) ) {
					$auth = TypeSquare_ST_Auth::get_instance();
					$auth_result = $auth->auth( $_POST['typesquare_auth'] );
					if ( is_wp_error( $auth_result ) ) {
						$this->set_error_messages( $auth_result );
					} else {
						$escaped_data = $auth->result_escape( $auth_result );
						update_option( 'typesquare_auth', $escaped_data );
					}
				}
			} elseif ( isset( $_POST['typesquare_fonttheme'] ) && $_POST['typesquare_fonttheme'] ) {
				if ( check_admin_referer( $nonce_key , self::MENU_ID ) ) {
					$fonts = TypeSquare_ST_Fonts::get_instance();
					$fonts->update_font_theme_setting();
				}
			}
			wp_safe_redirect( menu_page_url( self::MENU_ID , false ) );
		} elseif ( isset( $_POST['ts_update_font_settings'] ) && $_POST['ts_update_font_settings'] ) {
			if ( check_admin_referer( 'ts_update_font_settings', 'ts_update_font_settings' ) ) {
				$fonts = TypeSquare_ST_Fonts::get_instance();
				$fonts->update_font_theme_setting();
			}
		} elseif ( isset( $_POST['ts_update_font_name_setting'] ) && $_POST['ts_update_font_name_setting'] ) {
			if ( check_admin_referer( 'ts_update_font_name_setting', 'ts_update_font_name_setting' ) ) {
				$fonts = TypeSquare_ST_Fonts::get_instance();
				if ( 'delete' == $_POST['ts_edit_mode'] ) {
					$fonts->delete_custom_theme();
				} else {
					$fonts->update_font_setting();
				}
			}
		}
	}
}
