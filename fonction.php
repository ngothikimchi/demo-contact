<?php
    //connexion à la base de données : extraction et injection des données
    function connexion ()
    {
        $connect = mysqli_connect("localhost","root","","democontact"); //les PC    
        
        if (!$connect)        
            echo"Erreur de connexion à la base de données";
        
        return $connect;
    }

    function deconnexion ($connect)
    {
        mysqli_close ($connect);
    }

    function insertInfo ($tab)
    {
        
        $requete = "insert into contact 
        values ('','".$tab['nom']."', '".$tab['email']."','".$tab['numtelephone']."','".$tab['date_creation']."') ; ";       
        $connect = connexion();  
        mysqli_query($connect, $requete);
        //je me déconnecte
        deconnexion($connect);
    }

    function selectAllInfo ($mot ="")
    {
        if($mot =="")
        {
            $requete = "select * from contact;";
        }
        else 
        {
            $requete = "select * 
                        from contact 
                        where nom like '%".$mot."%'
                        or email like '%".$mot."%'
                        or numtelephone like '%".$mot."%' 
                        or date_creation like '%".$mot."%'
                        ;" ;
        }
        $connect = connexion ();
        
        $resultats = mysqli_query($connect,$requete);
        
        $tab = array ();
        while ($ligne = mysqli_fetch_assoc($resultats))
        
        {
            $tab [] = $ligne;   
        }
        deconnexion($connect);
        return $tab;
    }


    function deleteInfo ($id)
    {
        $requete ="delete from contact where id ='".$id."';";
        //je me connect à la base de données
        $connect = connexion();
        // j'execute la requete
        mysqli_query($connect, $requete);
        //je me déconnecte
        deconnexion($connect);
    }  

    function updateInfo ($tab)
    {
        $requete = "update contact 
        set id ='".$tab['id']."',
        nom ='".$tab['nom']."', 
        email ='".$tab['email']."',
        numtelephone ='".$tab['numtelephone']."',
        date_creation ='".$tab['date_creation']."' 
        where id = ".$tab['id'].";" ;
        
        $connect = connexion();
        
        mysqli_query($connect, $requete);
       
        deconnexion($connect);
    }  

    function selectWhereInfo ($id)
    {

        //recupere une seule classe identifié par idclasse.
        $requete ="select id, nom, email, numtelephone, date_creation   
        from contact where id ='".$id."';";
        $connect = connexion();
        
        $resultats = mysqli_query($connect, $requete);

        $ligne = mysqli_fetch_assoc($resultats);

        deconnexion ($connect);
        
        return $ligne;
    }


?>