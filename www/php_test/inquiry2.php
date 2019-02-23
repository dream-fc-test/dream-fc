<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=EUC-JP">
<title>���䤤��碌��λ</title>
	<meta name="Description" content="���䤤��碌��λ" /> 
	<meta name="Keywords" content="�ۡ���ڡ���,����,���" /> 
	<meta http-equiv="Content-Style-Type" content="text/css" />
<style type="text/css">
<!--
body, div, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, pre, form, 
fieldset, input, textarea, p, blockquote, th, td{
    margin: 0; 
    padding: 0;
}
html{
    overflow-y: scroll;
}
h1, h2, h3, h4, h5, h6{
    font-size: 100%; 
    font-weight: normal;
}
ol, ul{
    list-style:none;
}
fieldset, img{
     border:0;
}
table{
	border-collapse: collapse;
	border-spacing:0;
	margin-top: 10px;
}
caption, th{
    text-align: left;
}
address, caption, cite, code, dfn, em, strong, th, var{
    font-style: normal; 
    font-weight: normal;
}
body {
	font-family: "�ҥ饮�γѥ� Pro W3", "Hiragino Kaku Gothic Pro", "�ᥤ�ꥪ", Meiryo, Osaka, "�ͣ� �Х����å�", "MS PGothic", sans-serif;
	margin-top: 25px;
	color: #555;
	font-size: 13px;
}

#header {
	margin-left: 100px;
}
#main {
	margin-left: 30px;
}
#footer {
	margin-left: 30px;
}
#plv {
	margin-left: 100px;
}
#headerbg {
	border-top-width: 0px;
	border-right-width: 0px;
	border-bottom-width: 1px;
	border-left-width: 0px;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-top-color: #CCC;
	border-right-color: #CCC;
	border-bottom-color: #CCC;
	border-left-color: #CCC;
}
#footerbg {
	background-image: url(img/bg2.jpg);
	background-position: bottom;
}
#header p {
	margin-bottom: 15px;
}
#footer p {
	padding-top: 8px;
	padding-bottom: 8px;
}
#faq table tr td {
	background-color: #FFF;
}
#faq table tr th {
	background-color: #FFC;
}
table p {
	padding-top: 5px;
	padding-right: 10px;
	padding-bottom: 5px;
	padding-left: 10px;
}
strong {
	font-weight: bold;
}
h2 {
	margin-top: 20px;
	margin-bottom: 15px;
}
#main ul li {
	border-top-width: 0px;
	border-right-width: 0px;
	border-bottom-width: 1px;
	border-left-width: 0px;
	border-top-style: dashed;
	border-right-style: dashed;
	border-bottom-style: dashed;
	border-left-style: dashed;
	border-top-color: #CCC;
	border-right-color: #CCC;
	border-bottom-color: #CCC;
	border-left-color: #CCC;
	padding-right: 5px;
	padding-left: 5px;
	padding-top: 2px;
	padding-bottom: 2px;
}
#faq {
	margin-left: 100px;
}
#faq2 {
	margin-bottom: 25px;
	margin-top: 10px;
}
#button {
	padding-top: 3px;
	padding-right: 7px;
	padding-bottom: 3px;
	padding-left: 7px;
}
.title {
	font-size: 14px;
	margin-bottom: 15px;
}

-->
</style>
</head>

<body>
<?php

$to="ken-k@hcn.zaq.ne.jp";
$sbj="���䤤��碌�ե�����";
$text1=$_POST["text1"];
$text2=$_POST["text2"];
$text3=$_POST["text3"];
$textfield=$_POST["textfield"];
$textarea=$_POST["textarea"];

$hdr="content-Type: text/plain;charset=ISO-2022-JP";
$text0="�ե������ꤪ�䤤��碌�Ǥ���
\n\n��̾����$text1
\n\n�����ֹ桧$text2
\n\n�᡼�륢�ɥ쥹��$text3
\n\n���ơ�$textarea";

mb_language("ja");

if($_POST["text1"])
{
	if(mb_send_mail($to,$sbj,$text0,$hdr))
	print "";
	else
	print "���顼�ˤ�������˼��Ԥ�����ǽ�����������ޤ���\n";
}

?>
<div id="header">
  <h1><img src="logo.png" /></h1>
</div>
<hr />
<div id="faq">
  <h2>���䤤��碌���꤬�Ȥ��������ޤ���</h2>
  <p>�ʲ������ƤǤ��䤤��碌������դ��ޤ�����</p>
  <table width="700" border="1" cellspacing="0" cellpadding="0">
    <tr>
    <th width="237" bgcolor="#ECF0FB"><p>��̾��</p></th>
    <td width="457"><p><?php print $text1; ?></p></td>
  </tr>
  <tr>
    <th bgcolor="#ECF0FB"><p>�����ֹ�</p></th>
    <td><p><?php print $text2; ?></p></td>
  </tr>
  <tr>
    <th bgcolor="#ECF0FB"><p>�᡼�륢�ɥ쥹</p></th>
    <td><p><?php print $text3; ?></p></td>
  </tr>

  <tr>
    <th bgcolor="#ECF0FB"><p>����</p></th>
    <td><p><?php print $textarea; ?></p></td>
  </tr>
</table>
<p>&nbsp;</p>
</div>
  <div id="plv">
<h2>Copyright(c)��DREAM-FC��All Rights Reserved.</h2>
</div>
<hr />
</body>
</html>