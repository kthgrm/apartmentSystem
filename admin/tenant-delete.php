<?php
    require 'config/function.php';

    $paramResult = checkParamID('id');
    if(is_numeric($paramResult)){
        $tenantID = validate($paramResult);
        $tenant = getByID('tenant', $tenantID);
        if($tenant['status'] == 200){
            $tenantDelete = deleteQuery('tenant', $tenantID);
            if($tenantDelete){
                redirect("tenant.php", "Tenant deleted successfully." , 'success');
            }
        }else{
            redirect("tenant.php", $tenant['message'], 'error');
        }
    }else{
        redirect("tenant.php", $paramResult, 'error');
    }
?>