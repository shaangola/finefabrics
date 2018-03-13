<?php 
function getSubsMailFormat($mailparam){
	$mail_subject="Welcome to Fine Fabrics: Enjoy 10% Off In-Store. Online Sales Coming Soon";
	$mail_message=getMailerHeader($mailparam);
	$mail_message.='
	<div id="mailsub" class="notification" align="center">

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 320px;"><tr><td align="center" bgcolor="#333">


<table border="0" cellspacing="0" cellpadding="0" class="table_width_100" width="100%" style="max-width: 680px; min-width: 300px;">
    <tr><td>
	<div style="height: 80px; line-height: 80px; font-size: 10px;"></div>
	</td></tr>
	<tr><td align="center" bgcolor="#ffffff">
		<div style="padding:16px 15px; margin-top:10px; line-height: 20px; font-size: 10px;"><img src="'._SITE_URL_.'mailerimg/titte_headding.png" alt="titte_headding"/ > </div>
        <div style="padding:10px 15px; line-height: 15px; font-size: 10px;"><img src="'._SITE_URL_.'mailerimg/truelegance.png" alt="truelegance"/ > </div>
	</td></tr>
	
    
	<tr><td align="center" bgcolor="#ffffff">
		<table width="90%" border="0" cellspacing="0" cellpadding="0">
			<tr><td align="center">
				<div style="line-height: 44px; padding:0;">
					<img src="'._SITE_URL_.'mailerimg/banner.png" alt="Fine Fabrics design" />
				</div>
				<div style="height: 40px; line-height: 40px; font-size: 10px;"> </div>
			</td></tr>
			<tr><td align="center">
				<div style="line-height: 24px;">
					<img src="'._SITE_URL_.'mailerimg/store_text.png" alt="store_text"/ > 
				</div>
				<div style="font-size: 10px;"> </div>
			</td></tr>
			<tr><td align="center">
				<div>
				<img src="'._SITE_URL_.'mailerimg/new_store.png" alt="New In-Store" border="0" style="display: block;" />
				</div>
                <div style="height: 15px; line-height: 15px; font-size: 10px;"> </div>
				<div style="padding:15px; margin:0 auto; text-align:center">
                <a href="http://finefabrics.ca" target="_blank" style="text-align:center; display:block;">
                <img src="'._SITE_URL_.'mailerimg/fine_fabrics.png" alt="finefabrics.ca" align="middle" style="display:inline-block; vertical-align:top;" />
                </a>
                </div>
                <div><img src="'._SITE_URL_.'mailerimg/avenue.png" alt="Nomber" /></div>
                <div style="height: 30px; line-height: 30px; font-size: 10px;"> </div>
               
				
				<font face="Arial, Helvetica, sans-serif" size="3" color="#4db3a4" style="font-size: 14px;">
                <div style="font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#FFF; background:#0070c0; border-radius: 20px; padding:6px 15px; width:150px; margin:0 auto;">
                <span style="float:left; padding-top:5px; padding-left:8px;">Follow us on:</span>
                <a href="finefabrics.ca" target="_blank" title="follow us facebook" style="color:#FFFFFF;display:inline-block; width:20px;height:17px;margin-top:5px; padding-top:10x; text-align:center">
                <img src="'._SITE_URL_.'mailerimg/facebook_icon.png" alt="facebook_icon">
                
                </a>
                <a href="finefabrics.ca" target="_blank" title="follow us instagram" style="color:#FFFFFF;display:inline-block; width:20px;height:17px;margin-top:5px; padding-top:10x; text-align:center"><img src="'._SITE_URL_.'mailerimg/instagrame_icon.png" alt="instagrame_icon"></a></div>
                </font>
				
			</td></tr>
		</table>		
	</td></tr>

	<tr><td class="iage_footer" align="center" bgcolor="#ffffff">
		<div style="height: 25px; line-height: 45px; font-size: 10px;"> </div>	
		
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr><td align="center">
				<font face="Arial, Helvetica, sans-serif" size="3" color="#96a5b5" style="font-size: 13px;">
				<span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #96a5b5;">
					Copyright 2017@ finefabrics.ca .All Rights Reserved
				</span></font>				
			</td></tr>			
		</table>
		<div style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; padding-top:10px; color: #96a5b5;"> 
			To unsubscribe <a href="'._SITE_URL_.'unsubscribe.php?id='.md5($mailparam['id']).'">click here</a>
		</div>
		<div style="height: 40px; line-height: 60px; font-size: 14px;"></div>	
	</td></tr>
	
	<tr><td>
	<div style="height: 40px; line-height: 80px; font-size: 10px;"> </div>
	</td></tr>
</table>

</td></tr>
</table>
</div> ';

	//$mail_message.=getMailerFooter($mailparam);
	
	$reg_mail_param = array ("mail_subject" => $mail_subject,"mail_message" => $mail_message);
	return $reg_mail_param;
}


