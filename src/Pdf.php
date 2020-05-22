<?php
namespace App;
require __DIR__ .'/../vendor/autoload.php';

use setasign\Fpdi\Tcpdf\Fpdi;
class Pdf
{
  public function __construct()
  {
    
  }

  public function signDocument()
  {
    $pdf = new Fpdi();
    $pages = $pdf->setSourceFile(__DIR__ . '/test.pdf');
    $certificate = "file://" . realpath("/home/jitu/.ssh/tcpdf.crt");
    $info = array(
      'Name' => 'TPS',
      'Location' => 'Auckland',
      'Reason' => 'Verifying Agreement',
      'ContactInfo' => 'http://www.tpsportal.co.nz',
      );
    for($i = 1; $i <= $pages; $i++){
      $pdf->AddPage();
      $page = $pdf->importPage($i);
      $pdf->useTemplate($page,0,0);

      $pdf->setSignature($certificate, $certificate, '', '', 2, $info);
    }
    $pdf->Output(__DIR__.'/test_signed2.pdf','F');
  }
}

$pdf = new Pdf();
$pdf->signDocument();