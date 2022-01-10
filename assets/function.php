<?php 


function setNbr($amount)
{
	$con = new mysqli('localhost','root','','CunLab');
	$array = $con->query("select * from tontine where id='$amount'");
	$row = $array->fetch_assoc();
	$nmbre_mbr = $row['nbre_mbr'] + 1;
	return $con->query("update tontine set nbre_mbr = '$nmbre_mbr' where id = '$amount'");
}

function setNbrv($amount)
{
	$con = new mysqli('localhost','root','','CunLab');
	$array = $con->query("select * from vote where id='$amount'");
	$row = $array->fetch_assoc();
	$id=$amount+$_SESSION['userId'];
	$nmbre_mbr = $row['nv'] + 1;
	return $con->query("update vote set nv = '$nmbre_mbr' where id = '$amount'");
}

function setNbrc($amount)
{
	$con = new mysqli('localhost','root','','CunLab');
	$array = $con->query("select * from election where id='$amount'");
	$row = $array->fetch_assoc();
	$nmbre_mbr = $row['candidats'] + 1;
	return $con->query("update election set candidats = '$nmbre_mbr' where id = '$amount'");
}

function setBalance($amount,$process,$accountNo)
{
	$con = new mysqli('localhost','root','','CunLab');
	$array = $con->query("select * from userAccounts where accountNo='$accountNo'");
	$row = $array->fetch_assoc();
	if ($process == 'credit') 
	{
		$balance = $row['balance'] + $amount;
		return $con->query("update userAccounts set balance = '$balance' where accountNo = '$accountNo'");
	}else
	{
		$balance = $row['balance'] - $amount;
		return $con->query("update userAccounts set balance = '$balance' where accountNo = '$accountNo'");
	}
}
function setOtherBalance($amount,$process,$accountNo)
{
	$con = new mysqli('localhost','root','','CunLab');
	$array = $con->query("select * from otheraccounts where accountNo='$accountNo'");
	$row = $array->fetch_assoc();
	if ($process == 'credit') 
	{
		$balance = $row['balance'] + $amount;
		return $con->query("update otheraccounts set balance = '$balance' where accountNo = '$accountNo'");
	}else
	{
		$balance = $row['balance'] - $amount;
		return $con->query("update otheraccounts set balance = '$balance' where accountNo = '$accountNo'");
	}
}
function makeTransaction($action,$amount,$other)
{
	$con = new mysqli('localhost','root','','CunLab');
	if ($action == 'transfer')
	{
		return $con->query("insert into transaction (action,debit,other,userId) values ('transfer','$amount','$other','$_SESSION[userId]')");
	}
	if ($action == 'withdraw')
	{
		return $con->query("insert into transaction (action,debit,other,userId) values ('withdraw','$amount','$other','$_SESSION[userId]')");
		
	}
	if ($action == 'deposit')
	{
		return $con->query("insert into transaction (action,credit,other,userId) values ('deposit','$amount','$other','$_SESSION[userId]')");
		
	}
}
function makeTransactionCashier($action,$amount,$other,$userId)
{
	$con = new mysqli('localhost','root','','CunLab');
	if ($action == 'transfer')
	{
		return $con->query("insert into transaction (action,debit,other,userId) values ('transfer','$amount','$other','$userId')");
	}
	if ($action == 'withdraw')
	{
		return $con->query("insert into transaction (action,debit,other,userId) values ('withdraw','$amount','$other','$userId')");
		
	}
	if ($action == 'deposit')
	{
		return $con->query("insert into transaction (action,credit,other,userId) values ('deposit','$amount','$other','$userId')");
		
	}
}
 ?>