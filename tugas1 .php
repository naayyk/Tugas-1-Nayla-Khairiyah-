<?php

$mahasiswa = ["Ali" =>85, "Siti" =>90, "Tio" =>67, "Yudi" =>55, "Lily" =>76];

foreach ($mahasiswa as $nama => $nilai) {
    if ($nilai>=80) {
        $grade = "A";
    } elseif ($nilai>=60) {
        $grade = "B";
    } elseif ($nilai>=50) {
        $grade = "C";
    } else {
        $grade = "D";
    }
    
    echo "$nama : $nilai ($grade)<br>";
}