<?php
 $phpAD["ldap_server"] = "192.168.16.2";
 $phpAD["auth_user"] = "administrador@sisloc.network";
 $phpAD["auth_pass"] = "13@*Sisloc@*";
 $phpAD["ldap_dn"] = "OU=Sisloc,DC=sisloc,DC=network";
 $phpAD["ldap_default_ou"] = "Sisloc";
 $phpAD["ad_domain_name"] = "sisloc.network";
 set_time_limit(0);

// Base do dominio para procura.
  $base_dn = $phpAD["ldap_dn"];

 // Conectando ao servidor
 if (!($connect=@ldap_connect($phpAD["ldap_server"]))){
  echo "Could not connect to ldap server";
  }
 // Autenticando
 if (!($bind=@ldap_bind($connect, $phpAD["auth_user"], $phpAD["auth_pass"]))){
  echo "Unable to bind to server";
 }
        $filtro = "(&(objectClass=user)(objectCategory=person)(displayname=*))";
        $mostrar = array("displayname","samaccountname","useraccountcontrol","userprincipalname","mail","mobile","department","thumbnailphoto","description","title","wwwhomepage","givenname","info","telephoneNumber","ipPhone");

 // Busca no active directory $busca = ldap_search($ds, $ldap_dn, $filtro/*, $attributes*/);
 if (!($busca=@ldap_search($connect, $base_dn, $filtro, $mostrar)))
  die("Não foi possível realizar busca no Active Directory");

$info = ldap_get_entries($connect, $busca);

foreach ($info as $Key => $Value ){
   $Name      = $info[$Key]["displayname"][0];
   $SHName    = $info[$Key]["givenname"][0];
   $Account   = $info[$Key]["samaccountname"][0];
   $State     = $info[$Key]["useraccountcontrol"][0];
   $Photo     = $info[$Key]["thumbnailphoto"][0];
   $Mobile    = $info[$Key]["mobile"][0];
   $Externo   = $info[$Key]["ipphone"][0];
   $Celular   = $info[$Key]["telephoneNumber"][0];
   $Desc      = $info[$Key]["description"][0];
   $Mail      = $info[$Key]["mail"][0];
   $Setor     = $info[$Key]["department"][0];
   $URL       = $info[$Key]["wwwhomepage"][0];
   $org       = $info[$Key]["distinguishedname"][0];
   $Funcao     = $info[$Key]["title"][0];
   $Bday	= $info[$Key]["info"][0];
   $State     = dechex($State);
   $State     = substr($State,-1,1);//verifica contas desabilitadas
   $Value     = $Photo;
   if ( $Name != "" && $State != 2)
	$USERs[$Name]=$Value;
        $infos[$Name]["nome"] = $Name;
	$infos[$Name]["shnome"] = $SHName;
	$infos[$Name]["funcao"] = $Funcao;
	$infos[$Name]["email"] = $Mail;
	$infos[$Name]["setor"] = $Setor;
	$infos[$Name]["url"] = $URL;
	$infos[$Name]["ramal"] = $Mobile;
	$infos[$Name]["bday"] = $Bday;
	$infos[$Name]["foto"] = $Photo;
	$infos[$Name]["celular"] = $Celular;
        $infos[$Name]["externo"] = $Externo;
}
if ( count($USERs) > 0 )
	ksort($USERs);

if ( count($USERs) == 0 ){
	echo "Não foi econtrado nenhum usuário";
}

?>
