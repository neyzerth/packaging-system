<?php
    require_once "../../config.php";
    require_once FPDF . "fpdf.php";

    function getReports() {
        try {
            $db = connectdb();
            $query = "SELECT * FROM report";
            $result = mysqli_query($db, $query);
            $reports = [];
            while($row = mysqli_fetch_assoc($result)){
                $reports[] = $row;
            }
            mysqli_close($db);
            return $reports;
        } catch (Exception $e) {
            return false; 
        }
    }

    function getFolio() {
        try {
            $db = connectdb();
            if ($db === false) {
                throw new Exception('Database connection error: ' . htmlspecialchars(mysqli_connect_error()));
            }

            $query = "SELECT MAX(folio) AS folio FROM report";
            $result = mysqli_query($db, $query);
            
            if ($result === false) {
                throw new Exception('Error executing the query: ' . htmlspecialchars(mysqli_error($db)));
            }
    
            $row = mysqli_fetch_assoc($result);
            mysqli_close($db);

            $nextFolio = ($row['folio'] !== null) ? $row['folio'] + 1 : 1;
    
            return $nextFolio;
    
        } catch (Exception $e) {
            return false;
        }
    }

    function getTraceabilities() {
        try {
            $db = connectdb();
            $query = "SELECT * FROM vw_traceability_info";
            $result = mysqli_query($db, $query);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }

    function addReport($start_date, $end_date, $report_date, $packed_products, $observations, $traceability) {
        try {
            $db = connectdb();
            if ($db === false) {
                throw new Exception('Database connection error: '. htmlspecialchars(mysqli_connect_error()));
            }
    
            $stmt = $db->prepare("CALL addReport(?,?,?,?,?,?)");
            if ($stmt === false) {
                throw new Exception('Error preparing the query: '. htmlspecialchars(mysqli_error($db)));
            }
    
            $stmt->bind_param("sssisi", $start_date, $end_date, $report_date, $packed_products, $observations, $traceability);
    
            $result = $stmt->execute();
            if ($result === false) {
                throw new Exception('Error executing the query: '. htmlspecialchars($stmt->error));
            }
    
            $stmt->close();
            $db->close();
    
            return $result;
    
        } catch (Exception $e) {
            return false;
        }
    }

    /*function searchReport($search){
        $db = connectdb();
        
        $search = $db->real_escape_string($search);

        $query = "SELECT * FROM report WHERE folio = $search";
        $result = $db->query($query);
        
        $reports = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $reports[] = $row;
            }
        }
        
        return $reports;
    }*/

    function generateReportPDF($folio, $start_date, $end_date, $report_date, $packed_products, $observations, $traceability) {
        $pdfDir = "../pdfReports/";
        if (!is_dir($pdfDir)) {
            mkdir($pdfDir, 0777, true);
        }
        
        $fileName = $pdfDir . "report_" . $folio . ".pdf";
        
        $pdf = new FPDF();

        $pdf->SetMargins(2.5, 3, 2.5);
        $pdf->SetAutoPageBreak(true, 3);

        $pdf->AddPage();
        
        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(0, 10, "Report Details", 0, 1, 'C');
        $pdf->Ln(10);
        
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(40, 10, "Folio:");
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(0, 10, $folio, 0, 1);
        
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(40, 10, "Start Date:");
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(0, 10, $start_date, 0, 1);
        
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(40, 10, "End Date:");
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(0, 10, $end_date, 0, 1);
        
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(40, 10, "Report Date:");
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(0, 10, $report_date, 0, 1);
        
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(40, 10, "Packed Products:");
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(0, 10, $packed_products, 0, 1);
        
        $pdf->Ln(5);
    
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(40, 10, "Observations:");
        $pdf->Ln(10);
        $pdf->SetFont('Times', '', 12);
        $pdf->MultiCell(0, 10, $observations, 0, 'J');
        
        $pdf->Ln(5);
    
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(40, 10, "Traceability:");
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(0, 10, $traceability, 0, 1);
        
        $pdf->Output("F", $fileName);
        return $fileName;
    }
        
    function checkProtocolFile($filename) {
        $filePath = REPORT . $filename;
        return file_exists($filePath);
    }

?>