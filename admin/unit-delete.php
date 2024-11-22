<?php
    require '../config/function.php';

    $paramResult = checkParamID('id');
    if(is_numeric($paramResult)){
        $unitID = validate($paramResult);
        $unit = getByIdUnit('unit', $unitID);
        if($unit['status'] == 200){
            $unitDelete = deleteQueryUnit('unit', $unitID);
            if($unitDelete){
                redirect("unit.php", "Unit deleted successfully." , 'success');
            } else {
                redirect("unit.php", "Tenant record restricts delete.", 'error');
            }
        } else {
            redirect("unit.php", $unit['message'], 'error');
        }
    } else {
        redirect("unit.php", $paramResult, 'error');
    }
?>