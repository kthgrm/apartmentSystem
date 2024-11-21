<?php
    require '../config/function.php';

    $paramResult = checkParamID('id');
    if(is_numeric($paramResult)){
        $tenantID = validate($paramResult);
        $tenant = getByID('tenant', $tenantID);
        if($tenant['status'] == 200){
            if (!empty($tenant['data']['tenantImage']) && file_exists('../'.$tenant['data']['tenantImage'])) {
                unlink('../'.$tenant['data']['tenantImage']);
            }

            $tenantUnit = $tenant['data']['unitID'];
            $tenantDelete = deleteQuery('tenant', $tenantID);
            if($tenantDelete){
                $query = "SELECT COUNT(*) AS tenantCount FROM tenant WHERE unitID = '$tenantUnit'";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    if ($row['tenantCount'] == 0) {
                        $query2 = "UPDATE unit SET status = 'vacant' WHERE unitID = '$tenantUnit'";
                        $result2 = mysqli_query($conn, $query2);
                    }
                }
                redirect("tenant.php", "Tenant deleted successfully." , 'success');
            } else {
                redirect("tenant.php", "Failed to delete tenant.", 'error');
            }
        } else {
            redirect("tenant.php", $tenant['message'], 'error');
        }
    } else {
        redirect("tenant.php", $paramResult, 'error');
    }
?>