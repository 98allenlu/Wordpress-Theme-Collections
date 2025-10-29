<?php
/**
 * ACF Image template
 *
 * @package GoodwillNJ2020
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Create id attribute allowing for custom "anchor" value.
$id = 'gw-docs-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Load values and assing defaults.
$rows = get_field( 'gw_documents' );

// Create class attribute allowing for custom "className" and "align" values.
$className = 'gw-documents';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<div class="row">
		<div class="col-12">

			<div class="text-center">

				<h4 class="mb-4"><?php echo __( 'Documents', 'goodwillnj' ); ?></h4>

				<?php
				if( $rows ) {
				    foreach( $rows as $row ) {
				        $doc = $row['document'];
				        echo '<a class="btn btn-primary m-2" href="' . esc_html( $doc['url'] ) . '" target="_blank" rel="noopener noreferrer">' . esc_html( $doc['title'] ) . '</a>';
				    }
				    //print_r($doc);
				}
				?>

			</div>

		</div>
	</div>
</div>