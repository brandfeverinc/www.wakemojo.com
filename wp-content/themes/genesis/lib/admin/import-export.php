<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Admin
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/genesis/
 */

/**
 * Register a new admin page, providing content and corresponding menu item for the Import / Export page.
 *
 * Although this class was added in 1.8.0, some of the methods were originally standalone functions added in previous
 * versions of Genesis.
 *
 * @package Genesis\Admin
 *
 * @since 1.8.0
 */
class Genesis_Admin_Import_Export extends Genesis_Admin_Basic {

	/**
	 * Create an admin menu item and settings page.
	 *
	 * Also hook in the handling of file imports and exports.
	 *
	 * @since 1.8.0
	 *
	 * @uses \Genesis_Admin::create() Create an admin menu item and settings page.
	 *
	 * @see \Genesis_Admin_Import_Export::export() Handle settings file exports.
	 * @see \Genesis_Admin_Import_Export::import() Handle settings file imports.
	 */
	public function __construct() {

		$page_id = 'genesis-import-export';

		$menu_ops = array(
			'submenu' => array(
				'parent_slug' => 'genesis',
				'page_title'  => __( 'Genesis - Import/Export', 'genesis' ),
				'menu_title'  => __( 'Import/Export', 'genesis' )
			)
		);

		$this->create( $page_id, $menu_ops );

		add_action( 'admin_init', array( $this, 'export' ) );
		add_action( 'admin_init', array( $this, 'import' ) );

	}

	/**
	 * Contextual help content.
	 *
	 * @since 2.0.0
	 */
	public function help() {

		$screen = get_current_screen();

		$general_settings_help =
			'<h3>' . __( 'Import/Export', 'genesis' ) . '</h3>' .
			'<p>'  . __( 'This allows you to import or export Genesis Settings.', 'genesis' ) . '</p>' .
			'<p>'  . __( 'This is specific to Genesis settings and does not includes posts, pages, or images, which is what the built-in WordPress import/export menu does.', 'genesis' ) . '</p>' .
			'<p>'  . __( 'It also does not include other settings for plugins, widgets, or post/page/term/user specific settings.', 'genesis' ) . '</p>';

		$import_settings_help =
			'<h3>' . __( 'Import', 'genesis' ) . '</h3>' .
			'<p>'  . sprintf( __( 'You can import a file you\'ve previously exported. The file name will start with %s followed by one or more strings indicating which settings it contains, finally followed by the date and time it was exported.', 'genesis' ), genesis_code( 'genesis-' ) ) . '</p>' .
			'<p>' . __( 'Once you upload an import file, it will automatically overwrite your existing settings.', 'genesis' ) . ' <strong>' . __( 'This cannot be undone', 'genesis' ) . '</strong>.</p>';

		$export_settings_help =
			'<h3>' . __( 'Export', 'genesis' ) . '</h3>' .
			'<p>'  . sprintf( __( 'You can export your Genesis-related settings to back them up, or copy them to another site. Child themes and plugins may add their own checkboxes to the list. The settings are exported in %s format.', 'genesis' ), '<abbr title="' . __( 'JavaScript Object Notation', 'genesis' ) . '">' . __( 'JSON', 'genesis' ) . '</abbr>' ) . '</p>';

		$screen->add_help_tab( array(
			'id'      => $this->pagehook . '-general-settings',
			'title'   => __( 'Import/Export', 'genesis' ),
			'content' => $general_settings_help,
		) );
		$screen->add_help_tab( array(
			'id'      => $this->pagehook . '-import',
			'title'   => __( 'Import', 'genesis' ),
			'content' => $import_settings_help,
		) );
		$screen->add_help_tab( array(
			'id'      => $this->pagehook . '-export',
			'title'   => __( 'Export', 'genesis' ),
			'content' => $export_settings_help,
		) );

		//* Add help sidebar
		$screen->set_help_sidebar(
			'<p><strong>' . __( 'For more information:', 'genesis' ) . '</strong></p>' .
			'<p><a href="http://my.studiopress.com/help/" target="_blank" title="' . __( 'Get Support', 'genesis' ) . '">' . __( 'Get Support', 'genesis' ) . '</a></p>' .
			'<p><a href="http://my.studiopress.com/snippets/" target="_blank" title="' . __( 'Genesis Snippets', 'genesis' ) . '">' . __( 'Genesis Snippets', 'genesis' ) . '</a></p>' .
			'<p><a href="http://my.studiopress.com/tutorials/" target="_blank" title="' . __( 'Genesis Tutorials', 'genesis' ) . '">' . __( 'Genesis Tutorials', 'genesis' ) . '</a></p>'
		);

	}

