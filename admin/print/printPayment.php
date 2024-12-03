<?php

require '../../fpdf186/fpdf.php';
require '../../config/dbcon.php';

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 20);
        $this->Image('../assets/image/logo-g.png', 75, 31, 150, 150);
        $this->Cell(100, 10, 'Payment Report', 0, 1);
        $this->Ln(1);

        $this->SetFont('Arial', 'B', 11);
        $this->SetFillColor(255, 131, 0);
        $this->SetDrawColor(0, 0, 0);
        $this->Cell(15, 10, 'ID', 1, 0, '', true);
        $this->Cell(30, 10, 'Invoice', 1, 0, '', true);
        $this->Cell(30, 10, 'Unit', 1, 0, '', true);
        $this->Cell(50, 10, 'Tenant', 1, 0, '', true);
        $this->Cell(30, 10, 'Date', 1, 0, '', true);
        $this->Cell(30, 10, 'Amount', 1, 0, '', true);
        $this->Cell(40, 10, 'Payment Method', 1, 0, '', true);
        $this->Cell(50, 10, 'Reference Number', 1, 1, '', true);
    }

    function Footer() {
        $this->Cell(190, 0, '', 'T', 1);
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page '.$this->PageNo().'/{pages}', 0, 0, 'C');
    }
}

$pdf = new PDF('L', 'mm', 'A4');
$pdf->AliasNbPages('{pages}');
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->SetDrawColor(0, 0, 0);

$year = isset($_POST['year']) ? $_POST['year'] : 'all';
$month = isset($_POST['month']) ? $_POST['month'] : 'all';
$paymentMethod = isset($_POST['paymentMethod']) ? $_POST['paymentMethod'] : 'all';

$sql = "SELECT p.*, t.fname, t.lname, i.unitID FROM payment p JOIN tenant t ON p.tenantID = t.tenantID JOIN invoice i ON p.invoiceID = i.invoiceID WHERE 1=1";

if ($month != 'all') {
    $sql .= " AND LOWER(DATE_FORMAT(p.paymentDate, '%M')) = LOWER('$month')";
}

if ($year != 'all') {
    $sql .= " AND YEAR(p.paymentDate) = '$year'";
}

if ($paymentMethod != 'all') {
    $sql .= " AND p.paymentMethod = '$paymentMethod'";
}

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(15, 10, $row['paymentID'], 1, 0);
        $pdf->Cell(30, 10, $row['invoiceID'], 1, 0);
        $pdf->Cell(30, 10, $row['unitID'], 1, 0);
        $pdf->Cell(50, 10, $row['fname'].' '.$row['lname'], 1, 0);
        $pdf->Cell(30, 10, $row['paymentDate'], 1, 0);
        $pdf->Cell(30, 10, $row['paymentAmount'], 1, 0);
        $pdf->Cell(40, 10, $row['paymentMethod'], 1, 0);
        $pdf->Cell(50, 10, $row['referenceNum'], 1, 1);
    }
} else {
    $pdf->Cell(225, 10, 'No records found', 1, 1, 'C');
}

$pdf->Output();
?>