Obfuscalp
=========

Finds and removes suspicious/malicious code planted inside PHP and other scripts. It will not detect plainly coded malware at this time. In its current state, it may produce false-positives due to its primitiveness, so please manually check each detected file before processing it with remove.php.

This file *does not* ask to confirm your command before executing. You have been warned. Keep backups.

You will naturally be using this tool to assist in either intrusion detection or to aid in clean-up after files have been compromised. Obfuscalp *will not* bolster protection. Take appropriate measures to ensure the lowest chance of ever needing to use the remove.php script. Secure your network, harden your server and your scripts.

Example Usage
=============

php find.php /path/to/a/bunch/of/php/sites > infected.txt
...
Processed 3950000 files, found 30
Processed 3960000 files, found 30
Processed 3970000 files, found 30

php remove.php infected.txt
...
Processing file 28 of 30 (%93.33)
Processing file 29 of 30 (%96.66)
Processing file 30 of 30 (%100)