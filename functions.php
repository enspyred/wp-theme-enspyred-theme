<?php // Functions

// Theme Update Checker
require get_template_directory() . '/plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5p6\PucFactory;

$enspyredThemeUpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/enspyred/wp-theme-enspyred-theme',
	get_template_directory() . '/style.css',
	'enspyred-theme'
);
$enspyredThemeUpdateChecker->getVcsApi()->enableReleaseAssets();

// Enable theme support for menus
add_action('after_setup_theme', function() {
    add_theme_support('menus');
    register_nav_menus([
        'primary' => __('Primary Menu', 'enspyred-theme'),
    ]);
});

add_action('wp_enqueue_scripts', function () {
    $manifest_path = get_stylesheet_directory() . '/build/.vite/manifest.json';
    $build_uri     = get_stylesheet_directory_uri() . '/build/';

    if (!file_exists($manifest_path)) return;

    $manifest = json_decode(file_get_contents($manifest_path), true);
    if (!is_array($manifest)) return;

    $entries = array_values(array_filter($manifest, fn($v) => !empty($v['isEntry'])));
    if (empty($entries)) return;

    $entry = $entries[0];

    wp_enqueue_script(
        'enspyred-theme-app',
        $build_uri . $entry['file'],
        [],
        null,
        [ 'in_footer' => true, 'type' => 'module' ]
    );

    if (!empty($entry['css'])) {
        foreach ($entry['css'] as $css) {
            wp_enqueue_style('enspyred-theme-style-' . md5($css), $build_uri . $css, [], null);
        }
    }
});

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['script', 'style']);
});