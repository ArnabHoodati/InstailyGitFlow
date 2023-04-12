<?php

$log1 = '08-Jun-2012 1:00 AM 4ABCDEFGHI 
09-Jun-2012 1:00 AM 1ABCDEFGHI
09-Jun-2012 9:23 AM 3ABCDEFGHI
10-Jun-2012 1:00 AM 2ABCDEFGHI
10-Jun-2012 2:03 AM 2ABCDEFGHI
10-Jun-2012 1:00 AM 1ABCDEFGHI
10-Jun-2012 7:23 AM 3ABCDEFGHI
10-Jun-2012 9:23 AM 3ABCDEFGHI
11-Jun-2012 1:00 AM 1ABCDEFGHI
11-Jun-2012 2:12 AM 2ABCDEFGHI
11-Jun-2012 8:23 AM 3ABCDEFGHI
12-Jun-2012 10:21 PM 1ABCDEFGHI';
$log2 = '08-Jun-2012 1:00 AM 4ABCDEFGHI
09-Jun-2012 2:00 AM 1ABCDEFGHI
10-Jun-2012 1:00 AM 1ABCDEFGHI
11-Jun-2012 1:00 AM 1ABCDEFGHI
11-Jun-2012 8:23 AM 3ABCDEFGHI';
$log3 = '08-Jun-2012 1:00 AM 4ABCDEFGHI
09-Jun-2012 1:00 AM 1ABCDEFGHI
09-Jun-2012 2:00 AM 1ABCDEFGHI
10-Jun-2012 1:00 AM 1ABCDEFGHI
11-Jun-2012 1:00 AM 1ABCDEFGHI
11-Jun-2012 8:23 AM 3ABCDEFGHI';
$log4 = '08-Jun-2012 1:00 AM 4ABCDEFGHI
11-Jun-2012 1:00 AM 1ABCDEFGHI
10-Jun-2012 1:00 AM 1ABCDEFGHI
09-Jun-2012 2:00 AM 1ABCDEFGHI
11-Jun-2012 8:23 AM 3ABCDEFGHI';
$log5 = '08-Jun-2012 1:00 AM 4ABCDEFGHI
12-Jun-2012 1:00 AM 1ABCDEFGHI
11-Jun-2012 1:00 AM 1ABCDEFGHI
09-Jun-2012 2:00 AM 1ABCDEFGHI
10-Jun-2012 1:00 AM 1ABCDEFGHI
11-Jun-2012 8:23 AM 3ABCDEFGHI';
$log6 = '08-Jun-2012 1:00 AM 4ABCDEFGHI
12-Jun-2012 1:00 AM 1ABCDEFGHI
10-Jun-2012 1:00 AM 1ABCDEFGHI
09-Jun-2012 2:00 AM 1ABCDEFGHI
11-Jun-2012 1:00 AM 1ABCDEFGHI
11-Jun-2012 8:23 AM 3ABCDEFGHI';
$log7 = '08-Jun-2012 1:00 AM 4ABCDEFGHI
12-Jun-2012 1:00 AM 1ABCDEFGHI
11-Jun-2012 5:00 AM 1ABCDEFGHI
08-Jun-2012 2:00 AM 1ABCDEFGHI
10-Jun-2012 1:00 AM 1ABCDEFGHI
11-Jun-2012 8:23 AM 3ABCDEFGHI';
$log8 = '08-Jun-2012 1:00 AM 4ABCDEFGHI
12-Jun-2012 1:00 AM 1ABCDEFGHI
11-Jun-2012 5:00 AM 1ABCDEFGHI
09-Jun-2012 1:00 AM 1ABCDEFGHI
11-Jun-2012 1:00 AM 1ABCDEFGHI
13-Jun-2012 1:00 AM 1ABCDEFGHI
11-Jun-2012 8:23 AM 3ABCDEFGHI';

echo repeatedId($log1)."<br>";
echo repeatedId($log2)."<br>";
echo repeatedId($log3)."<br>";
echo repeatedId($log4)."<br>";
echo repeatedId($log5)."<br>";
echo repeatedId($log6)."<br>";
echo repeatedId($log7)."<br>";
echo repeatedId($log8)."<br>";

function repeatedId($log){
    $array1 = explode("\n", $log);
    $array2 = array();
    $array3 = array();
    $data = array();

    for ($i=0; $i < count($array1); $i++) { 
        $array2[$i] = explode(" ", $array1[$i]);
    }
    for ($i=0; $i < count($array2) ; $i++) { 
        $date = strtotime($array2[$i][0]);
        $id = $array2[$i][count($array2[$i])-1];

        if (!array_key_exists($id, $array3)) {
            $array3[$id]=array($date);
        }
        else {
            array_push($array3[$id], $date);
        }
        
    }
    foreach ($array3 as $id => $dates) {
        $array3[$id] = array_unique($dates);
        sort($array3[$id]);
    }

    foreach ($array3 as $id => $dates) {

        if (count($dates) >=3) {
           for ($i=0; $i < count($dates)-2  ; $i++) { 
            if (strtotime("+1 day", $dates[$i]) == $dates[$i+1] && strtotime("+2 day", $dates[$i])==$dates[$i+2]) {
                if (!in_array($id, $data)) {
                    array_push($data, $id);
                }
            }
           }
        }
    }
    if (empty($data)) {
        return "3 or more consecutive days id entries";
    }else{
        $repeatId='';
        for ($i=0; $i < count($data); $i++) { 
            $repeatId .=($i+1).'->'.$data[$i].'';
        }
        return $repeatId;
    }

}

?>