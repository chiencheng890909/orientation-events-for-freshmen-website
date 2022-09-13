	<?php

ini_set("display_errors","On");
error_reporting(E_ALL);

require_once('TCPDF/tcpdf_import.php');




$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetFont('cid0jp','', 18); 
$pdf->AddPage();

$nickname=$_POST['nickname'];
$date=$_POST['date'];
$tel=$_POST['tel'];
$email=$_POST['email'];
$address=$_POST['address'];

$html = <<<EOF
	<style type="text/css">
		table { border-collapse: collapse; }
		em       { font-weight: bold;}
	</style>
		<table border = "1" width=400 height= 200>
			<tr>
				<td width="50" height="50" align="center">姓名:</td>
				<td width="150" height="50" align="center" ><em>$nickname</em></td>
				<td width="50" height="50" align="center" >生日:</td>
				<td width="150" height="50" align="center" >$date</td>
			</tr>
			<tr>
				<td width="50" height="50" align="center" >電話:</td>
				<td width="350" height="50" align="center">$tel</td>
			</tr>
			<tr>
				<td width="50" height="50" align="center" >信箱:</td>
				<td align="center" >$email</td>
			</tr>
			<tr>
				<td width="50" height="50" align="center" >地址:</td>
				<td align="center">$address</td>
			</tr>
		</table>
EOF;
$pdf->writeHTML($html);
$pdf->lastPage();

ob_end_clean();

$pdf->Output('output.pdf', 'I');


mb_internal_encoding("utf-8");
$subject=mb_encode_mimeheader("報名成功","utf-8");
$message="請分享我們的活動";
$headers="MIME-Version: 1.0\r\n";
$headers.="Content-type: text/html; charset=utf-8\r\n";
$headers.="From:".mb_encode_mimeheader("四資迎新","utf-8")."<2000miro0909@gmail.com>\r\n";
mail($email,$subject,$message,$headers);
 if(mail("$email", "$subject", "$message", "$headers")):
   echo "信件已經發送成功。";//寄信成功就會顯示的提示訊息
  else:
   echo "信件發送失敗！";//寄信失敗顯示的錯誤訊息
  endif;
 ?>