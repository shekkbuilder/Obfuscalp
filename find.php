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

if (empty($argv[1])) die("Usage: php find.php directory_to_scan > infected.txt");
else {
        fwrite(STDERR, "Scanning " . $argv[1] . " for potential obfuscated malware...\n\n");
        $data = array();
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($argv[1]),RecursiveIteratorIterator::SELF_FIRST); // Grab array of the entire structures of $argv[1] (a directory)
        $c = 0; // Counter for files processed
        $f = 0; // Counter for files with potential malware
        foreach ($files as $file)
        {
                if (($c % 10000) == 0 && $c > 0) { // Display status for every 10,000 files
                        fwrite(STDERR, "Processed " . $c . " files, found " . $f . "\n");
                }
                if (is_dir($file) === true) // Not in use, was used to check directory traversal was working properly
                {
                        //echo "Traversing into " . strval($file);
                }
                else { // If is file
                        if (strpos($file, '.php') !== false) { // Currently only selects PHP files for scanning
                                $arr = file($file); // Puts each line of the file into an array element
                                if (strlen($arr[0]) > 10000) { // If a line contains more than 10,000 characters, write it to stdout
                                        echo $file . "\n";
                                        $f++;
                                }
                        }
                }
                $c++;
        }
}

?>