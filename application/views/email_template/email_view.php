
                        <td valign="top" style="padding:40px 0 0;">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size: 13px;">
                            <tbody>
                              <tr style="margin: 0; padding: 0;">
                                <td valign="top" style="padding: 0 26px 0 26px;"><table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size: 13px;">
                                    <tbody>
                                 
                                      <tr>
                                        <td width="100%" valign="top" align="left" style="color: inherit; font-size: inherit; font-weight: inherit; line-height: 1; text-decoration: inherit; font-family: Arial;"><div style="margin: 0; outline: none; padding: 0; text-align: center;"> <span style="color: #4b4b4b; font-size: 30px; font-weight: inherit; line-height: 1.2; text-decoration: inherit; text-align: inherit; font-family: verdana;"><?php if(isset($email_heading))echo $email_heading;?></span></div></td>
                                      </tr>
                                    </tbody>
                                 
                                  </table>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td valign="top" style="padding: 40px 0 0;">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size: 13px;">
                            <tbody>
                              <tr style="margin: 0; padding: 0;">
                                <td valign="top" style="padding: 0 26px 0 26px;">
                                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size: 13px;">
                                    <tbody>
                                      <tr>
                                        <td width="100%" valign="top" align="left" style="color: inherit; font-size: inherit; font-weight: inherit; line-height: 1; text-decoration: inherit; font-family: Arial;"><div style="margin: 0; outline: none; padding: 0; text-align: left;">
                                            <div style="margin: 0; outline: none; padding: 0; color: inherit; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;"> <div style="color: #5c5c5c; font-size: 16px; font-weight: inherit; line-height: 1.7; text-decoration: inherit; font-family: verdana;"><?php echo $content;?></div></div>
                                          </div>
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
                     <tr>
                        <td valign="top">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size: 13px; padding: 0;">
                            <tbody>
                              <tr>
                                <td valign="top">
                                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size: 13px;">
                                    <tbody>
                                      <tr>
                                        <td width="100%" valign="top" align="left">

                                            <!--<div style="margin: 0; outline: none; padding: 0 0 10px 0; text-align: center;"><a style="margin: 0; outline: none; padding: 10px 20px; background-color: #4cc09c; border: 3px solid #4cc09c; border-radius: 6px; color: #ffffff; font-family: verdana; font-size: 18px; display: inline-block; text-align: center; text-decoration: none; mso-hide: all;" href="<?php if(isset($link)){echo $link;} else{echo  base_url();}?>"> <span style="color:#ffffff;"> &nbsp; &nbsp;<?php if(isset($btntitle)){ echo $btntitle;}else{echo 'Login now'; }?> &nbsp;&nbsp; </span> </a> </div></td>-->

                                      </tr>
                                    
                                    </tbody>
                                  </table>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td valign="top">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size: 13px;">
                            <tbody>
                                 <?php if((isset($ticket_detail['ticket_attachment'])) && (!empty($ticket_detail['ticket_attachment']))){ ?>
                              <tr>
                                <td valign="top">
                                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size: 13px;">
                                    <tbody>
                                      <tr>
                                        <td valign="top">
                                            <div style="margin: 0; outline: none; padding: 0 0 20px 0; height:auto;" >
                                            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size: 13px;">
                                              <tbody>
                                                 <tr>  <td width="100%" valign="top">&#128206; Attachment <?php echo '('.count($ticket_detail['ticket_attachment']).')';?></td></tr> 
                                                <tr>
                                                  <?php if(isset($note)){ ?>
                                                  <td width="100%" valign="top">&nbsp;<?php echo $note;?></td>
                                                  <?php } ?>
                                                 
                                                
                                                  <td width="100%" valign="top">
                                                      <ul style="list-style: none;padding:8px 0 0 10px;"> <?php foreach($ticket_detail['ticket_attachment'] as $att){?>
                       <li style="margin-top: 3px;"><a style="color:black; padding-bottom: 5px;" target="_self" href ="<?php echo base_url().'common/download/'.$att['attachment_id'];?>"><?php echo $att['attachment_name'];?></a></li>    
                                                  <?php };?></ul></td>
                                                 
                                                </tr>
                                              </tbody>
                                            </table>
                                          </div>                                            
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>                                    
                                </td>
                              </tr><?php } ?>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                     