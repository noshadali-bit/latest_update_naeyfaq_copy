<!DOCTYPE html>

<!--Code By Webdevtrick ( https://webdevtrick.com )-->

<html lang="en">

   <head>

      <meta charset="UTF-8">

      <title>The Education Team | Newsletter</title>

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

                           <td align="center" valign="top" background="{{asset('web/images/background-image-newletter.jpg')}}" bgcolor="#66809b" style="background-size:cover; background-position:top; background-size: cover;

    background-repeat: no-repeat;">

                           <table class="col-600" width="600" height="400" border="0" align="center" cellpadding="0" cellspacing="0">

                              <tbody>

                                 <tr>

                                    <td height="40"></td>

                                 </tr>

                                 <tr>

                                    <td align="center" style="line-height: 0px;">

                                       <img style="display:block; line-height:0px; font-size:0px; border:0px;" src="{{asset('web/images/logo.jpg')}}"  alt="The Education Team">

                                    </td>

                                 </tr>

                                 <tr>

                                    <td align="center" style="font-family: 'Raleway', sans-serif; font-size:37px; color:#ffffff; line-height:24px; font-weight: bold; letter-spacing: 5px;">

                                       WELCOME <span style="font-family: 'Raleway', sans-serif; font-size:37px; color:#ffffff; line-height:39px; font-weight: 300; letter-spacing: 5px;">TO NEWSLETTER</span>

                                    </td>

                                 </tr>

                                 <tr>

                                    <td align="center" style="font-family: 'Lato', sans-serif; font-size:15px; color:#ffffff; line-height:24px; font-weight: 300;">

                                       Now you will recive Email everytime automatically <br>on our new updates.

                                    </td>

                                 </tr>

                                 <tr>

                                    <td height="50"></td>

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

            @if($details['type'] == "user")

            <tr>

               <td align="center">

                  <table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-left:20px; margin-right:20px; border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9;">

                     <tbody>

                        <tr>

                           <td height="35"></td>

                        </tr>

                        <tr>

                           <td align="center" style="font-family: 'Raleway', sans-serif; font-size:22px; font-weight: bold; color:#333;">CONTENT SHOWCASE</td>

                        </tr>

                        <tr>

                           <td height="10"></td>

                        </tr>

                        <tr>

                           <td align="center" style="font-family: 'Lato', sans-serif; font-size:14px; color:#757575; line-height:24px; font-weight: 300;">

                              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur convallis maximus mollis.<br> Aenean purus magna, dignissim in aliquam quis, ullamcorper a dui.

                           </td>

                        </tr>

                     </tbody>

                  </table>

               </td>

            </tr>

           @else

           <tr>

               <td align="center">

                  <table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-left:20px; margin-right:20px; border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9;">

                     <tbody>

                        <tr>

                           <td height="35"></td>

                        </tr>

                        <tr>

                           <td align="center" style="font-family: 'Raleway', sans-serif; font-size:22px; font-weight: bold; color:#333;">User Subscribe</td>

                        </tr>

                        <tr>

                           <td height="10"></td>

                        </tr>

                        <tr>

                           <td align="center" style="font-family: 'Lato', sans-serif; font-size:14px; color:#757575; line-height:24px; font-weight: 300;">

                              A User has been successfully subscribe to <?= env('APP_NAME')?>, User email address is <?=$details['body']?>

                           </td>

                        </tr>

                     </tbody>

                  </table>

               </td>

            </tr>

           @endif

            

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

                              <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" style=" border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9;">

                                 <tbody>

                                    <tr>

                                       <td height="50"></td>

                                    </tr>

                                    <tr>

                                       <td align="center" bgcolor="#333" background="{{asset('web/images/background-image-newletter.jpg')}}" height="185">

                                          <table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0">

                                             <tbody>

                                                <tr>

                                                   <td height="25"></td>

                                                </tr>

                                                <tr>

                                                   <td align="center" style="font-family: 'Raleway',  sans-serif; font-size:26px; font-weight: 500; color:#fbb016; background-color: #333;">Follow Us On Social Media</td>

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

                                                      <a href="<?=Helper::config('twitterlink')?>" target="_blank"> <img src="https://webdevtrick.com/wp-content/uploads/icon-twitter.png"> </a>

                                                   </td>

                                                   <td align="center" class="margin" width="30%" style="vertical-align: top;">

                                                      <a href="<?=Helper::config('facebooklink')?>" target="_blank"> <img src="https://webdevtrick.com/wp-content/uploads/icon-fb.png"> </a>

                                                   </td>

                                                   <td align="center" width="30%" style="vertical-align: top;">

                                                      <a href="<?=Helper::config('linkedinlink')?>" target="_blank"> <img src="https://webdevtrick.com/wp-content/uploads/icon-googleplus.png"> </a>

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