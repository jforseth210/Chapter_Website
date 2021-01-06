<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

function run_site(): string {
    //Some of my code uses relative
    //paths, so run from root dir.
    chdir("../");
    ob_start();
    require("chaptersitewip.php");
    $chapter_site_output = ob_get_clean();
    //Write the output of the site to a file for
    //debugging.
    $writeFile = fopen("tests/site_output.txt", "w");
    fwrite($writeFile, $chapter_site_output);
    fclose($writeFile);

    return $chapter_site_output;
}

final class test_normal_view extends TestCase
{
    public function test_head(): void
    {
        $site = run_site();
        $this->assertTrue(false !== strpos($site, '<head>'));
    }
    public function test_navbar(): void
    {
        $site = run_site();
        $this->assertTrue(false !== strpos($site, '<nav class="navbar navbar-expand-lg navbar-dark bg-ffablue fixed-top" id="mainNav">'));
    }
    public function test_about(): void
    {
        $site = run_site();
        $this->assertTrue(false !== strpos($site, '<section id="about">'));
    }
}