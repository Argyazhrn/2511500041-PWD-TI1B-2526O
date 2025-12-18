<?php

function redirect_ke($url)
{
    header("location: " . $url);
    exit();
}

function bersihkan($str)
{
    return htmlspecialchars(trim($str));
}

function tidakKosong($str)
{
    return strlen(trim($str)) > 0;
}

function formatTanggal($tgl)
{
    return date("d M Y", strtotime($tgl));
}

function tampilkanBiodata($conf, $arr)
{
    $html = "";

    foreach ($conf as $k => $v) {

        $label  = $v["label"];
        $nilai  = bersihkan($arr[$k] ?? '');
        $suffix = $v["suffix"];

        $html .= "<p><strong>{$label}</strong> {$nilai}{$suffix}</p>";
    }

    return $html;
}


function tampilkanBiodataTabel($conf, $arr)
{
    $html = "<table border='1' cellpadding='8' cellspacing='0' style='border-collapse:collapse;margin-bottom:20px;'>";

    foreach ($conf as $k => $v) {

        $label  = $v["label"];
        $suffix = $v["suffix"];
        $nilai  = $arr[$k] ?? '';

        
        if ($k === "tanggal" && $nilai != '') {
            $nilai = formatTanggal($nilai);
        }

        $nilai = bersihkan($nilai);

        $html .= "
            <tr>
                <th align='left'>{$label}</th>
                <td>{$nilai}{$suffix}</td>
            </tr>
        ";
    }

    $html .= "</table>";

    return $html;
}
