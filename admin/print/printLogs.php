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
            $this->SetDrawColor(0, 0, 0);
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
    $pdf->SetDrawColor(0, 0, 0);

    $type = strtolower($_POST['type']);
    $sort = isset($_POST['sort']) ? strtolower($_POST['sort']) : 'latest';
    $orderBy = $sort == 'oldest' ? 'ASC' : 'DESC';

    if($type == 'all'){
        $query = "SELECT * FROM (
                    SELECT l.logDateTime, CONCAT(a.fname, ' ', a.lname) AS name, 'admin' AS role, l.logType
                    FROM log l
                    JOIN admin a ON l.userID = a.adminID
                    UNION
                    SELECT l.logDateTime, CONCAT(t.fname, ' ', t.lname) AS name, 'tenant' AS role, l.logType
                    FROM log l
                    JOIN tenant t ON l.userID = t.tenantID
                ) AS combined_logs
                ORDER BY logDateTime $orderBy";
    } elseif($type == 'admin'){
        $query = "SELECT l.logDateTime, CONCAT(a.fname, ' ', a.lname) AS name, 'admin' AS role, l.logType
                FROM log l
                JOIN admin a ON l.userID = a.adminID
                ORDER BY l.logDateTime $orderBy";
    } elseif($type == 'tenant'){
        $query = "SELECT l.logDateTime, CONCAT(t.fname, ' ', t.lname) AS name, 'tenant' AS role, l.logType
                FROM log l
                JOIN tenant t ON l.userID = t.tenantID
                ORDER BY l.logDateTime $orderBy";
    }

    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
        while($logItem = mysqli_fetch_assoc($result)){
            $pdf->Cell(60, 10, $logItem['name'], 1, 0);
            $pdf->Cell(60, 10, $logItem['logDateTime'], 1, 0);
            $pdf->Cell(30, 10, $logItem['role'], 1, 0);
            $pdf->Cell(40, 10, $logItem['logType'], 1, 1);
        }
    }

    $pdf->Output();
?>