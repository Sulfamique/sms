<?php

class SimpleMaillageSEO {

    private static $option_key = 'sms_keyword_links';

    public static function init() {
        add_action( 'admin_menu', array( __CLASS__, 'add_admin_menu' ) );
        add_action( 'admin_init', array( __CLASS__, 'handle_form_submission' ) );
        add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_admin_assets' ) );
        add_filter( 'the_content', array( __CLASS__, 'apply_links' ) );
    }

    public static function get_links() {
        $links = get_option( self::$option_key, array() );
        return is_array( $links ) ? $links : array();
    }

    public static function save_links( $links ) {
        update_option( self::$option_key, $links );
    }

    public static function enqueue_admin_assets( $hook ) {
        if ( $hook !== 'toplevel_page_simple-maillage-seo' ) {
            return;
        }
        wp_enqueue_style( 'sms-admin', SMS_PLUGIN_URL . 'admin/css/admin.css' );
    }

    public static function add_admin_menu() {
        add_menu_page(
            'Simple Maillage SEO',
            'Maillage SEO',
            'manage_options',
            'simple-maillage-seo',
            array( __CLASS__, 'admin_page' )
        );
    }

    public static function handle_form_submission() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        if ( isset( $_POST['sms_add'] ) && check_admin_referer( 'sms_save_links' ) ) {
            $keyword = sanitize_text_field( $_POST['sms_keyword'] );
            $url     = esc_url_raw( $_POST['sms_url'] );
            if ( $keyword && $url ) {
                $links = self::get_links();
                $links[ $keyword ] = $url;
                self::save_links( $links );
            }
        }

        if ( isset( $_POST['sms_delete'] ) && isset( $_POST['sms_keyword_delete'] ) && check_admin_referer( 'sms_save_links' ) ) {
            $del = sanitize_text_field( $_POST['sms_keyword_delete'] );
            $links = self::get_links();
            if ( isset( $links[ $del ] ) ) {
                unset( $links[ $del ] );
                self::save_links( $links );
            }
        }
    }

    public static function admin_page() {
        ?>
        <div class="wrap">
            <h1>Simple Maillage SEO</h1>
            <form method="post">
                <?php wp_nonce_field( 'sms_save_links' ); ?>
                <table class="widefat sms-table">
                    <thead>
                        <tr>
                            <th>Mot clef</th>
                            <th>URL</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ( self::get_links() as $kw => $url ) : ?>
                            <tr>
                                <td><?php echo esc_html( $kw ); ?></td>
                                <td><?php echo esc_url( $url ); ?></td>
                                <td>
                                    <button type="submit" name="sms_delete" class="button-link-delete" value="1">Supprimer</button>
                                    <input type="hidden" name="sms_keyword_delete" value="<?php echo esc_attr( $kw ); ?>" />
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td><input type="text" name="sms_keyword" /></td>
                            <td><input type="url" name="sms_url" /></td>
                            <td><button type="submit" name="sms_add" class="button button-primary" value="1">Valider</button></td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <?php
    }

    public static function apply_links( $content ) {
        $links = self::get_links();
        if ( empty( $links ) ) {
            return $content;
        }

        libxml_use_internal_errors( true );
        $dom = new DOMDocument();
        $encoding = get_bloginfo( 'charset' );
        $dom->loadHTML( '<?xml encoding="' . $encoding . '"?>' . $content );
        $xpath = new DOMXPath( $dom );

        foreach ( $links as $keyword => $url ) {
            $nodes = $xpath->query( '//text()[
                not(ancestor::a)
                and not(ancestor::h1)
                and not(ancestor::h2)
                and not(ancestor::h3)
                and not(ancestor::h4)
                and not(ancestor::h5)
                and not(ancestor::h6)
                and not(ancestor::nav)
                and not(ancestor::header)
                and not(ancestor::footer)
                and not(ancestor::*[contains(@class,"sommaire") or contains(@class,"toc") or contains(@class,"breadcrumb")])
            ]' );
            foreach ( $nodes as $node ) {
                if ( stripos( $node->nodeValue, $keyword ) !== false ) {
                    $regex = '/(\b' . preg_quote( $keyword, '/' ) . '\b)/i';
                    $new = preg_replace( $regex, '<a href="' . esc_url( $url ) . '">$1</a>', $node->nodeValue, 1 );
                    if ( $new !== $node->nodeValue ) {
                        $frag = $dom->createDocumentFragment();
                        $frag->appendXML( $new );
                        $node->parentNode->replaceChild( $frag, $node );
                        break;
                    }
                }
            }
        }

        $body = $dom->getElementsByTagName( 'body' )->item( 0 );
        $new_content = '';
        foreach ( $body->childNodes as $child ) {
            $new_content .= $dom->saveHTML( $child );
        }
        return $new_content;
    }
}

