<?php
$Fileinfo;
$BCMath;
$Ctype;
$JSON;
$OpenSSL;
$PDO;
$Tokenizer;
$XML;

if (!extension_loaded('Fileinfo')) {
    if (!dl('Fileinfo.so')) {
            $Fileinfo= 'Missing';
    }
}else{
    $Fileinfo= 'Loaded';
}

if (!extension_loaded('BCMath')) {
    if (!dl('BCMath.so')) {
            $BCMath='Missing';
    }
}else{
    $BCMath='Loaded';
}

if (!extension_loaded('Ctype')) {
    if (!dl('Ctype.so')) {
            $Ctype= 'Missing';
    }
}else{
    $Ctype='Loaded';
}


if (!extension_loaded('JSON')) {
    if (!dl('JSON.so')) {
            $JSON='Missing';
    }
}else{
    $JSON='Loaded';
}

if (!extension_loaded('Mbstring')) {
    if (!dl('Mbstring.so')) {
            $Mbstring='Missing';
    }
}else{
    $Mbstring='Loaded';
}

if (!extension_loaded('OpenSSL')) {
    if (!dl('OpenSSL.so')) {
            $OpenSSL= 'Missing';
    }
}else{
    $OpenSSL='Loaded';
}

if (!extension_loaded('PDO')) {
    if (!dl('PDO.so')) {
            $PDO= 'Missing';
    }
}else{
    $PDO='Loaded';
}


if (!extension_loaded('Tokenizer')) {
    if (!dl('Tokenizer.so')) {
            $Tokenizer= 'Missing';
    }
}else{
    $Tokenizer='Missing';
}

if (!extension_loaded('XML')) {
    if (!dl('XML.so')) {
            $XML= 'Missing';
    }
}else{
    $XML='Missing';
}
?>



<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<table>
  <tr>
    <th>PHP VERSION</th>
  </tr>
  <tr>
    <td><?php echo phpversion();?></td>
  </tr>
</table>

<h2>Extension INFO</h2>

<table>
  <tr>
    <th>Extension Name</th>
    <th>Status</th>
  </tr>
  <tr>
    <td>BCMath PHP Extension</td>
    <td><?php echo $BCMath ?></td>
  </tr>
  <tr>
    <td>Ctype PHP Extension</td>
    <td><?php echo $Ctype ?></td>
  </tr>
  <tr>
    <td>Fileinfo PHP extension</td>
    <td><?php echo $Fileinfo ?></td>
  </tr>
  <tr>
    <td>JSON PHP Extension</td>
    <td><?php echo $JSON ?></td>
  </tr>
  <tr>
    <td>Mbstring PHP Extension</td>
    <td><?php echo $Mbstring ?></td>
  </tr>
  
  <tr>
    <td>XML PHP Extension</td>
    <td><?php echo $XML ?></td>
  </tr>
  
  <tr>
    <td>OpenSSL PHP Extension</td>
    <td><?php echo $OpenSSL ?></td>
  </tr>
  
  <tr>
    <td>PDO PHP Extension</td>
    <td><?php echo $PDO ?></td>
  </tr>
  
  <tr>
    <td>Tokenizer PHP Extension</td>
    <td><?php echo $Tokenizer ?></td>
  </tr>
</table>

</body>
</html>





