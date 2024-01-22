<?php

require_once("Page.php");
$page = new Page("Example");
$page->description("Example description");
$page->keywords("ex1, ex2");
echo $page->display('Andrej Todorovski 201084');