	/**
	 * Callback for displaying the Genesis Import / Export admin page.
	 *
	 * Call the genesis_import_export_form action after the last default table row.
	 *
	 * @since 1.4.0
	 *
	 * @uses \Genesis_Admin_Import_Export::export_checkboxes()  Echo export checkboxes.
	 * @uses \Genesis_Admin_Import_Export::get_export_options() Get array of export options.
	 */
	public function admin() {

		?>
		<div class="wrap">
			<?php screen_icon( 'tools' ); ?>
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

			<table class="form-table">
				<tbody>

					<tr>
						<th scope="row"><b><?php _e( 'Import Genesis Settings File', 'genesis' ); ?></p></th>
						<td>
							<p><?php printf( __( 'Upload the data file (%s) from your computer and we\'ll import your settings.', 'genesis' ), genesis_code( '.json' ) ); ?></p>
							<p><?php _e( 'Choose the file from your computer and click "Upload file and Import"', 'genesis' ); ?></p>
							<p>
								<form enctype="multipart/form-data" method="post" action="<?php echo menu_page_url( 'genesis-import-export', 0 ); ?>">
									<?php wp_nonce_field( 'genesis-import' ); ?>
									<input type="hidden" name="genesis-import" value="1" />
									<label for="genesis-import-upload"><?php sprintf( __( 'Upload File: (Maximum Size: %s)', 'genesis' ), ini_get( 'post_max_size' ) ); ?></label>
									<input type="file" id="genesis-import-upload" name="genesis-import-upload" size="25" />
									<?php
									submit_button( __( 'Upload File and Import', 'genesis' ), 'primary', 'upload' );
									?>
								</form>
							</p>
						</td>
					</tr>

					<tr>
						<th scope="row"><b><?php _e( 'Export Genesis Settings File', 'genesis' ); ?></b></th>
						<td>
							<p><?php printf( __( 'When you click the button below, Genesis will generate a data file (%s) for you to save to your computer.', 'genesis' ), genesis_code( '.json' ) ); ?></p>
							<p><?php _e( 'Once you have saved the download file, you can use the import function on another site to import this data.', 'genesis' ); ?></p>
							<p>
								<form method="post" action="<?php echo menu_page_url( 'genesis-import-export', 0 ); ?>">
									<?php
									wp_nonce_field( 'genesis-export' );
									$this->export_checkboxes();
									if ( $this->get_export_options() )
										submit_button( __( 'Download Export File', 'genesis' ), 'primary', 'download' );
									?>
								</form>
							</p>
						</td>
					</tr>

					<?php do_action( 'genesis_import_export_form' ); ?>

				</tbody>
			</table>

		</div>
		<?php

	}

	/**
	 * Add custom notices that display after successfully importing or exporting the settings.
	 *
	 * @since 1.4.0
	 *
	 * @uses genesis_is_menu_page() Check if we're on a Genesis page.
	 *
	 * @return null Return early if not on the correct admin page.
	 */
	public function notices() {

		if ( ! genesis_is_menu_page( 'genesis-import-export' ) )
			return;

		if ( isset( $_REQUEST['imported'] ) && 'true' === $_REQUEST['imported'] )
			echo '<div id="message" class="updated"><p><strong>' . __( 'Settings successfully imported.', 'genesis' ) . '</strong></p></div>';
		elseif ( isset( $_REQUEST['error'] ) && 'true' === $_REQUEST['error'] )
			echo '<div id="message" class="error"><p><strong>' . __( 'There was a problem importing your settings. Please try again.', 'genesis' ) . '</strong></p></div>';

	}

	/**
	 * Return array of export options and their arguments.
	 *
	 * Plugins and themes can hook into the genesis_export_options filter to add
	 * their own settings to the exporter.
	 *
	 * @since 1.6.0
	 *
	 * @return array Export options
	 */
	protected function get_export_options() {

		$options = array(
			'theme' => array(
				'label'          => __( 'Theme Settings', 'genesis' ),
				'settings-field' => GENESIS_SETTINGS_FIELD,
			),
			'seo' => array(
				'label' => __( 'SEO Settings', 'genesis' ),
				'settings-field' => GENESIS_SEO_SETTINGS_FIELD,
			)
		);

		return (array) apply_filters( 'genesis_export_options', $options );

	}

	/**
	 * Echo out the checkboxes for the export options.
	 *
	 * @since 1.6.0
	 *
	 * @uses \Genesis_Admin_Import_Export::get_export_options() Get array of export options.
	 *
	 * @return null Return null if there are no options to export.
	 */
	protected function export_checkboxes() {

		if ( ! $options = $this->get_export_options() ) {
			//* Not even the Genesis theme / seo export options were returned from the filter
			printf( '<p><em>%s</em></p>', __( 'No export options available.', 'genesis' ) );
			return;
		}

		foreach ( $options as $name => $args ) {
			//* Ensure option item has an array key, and that label and settings-field appear populated
			if ( is_int( $name ) || ! isset( $args['label'] ) || ! isset( $args['settings-field'] ) || '' === $args['label'] || '' === $args['settings-field'] )
				return;

			printf( '<p><label for="genesis-export-%1$s"><input id="genesis-export-%1$s" name="genesis-export[%1$s]" type="checkbox" value="1" /> %2$s</label></p>', esc_attr( $name ), esc_html( $args['label'] ) );

		}

	}

