<?php
use Sami\Sami;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
                  ->files()
                  ->name('*.php')
                  ->exclude('Resources')
                  ->exclude('Tests')
                  ->in($dir = __DIR__ . '/');

$versions = GitVersionCollection::create($dir)
                                ->addFromTags('v0.1.*')
                                ->addFromTags('v0.2.*')
                                ->add('master');

return new Sami(
    $iterator, [
        'theme' => 'default',
        'versions' => $versions,
        'title' => 'Psi',
        'build_dir' => __DIR__ . '/docs/psi/%version%',
        'cache_dir' => __DIR__ . '/cache/psi/%version%',
        // use a custom theme directory
    //    'template_dirs' => array(__DIR__ . '/themes/symfony'),
        'default_opened_level' => 2,
    ]
);
