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

            $tenantDelete = deleteQuery('tenant', $tenantID);
            if($tenantDelete){
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