	/**
	 * Generate the export file, if requested, in JSON format.
	 *
	 * After checking we're on the right page, and trying to export, loop through the list of requested options to
	 * export, grabbing the settings from the database, and building up a file name that represents that collection of
	 * settings.
	 *
	 * A .json file is then sent to the browser, named with "genesis" at the start and ending with the current
	 * date-time.
	 *
	 * The genesis_export action is fired after checking we can proceed, but before the array of export options are
	 * retrieved.
	 *
	 * @since 1.4.0
	 *
	 * @uses genesis_is_menu_page()                             Check if we're on a Genesis page.
	 * @uses \Genesis_Admin_Import_Export::get_export_options() Get array of export options.
	 *
	 * @return null Return null if not correct page, or we're not exporting.
	 */
	public function export() {

		if ( ! genesis_is_menu_page( 'genesis-import-export' ) )
			return;

		if ( empty( $_REQUEST['genesis-export'] ) )
			return;

		check_admin_referer( 'genesis-export' );

		do_action( 'genesis_export', $_REQUEST['genesis-export'] );

		$options = $this->get_export_options();

		$settings = array();

		//* Exported file name always starts with "genesis"
		$prefix = array( 'genesis' );

		//* Loop through set(s) of options
		foreach ( (array) $_REQUEST['genesis-export'] as $export => $value ) {
			//* Grab settings field name (key)
			$settings_field = $options[$export]['settings-field'];

			//* Grab all of the settings from the database under that key
			$settings[$settings_field] = get_option( $settings_field );

			//* Add name of option set to build up export file name
			$prefix[] = $export;
		}

		if ( ! $settings )
			return;

		//* Complete the export file name by joining parts together
		$prefix = join( '-', $prefix );

	    $output = json_encode( (array) $settings );

		//* Prepare and send the export file to the browser
	    header( 'Content-Description: File Transfer' );
	    header( 'Cache-Control: public, must-revalidate' );
	    header( 'Pragma: hack' );
	    header( 'Content-Type: text/plain' );
	    header( 'Content-Disposition: attachment; filename="' . $prefix . '-' . date( 'Ymd-His' ) . '.json"' );
	    header( 'Content-Length: ' . mb_strlen( $output ) );
	    echo $output;
	    exit;

	}

	/**
	 * Handle the file uploaded to import settings.
	 *
	 * Upon upload, the file contents are JSON-decoded. If there were errors, or no options to import, then reload the
	 * page to show an error message.
	 *
	 * Otherwise, loop through the array of option sets, and update the data under those keys in the database.
	 * Afterwards, reload the page with a success message.
	 *
	 * Calls genesis_import action is fired after checking we can proceed, but before attempting to extract the contents
	 * from the uploaded file.
	 *
	 * @since 1.4.0
	 *
	 * @uses genesis_is_menu_page()   Check if we're on a Genesis page
	 * @uses genesis_admin_redirect() Redirect user to an admin page
	 *
	 * @return null Return null if not correct admin page, we're not importing
	 */
	public function import() {

		if ( ! genesis_is_menu_page( 'genesis-import-export' ) )
			return;

		if ( empty( $_REQUEST['genesis-import'] ) )
			return;

		check_admin_referer( 'genesis-import' );

		do_action( 'genesis_import', $_REQUEST['genesis-import'], $_FILES['genesis-import-upload'] );

		$upload = file_get_contents( $_FILES['genesis-import-upload']['tmp_name'] );

		$options = json_decode( $upload, true );

		//* Check for errors
		if ( ! $options || $_FILES['genesis-import-upload']['error'] ) {
			genesis_admin_redirect( 'genesis-import-export', array( 'error' => 'true' ) );
			exit;
		}

		//* Identify the settings keys that we should import
		$exportables = $this->get_export_options();
		$importable_keys = array();
		foreach ( $exportables as $exportable ) {
			$importable_keys[] = $exportable['settings-field'];
		}

		//* Cycle through data, import Genesis settings
		foreach ( (array) $options as $key => $settings ) {
			if ( in_array( $key, $importable_keys ) )
				update_option( $key, $settings );
		}

		//* Redirect, add success flag to the URI
		genesis_admin_redirect( 'genesis-import-export', array( 'imported' => 'true' ) );
		exit;

	}

}
