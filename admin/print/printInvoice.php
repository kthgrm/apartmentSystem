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
            $this->Cell(15, 10, 'ID', 1, 0, '', true);
            $this->Cell(15, 10, 'Unit', 1, 0, '', true);
            $this->Cell(35, 10, 'Month', 1, 0, '', true);
            $this->Cell(25, 10, 'Amount', 1, 0, '', true);
            $this->Cell(35, 10, 'Issue', 1, 0, '', true);
            $this->Cell(35, 10, 'Due', 1, 0, '', true);
            $this->Cell(30, 10, 'Status', 1, 1, '', true);
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

    $sort = $_POST['sort'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    $sql = "SELECT * FROM invoice WHERE 1=1";

    if($sort != 'all'){
        $sql .= " AND paymentStatus = '$sort'";
    }

    if($month != 'all'){
        $sql .= " AND LOWER(monthYear) LIKE LOWER('%$month%')";
    }

    if($year != 'all'){
        $sql .= " AND monthYear LIKE '%$year%'";
    }

    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $pdf->Cell(15, 10, $row['invoiceID'], 1, 0);
            $pdf->Cell(15, 10, $row['unitID'], 1, 0);
            $pdf->Cell(35, 10, $row['monthYear'], 1, 0);
            $pdf->Cell(25, 10, $row['rentAmount'], 1, 0);
            $pdf->Cell(35, 10, $row['issueDate'], 1, 0);
            $pdf->Cell(35, 10, $row['dueDate'], 1, 0);
            $pdf->Cell(30, 10, $row['paymentStatus'], 1, 1);
        }
    } else {
        $pdf->Cell(190, 10, 'No records found', 1, 1, 'C');
    }


    $pdf->Output();
?>