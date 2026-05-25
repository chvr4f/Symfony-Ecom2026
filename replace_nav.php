<?php
foreach(glob('templates/*.html.twig') as $f) {
    if(strpos($f, '_navbar') !== false) continue;
    $c = file_get_contents($f);
    $c = preg_replace('/<nav class=\"navbar.*<\/nav>/sU', '{% include \'_navbar.html.twig\' %}', $c);
    file_put_contents($f, $c);
}
