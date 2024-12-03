<?php

    require '../../fpdf186/fpdf.php';
    require '../../config/dbcon.php';

    class PDF extends FPDF{
        function Header(){
            $this->SetFont('Arial', 'B', 20);
            $this->Image('../assets/image/logo-g.png', 30, 75, 150, 150);
            $this->Cell(100, 10, 'Tenant Report', 0, 1);
            $this->Ln(1);

            $this->SetFont('Arial', 'B', 11);
            $this->SetFillColor(255, 131, 0);
            $this->SetDrawColor(0, 0, 0);
            $this->Cell(10, 10, 'ID', 1, 0, '', true);
            $this->Cell(30, 10, 'First Name', 1, 0, '', true);
            $this->Cell(30, 10, 'Middle Name', 1, 0, '', true);
            $this->Cell(25, 10, 'Last Name', 1, 0, '', true);
            $this->Cell(35, 10, 'Contact Number', 1, 0, '', true);
            $this->Cell(50, 10, 'Email', 1, 0, '', true);
            $this->Cell(10, 10, 'Unit', 1, 1, '', true);
        }

        function Footer(){
            $this->Cell(190, 0, '', 'T', 1);
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
    $totalTenants = 0;

    if($_POST['unit']=='all'){
        $query = "SELECT * FROM tenant";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
            while($tenant = mysqli_fetch_assoc($result)){
                $pdf->Cell(10, 10, $tenant['tenantID'], 1, 0);
                $pdf->Cell(30, 10, $tenant['fname'], 1, 0);
                $pdf->Cell(30, 10, $tenant['mname'], 1, 0);
                $pdf->Cell(25, 10, $tenant['lname'], 1, 0);
                $pdf->Cell(35, 10, $tenant['contact'], 1, 0);
                $pdf->Cell(50, 10, $tenant['email'], 1, 0);
                $pdf->Cell(10, 10, $tenant['unitID'], 1, 1);
                $totalTenants++;
            }
        }
    }else{
        $query = "SELECT * FROM tenant WHERE unitID = '".$_POST['unit']."'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
            while($tenant = mysqli_fetch_assoc($result)){
                $pdf->Cell(10, 10, $tenant['tenantID'], 'LR', 0);
                $pdf->Cell(30, 10, $tenant['fname'], 'LR', 0);
                $pdf->Cell(30, 10, $tenant['mname'], 'LR', 0);
                $pdf->Cell(25, 10, $tenant['lname'], 'LR', 0);
                $pdf->Cell(35, 10, $tenant['contact'], 'LR', 0);
                $pdf->Cell(50, 10, $tenant['email'], 'LR', 0);
                $pdf->Cell(10, 10, $tenant['unitID'], 'LR', 1);
                $totalTenants++;
            }
        }
    }

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(190, 10, 'Total Tenants: ' . $totalTenants, 1, 1, 'C');

    $pdf->Output();
?>