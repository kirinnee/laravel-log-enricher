<?php

echo "currentPath: " . __DIR__ . "\n";
$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude("tmp")
    ->exclude("vendor");



$config = new PhpCsFixer\Config();
return $config
    ->setRules([
        '@PSR12' => true,
    ])
    ->setFinder($finder);