function getMailerHeader($mailparam){

	$mailheader='<style type="text/css">
				@font-face {
					font-family: "CenturyGothic";
					src: url("'._SITE_URL_.'/fonts/CenturyGothic.eot") format("embedded-opentype"), url("'._SITE_URL_.'/fonts/CenturyGothic.woff") format("woff"), url("'._SITE_URL_.'fonts/CenturyGothic.ttf") format("truetype"), url("'._SITE_URL_.'fonts/CenturyGothic.svg") format("svg");
					}
					h1{ font-family: LatoLight !important; }
					body {padding: 0;margin: 0;font-family: "CenturyGothic";}
					img{display:block; max-width:100%;}
				
					html { -webkit-text-size-adjust:none; -ms-text-size-adjust: none;}
					@media only screen and (max-device-width: 680px), only screen and (max-width: 680px) { 
					*[class="table_width_100"] {width: 96% !important;}
					*[class="border-right_mob"] {border-right: 1px solid #dddddd;}
					*[class="mob_100"] {width: 100% !important;}
					*[class="mob_center"] {text-align: center !important;}
					*[class="mob_center_bl"] {float: none !important;display: block !important;margin: 0px auto;}	
					.iage_footer a {text-decoration: none;color: #929ca8;}
					img.mob_display_none {width: 0px !important;height: 0px !important;display: none !important;}
					img.mob_width_50 {width: 40% !important;height: auto !important;}
				}
				
				a{text-decoration:none;color:#529dd2}
				a:hover{text-decoration:underline;}
				.table_width_100 {width: 680px;}
				.domain a{background:  url('._SITE_URL_.'mailerimg/fine_fabrics.png) no-repeat !important; padding:10px 103px !important;background-position:0px 10px;}
				.domain a:hover{background: url('._SITE_URL_.'mailerimg/fine_fabrics-hover.png)  no-repeat !important;}
				.follow_us{width:180px; margin:0 auto; background:#13cabf; border-radius:30px;padding: 9px 15px;color: #000;font-family: "CenturyGothic";}
				.follow_us a{color:#FFFFFF;padding:0px 8px;margin-left:15px;}
				.follow_us a.facebook_icon{background:url('._SITE_URL_.'mailerimg/icons.png) no-repeat;background-position:7px 2px;}
				.follow_us a.facebook_icon:hover{background:url('._SITE_URL_.'mailerimg/icons.png) no-repeat;background-position:7px -18px;}
				.follow_us a.instagrame{background:url('._SITE_URL_.'mailerimg/icons.png) no-repeat;background-position:-20px 2px;}
				.follow_us a.instagrame:hover{background:url('._SITE_URL_.'mailerimg/icons.png) no-repeat;background-position:-20px -17px;}
				
				</style>';



	
		return $mailheader;
}
function getMailerFooter($mailparam){
	$mailfooter='<table width="100%" border="0" cellspacing="0" cellpadding="0" class="full">
  					<tbody>
						<tr>
							<td align="center">
								<table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="devicewidth">
									<tbody>
										<tr>
											<td>
												<table width="100%" bgcolor="#f1f1f1" border="0" cellspacing="0" cellpadding="0" align="center" class="full">
													<tbody>
														<tr><td>&nbsp;</td></tr>
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>';
	$mailfooter.='<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="full">
  					<tbody>
						<tr>
    						<td align="center">
								<table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="devicewidth">
        							<tbody>
										<tr>
								          <td>
										  <table width="100%" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0" align="center" class="full" style="border-radius:0 0 7px 7px;">
										  	<tbody>
												<tr><td height="18">&nbsp;</td></tr>
              									<tr>
                									<td>
													<table class="inner" align="right" width="340" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; text-align:center;">
														<tbody>
															<tr>
																<td>
																<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                        											<tbody>
																		<tr>
												                          <td>
																		  <!--<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="full">
                              												<tbody>
																				<tr>
                                													<td align="center" style="font:11px Helvetica,  Arial, sans-serif; color:#ffffff;">
																					<a style="color:#000000; text-decoration:none;" href="#"> View in browser</a>
																					</td>
                                													<td style="color:#000000;"> | </td>
                                													<td align="center" style="font:11px Helvetica,  Arial, sans-serif; color:#ffffff;">
																					<a style="color:#000000; text-decoration:none;" href="#"> Send to a friend</a>
																					</td>
                                													<td class="hide" width="40" align="right">&nbsp;</td>
                             													 </tr>
                              													 <tr><td height="18">&nbsp;</td></tr>
																		 	 </tbody>
																			</table>-->
																			</td>
																		</tr>
																	  </tbody>
																	 </table>
																	</td>
																</tr>
															</tbody>
														</table>
														<table class="inner" align="left" width="230" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; text-align:center;">
															<tbody>
																<tr>
																  <td>
																  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
																	<tbody>
																		<tr>
																		<td align="center" style="font:11px Helvetica,  Arial, sans-serif; color:#000000;">
																			2016 &copy;  CONCEPT F. ALL Rights Reserved. 
																		</td>
																		</tr>
																		<tr><td height="18">&nbsp;</td></tr>
																	  </tbody>
																	</table>
																	</td>
																	</tr>
																</tbody>
															</table>
														</td>
													  </tr>
													</tbody>
												</table>
											</td>
										</tr>
										<tr><td height="20">&nbsp;</td></tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>';
			return $mailfooter;	

}

?>