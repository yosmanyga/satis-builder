<?php

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;
use Mustache\Engine;

// Folder where the yaml files are
$list = $argv[1];
// Folder where the satis.json file will be generated
$satis = $argv[2];

$repos = [];

// Read files in folder
$files = @scandir($list);

if ($files === false) {
    echo "Error reading folder $list\n";
    exit(1);
}

echo sprintf("Will process %s files\n", count($files)
    // For . and ..
    - 2
);

// Loop through files
foreach ($files as $key => $file) {
    // Skip . and ..
    if (in_array($file, ['.', '..'])) {
        continue;
    }

    echo sprintf("Processing file %s\n", $file);

    $content = file_get_contents($list . '/' . $file);
    $data = Yaml::parse($content);

    // Loop through lines
    foreach ($data['packages'] as $package) {
        [$namespace, $name] = explode('/', $package, 2);

        // Add to repos array
        $repos[] = [
            'name' => $package,
            'url' => sprintf(
                "%s/%s",
                sprintf($data['path_pre'], $namespace, $name),
                $data['path_post'] ?? '',
            )
        ];
    }
}

echo sprintf("Found %s repos\n", count($repos));

// Update last item
$repos[count($repos) - 1]['last'] = true;

$template = file_get_contents(__DIR__ . '/satis.json.mustache');

$m = new Engine(array('entity_flags' => ENT_QUOTES));
$content = $m->render($template, [
    'repos' => $repos,
]);

file_put_contents($satis . '/satis.json', $content);