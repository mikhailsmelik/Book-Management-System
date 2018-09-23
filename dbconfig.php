<?php

    $conn = oci_connect('<username>', '<password>', '//dbserver.engr.scu.edu/db11g');
    if (!$conn) {
        print "<br>connection failed:";
        exit;
    }
