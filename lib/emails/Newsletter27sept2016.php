<?php
namespace JCarignan\tickets\Newsletter27sept2016;
use Roots\Sage\Extras;

function get_html($subject, $ticket)
{
    return '<!doctype html>
            <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
                <head>
                    <!-- NAME: 1 COLUMN - BANDED -->
                    <!--[if gte mso 15]>
                    <xml>
                        <o:OfficeDocumentSettings>
                        <o:AllowPNG/>
                        <o:PixelsPerInch>96</o:PixelsPerInch>
                        </o:OfficeDocumentSettings>
                    </xml>
                    <![endif]-->
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <title>'.$subject.'</title>
                     <style type="text/css">
                            @import url(https://fonts.googleapis.com/css?family=Noto+Sans:400,700);
                            div[style*="margin: 16px 0"] {
                                margin:0 !important;
                            }
                            @media only screen and (max-width: 600px){
                                .ticket-infos {
                                    max-width: 400px !important;
                                }
                            }

                            p{
                                margin:10px 0;
                                padding:0;
                            }
                            table{
                                border-collapse:collapse;
                            }
                            h1,h2,h3,h4,h5,h6{
                                display:block;
                                margin:0;
                                padding:0;
                            }
                            img,a img{
                                border:0;
                                height:auto;
                                outline:none;
                                text-decoration:none;
                            }
                            body,#bodyTable,#bodyCell{
                                height:100%;
                                margin:0;
                                padding:0;
                                width:100%;
                            }
                            #outlook a{
                                padding:0;
                            }
                            img{
                                -ms-interpolation-mode:bicubic;
                            }
                            table{
                                mso-table-lspace:0pt;
                                mso-table-rspace:0pt;
                            }
                            .ReadMsgBody{
                                width:100%;
                            }
                            .ExternalClass{
                                width:100%;
                            }
                            p,a,li,td,blockquote{
                                mso-line-height-rule:exactly;
                            }
                            a[href^=tel],a[href^=sms]{
                                color:inherit;
                                cursor:default;
                                text-decoration:none;
                            }
                            p,a,li,td,body,table,blockquote{
                                -ms-text-size-adjust:100%;
                                -webkit-text-size-adjust:100%;
                            }
                            .ExternalClass,.ExternalClass p,.ExternalClass td,.ExternalClass div,.ExternalClass span,.ExternalClass font{
                                line-height:100%;
                            }
                            a[x-apple-data-detectors]{
                                color:inherit !important;
                                text-decoration:none !important;
                                font-size:inherit !important;
                                font-family:inherit !important;
                                font-weight:inherit !important;
                                line-height:inherit !important;
                            }
                            .templateContainer{
                                max-width:600px !important;
                            }
                            a.mcnButton{
                                display:block;
                            }
                            .mcnImage{
                                vertical-align:bottom;
                            }
                            .mcnTextContent{
                                word-break:break-word;
                            }
                            .mcnTextContent img{
                                height:auto !important;
                            }
                            .mcnDividerBlock{
                                table-layout:fixed !important;
                            }
                            body,#bodyTable{
                                /*@editable*/background-color:#FAFAFA;
                            }
                            #bodyCell{
                                /*@editable*/border-top:0;
                            }
                            h1{
                                /*@editable*/color:#202020;
                                /*@editable*/font-family:Helvetica;
                                /*@editable*/font-size:26px;
                                /*@editable*/font-style:normal;
                                /*@editable*/font-weight:bold;
                                /*@editable*/line-height:125%;
                                /*@editable*/letter-spacing:normal;
                                /*@editable*/text-align:left;
                            }
                            h2{
                                /*@editable*/color:#202020;
                                /*@editable*/font-family:Helvetica;
                                /*@editable*/font-size:22px;
                                /*@editable*/font-style:normal;
                                /*@editable*/font-weight:bold;
                                /*@editable*/line-height:125%;
                                /*@editable*/letter-spacing:normal;
                                /*@editable*/text-align:left;
                            }
                            h3{
                                /*@editable*/color:#202020;
                                /*@editable*/font-family:Helvetica;
                                /*@editable*/font-size:20px;
                                /*@editable*/font-style:normal;
                                /*@editable*/font-weight:bold;
                                /*@editable*/line-height:125%;
                                /*@editable*/letter-spacing:normal;
                                /*@editable*/text-align:left;
                            }
                            h4{
                                /*@editable*/color:#202020;
                                /*@editable*/font-family:Helvetica;
                                /*@editable*/font-size:18px;
                                /*@editable*/font-style:normal;
                                /*@editable*/font-weight:bold;
                                /*@editable*/line-height:125%;
                                /*@editable*/letter-spacing:normal;
                                /*@editable*/text-align:left;
                            }
                            #templatePreheader{
                                /*@editable*/background-color:#FAFAFA;
                                /*@editable*/border-top:0;
                                /*@editable*/border-bottom:0;
                                /*@editable*/padding-top:9px;
                                /*@editable*/padding-bottom:9px;
                            }
                            #templatePreheader .mcnTextContent,#templatePreheader .mcnTextContent p{
                                /*@editable*/color:#656565;
                                /*@editable*/font-family:Helvetica;
                                /*@editable*/font-size:12px;
                                /*@editable*/line-height:150%;
                                /*@editable*/text-align:left;
                            }
                            #templatePreheader .mcnTextContent a,#templatePreheader .mcnTextContent p a{
                                /*@editable*/color:#656565;
                                /*@editable*/font-weight:normal;
                                /*@editable*/text-decoration:underline;
                            }
                            #templateHeader{
                                /*@editable*/background-color:#FFFFFF;
                                /*@editable*/border-top:0;
                                /*@editable*/border-bottom:0;
                                /*@editable*/padding-top:9px;
                                /*@editable*/padding-bottom:0;
                            }
                            #templateHeader .mcnTextContent,#templateHeader .mcnTextContent p{
                                /*@editable*/color:#202020;
                                /*@editable*/font-family:Helvetica;
                                /*@editable*/font-size:16px;
                                /*@editable*/line-height:150%;
                                /*@editable*/text-align:left;
                            }
                            #templateHeader .mcnTextContent a,#templateHeader .mcnTextContent p a{
                                /*@editable*/color:#2BAADF;
                                /*@editable*/font-weight:normal;
                                /*@editable*/text-decoration:underline;
                            }
                            #templateBody{
                                /*@editable*/background-color:#FFFFFF;
                                /*@editable*/border-top:0;
                                /*@editable*/border-bottom:0;
                                /*@editable*/padding-top:9px;
                                /*@editable*/padding-bottom:9px;
                            }
                            #templateBody .mcnTextContent,#templateBody .mcnTextContent p{
                                /*@editable*/color:#202020;
                                /*@editable*/font-family:Helvetica;
                                /*@editable*/font-size:16px;
                                /*@editable*/line-height:150%;
                                /*@editable*/text-align:left;
                            }
                            #templateBody .mcnTextContent a,#templateBody .mcnTextContent p a{
                                /*@editable*/color:#2BAADF;
                                /*@editable*/font-weight:normal;
                                /*@editable*/text-decoration:underline;
                            }
                            #templateFooter{
                                /*@editable*/background-color:#fafafa;
                                /*@editable*/border-top:0;
                                /*@editable*/border-bottom:0;
                                /*@editable*/padding-top:9px;
                                /*@editable*/padding-bottom:9px;
                            }
                            #templateFooter .mcnTextContent,#templateFooter .mcnTextContent p{
                                /*@editable*/color:#656565;
                                /*@editable*/font-family:Helvetica;
                                /*@editable*/font-size:12px;
                                /*@editable*/line-height:150%;
                                /*@editable*/text-align:center;
                            }
                            #templateFooter .mcnTextContent a,#templateFooter .mcnTextContent p a{
                                /*@editable*/color:#656565;
                                /*@editable*/font-weight:normal;
                                /*@editable*/text-decoration:underline;
                            }
                        @media only screen and (min-width:768px){
                            .templateContainer{
                                width:600px !important;
                            }

                    }    @media only screen and (max-width: 480px){
                            body,table,td,p,a,li,blockquote{
                                -webkit-text-size-adjust:none !important;
                            }

                    }    @media only screen and (max-width: 480px){
                            body{
                                width:100% !important;
                                min-width:100% !important;
                            }

                    }    @media only screen and (max-width: 480px){
                            #bodyCell{
                                padding-top:10px !important;
                            }

                    }    @media only screen and (max-width: 480px){
                            .mcnImage{
                                width:100% !important;
                            }

                    }    @media only screen and (max-width: 480px){
                            .mcnCartContainer,.mcnCaptionTopContent,.mcnRecContentContainer,.mcnCaptionBottomContent,.mcnTextContentContainer,.mcnBoxedTextContentContainer,.mcnImageGroupContentContainer,.mcnCaptionLeftTextContentContainer,.mcnCaptionRightTextContentContainer,.mcnCaptionLeftImageContentContainer,.mcnCaptionRightImageContentContainer,.mcnImageCardLeftTextContentContainer,.mcnImageCardRightTextContentContainer{
                                max-width:100% !important;
                                width:100% !important;
                            }

                    }    @media only screen and (max-width: 480px){
                            .mcnBoxedTextContentContainer{
                                min-width:100% !important;
                            }

                    }    @media only screen and (max-width: 480px){
                            .mcnImageGroupContent{
                                padding:9px !important;
                            }

                    }    @media only screen and (max-width: 480px){
                            .mcnCaptionLeftContentOuter .mcnTextContent,.mcnCaptionRightContentOuter .mcnTextContent{
                                padding-top:9px !important;
                            }

                    }    @media only screen and (max-width: 480px){
                            .mcnImageCardTopImageContent,.mcnCaptionBlockInner .mcnCaptionTopContent:last-child .mcnTextContent{
                                padding-top:18px !important;
                            }

                    }    @media only screen and (max-width: 480px){
                            .mcnImageCardBottomImageContent{
                                padding-bottom:9px !important;
                            }

                    }    @media only screen and (max-width: 480px){
                            .mcnImageGroupBlockInner{
                                padding-top:0 !important;
                                padding-bottom:0 !important;
                            }

                    }    @media only screen and (max-width: 480px){
                            .mcnImageGroupBlockOuter{
                                padding-top:9px !important;
                                padding-bottom:9px !important;
                            }

                    }    @media only screen and (max-width: 480px){
                            .mcnTextContent,.mcnBoxedTextContentColumn{
                                padding-right:18px !important;
                                padding-left:18px !important;
                            }

                    }    @media only screen and (max-width: 480px){
                            .mcnImageCardLeftImageContent,.mcnImageCardRightImageContent{
                                padding-right:18px !important;
                                padding-bottom:0 !important;
                                padding-left:18px !important;
                            }

                    }    @media only screen and (max-width: 480px){
                            .mcpreview-image-uploader{
                                display:none !important;
                                width:100% !important;
                            }

                    }    @media only screen and (max-width: 480px){
                            h1{
                                /*@editable*/font-size:22px !important;
                                /*@editable*/line-height:125% !important;
                            }

                    }    @media only screen and (max-width: 480px){
                            h2{
                                /*@editable*/font-size:20px !important;
                                /*@editable*/line-height:125% !important;
                            }

                    }    @media only screen and (max-width: 480px){
                            h3{
                                /*@editable*/font-size:18px !important;
                                /*@editable*/line-height:125% !important;
                            }

                    }    @media only screen and (max-width: 480px){
                            h4{
                                /*@editable*/font-size:16px !important;
                                /*@editable*/line-height:150% !important;
                            }

                    }    @media only screen and (max-width: 480px){
                            .mcnBoxedTextContentContainer .mcnTextContent,.mcnBoxedTextContentContainer .mcnTextContent p{
                                /*@editable*/font-size:14px !important;
                                /*@editable*/line-height:150% !important;
                            }

                    }    @media only screen and (max-width: 480px){
                            #templatePreheader{
                                /*@editable*/display:block !important;
                            }

                    }    @media only screen and (max-width: 480px){
                            #templatePreheader .mcnTextContent,#templatePreheader .mcnTextContent p{
                                /*@editable*/font-size:14px !important;
                                /*@editable*/line-height:150% !important;
                            }

                    }    @media only screen and (max-width: 480px){
                            #templateHeader .mcnTextContent,#templateHeader .mcnTextContent p{
                                /*@editable*/font-size:16px !important;
                                /*@editable*/line-height:150% !important;
                            }

                    }    @media only screen and (max-width: 480px){
                            #templateBody .mcnTextContent,#templateBody .mcnTextContent p{
                                /*@editable*/font-size:16px !important;
                                /*@editable*/line-height:150% !important;
                            }

                    }    @media only screen and (max-width: 480px){
                            #templateFooter .mcnTextContent,#templateFooter .mcnTextContent p{
                                /*@editable*/font-size:14px !important;
                                /*@editable*/line-height:150% !important;
                            }

                    }</style>
                 </head>
                 <body style="height: 100%;margin: 0;padding: 0;width: 100%;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FAFAFA">
                    <center>
                        <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="border-collapse: collapse;height: 100%;margin: 0;padding: 0;width: 100%;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FAFAFA">
                            <tr>
                                <td align="center" valign="top" id="bodyCell" style="height: 100%;margin: 0;padding: 0;width: 100%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;border-top: 0">
                                    <!-- BEGIN TEMPLATE // -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                        <tr>
                                            <td align="center" valign="top" id="templatePreheader" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FAFAFA;border-top: 0;border-bottom: 0;padding-top: 9px;padding-bottom: 9px">
                                                <!--[if gte mso 9]>
                                                <table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
                                                <tr>
                                                <td align="center" valign="top" width="600" style="width:600px;">
                                                <![endif]-->
                                                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;max-width: 600px !important">
                                                    <tr>
                                                        <td valign="top" class="preheaderContainer" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                            <!--[if mso]>
                            </td>
                            <![endif]-->

                            <!--[if mso]>
                            </tr>
                            </table>
                            <![endif]-->
                        </td>
                    </tr>

            </table></td>
                                                    </tr>
                                                </table>
                                                <!--[if gte mso 9]>
                                                </td>
                                                </tr>
                                                </table>
                                                <![endif]-->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top" id="templateHeader" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FFF;border-top: 0;border-bottom: 0;padding-top: 9px;padding-bottom: 0">
                                                <!--[if gte mso 9]>
                                                <table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
                                                <tr>
                                                <td align="center" valign="top" width="600" style="width:600px;">
                                                <![endif]-->
                                                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;max-width: 600px !important">
                                                    <tr>
                                                        <td valign="top" class="headerContainer" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                <tbody class="mcnImageBlockOuter">
                        <tr>
                            <td valign="top" style="padding: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%" class="mcnImageBlockInner">
                                <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                    <tbody><tr>
                                        <td class="mcnImageContent" valign="top" style="padding-right: 9px;padding-left: 9px;padding-top: 0;padding-bottom: 0;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">

                                                <a href="http://accromontreal.com/" title="" class="" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                    <img align="center" alt="" src="http://accromontreal.com/wp-content/uploads/2016/09/header.jpg" width="564" style="max-width: 1024px;padding-bottom: 0;display: inline !important;vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic" class="mcnImage"/>
                                                </a>

                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                        </tr>
                </tbody>
            </table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                <tbody class="mcnTextBlockOuter">
                    <tr>
                        <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                              <!--[if mso]>
                            <table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                            <tr>
                            <![endif]-->

                            <!--[if mso]>
                            <td valign="top" width="600" style="width:600px;">
                            <![endif]-->
                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%" width="100%" class="mcnTextContentContainer">
                                <tbody><tr>

                                    <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #202020;font-family: Helvetica;font-size: 16px;line-height: 150%;text-align: left">

                                        <div style="text-align: center;"><span style="font-size:18px"><strong id="docs-internal-guid-089d6036-6234-822a-0ab6-2da2904f6a95">Êtes-vous prêts pour ACCRO?</strong></span></div>

                                    </td>
                                </tr>
                            </tbody></table>
                            <!--[if mso]>
                            </td>
                            <![endif]-->

                            <!--[if mso]>
                            </tr>
                            </table>
                            <![endif]-->
                        </td>
                    </tr>
                </tbody>
            </table></td>
                                                    </tr>
                                                </table>
                                                <!--[if gte mso 9]>
                                                </td>
                                                </tr>
                                                </table>
                                                <![endif]-->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top" id="templateBody" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FFF;border-top: 0;border-bottom: 0;padding-top: 9px;padding-bottom: 9px">
                                                <!--[if gte mso 9]>
                                                <table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
                                                <tr>
                                                <td align="center" valign="top" width="600" style="width:600px;">
                                                <![endif]-->
                                                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;max-width: 600px !important">
                                                    <tr>
                                                        <td valign="top" class="bodyContainer" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                <tbody class="mcnTextBlockOuter">
                    <tr>
                        <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                              <!--[if mso]>
                            <table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                            <tr>
                            <![endif]-->

                            <!--[if mso]>
                            <td valign="top" width="600" style="width:600px;">
                            <![endif]-->
                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%" width="100%" class="mcnTextContentContainer">
                                <tbody><tr>

                                    <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #202020;font-family: Helvetica;font-size: 16px;line-height: 150%;text-align: left">

                                        Il ne reste que quelques jours avant ACCRO: on nourrit votre dépendance à l’innovation, êtes-vous prêt pour vivre l’expérience 100 % immersive?<br/>
            <br/>
            <strong>Pour vivre l’expérience de façon optimale, téléchargez les applications qui vous seront nécessaires à l’événement:</strong>

            <ul>
                <li style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%"><strong><span style="color:#d67f32">Téléchargez</span></strong> <a href="https://www.google.ca/" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #2BAADF;font-weight: normal;text-decoration: underline">application Ties</a>: votre application officielle de l’événement: réseautage efficace et ne manquez aucune alerte de l’événement - votre DJ de la comm, signé ACCRO!</li>
                <li style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%"><strong><span style="color:#d67f32">Téléchargez</span></strong> application MyBubbles <a href="https://itunes.apple.com/en/app/mybubbles-points-recharge/id993145155?mt=8" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #2BAADF;font-weight: normal;text-decoration: underline">iOS</a> | <a href="https://play.google.com/store/apps/details?id=com.mybubbles.app&amp;hl=fr" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #2BAADF;font-weight: normal;text-decoration: underline">Android</a>: vous pensez connaître le marketing de proximité? Venez le vivre de façon innovante! Une vraie expérience géolocalisée: gamification et prix à remporter! </li>
            </ul>

                                    </td>
                                </tr>
                            </tbody></table>
                            <!--[if mso]>
                            </td>
                            <![endif]-->

                            <!--[if mso]>
                            </tr>
                            </table>
                            <![endif]-->
                        </td>
                    </tr>
                </tbody>
            </table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                <tbody class="mcnTextBlockOuter">
                    <tr>
                        <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                              <!--[if mso]>
                            <table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                            <tr>
                            <![endif]-->

                            <!--[if mso]>
                            <td valign="top" width="600" style="width:600px;">
                            <![endif]-->
                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%" width="100%" class="mcnTextContentContainer">
                                <tbody><tr>

                                    <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #202020;font-family: Helvetica;font-size: 16px;line-height: 150%;text-align: left">

                                        L’ambiance parfaite accompagnera nos entreprises innovantes! <br/>
            Venez dégustez les meilleurs ($): 
            <ul>
                <li style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%"><a href="http://www.traiteur-lesenfantsterribles.fr/#lesenfantsterribles" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #2BAADF;font-weight: normal;text-decoration: underline">Le chef des enfants terribles</a></li>
                <li style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%"><a href="https://www.facebook.com/philracinetraiteur/" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #2BAADF;font-weight: normal;text-decoration: underline">Phil Racine Traiteur</a></li>
                <li style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%"><a href="http://cremypatisserie.com/" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #2BAADF;font-weight: normal;text-decoration: underline">Crémy</a></li>
                <li style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%"><a href="http://www.cafepista.com/evenementiel/" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #2BAADF;font-weight: normal;text-decoration: underline">Café Pista Mobile</a></li>
            </ul>

                                    </td>
                                </tr>
                            </tbody></table>
                            <!--[if mso]>
                            </td>
                            <![endif]-->

                            <!--[if mso]>
                            </tr>
                            </table>
                            <![endif]-->
                        </td>
                    </tr>
                </tbody>
            </table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                <tbody class="mcnTextBlockOuter">
                    <tr>
                        <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                              <!--[if mso]>
                            <table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                            <tr>
                            <![endif]-->

                            <!--[if mso]>
                            <td valign="top" width="600" style="width:600px;">
                            <![endif]-->
                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%" width="100%" class="mcnTextContentContainer">
                                <tbody><tr>

                                    <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #202020;font-family: Helvetica;font-size: 16px;line-height: 150%;text-align: left">

                                        <div style="text-align: center;">Tous seront au rendez-vous le 29 septembre à la TOHU dès 17 h!</div>

                                    </td>
                                </tr>
                            </tbody></table>
                            <!--[if mso]>
                            </td>
                            <![endif]-->

                            <!--[if mso]>
                            </tr>
                            </table>
                            <![endif]-->
                        </td>
                    </tr>
                </tbody>
            </table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;table-layout: fixed !important">
                <tbody class="mcnDividerBlockOuter">
                    <tr>
                        <td class="mcnDividerBlockInner" style="min-width: 100%;padding: 0 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                            <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-top: 2px solid #DDD;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                <tbody><tr>
                                    <td style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                        <span/>
                                    </td>
                                </tr>
                            </tbody></table>
            <!--
                            <td class="mcnDividerBlockInner" style="padding: 18px;">
                            <hr class="mcnDividerContent" style="border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;" />
            -->
                        </td>
                    </tr>
                </tbody>
            </table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                <tbody class="mcnTextBlockOuter">
                    <tr>
                        <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                              <!--[if mso]>
                            <table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                            <tr>
                            <![endif]-->

                            <!--[if mso]>
                            <td valign="top" width="600" style="width:600px;">
                            <![endif]-->
                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%" width="100%" class="mcnTextContentContainer">
                                <tbody><tr>

                                    <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #202020;font-family: Helvetica;font-size: 16px;line-height: 150%;text-align: left">

                                        <div style="text-align: center;"><strong><span style="font-size:14px">Vous n’avez qu’à préserver votre billet jusqu’à l’événement et le présenter à l’accueil simplement à partir de votre téléphone intelligent.</span></strong><br/>
            <br/>
            </div>

                                    </td>
                                </tr>
                            </tbody></table>
                            <!--[if mso]>
                            </td>
                            <![endif]-->

                            <!--[if mso]>
                            </tr>
                            </table>
                            <![endif]-->
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Ticket start -->
            <!--[if mso]>
                    <style type="text/css">
                        td {
                            font-family: Arial, sans-serif;
                        }
                    </style>
                <![endif]-->
                <center class="wrapper" style=" margin: 0 !important;padding: 0;width: 100%; table-layout: fixed; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
                    <div class="webkit" style="max-width: 600px;margin: 0 auto;">
                        <!--[if (gte mso 9)|(IE)]>
                        <table width="600" align="center" style="border-collapse:separate;">
                        <tr>
                        <td style="padding: 0;">
                        <![endif]-->
                        <table class="outer" align="center" style="font-family: Noto Sans, Arial, Helvetica, sans-serif !important;border-spacing: 0; margin: 0 auto;width: 100%;max-width: 600px;border-collapse:separate;">
                            '.\Roots\Sage\Extras\generate_ticket_html($ticket).'
                        </table>
                        <!--[if (gte mso 9)|(IE)]>
                        </td>
                        </tr>
                        </table>
                        <![endif]-->
                    </div>
                </center>
            <!-- Ticket end -->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;table-layout: fixed !important">
                <tbody class="mcnDividerBlockOuter">
                    <tr>
                        <td class="mcnDividerBlockInner" style="min-width: 100%;padding: 0 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                            <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-top: 2px solid #DDD;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                <tbody><tr>
                                    <td style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                        <span/>
                                    </td>
                                </tr>
                            </tbody></table>
            <!--
                            <td class="mcnDividerBlockInner" style="padding: 18px;">
                            <hr class="mcnDividerContent" style="border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;" />
            -->
                        </td>
                    </tr>
                </tbody>
            </table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                <tbody class="mcnFollowBlockOuter">
                    <tr>
                        <td align="center" valign="top" style="padding: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%" class="mcnFollowBlockInner">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentContainer" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                <tbody><tr>
                    <td align="center" style="padding-left: 9px;padding-right: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%" class="mcnFollowContent">
                            <tbody><tr>
                                <td align="center" valign="top" style="padding-top: 9px;padding-right: 9px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                        <tbody><tr>
                                            <td align="center" valign="top" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                <!--[if mso]>
                                                <table align="center" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                <![endif]-->

                                                    <!--[if mso]>
                                                    <td align="center" valign="top">
                                                    <![endif]-->


                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" style="display: inline;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                            <tbody><tr>
                                                                <td valign="top" style="padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%" class="mcnFollowContentItemContainer">
                                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                        <tbody><tr>
                                                                            <td align="left" valign="middle" style="padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                                    <tbody><tr>

                                                                                            <td align="center" valign="middle" width="24" class="mcnFollowIconContent" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                                                <a href="https://www.facebook.com/ACCRO-261078524281645/?fref=ts" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%"><img src="http://accromontreal.com/wp-content/uploads/2016/09/facebook.png" style="display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic" height="24" width="24" class=""/></a>
                                                                                            </td>


                                                                                    </tr>
                                                                                </tbody></table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>

                                                    <!--[if mso]>
                                                    </td>
                                                    <![endif]-->

                                                    <!--[if mso]>
                                                    <td align="center" valign="top">
                                                    <![endif]-->


                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" style="display: inline;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                            <tbody><tr>
                                                                <td valign="top" style="padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%" class="mcnFollowContentItemContainer">
                                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                        <tbody><tr>
                                                                            <td align="left" valign="middle" style="padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                                    <tbody><tr>

                                                                                            <td align="center" valign="middle" width="24" class="mcnFollowIconContent" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                                                <a href="https://twitter.com/ACCROMTL?lang=fr" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%"><img src="http://accromontreal.com/wp-content/uploads/2016/09/twitter.png" style="display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic" height="24" width="24" class=""/></a>
                                                                                            </td>


                                                                                    </tr>
                                                                                </tbody></table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>

                                                    <!--[if mso]>
                                                    </td>
                                                    <![endif]-->

                                                    <!--[if mso]>
                                                    <td align="center" valign="top">
                                                    <![endif]-->


                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" style="display: inline;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                            <tbody><tr>
                                                                <td valign="top" style="padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%" class="mcnFollowContentItemContainer">
                                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                        <tbody><tr>
                                                                            <td align="left" valign="middle" style="padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                                    <tbody><tr>

                                                                                            <td align="center" valign="middle" width="24" class="mcnFollowIconContent" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                                                <a href="https://www.instagram.com/accromtl/" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%"><img src="http://accromontreal.com/wp-content/uploads/2016/09/instagram.png" style="display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic" height="24" width="24" class=""/></a>
                                                                                            </td>


                                                                                    </tr>
                                                                                </tbody></table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>

                                                    <!--[if mso]>
                                                    </td>
                                                    <![endif]-->

                                                    <!--[if mso]>
                                                    <td align="center" valign="top">
                                                    <![endif]-->


                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" style="display: inline;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                            <tbody><tr>
                                                                <td valign="top" style="padding-right: 0;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%" class="mcnFollowContentItemContainer">
                                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                        <tbody><tr>
                                                                            <td align="left" valign="middle" style="padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                                    <tbody><tr>

                                                                                            <td align="center" valign="middle" width="24" class="mcnFollowIconContent" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                                                <a href="https://www.linkedin.com/company/accro-montr%C3%A9al" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%"><img src="http://accromontreal.com/wp-content/uploads/2016/09/linkedin.png" style="display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic" height="24" width="24" class=""/></a>
                                                                                            </td>


                                                                                    </tr>
                                                                                </tbody></table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>

                                                    <!--[if mso]>
                                                    </td>
                                                    <![endif]-->

                                                <!--[if mso]>
                                                </tr>
                                                </table>
                                                <![endif]-->
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
            </tbody></table>

                        </td>
                    </tr>
                </tbody>
            </table></td>
                                                    </tr>
                                                </table>
                                                <!--[if gte mso 9]>
                                                </td>
                                                </tr>
                                                </table>
                                                <![endif]-->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top" id="templateFooter" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #fafafa;border-top: 0;border-bottom: 0;padding-top: 9px;padding-bottom: 9px">
                                                <!--[if gte mso 9]>
                                                <table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
                                                <tr>
                                                <td align="center" valign="top" width="600" style="width:600px;">
                                                <![endif]-->
                                                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;max-width: 600px !important">
                                                    <tr>
                                                        <td valign="top" class="footerContainer" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%"/>
                                                    </tr>
                                                </table>
                                                <!--[if gte mso 9]>
                                                </td>
                                                </tr>
                                                </table>
                                                <![endif]-->
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // END TEMPLATE -->



                    </center>
                </body>
            </html>';
}
?>
