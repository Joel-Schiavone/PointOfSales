<?php
@session_start();
include_once('inc/conectar.php');
include_once('inc/classes.php');
include_once('inc/classesExclusivas.php');
include_once('librerias/fpdf/fpdf.php');
$cantidad_De_Articulos_Por_Pagina               =     10; // CAMBIAR NUMERO PARA ACOMODAR CANTIDAD DE ARTICULOS AL TAMAÑO DE IMPRECION REQUERIDO
$comprobantesE                                  =     new comprobantesE;
$detalle_comprobantesE                          =     new detalle_comprobantesE;
//Recibe variable para buscar comprobantes
$ID_cte                                         =     $_GET['ID_cte'];

//buscar comprobante
$get_cabecera_comprobantesById                  =     $comprobantesE->get_cabecera_comprobantesById($ID_cte);
$assoc_get_cabecera_comprobantesById            =     mysql_fetch_assoc($get_cabecera_comprobantesById);

//Si tiene detalles, busca detalles
$detalle_comprobantesById                       =     $detalle_comprobantesE->get_detalle_comprobantesById($ID_cte);
$num_detalle_comprobantesById                   =     mysql_num_rows($detalle_comprobantesById);

if ($num_detalle_comprobantesById<=9) 
{
     $paginas                                   =     1;  
}
else
{
     $paginasA                                  =     $num_detalle_comprobantesById/$cantidad_De_Articulos_Por_Pagina; 
     $paginas                                   =     ceil($paginasA);
}

$pdf                                            =     new FPDF('P','mm','A4');

$pdf->SetFont('Arial','B',8);

for ($contador_de_paginas=0; $contador_de_paginas < $paginas ; $contador_de_paginas++) 
{ 
     $pdf->addPage();
     $pdf->Cell(20,10,$paginas,1,0,'C');
     $pdf->Cell(20,10,$num_detalle_comprobantesById,1,0,'C');
}


$pdf->Output();
?>