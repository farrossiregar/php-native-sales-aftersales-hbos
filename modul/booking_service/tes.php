<?php
$userArray = array(
    array('name'=>'John Doe', 'email'=>'john@example.com'),
    array('name'=>'Marry Moe', 'email'=>'marry@example.com'),
    array('name'=>'Smith Watson', 'email'=>'smith@example.com')
);

$array2 = array('name'=>'John Doe', 'email'=>'john@example.com');

$nama1 = "ariqo";
$nama2 = "Abdul";

$array3 = array($nama1,$nama2,12);
?>

<script type="text/javascript">
var users = <?php echo json_encode($array3); ?>;

//alert(users[0].name); //output will be "john@example.com"
//alert(users[1]);
$('#tampil').html(users[1]);

function tampil(){
	
	alert(users[1]);
	$('#tampilah').html("asdasd");
}
</script>

<html>
<head>
</head>
<body>
<div onclick="tampil()">click</div>

<div id="tampilah" >
<?php echo json_encode($array3) ;?>
</div>

</body>
</html>