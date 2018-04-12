<?php
$link = mysql_connect("localhost", "root", "");
mysql_select_db("supermercados",$link);   
$ID_ven                 = $_GET['ID_ven'];
$ID_caj                 = $_GET['ID_caj'];
$get_mov_caja = 'SELECT articulos.ID_art, articulos.art_unidad, sum(mov_cantidad) AS mov_cantidad, articulos.art_desc, sum(pre_cant) AS pre_cant, sum(mov_cantidad*pre_cant) AS multiplicacion, ID_mov, mov_sal, mov_descuento, pre_iva, (((mov_cantidad*pre_cant)*pre_iva)/100) AS precioSinIva FROM caja, venta, mov_caja, articulos, precios where precios.ID_pre=articulos.ID_pre AND articulos.ID_art=mov_caja.ID_art AND mov_caja.ID_ven=venta.ID_ven AND venta.ID_caj=caja.ID_caj AND caja.ID_caj='.$ID_caj.' AND venta.ID_ven='.$ID_ven.' group by articulos.ID_art'; 
                  $get_mov_cajaByIdVen =mysql_query($get_mov_caja);
$num_get_mov_cajaById               =   mysql_num_rows($get_mov_cajaByIdVen);
require('librerias/fpdf/fpdf.php');
$pdf              = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',8);
            

 $pdf->Cell(20,10,'CANT.',1,0,'C');
       $pdf->Cell(80,10,'ARTICULO',1,0,'C');
       $pdf->Cell(20,10,'PRECIO',1,0,'C') ;
       $pdf->Cell(20,10,'SUBTOTAL',1,0,'C');
       $pdf->ln();
       $mov_salA=0;
       $precioFinalParaImpresion=0;
       for ($contador=0; $contador < $num_get_mov_cajaById; $contador++) 
       {
            $assoc_get_mov_cajaById               =   mysql_fetch_assoc($get_mov_cajaByIdVen);
            $mov_cantidad     = $assoc_get_mov_cajaById['mov_cantidad'];
            $art_desc         = $assoc_get_mov_cajaById['art_desc'];
            $pre_cant         = $assoc_get_mov_cajaById['pre_cant'];
            $mov_sal        = $assoc_get_mov_cajaById['mov_sal'];

            $precioFinalParaImpresionA = ($assoc_get_mov_cajaById['pre_cant']*$assoc_get_mov_cajaById['pre_iva'])/100;
        $precioFinalParaImpresion  = $assoc_get_mov_cajaById['pre_cant']+$precioFinalParaImpresionA;

            $pdf->Cell(20,10,$mov_cantidad,1,0,'C');
          $pdf->Cell(80,10,$art_desc,1,0,'C');
          $pdf->Cell(20,10,'$ '.$precioFinalParaImpresion,1,0,'C') ;
          $pdf->Cell(20,10,'$ '.$mov_sal,1,0,'C');
          $pdf->ln();
          $mov_salA=$mov_salA+$mov_sal;
       }

       $pdf->Cell(100,10,'TOTAL',1,0,'C');
       $pdf->Cell(40,10,'$ '.$mov_salA,1,0,'C');
$pdf->Output();
?>