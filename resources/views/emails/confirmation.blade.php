<html>
<head>
<title> </title>
</head>
<body>
    <table>
        <tr>
            <td> Dear {{$name}} ! </td>
</tr>
<tr>
    <td>&nbsp;</td>
</tr>
<tr>
    <td> Please click on below link to activate your account :</td>
</tr>
<tr>
    <td>&nbsp;</td>
</tr>
<tr>
    <td><a href="{{ url('confirm/'.$code) }}">Confirm Account</a></td>
</tr>
<tr>
    <td>&nbsp;</td>
</tr>
<tr>
    <td> Thanks for chosing shop216 </td>
</tr>
<tr>
    <td> Shop216 Website. </td>
</tr>
</body>
</html>
