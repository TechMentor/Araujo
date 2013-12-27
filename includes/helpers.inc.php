<?php

// See N2N p180-181
function html($text)
{
  return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

// See N2N p181
function htmlout($text)
{
  echo html($text);
}

function outputToText($content)
{
    // 1/0;
    // opening for writng/append mode the results file in the log folder.
    $h = fopen("C:\\Program Files\\Apache Software Foundation\\Apache2.2\\htdocs\\araujo_tc\\log\\results.txt", "a+");
    
    // write the $content value to the log
    fwrite($h, "\n" . $content);
    
    // close the results.txt file.
    fclose($h);
}