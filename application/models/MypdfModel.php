<?php

/**
 * 用户Model
 */
class MypdfModel extends TCPDF{
	
//Page header
	public function Header() {
   		$html=<<< EOD
		<table style="width:595px;font-size:11px;">
			<tr>
				<td width="30%"></td>
				<td valign="bottom" style="font-size:11px" width="50%">Werner-von-Siemens-Str.2 ‚ 64319 Pfungstadt</td>
				<td><img src="img/logo1.png"/></td>
			</tr>
		</table>
	
EOD;
	$this->WriteHTML($html, true, false, true, false, '');
}

// Page footer
	public function Footer() {
	// Position at 15 mm from bottom
	$html=<<< EOD
		<div style="text-align:center;width:595px;margin-bottom:100px;font-size:11px;color:#666">
			<table cellpadding="0" cellspacing="0" style="text-align:left;width:100%">
				<tr><td><b>QSH Engineering & Business GmbH</b><br />  
					Werner-von-Siemens-Str.2 D-64319 Pfungstadt<br />
					Tel.:  +49(0) 6157 9892870<br />  
					FAX.  +49(0) 6157 9892872<br />  
					E-Mail: info@qsh-germany.com<br />
					Internet: www.qsh-germany.com<br />
					</td>
					<td><b>Geschaeftsfuehrer</b><br />
						M.S. Ing. Minzhi Qi<br />  
						Steuer-Nr.: 00724150998<br />
						Ust.-IdNr.: DE292590334<br />   
						Amtsgericht Darmstadt<br />
						HRB: 92629<br /> 
					</td>
					<td><b>Bankverbindungen</b><br />
					Commerzbank Darmstadt<br />
					Konto: 552644700<br />
					BLZ: 508 400 05<br />
					IBAN: DE93 5084 0005 0552 6447 00<br />
					BIC: COBADEFFXXX<br />
					</td>
				</tr>
			</table>
		</div>
EOD;
	$this->WriteHTML($html, true, false, true, false, '');
	}
}
