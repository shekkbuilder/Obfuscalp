<?php

/*
    This file is part of Obfuscalp.

    Obfuscalp is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
	
    Obfuscalp is coded and maintained by Ricky Burgin.
	
    © Ricky Burgin 2014
	
    http://ricky.burg.in/
    https://github.com/Orbixx/Obfuscalp
*/

if (empty($argv[1])) die("Usage: php remove.php infected.txt\n");
$handle = fopen($argv[1], "r"); // Open infected list read only
if ($handle) {
        $c = 0; // Counter for processed files
        $linecount = 0; // Total files in list
        while (($line = fgets($handle)) !== false) { // Count files, place into $linecount
                $linecount++;
        }
        $handle = fopen($argv[1], "r"); // Open again from the start
        echo "Disinfecting " . $linecount . " files...\n\n";
        while (($line = fgets($handle)) !== false) { // Traverse file list
                $line = str_replace("\n", '', $line); // Populate one line
                $c++;
                echo "Processing file " . $c . " of " . $linecount . " (%" . round((($c / $linecount) * 100),2) . ")\n"; // Display processing status
                $arr = file($line);
                if (strpos($arr[0], '?><?php') !== false) { // Sometimes the obfuscated malware inserts PHP tags and they sit on the same line as the obfuscated malware. This detects if that is the case, and prepares removal but replacing with a new tag to ensure it doesn't break the PHP file.
                        $arr[0] = "<?php\n\n";
                        file_put_contents($line, implode($arr));
                }
                else { // If no PHP opening tag exists on the same line as the malware
                        $arr[0] = "";
                        file_put_contents($line, implode($arr));
                }
        }
        echo $c;
        }
else {
        echo "Error opening infected list, check permissions?";
}

?>