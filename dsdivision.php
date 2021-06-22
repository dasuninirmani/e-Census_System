
<?php
include "config.php";

                $districtId=0;
				
                if(isset($_POST['district'])){
					$districtId = mysqli_real_escape_string($link,$_POST['district']); 
					
					}
                   
                    $dsdivision_arr = array();

                    $ds_res=mysqli_query($link,"Select divisionalSecretariatId,divisionalSecretariatName from divisionalsecretariat WHERE districtId='".$districtId."'");
                     while($row=mysqli_fetch_array($ds_res))
                    { 
                        $dsdivisionid = $row['divisionalSecretariatId'];
                        $dsdivision_name = $row['divisionalSecretariatName'];                  
                        $dsdivision_arr[] = array("divisionalSecretariatId" => $dsdivisionid, "divisionalSecretariatName" => $dsdivision_name);
                    }
                 
                echo json_encode($dsdivision_arr); 
?>