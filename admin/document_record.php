<?php
    require_once "config.php";
?>

<!DOCTYPE html>
<html lang="en">
    <script>
        window.print();
    </script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        form{
            font-family: Arial;
        }

        #customers {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        color: black;
        }
        
    </style>
    <title>Inventory Management KKTF</title>
</head>
<body>
    <form action="" method="post">
    <div>
			<table width="791">
                <tr>
                    <td>
						<!-- width="678" -->
						<table width="791" style="text-align:center">
							<tr>
								<td width="170"></td>
								<td class="auto-style1">
									<div style="font-weight:300; font-family:'Franklin Gothic Medium', 'Arial Narrow', 'Arial', 'sans-serif'; color:black;">Summary of Inventory KKTF
								</td>
                                <td width="170"></td>
							</tr> 
						</table>
					</td>
				</tr>
				<tr>
					<td height="180">
            <!-- width="580" -->
            <table width="791" id="customers">
                <tr>
                    
                    <td colspan="2">   

                        <table width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barcode ID</th>
                                <th>Asset Name</th>
                                <th>Price (RM)</th>
                                <th>Status</th>
                                <th>Description</th>
                                <th>Date Created</th>
                                <th>Date Modify</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                if(isset($_POST["month"]))
                                {
                                    $month = date('m');
                                    $year = date('y');
                                    
                                    switch($month)
                                    {
                                        case 1:
                                        {
                                            $start = strtotime($year.'-'.$month.'-01');
                                            $end = strtotime($year.'-'.$month.'-31');
                                            break;
                                        }
                                        case 2:
                                        {
                                            $start = strtotime($year.'-'.$month.'-01');
                                            $end = strtotime($year.'-'.$month.'-29');
                                            break;
                                        }
                                        case 3:
                                        {
                                            $start = strtotime($year.'-'.$month.'-01');
                                            $end = strtotime($year.'-'.$month.'-31');
                                            break;
                                        }
                                        case 4:
                                        {
                                            $start = strtotime($year.'-'.$month.'-01');
                                            $end = strtotime($year.'-'.$month.'-30');
                                            break;
                                        }
                                        case 5:
                                        {
                                            $start = strtotime($year.'-'.$month.'-01');
                                            $end = strtotime($year.'-'.$month.'-30');
                                            break;
                                        }
                                        case 6:
                                        {
                                            $start = strtotime($year.'-'.$month.'-01');
                                            $end = strtotime($year.'-'.$month.'-30');
                                            break;
                                        }
                                        case 7:
                                        {
                                            $start = strtotime($year.'-'.$month.'-01');
                                            $end = strtotime($year.'-'.$month.'-31');
                                            break;
                                        }
                                        case 8:
                                        {
                                            $start = strtotime($year.'-'.$month.'-01');
                                            $end = strtotime($year.'-'.$month.'-31');
                                            break;
                                        }
                                        case 9:
                                        {
                                            $start = strtotime($year.'-'.$month.'-01');
                                            $end = strtotime($year.'-'.$month.'-30');
                                            break;
                                        }
                                        case 10:
                                        {
                                            $start = strtotime($year.'-'.$month.'-01');
                                            $end = strtotime($year.'-'.$month.'-31');
                                            break;
                                        }
                                        case 11:
                                        {
                                            $start = strtotime($year.'-'.$month.'-01');
                                            $end = strtotime($year.'-'.$month.'-30');
                                            break;
                                        }
                                        case 12:
                                        {
                                            $start = strtotime($year.'-'.$month.'-01');
                                            $end = strtotime($year.'-'.$month.'-31');
                                            break;
                                        }
                                    }
                                }
                                else if(isset($_POST["year"]))
                                {
                                    $year = date('y');

                                    $start = strtotime($year.'-01-01');
                                    $end = strtotime(($year+1).'-01-01');
                                }
                                else if(isset($_POST["generate"]))
                                {
                                    $start = strtotime($_POST['start']);
                                    $end = strtotime($_POST['end']);
                                }

                                if($start == $end)
                                {
                                    echo ("<script>
                                    window.alert('Invalid! Both date are same.');
                                    window.location.href='summary.php';
                                    </script>");
                                }
                                else
                                {

                                    $sql = mysqli_query($connect, "SELECT c.list_id, a.asset_barcode, a.name AS asset_name, a.price, b.status_id, b.name, c.description, c.date_created, c.date_modify, d.name AS user
                                    FROM asset a, status b, list_record c, user d
                                    WHERE a.asset_id = c.fk_asset_id AND b.status_id = c.fk_status_id AND a.fk_user_id = d.user_id AND c.date_created BETWEEN '".date('Y-m-d', $start)."' AND '".date('Y-m-d', $end)."'
                                    ORDER BY c.date_created DESC") or die(mysqli_error($connect));

                                }

                                //if query above make  > 0 so running script below if...
                                if(mysqli_num_rows($sql) > 0){
                                    
                                    //make variable $no for keep number 
                                    $no = 1;
                                
                                    //make repeation while from  query $sql
                                    while($data = mysqli_fetch_assoc($sql)){
                                    $timecreate = strtotime($data['date_created']);
                                    $timemodify = strtotime($data['date_modify']);
                                    if($data['description'] == '')
                                    {
                                        $data['description'] = '-';
                                    }
                                                    
                                    //appear data
                                    echo '
                                    <tr>
                                 
                                    <td>'.$no++.'</td>
                                    <td>'.$data['asset_barcode'].'</td>
                                    <td>'.$data['asset_name'].'</td>
                                    <td>RM'.$data['price'].'.00</td>
                                    <td>'.$data['name'].'</td>
                                    <td>'.$data['description'].'</td>
                                    <td>'.date('d/m/Y h:i:s', $timecreate).'</td>
                                    <td>'.date('d/m/Y h:i:s', $timemodify).'</td>
                                    <td>'.$data['user'].'</td>
                                    </tr>';
                                                
                                }
                                //if query make  0
                                }else{
                                    echo '
                                    <tr>
                                        <td colspan="11">no data.</td>
                                    </tr>';
                                }
                                ?>
                            <tbody>
                        </table>

                    </td>
					
                </tr>
                
                </table>
			    </td>
			</tr>
            <tr>
			<td>
                <!-- width="678" -->
            </td>
			</tr>
				</table>
        </div>
    </form>
</body>
</html>