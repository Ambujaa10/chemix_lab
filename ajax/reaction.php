 <?php
    include_once './db.php';
    
	$reactant1 = $_POST['chem01'];
        $reactant2 = $_POST['chem02'];
	$rplevel1 = $_POST['phy01'];
	$rplevel2 = $_POST['phy02'];

    
    function reaction_testing($reactant1,$reactant2,$rplevel1,$rplevel2){
        $reslut = array();
        $sql = "SELECT * FROM `reaction` WHERE `reactant1`='$reactant1' AND `reactant2`='$reactant2' AND `rplevel1`='$rplevel1' AND `rplevel2`='$rplevel2'";           
        $response = mysql_query($sql);

        while ($row = mysql_fetch_array($response)) {
            array_push($reslut, array("id"=>$row['id'],"indicator"=>$row['indicator']));
        }
        return $reslut;
    }
    
    $result_array = array();
    
    if(count(reaction_testing($reactant1,$reactant2,$rplevel1,$rplevel2)) > 0){
        $result_array = reaction_testing($reactant1,$reactant2,$rplevel1,$rplevel2);
    }
    else if(count(reaction_testing($reactant2,$reactant1,$rplevel2,$rplevel1)) > 0){
        $result_array = reaction_testing($reactant2,$reactant1,$rplevel2,$rplevel1);
    }
 

    echo json_encode(array("result"=>$result_array));