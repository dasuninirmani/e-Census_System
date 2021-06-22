<?php
include "config.php";

                $provinceId=0;
				
                if(isset($_POST['province'])){
					$provinceId = mysqli_real_escape_string($link,$_POST['province']); 
					
					}
                   
                    $district_arr = array();

                    $ds_res=mysqli_query($link,"Select districtId,districtName from district WHERE provinceId='".$provinceId."'");
                     while($row=mysqli_fetch_array($ds_res))
                    { 
                        $districtid = $row['districtId'];
                        $district_name = $row['districtName'];                  
                        $district_arr[] = array("districtId" => $districtid, "districtName" => $district_name);
                    }
                 
                echo json_encode($district_arr); 
?>