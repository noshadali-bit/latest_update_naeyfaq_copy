<!DOCTYPE html>
<!--Code By Webdevtrick ( https://webdevtrick.com )-->
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>The Education Team | Registration Form</title>
   </head>
   <body>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
         <!--HEADER -->
         <tbody>
            <tr>
               <td align="center">
                  <table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0">
                     <tbody>
                        <tr>
                           <td align="center" valign="top" background="" bgcolor="" style="">
                           <table class="col-600" width="600" height="400" border="0" align="center" cellpadding="0" cellspacing="0">
                              <tbody>
                                 <tr>
                                    <td height="40"></td>
                                 </tr>
                                 <tr>
                                    <td align="center" style="line-height: 0px;">
                                       <img style="display:block; line-height:0px; font-size:0px; border:0px;" src="{{asset('web/images/logo.jpg')}}" alt="The Education Team">
                                    </td>
                                 </tr>
                                 <tr>
                                    <td align="center" style="font-family: 'Raleway', sans-serif;font-size:37px;color: #000;line-height:24px;font-weight: bold;letter-spacing: 5px;">
                                      Registration FORM
                                    </td>
                                 </tr>
                                 <tr>
                                    <td align="center" style="font-family: 'Lato', sans-serif;font-size:15px;color: #000;line-height:24px;font-weight: 300;">
                                       Registration form has been successfully submitted <br>Quick Review.
                                    </td>
                                 </tr>
                                 <tr>
                                    <td height="30"></td>
                                 </tr>
                              </tbody>
                           </table>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
            <!-- END HEADERR -->
            <!-- START SHOWCASE -->
            <tr>
               <td align="center">
                  <table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-left:20px;margin-right:20px;">
                     <tbody>
                        <tr>
                           <td height="35"></td>
                        </tr>
                        <tr>
                           <td align="center" style="font-family: 'Raleway', sans-serif; font-size:22px; font-weight: bold; color:#333;">Registration FORM</td>
                        </tr>
                        <tr>
                           <td height="10"></td>
                        </tr>
                        <tr>
                           <td align="left" style="font-family: 'Lato', sans-serif; font-size:14px; color:#757575;padding: 0px 51px;line-height: 0.8rem; font-weight: 300;">

                        <p>Full Name or Company Name : <b><?=$details['name']?> </b></p>

                        <p>Email : <b><?=$details['email']?> </b></p>

                           <p>Phone Number: <b><?=$details['phonenumber']?></b></p>

                        <p>State   : <b><?=$details['country']?> </b></p>

                         <p>City   : <b><?=$details['city']?> </b></p>

                        <p>Address   : <b><?=$details['address']?> </b></p>

                        <p>Zip Code : <b><?=$details['zipcode']?></b></p>

                        <a href="<?=$details['redirect_link']?>" target="_blank" >Verify your Account</a>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
            <tr>
               <td height="5"></td>
            </tr>
            <!-- END SHOWCASE -->
            <!--ABOUT -->
            <tr>
               <td align="center">
                  <table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-left:20px; margin-right:20px;">
                     <tbody>
                        <!-- END ABOUT -->
                        <!-- START FOOTER -->
                        <tr>
                           <td align="center">
                              <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" style="">
                                 <tbody>
                                    <tr>
                                       <td height="30"></td>
                                    </tr>
                                    <tr>
                                       <td align="center" bgcolor="" background="" height="185">
                                          <table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0">
                                             <tbody>
                                                <tr>
                                                   <td height="25"></td>
                                                </tr>
                                                <tr>
                                                   <td align="center" style="font-family: 'Raleway',  sans-serif;font-size:26px;font-weight: 500;color: #000;">Follow Us On Social Media</td>
                                                </tr>
                                                <tr>
                                                   <td height="25"></td>
                                                </tr>
                                             </tbody>
                                          </table>
                                          <table align="center" width="35%" border="0" cellspacing="0" cellpadding="0">
                                             <tbody>
                                                <tr>
                                                   <td align="center" width="30%" style="vertical-align: top;">
                                                      <a href="<?=Helper::config('twitterlink')?>" target="_blank"> <img src="{{asset('web/images/icon-twitter.png')}}"> </a>
                                                   </td>
                                                   <td align="center" class="margin" width="30%" style="vertical-align: top;">
                                                      <a href="<?=Helper::config('facebooklink')?>" target="_blank"> <img src="{{asset('web/images/icon-fb.png')}}"> </a>
                                                   </td>
                                                   <td align="center" width="30%" style="vertical-align: top;">
                                                      <a href="<?=Helper::config('linkedinlink')?>" target="_blank"> <img src="{{asset('web/images/icon-googleplus.png')}}"> </a>
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
                     </tbody>
                  </table>
               </td>
            </tr>
            <!-- END FOOTER -->
         </tbody>
      </table>
   

</body>
</html>