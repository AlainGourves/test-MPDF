<?php

require_once __DIR__ . '/vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'tempDir' => __DIR__ . '/tmp', // custom temporary directory as the default temporary directory
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/fonts',
    ]),
    'fontdata' => $fontData + [
        'righteous' => [
            'R' => 'Righteous-Regular.ttf'
        ]
    ],
    'default_font' => 'dejavusans',
    'mode' => 's' // inclut subset des fonts utlisées
]);

$mpdf->WriteHTML("h1{font-family: righteous; color:rgb(255,0,0); border-bottom: 4px solid rgb(255,0,0);}", \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML('<h1>Hello world (Arch Arch Arch) !</h1>', \Mpdf\HTMLParserMode::HTML_BODY);

// nom du PDF, "D" pour download
$mpdf->Output("exemple-01.pdf", "D");

?>