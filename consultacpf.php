<?php
require_once 'vendor/autoload.php';
use JansenFelipe\CpfGratis\CpfGratis;
use JansenFelipe\Utils\Utils;
try {
if(!isset($_POST['captcha']) || !isset($_POST['cookie']) || !isset($_POST['token']) || !isset($_POST['cpf']) || !isset($_POST['data_nascimento']))
	throw new Exception('Informe todos os campos', 99);
    $return = CpfGratis::consulta($_POST['cpf'], $_POST['data_nascimento'], $_POST['captcha'], $_POST['cookie'], $_POST['token']) ;
    $return['code'] = 0;
} catch (Exception $e) {
    $return = array('code' => $e->getCode(), 'message' => $e->getMessage());
}
header('Content-Type: application/json');
echo json_encode($return);

?>
