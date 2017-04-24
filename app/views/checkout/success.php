<?php
use yii\easyii\modules\page\api\Page;
use yii\easyii\modules\shopcart\api\Shopcart;
use yii\helpers\Html;

$page = Page::get('page-shopcart-success');

$this->title = $page->seo('title', $page->model->title);
$this->params['breadcrumbs'][] = $page->model->title;
?>
<h1><?= $page->seo('h1', $page->title) ?></h1>

<br/>

<?= $page->text ?>

<?php
//Baokim Payment Notification (BPN) Sample
//Lay thong tin tu Baokim POST sang
$req = '';
 echo "<pre>";
 print_r(Yii::$app->request->get());
 echo "</pre>";

foreach ( Yii::$app->request->post() as $key => $value ) {
	$value = urlencode ( stripslashes ( $value ) );
	$req .= "&$key=$value";
}

//thuc hien  ghi log cac tin nhan BPN
$myFile = "logs/bpn.log";
$fh = fopen($myFile, 'a') or die("can't open file");
fwrite($fh, $req);

$ch = curl_init();

//Dia chi chay BPN test
//curl_setopt($ch, CURLOPT_URL,'http://sandbox.baokim.vn/bpn/verify');

//Dia chi chay BPN that
curl_setopt($ch, CURLOPT_URL,'https://www.baokim.vn/bpn/verify');
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
$result = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
$error = curl_error($ch);



if($result != '' && strstr($result,'VERIFIED') && $status==200){
	//thuc hien update hoa don
	fwrite($fh, ' => VERIFIED');
	
	$order_id = $_POST['order_id'];
	$transaction_id = $_POST['transaction_id'];
	$transaction_status = $_POST['transaction_status'];
	$total_amount = $_POST['total_amount'];
	
	//Mot so thong tin khach hang khac
	$customer_name = $_POST['customer_name'];
	$customer_address = $_POST['customer_address'];
	//...
	
	//kiem tra trang thai giao dich
if ($transaction_status == 4||$transaction_status == 13){//Trang thai giao dich =4 la thanh toan truc tiep = 13 la thanh toan an toan
		echo "Da thanh toan thanh cong";
	}
	
	/**
	 * Neu khong thi bo qua
	 */
}else{
	fwrite($fh, ' => INVALID');
}

if ($error){
	fwrite($fh, " | ERROR: $error");
}

fwrite($fh, "\r\n");
fclose($fh);
?>
<script type="text/javascript">
	//window.location = "http://google.com.vn";
</script>
