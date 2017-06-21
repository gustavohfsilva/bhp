<?php
session_start(['cookie_lifetime' => 10800,]);
set_time_limit(0);
ini_set('mysql.connect_timeout', 3000);
ini_set('default_socket_timeout', 3000);

// Configuracoes LDAP
$ldap_ip = 'srv-bhp';
$ldap_dominio = '@bhpoker.network';
$ldap_dn = "dc=bhpoker,dc=network";

// Grava log
function grava_log($dados){
	include "config.php";
    $ip = $_SERVER['REMOTE_ADDR'];
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $sqlx = "INSERT INTO log SET nome = '".$dados["name"]."', login = '".$dados["login"]."', setor = '".$dados["department"]."', ip = '$ip', browser = '$browser', data = NOW() ";
    mysqli_query($conn, $sqlx);
    if(!$sqlx){
        die("Erro: Inserir log");
    }
}



// Busca dados do LDAP dado username
function get_data_ldap($username, $password){
    global $ldap_ip, $ldap_dominio, $ldap_dn;

    $ds = ldap_connect( $ldap_ip );
    ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);

    $login = ldap_bind( $ds, "$username$ldap_dominio", $password );
    try{
        $attributes = array("displayname","givenname","mobile","mail","department","title","physicaldeliveryofficename","manager","thumbnailphoto","description","wwwhomepage");
        $filter = "(&(objectCategory=person)(objectClass=user)(displayname=*)(sAMAccountName=$username))";
        $result = ldap_search($ds, $ldap_dn, $filter, $attributes);
	    $entries = ldap_get_entries($ds, $result);
        $data["login"] = $username;
        if($entries["count"] > 0){
            $data["name"] = $entries[0]['displayname'][0];
	    $data["shname"] = $entries[0]['givenname'][0];
            $data["email"] = $entries[0]['mail'][0];
            $data["ramal"] = $entries[0]['mobile'][0];
            $data["department"] = $entries[0]['department'][0];
            $data["title"] = $entries[0]['title'][0];
            $data["office"] = $entries[0]['physicaldeliveryofficename'][0];
            $data["manager"] = $entries[0]['manager'][0];
	    $data["desc"] = $entries[0]['description'][0];
            $data["site"] = $entries[0]['wwwhomepage'][0];
            $data["foto"] = $entries[0]['thumbnailphoto'][0];
            $manager_result = ldap_search($ds, $entries[0]['manager'][0], '(objectCategory=person)', array("displayname"));
            $manager_entries = ldap_get_entries($ds, $manager_result);
            if($manager_entries["count"] > 0){
                $data["manager"] = $manager_entries[0]['displayname'][0];
            }
        }
	

		
	//Não Apagar	
    }catch(Exception $e){
        ldap_unbind($ds);
        return;
    }
    ldap_unbind($ds);
    return $data;
}


function valida_ldap($auth_user, $auth_pass){

    global $ldap_ip;

    if(!$auth_user || !$auth_pass) {return false;}

    // Tenta se conectar com o servidor
    if (!($connect = @ldap_connect($ldap_ip))){
        return FALSE;
    }

    // Tenta autenticar no servidor
    if (!($bind = @ldap_bind($connect, $auth_user, $auth_pass))) {
        // se nao validar retorna false
        return FALSE;
    } else {
        // se validar retorna true

        return TRUE;
    }

} // fim funcao conectar ldap

 
?>
