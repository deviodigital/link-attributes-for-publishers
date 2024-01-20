<?php


/**
 * Adds rel="sponsored" and other rel values to any <a href> tag that links to specified domains.
 *
 * @param string $content The post content to filter.
 * 
 * @since  1.0.0
 * @return string The filtered post content.
 */
function add_custom_rel_to_links( $content ) {
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
                            if ( !in_array($rel, $rel_values) ) {
                                $rel_values[] = $rel;
                            }
                            $rel_attr = implode(' ', $rel_values);
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
add_filter( 'the_content', 'add_custom_rel_to_links' );


/**
 * String replace on Gutenberg content
 * 
 * @since  1.0.0
 * @return string
 */
function apply_custom_rel_to_gutenberg_block_content( $block_content, $block ) {
    if ( isset( $block['innerHTML'] ) ) {
        $block['innerHTML'] = add_custom_rel_to_links( $block['innerHTML'] );
    }
    return $block_content;
}

add_filter( 'render_block_core/*', 'apply_custom_rel_to_gutenberg_block_content', 10, 2 );


/**
 * String replace on widgets
 * 
 * @since  1.0.0
 * @return string
 */
function wpdocs_text_replace( $text, $instance, $that ) {
    // Create array.
    $affiliate_domains = array();

    // Get affiliate domains from ACF options page.
    $rows = get_field( 'affiliate_domains', 'options' );

    // Verify rows exist.
    if ( $rows ) {
        foreach( $rows as $row ) {
            $domain              = $row['domain'];
            $affiliate_domains[] = $domain;
        }
    }

    // Loop through domains and add rel="sponsored" to matching <a href> tags.
    foreach ( $affiliate_domains as $domain ) {
        $regex = '/(<a\s+)([^>]*)(class=(["\'])(?:[^"\']+)\4[^>]*)(\s+href=(["\'])https?:\/\/(www\.)?' . preg_quote( $domain, '/' ) . '(\/[^\"\']+)?\6[^>]*)(>.*?<\/a>)/i';
        $text  = preg_replace( $regex, '$1$2$5 rel="sponsored" $3$8', $text );
    }

    return $text;
}
//add_filter( 'widget_text', 'wpdocs_text_replace', 10, 3 );

/**
 * String replace on WP Recipe Maker plugin
 * 
 * @return string
 */
function lafp_wprm_recipe_shortcode_output( $output, $recipe, $type, $slug ) {
    $reflectionClass = new ReflectionClass( $recipe );
    $metaProperty    = $reflectionClass->getProperty( 'meta' );
    $metaProperty->setAccessible( true );
    $metaData        = $metaProperty->getValue( $recipe );

    // Access the wprm_instructions data.
    $wprmInstructions  = $metaData['wprm_instructions'];
    $instructionsArray = unserialize( $wprmInstructions[0] );
    $textContents      = array_map( function ( $instruction ) {
        return $instruction['instructions'][0]['text'];
    }, $instructionsArray );

    // Filter the output.
    $modifiedText = add_custom_rel_to_links( $textContents[0] );

    sctk_console_log( 'This is $modifiedText ...', true, true );
    sctk_console_log( $modifiedText, true, true );

    sctk_console_log( 'This is $textContents[0] ...', true, true );
    sctk_console_log( $textContents[0], true, true );

    sctk_console_log( 'This is $output...', true, true );
    sctk_console_log( $output, true, true );

    // Replace the <p> tags with <span> tags in the modified text.
    $modifiedText = str_replace( '<p>', '<span style="display: block;">', $modifiedText );
    $modifiedText = str_replace( '</p>', '</span>', $modifiedText );


    sctk_console_log( 'This is $modifiedText after str_replace ...', true, true );
    sctk_console_log( $modifiedText, true, true );

    // Replace the wrapped instructions with the modified text.
    $output = str_replace( $textContents[0], $modifiedText, $output );

    sctk_console_log( 'This is $output (after str_replace)...', true, true );
    sctk_console_log( $output, true, true );

    return $output;
}
add_filter( 'wprm_recipe_shortcode_output', 'lafp_wprm_recipe_shortcode_output', 1, 4 );
