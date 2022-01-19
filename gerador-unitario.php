<?php 
// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');

// Set Local and input type
header("Content-type: text/html;charset=utf-8");


// ---------------------------------------------------------------------
$nome  = $_POST['nome-arquivo'];
$texto = $_POST['texto'];
$texto = '<div align="justify" style="line-height:150%;">'.$texto.'</div>';
// Image File Upload
/* Diretório para aonde a imagem será salva */
$dirIMG = "backgrounds/"; 
/* Caminho do arquivo com o diretório em que desejamos salva-lo */
$fileIMG = $dirIMG.basename($_FILES['fileIMG']['name']); 
/* Fazendo upload do arquivo */
move_uploaded_file($_FILES['fileIMG']['tmp_name'], $fileIMG);
/*
$imagem = $_FILES[imagem][tmp_name];
$caminhoIMG = "./backgrounds/";
$caminhoIMG = $caminhoIMG.$_FILES[imagem][name];
move_uploaded_file($imagem,$caminhoIMG);
*/
/*
$ext = pathinfo($arquivo['name']); // nome do arquivo
$exensao = $ext['extension']; 
$nome_imagem = time().'.'.$extensao; /// novo nome do arquivo
$caminho_imagem = $_SERVER['DOCUMENT_ROOT'].'/backgrounds/'.$nome_imagem;
move_uploaded_file($arquivo['tmp_name'], $caminho_imagem);
*/
// -------------------------------------------------------------------

    // Extend the TCPDF class to create custom Header and Footer
    class MYPDF extends TCPDF {
        //Page header
        public function Header() {
            // get the current page break margin
            $bMargin = $this->getBreakMargin();
            // get current auto-page-break mode
            $auto_page_break = $this->AutoPageBreak;
            // disable auto-page-break
            $this->SetAutoPageBreak(false, 0);
            // set bacground image
            $img_file = 'backgrounds/'.basename($_FILES['fileIMG']['name']);
            $this->Image($img_file, 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
            // restore auto-page-break status
            $this->SetAutoPageBreak($auto_page_break, $bMargin);
            // set the starting point for the page content
            $this->setPageMark();
        }
    }

    // -------------------------------------------------------------------

    ob_start();
    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Jack');
    $pdf->SetTitle('Certificado');
    $pdf->SetSubject('Certificado'.$nome);
    $pdf->SetKeywords('');

    // set header and footer fonts
    //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    // set margins
    $pdf->SetMargins(20, 0, 20);
    $pdf->SetHeaderMargin(0);
    $pdf->SetFooterMargin(0);


    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set font
    $pdf->SetFont('dejavusans', '', 16);

    // add a page
    $pdf->AddPage('L', 'A4');

    $pdf->SetY(80);
    //$pdf->SetLine-height(0,1);
    // Print a text
    $pdf->writeHTML($texto, true, false, true, false, '');

    // --- example with background set on page ---

    // ---------------------------------------------------------

    //Close and output PDF document
    $pdf->Output($_SERVER['DOCUMENT_ROOT'].'certificados/gerador-certificados/certificados/'.$nome.'.pdf', 'F');
    ob_clean();

//============================================================+
// END OF FILE
//======================