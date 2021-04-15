<?php
require_once("fonction.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Demo contact</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Redressed&display=swap" rel="stylesheet">
    
    
</head>
<body>    
<center>
<div class="">
        <img class="logo" src="images/logo.jfif">
        <div class="titre">Demo contact</div>        
</div>

<div class="form_contact">
    
    <?php 
    $le_contact = null;
    if(isset($_GET['action']) && isset($_GET['id']))
    {
        $action = $_GET['action'];
        $id = $_GET ['id'];
        switch ($action)
        {
            case 'sup':
                //suppresion de l'enseigne par id_enseigne(numsiret)
                 deleteInfo ($id);                
            break;
            case 'edit':
                //recuperation de l'enseigne  à modifier par id_enseigne(numsiret)
                $le_contact = selectWhereInfo($id);
            break;
        }
    }
    ?>


<form method="post" action="">

<label for="nom">Nom :</label>
    <input required id="nom" type="text" name="nom" value="<?php if ($le_contact != null) 
    echo $le_contact['nom']; ?>"></br>

<label for="email">Email :</label>
    <input required id="email" type="text" name="email" value="<?php if ($le_contact != null) 
    echo $le_contact['email']; ?>"></br>

<label for="numtelephone">Numéro téléphone :</label>
    <input required id="numtelephone" type="text" name="numtelephone" value="<?php if ($le_contact != null) 
    echo $le_contact['numtelephone']; ?>"></br>

<label for="date_creation">Date_creation :</label>
    <input required id="date_creation" type="date" name="date_creation" value="<?php if ($le_contact != null) 
    echo $le_contact['date_creation']; ?>"></br>


<div class="form-buttons">
        <input class="button button-red"  type="reset" name="Annuler" value="Annuler">
        <input class="button button-green" type="submit"
            <?php
            if ($le_contact  != null) echo ' name="Modifier" value="Modifier"';
            else echo ' name="Valider" value="Valider"';
            ?>
        >
</div>

<?php
    if($le_contact != null) echo '<input type="hidden" name="id"
        value="'.$le_contact['id'].'">';
?>
</form>



<?php
    if (isset($_POST['Valider']))
    {
        insertInfo ($_POST);
        echo "Insertion réussie du nouveau contact!";
    }

    if (isset($_POST['Modifier']))
    {
        updateInfo ($_POST);
        header("Location: index.php"); //recharger la page
    }
?>

<br/>
<div class="titre_h1">Liste des contacts</div>
<br/>

<form method="post" action="">
    <label for="mot">Recherche par:</label>
    <input id="mot" type="text" name="mot">
    <div class="form-buttons">
        <input class="button button-green" type="submit" name="Filtrer" value="Filtrer">
    </div>
</form>
<br/>
</div>



<?php
if(isset($_POST['Filtrer']))
{
    $mot = $_POST['mot'];
    $resultats = selectAllInfo($mot);
}
else 
{
    $resultats = selectAllInfo();
}


?>
<br/>
<table class="styled-table" border="1">
<thead>
    <tr>
        <td >ID</td>
        <td >Nom</td>
        <td >Email</td>
        <td >Numéro de téléphone</td>
        <td >Date de création</td>
        <td >Statut</td>
    </tr>
    </thead>
    <tbody>
    <?php
   
    foreach ($resultats as $uncontact)
    {
        
        echo "<tr> <td>".$uncontact['id']."</td>
            <td>".$uncontact['nom']."</td>
            <td>".$uncontact['email']."</td>
            <td>".$uncontact['numtelephone']."</td>
            <td>".$uncontact['date_creation']."</td>
            
            <td>
            <a href='?action=sup&id=".$uncontact['id']."'>
            <img src ='images/sup.png' height='20' width='20'>
            </a>
            <a href='?action=edit&id=".$uncontact['id']."'>
            <img src ='images/edit.png' height='20' width='20'>
            </a>
            </td>
            
         </tr>";
    }
    ?>


</center>
</body> 
</html>