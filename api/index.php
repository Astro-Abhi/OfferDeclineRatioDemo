<?php
 header("Access-Control-Allow-Origin: *");
//error_reporting(E_ALL);
require 'Medoo.php';

use Medoo\Medoo;

$database = new Medoo([
  // required
  'database_type' => 'mysql',
  'database_name' => 'parammgq_odr',
  'server' => 'localhost',
  'username' => 'parammgq_astro',
    'password' => 'Nnt!uMTB2t2VQah'
]);

$response = null;

// Get the required Tag
if (isset($_GET['tag'])) {
    
    $tag = $_GET['tag'];

    // Get Job Count
    if ($tag == "getJobCount") {
        $count = $database->select("offer",['vacancy']); 
        echo $count[0]['vacancy'];
    }
    // Get Accepted Job Count
    if ($tag == "getAccepted") {
        $count = $database->count("response",['accepted' => 1]); 
        echo $count;
    }
    // Get Declined Job Count
    if ($tag == "getDecline") {
        $count = $database->count("response",['decline' => 1]); 
        echo $count;
    }
    // Get Pending Job Count
    if ($tag == "getPending") {
        $jobs = $database->select("offer",['vacancy']); 
        $ac = $database->count("response",['accepted' => 1]); 
        $dc = $database->count("response",['decline' => 1]); 
        $count = $jobs[0]['vacancy'] - ($ac+$dc);
        echo $count;
    }

    // Updated Job Initated Count
    if ($tag == "jobInit" && isset($_GET['data'],$_GET['date'])) {
      $data = $_GET['data'];
      $date = $_GET['date'];

        $d = $database->update("offer", [
            "vacancy" => (int)$data,
            "updated" => $date
        ]);
       response($d->rowCount());
    }

    // Post Feedback of Applicant
    if($tag == "feedback" && isset($_GET['data'],$_GET['date'])){
        $data = $_GET['data'];
        $date = $_GET['date'];
        switch($data)
        {
            case "accepted":
                $dd = $database->insert("response", [
                    "accepted" => 1,
                    "dated" => $date
                ]);
                response($dd->rowCount());
            break;
            case "decline":
                $dd = $database->insert("response", [
                    "decline" => 1,
                    "dated" => $date
                ]);
                if ($dd->rowCount() > 0) {
                    $why = $_GET['why'];
                    $d = $database->insert("declinedfeedback",[$why=>1]);            
                   response($d->rowCount());
                }
               
            break;
        }

    }

    // Get Offer Decline Ratio
    if($tag == "odr")
    {
        $for30 = 0;
        $for2130 = 0;
        $for1521 = 0;
        $for715 = 0;
        $for27 = 0;
        $for1 = 0;
        $data = $database->select("response",['decline','dated'],["decline"=>1]);

        $datas = $database->select("offer",['vacancy','updated']);
        $date = $datas[0]['updated'];

        foreach ($data as $value) {
            $days =  dateDiffInDays($date,$value['dated']);
    
            if ($days > 30) {
                $for30 += 1;
            }
            if ($days > 21 && $days < 30) {
                $for2130 += 1;
            }
            if ($days > 15 && $days < 21) {
                $for1521 += 1;
            }
            if ($days > 7 && $days < 15) {
                $for715 += 1;
            }
            if ($days > 2 && $days < 7) {
                $for27 += 1;
            }
            if ($days == 1) {
                $for1 += 1;
            }
            

        }
       
        $per30 = round(($for30 / $datas[0]['vacancy']) * 100,2);
        $per2130 = round(($for2130 / $datas[0]['vacancy']) * 100,2);
        $per1521 = round(($for1521 / $datas[0]['vacancy']) * 100,2);
        $per715 = round(($for715 / $datas[0]['vacancy']) * 100,2);
        $per27 = round(($for27 / $datas[0]['vacancy']) * 100,2);
        $per1 = round(($for1 / $datas[0]['vacancy']) * 100,2);

        echo json_encode(array($per30,$per2130,$per1521,$per715,$per27,$per1));

    }

    // Get Reason Ratio
    if ($tag == "reason") {
        $bo = 0;
        $lc = 0;
        $o = 0;
        $vac = $database->select("offer",['vacancy']);
        $data = $database->select("declinedfeedback",["betterOp","locationCon","others"]);
        foreach ($data as $value) {
            if ($value['betterOp'] == 1) {
                $bo += 1;
            }
            if ($value['locationCon'] == 1) {
                $lc += 1;
            }
            if ($value['others'] == 1) {
                $o += 1;
            }
        }

        $pbo = round(($bo / $vac[0]['vacancy']) * 100,2);
        $plc = round(($lc / $vac[0]['vacancy']) * 100,2);
        $po = round(($o / $vac[0]['vacancy']) * 100,2);
        $rm = ($vac[0]['vacancy'] - ($bo+$lc+$o));
        $prm = round(($rm / $vac[0]['vacancy']) * 100,2);

        echo json_encode(array($pbo,$plc,$po,$prm));

    }

} 

// Output Response
function response($type)
{
    if ($type == 1) {
        $response = array("status"=>200,"type"=>"success");
        echo json_encode($response);
    }else{
        $response = array("status"=>400,"type"=>"error");
        echo json_encode($response);
    }
}

function dateDiffInDays($date1, $date2)  
{ 
    $diff = strtotime($date2) - strtotime($date1); 
    return abs(round($diff / 86400)); 
}
?>
