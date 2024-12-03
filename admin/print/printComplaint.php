<?php

    require '../../fpdf186/fpdf.php';
    require '../../config/dbcon.php';

    class PDF extends FPDF{
        function Header(){
            $this->SetFont('Arial', 'B', 20);
            $this->Image('../assets/image/logo-g.png', 75, 31, 150, 150);
            $this->Cell(100, 10, 'Complaint Report', 0, 1);
            $this->Ln(1);

            $this->SetFont('Arial', 'B', 11);
            $this->SetFillColor(255, 131, 0);
            $this->SetDrawColor(0, 0, 0);
            $this->Cell(10, 10, 'ID', 1, 0, '', true);
            $this->Cell(50, 10, 'Name', 1, 0, '', true);
            $this->Cell(20, 10, 'Unit', 1, 0, '', true);
            $this->Cell(30, 10, 'Date', 1, 0, '', true);
            $this->Cell(50, 10, 'Subject', 1, 0, '', true);
            $this->Cell(80, 10, 'Description', 1, 0, '', true);
            $this->Cell(40, 10, 'Status', 1, 1, '', true);
        }

        function Footer(){
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
    $totalTenants = 0;

    if($_POST['status']=='all'){
        $query = "SELECT * FROM complaint JOIN tenant ON complaint.tenantID = tenant.tenantID";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
            while($complaint = mysqli_fetch_assoc($result)){
                $cellWidth = 80; // wrapped cell width
                $cellHeight = 10; // normal one-line cell height
                
                // Calculate the height needed for the complaintDescription cell
                if($pdf->GetStringWidth($complaint['complaintDescription']) < $cellWidth){
                    $line = 1;
                } else {
                    $textLength = strlen($complaint['complaintDescription']);
                    $errMargin = 10;
                    $startChar = 0;
                    $maxChar = 0;
                    $textArray = array();
                    $tmpString = "";

                    while($startChar < $textLength){
                        while($pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin) && ($startChar + $maxChar) < $textLength){
                            $maxChar++;
                            $tmpString = substr($complaint['complaintDescription'], $startChar, $maxChar);
                        }
                        $startChar = $startChar + $maxChar;
                        array_push($textArray, $tmpString);
                        $maxChar = 0;
                        $tmpString = '';
                    }
                    $line = count($textArray);
                }
                
                // Calculate the height of the row
                $height = $line * $cellHeight;
                
                // Write the cells
                $pdf->Cell(10, $height, $complaint['complaintID'], 1, 0);
                $pdf->Cell(50, $height, $complaint['fname'].' '.$complaint['lname'], 1, 0);
                $pdf->Cell(20, $height, $complaint['unitID'], 1, 0);
                $pdf->Cell(30, $height, $complaint['complaintDate'], 1, 0);
                $pdf->Cell(50, $height, $complaint['complaintSubject'], 1, 0);
                
                // Use MultiCell for the complaintDescription
                $xPos = $pdf->GetX();
                $yPos = $pdf->GetY();
                $pdf->MultiCell($cellWidth, $cellHeight, $complaint['complaintDescription'], 1);
                
                // Set the position for the next cell
                $pdf->SetXY($xPos + $cellWidth, $yPos);
                
                // Write the complaintStatus cell
                $pdf->Cell(40, $height, $complaint['complaintStatus'], 1, 1);
            }
        }
    }else{
        $query = "SELECT * FROM complaint JOIN tenant ON complaint.tenantID = tenant.tenantID WHERE complaintStatus = '".$_POST['status']."'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
            while($complaint = mysqli_fetch_assoc($result)){
                $cellWidth = 80; // wrapped cell width
                $cellHeight = 10; // normal one-line cell height
                
                // Calculate the height needed for the complaintDescription cell
                if($pdf->GetStringWidth($complaint['complaintDescription']) < $cellWidth){
                    $line = 1;
                } else {
                    $textLength = strlen($complaint['complaintDescription']);
                    $errMargin = 10;
                    $startChar = 0;
                    $maxChar = 0;
                    $textArray = array();
                    $tmpString = "";

                    while($startChar < $textLength){
                        while($pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin) && ($startChar + $maxChar) < $textLength){
                            $maxChar++;
                            $tmpString = substr($complaint['complaintDescription'], $startChar, $maxChar);
                        }
                        $startChar = $startChar + $maxChar;
                        array_push($textArray, $tmpString);
                        $maxChar = 0;
                        $tmpString = '';
                    }
                    $line = count($textArray);
                }
                
                // Calculate the height of the row
                $height = $line * $cellHeight;
                
                // Write the cells
                $pdf->Cell(10, $height, $complaint['complaintID'], 1, 0);
                $pdf->Cell(50, $height, $complaint['fname'].' '.$complaint['lname'], 1, 0);
                $pdf->Cell(20, $height, $complaint['unitID'], 1, 0);
                $pdf->Cell(30, $height, $complaint['complaintDate'], 1, 0);
                $pdf->Cell(50, $height, $complaint['complaintSubject'], 1, 0);
                
                // Use MultiCell for the complaintDescription
                $xPos = $pdf->GetX();
                $yPos = $pdf->GetY();
                $pdf->MultiCell($cellWidth, $cellHeight, $complaint['complaintDescription'], 1);
                
                // Set the position for the next cell
                $pdf->SetXY($xPos + $cellWidth, $yPos);
                
                // Write the complaintStatus cell
                $pdf->Cell(40, $height, $complaint['complaintStatus'], 1, 1);
            }
        }
    }

    $pdf->Output();
?>