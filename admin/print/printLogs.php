<?php

    require '../../fpdf186/fpdf.php';
    require '../../config/dbcon.php';

    class PDF extends FPDF{
        function Header(){
            $this->SetFont('Arial', 'B', 20);
            $this->Cell(30);
            $this->Image('../../assets/image/logo-b.png', 10, 10, 25);
            $this->Cell(100, 25, 'Log Report', 0, 1);
            $this->Ln(5);

            $this->SetFont('Arial', 'B', 11);
            $this->SetFillColor(255, 131, 0);
            $this->SetDrawColor(255, 255, 255);
            $this->Cell(60, 10, 'Name', 1, 0, '', true);
            $this->Cell(60, 10, 'Date', 1, 0, '', true);
            $this->Cell(30, 10, 'Role', 1, 0, '', true);
            $this->Cell(40, 10, 'Log Type', 1, 1, '', true);
        }

        function Footer(){
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, 'Page '.$this->PageNo().'/{pages}', 0, 0, 'C');
        }
    }

    $pdf = new PDF('P', 'mm', 'A4');
    $pdf->AliasNbPages('{pages}');
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    $pdf->SetDrawColor(255, 255, 255);

    if(strtolower($_POST['type']) == 'all'){
        $query = "SELECT * FROM log l, admin a WHERE l.userID = a.adminID";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
            while($logItem = mysqli_fetch_assoc($result)){
                $pdf->Cell(60, 10, $logItem['fname']. ' '.$logItem['lname'], 1, 0);
                $pdf->Cell(60, 10, $logItem['logDateTime'], 1, 0);
                $pdf->Cell(30, 10, $logItem['type'], 1, 0);
                $pdf->Cell(40, 10, $logItem['logType'], 1, 1);
            }
        }

        $query = "SELECT * FROM log l, tenant t WHERE l.userID = t.tenantId";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
            while($logItem = mysqli_fetch_assoc($result)){
                $pdf->Cell(60, 10, $logItem['fname']. ' '.$logItem['lname'], 1, 0);
                $pdf->Cell(60, 10, $logItem['logDateTime'], 1, 0);
                $pdf->Cell(30, 10, $logItem['type'], 1, 0);
                $pdf->Cell(40, 10, $logItem['logType'], 1, 1);
            }
        }
    }else{
        if(strtolower($_POST['type']) == 'admin'){
            $query = "SELECT * FROM log l, admin a WHERE l.userID = a.adminID AND type LIKE '%" .strtolower($_POST['type']). "%'";
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) > 0){
                while($logItem = mysqli_fetch_assoc($result)){
                    $pdf->Cell(60, 10, $logItem['fname']. ' '.$logItem['lname'], 1, 0);
                    $pdf->Cell(60, 10, $logItem['logDateTime'], 1, 0);
                    $pdf->Cell(30, 10, $logItem['type'], 1, 0);
                    $pdf->Cell(40, 10, $logItem['logType'], 1, 1);
                }
            }
        }else{
            $query = "SELECT * FROM log l, tenant t WHERE l.userID = t.tenantId AND type LIKE '%" .strtolower($_POST['type']). "%'";
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) > 0){
                while($logItem = mysqli_fetch_assoc($result)){
                    $pdf->Cell(60, 10, $logItem['fname']. ' '.$logItem['lname'], 1, 0);
                    $pdf->Cell(60, 10, $logItem['logDateTime'], 1, 0);
                    $pdf->Cell(30, 10, $logItem['type'], 1, 0);
                    $pdf->Cell(40, 10, $logItem['logType'], 1, 1);
                }
            }
        }
    }

    $pdf->Output();
?>