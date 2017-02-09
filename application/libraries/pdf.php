<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



require_once APPPATH . '/third_party/mpdf/mpdf.php';

class Pdf extends mPDF
{
    function __construct()
    {
        parent::__construct();
       
    }
    
    function generate_report($data){
       
      
//==============================================================
//==============================================================
//==============================================================

       

//$mpdf=new mPDF('c','A4','','',15,15,30,0,10,10); 
$mpdf=new mPDF('c','A4','','',15,15,37,47,10,0); 

	// Use different Odd/Even headers and footers and mirror margins
$header = '
<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt;background-color:#2A3F54; border-width: 0 0 1px; z-index: 1000; margin-top:10px; margin-bottom:30px">
<tr>
<td width="55%">
<img style="float:left;vertical-align: middle;" width="70px" alt="" src="'.base_url($data['org_logo']).'">
<span style="display: inline; line-height: 1.42857; font-size: 130%; font-weight: bold; position: relative; top: 20px; color: #ecf0f1;">'.$data['org_name'].'</span>
</td>
<td width="45%" valign="middle">
<span style="display: inline; line-height: 1.42857; font-size: 11px; font-weight: bold; position: relative; top: 20px; color: #ecf0f1;">Report Period | '.$data['start_date'].' to '.$data['end_date'].'</span>
</td>
</tr>
  
</table>';

$stylesheet = file_get_contents(base_url().'assets/css/common/report.css'); 

//// external css 

$footer = '

	<table style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic; border-top:1px solid black;" width="100%">
		<tbody>
			<tr>
				<td width="90%">
<span style="display: inline; line-height: 1.42857; font-size: 130%; font-weight: bold; position: relative; top: 20px; color: #888;">'.$data['org_name'].'</span></td>
				<td align=right style="font-weight: bold; font-style: italic;" align="center" width="10%">{PAGENO}/{nbpg}</td>
				
			</tr>
                    
		</tbody>
	</table>';


$mpdf->WriteHTML($stylesheet,1);

$mpdf->SetHTMLHeader($header);

//$mpdf->setFooter('{PAGENO} of {nb}');
$mpdf->WriteHTML($data['html'],2);
$mpdf->SetHTMLFooter($footer);

$mpdf->Output("$data[heading].pdf","D");
exit;
    }
}