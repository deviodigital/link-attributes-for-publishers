<?php

/**
 * The public-facing filters of the plugin.
 *
 * @package    Link_Attributes_For_Publishers
 * @subpackage Link_Attributes_For_Publishers/public
 * @author     Devio Digital <contact@deviodigital.com>
 * @license    GPL-2.0+ http://www.gnu.org/licenses/gpl-2.0.txt
 * @link       https://deviodigital.com
 * @since      1.0.0
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adds rel="" values to any <a href> tag that links to specified domains.
 *
 * @param string $content The post content to filter.
 * 
 * @since  1.0.0
 * @return string The filtered post content.
 */
function lafp_add_custom_rel_to_links( $content ) {
    // Loop through each of the attributes from the admin settings.
    foreach ( lafp_attributes_array() as $key => $attributes ) {
        // Sponsored domains.
        if ( in_array( $key, array( 'sponsored_domains', 'ugc_domains', 'nofollow_domains' ) ) ) {
            $rel = str_replace( '_domains', '', $key );
            // Loop through attributes and use their domains.
            foreach ( $attributes as $domains ) {
                // Create an array from the string.
                $domains = explode( ',', $domains );
                // Loop through domains and add rel attribute to matching <a href> tags.
                foreach ( $domains as $domain ) {
                    $regex    = '/(<a\b[^>]*)(?:\s+(?:(?!href\b)\w+=(?:"[^"]*"|\'[^\']*\'|[^>\s]+)))*\s+href=(["\'])https?:\/\/(www\.)?' . preg_quote( $domain, '/' ) . '(\/[^\"\']*)?\2((?:\s+(?:(?!href\b)\w+=(?:"[^"]*"|\'[^\']*\'|[^>\s]+)))*)([^>]*>.*?<\/a>)/i';
                    $content  = preg_replace_callback( $regex, function( $matches ) use ( $rel, $domain ) {
                        $rel_attr = '';
                        $existing_rel = '';
                        if ( preg_match( '/\brel=(["\'])([^"\']+)\1/i', $matches[0], $rel_matches ) ) {
                            $existing_rel = $rel_matches[2];
                            $rel_values = explode(' ', $existing_rel);
                            if ( ! in_array( $rel, $rel_values ) ) {
                                $rel_values[] = $rel;
                            }
                            $rel_attr = implode( ' ', $rel_values );
                        } else {
                            $rel_attr = $rel;
                        }
                        if ( strpos( $matches[0], 'rel="' . $rel_attr . '"' ) === false ) {
                            $matches[0] = preg_replace( '/<a\b/', '<a rel="' . $rel_attr . '"', $matches[0] );
                        }
                        return $matches[0];
                    }, $content );
                }
            }
        }
    }
    return $content;
}
add_filter( 'the_content', 'lafp_add_custom_rel_to_links' );

/**
 * String replace on core editor content
 * 
 * @since  1.0.0
 * @return string
 */
function lafp_apply_custom_rel_to_core_editor_block_content( $block_content, $block ) {
    if ( isset( $block['innerHTML'] ) ) {
        $block['innerHTML'] = lafp_add_custom_rel_to_links( $block['innerHTML'] );
    }
    return $block_content;
}
add_filter( 'render_block_core/*', 'lafp_apply_custom_rel_to_core_editor_block_content', 10, 2 );
