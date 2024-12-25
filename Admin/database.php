<?php  // NB : le mot self permet d'utiliser une variable static
class Database{
private static $dbHost= "localhost";
private static $dbName = "burger_code";
private static $dbUser= "root";
private static $dbUserPassword= "";
private static $connection=null;


public static function connect(){ // les paramètres static appartienne à la class elle meme et non à l'instance (il faut le nom de la class pour son utilisation)
    try{
        self:: $connection=new PDO("mysql:host=".self::$dbHost.";dbname=".self::$dbName,self::$dbUser,self::$dbUserPassword);
        }
        catch(PDOException $exp){
            die($exp->getMessage());
        }
        return self::$connection;
}

public static function disconnect(){
self::$connection=null;
}

public static function selectwhere($table, $where){
			$champs = array(); 
			$donnees = array(); 
			foreach ($where as $cle=>$valeur)
			{
				$champs[] = $cle . " =:".$cle; 
				$donnees[":".$cle]= $valeur; 
			}
			$chaineWhere = implode("AND ", $champs);
			$requete = " select * from  `{$table}` where $chaineWhere ";

			$select = self::$connection->prepare ($requete); 
			$select->execute($donnees); 
			return $select->fetch();
		}
        
public static function verif_input($input){
    $input=htmlspecialchars($input);
    $input=trim($input);
    $input=stripslashes($input);
    return $input;
}
}


?>