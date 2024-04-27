<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailTemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('email_templates')->truncate();
        $templates = [
            [
                'id'=>1,
                'type'=>'contact_us_admin',
                'subject'=>null,
                'body'=>'
                <div style="background-color: #EDF2F7; padding: 40px;">
                    <table style="width: 100%; margin-bottom: 20px;">
                        <tr style="width: 100%;">
                            <td style="text-align: center;"><a href="{front_url}"><img src="https://admin.carryshipment.com/admin/img/profile/logo.png" alt="" width="100px" height="50px"></a></td>
                        </tr>
                    </table>
                    <table style="background-color: #fff; border-radius: 20px; width: 100%;">
                        <tr>
                            <td style="padding: 20px;">
                                <p style="font-size: 18px;font-weight: bold;">Dear {name}</p>
                                <p>Person Name:{name}</p>
                                <p>Email:{email}</p>
                                <p>Phone:{phone_number}</p>
                                <h4>Company Information</h4>
                                <p>Name:{company_name}</p>
                                <p>Website:{url}</p>
                                <p>Address:{address}</p>
                                <br>
                                <p style="word-break: break-word;">{message}</p>

                            </td>
                        </tr>
                        <tr style="width: 100px;">
                            <td style="text-align: center; padding: 20px 0;">
                                <p style="word-break: break-word; margin-left: 20%;margin-right: 20%;">{customer_existing}</p>
                            </td>
                        </tr>
                    </table>
                    <table style="width: 100%;margin-top: 20px;">
                        <tr style="width: 100%;">
                            <td style="text-align: center;font-size: 16px; color: #b0adc5;">Copyright © {date} Carry Shipment Inc. All Rights Reserved.</td>
                        </tr>
                    </table>
                </div>
                ',
                'created_at' => '2024-03-09 11:30:16',
                'updated_at' => null,
            ],
            [
                'id'=>2,
                'type'=>'contact_us_customer',
                'subject'=>null,
                'body'=>'
                <div style="background-color: #EDF2F7; padding: 40px;">
                    <table style="width: 100%; margin-bottom: 20px;">
                        <tr style="width: 100%;">
                            <td style="text-align: center;"><a href="{front_url}"><img src="https://admin.carryshipment.com/admin/img/profile/logo.png" alt="" width="100px" height="50px"></a></td>
                        </tr>
                    </table>
                    <table style="background-color: #fff; border-radius: 20px; width: 100%;">
                        <tr>
                            <td style="padding: 20px;">
                                <p style="font-size: 18px;font-weight: bold;">Dear {name}</p>
                                <p style="word-break: break-word;">{message}</p>

                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 20px;">
                                <p>Sincerely,</p>
                                <p>CarryShipment.com</p>
                            </td>
                        </tr>
                    </table>
                    <table style="width: 100%;margin-top: 20px;">
                        <tr style="width: 100%;">
                            <td style="text-align: center;font-size: 16px; color: #b0adc5;">Copyright © {date} Carry Shipment Inc. All Rights Reserved.</td>
                        </tr>
                    </table>
                </div>
                ',
                'created_at' => '2024-03-09 11:30:16',
                'updated_at' => null,
            ],
            [
                'id'=>3,
                'type'=>'verify_mail',
                'subject'=>'CarryShipment.com Verify Email',
                'body'=>'
                <div style="background-color: #EDF2F7; padding: 40px;">
                    <table style="width: 100%; margin-bottom: 20px;">
                        <tr style="width: 100%;">
                            <td style="text-align: center;"><a href="{front_url}"><img src="https://admin.carryshipment.com/admin/img/profile/logo.png" alt="" width="100px" height="50px"></a></td>
                        </tr>
                    </table>
                    <table style="background-color: #fff; border-radius: 20px; width: 100%;">
                        <tr>
                            <td style="padding: 20px;">
                                <p style="font-size: 18px;font-weight: bold;">Hello {name}</p>
                                <p style="word-break: break-word;">Congratulations. You are half way there. Please click on the link below to continue. Any questions or problems you may have, please click on our <a style="color: #3e7bf1;text-decoration: none;" href="https://carryshipment.com/contact">Contact Us</a> link on <a style="color: #213dda;text-decoration: none;" href="https://carryshipment.com">CarryShipment.com</a>.</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; padding: 20px 0;">
                                <a href="{url}"
                                    style="display: inline-block; padding: 10px 20px; border-radius: 5px; background-color: #2D3748; color: white; text-decoration: none; border: none;">Verify
                                    Email</a>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 20px;">
                                <p>Sincerely,</p>
                                <p>CarryShipment.com Team</p>
                            </td>
                        </tr>
                    </table>
                    <table style="width: 100%;margin-top: 20px;">
                        <tr style="width: 100%;">
                            <td style="text-align: center;font-size: 16px; color: #b0adc5;">Copyright © {date} Carry  Shipment Inc. All Rights Reserved.</td>
                        </tr>
                    </table>
                </div>',
                'created_at' => '2024-04-22 11:30:16',
                'updated_at' => null,
            ],
            [
                'id'=>4,
                'type'=>'forget_password',
                'subject'=>'OTP | {otp}',
                'body'=>'
                <div style="background-color: #EDF2F7; padding: 40px;">
                    <table style="width: 100%; margin-bottom: 20px;">
                        <tr style="width: 100%;">
                            <td style="text-align: center;"><a href="{front_url}"><img src="https://admin.carryshipment.com/admin/img/profile/logo.png" alt="" width="100px" height="50px"></a></td>
                        </tr>
                    </table>
                    <table style="background-color: #fff; border-radius: 20px; width: 100%;">
                        <tr>
                            <td style="padding: 20px;">
                                <p style="font-size: 18px;font-weight: bold;">Dear {name},</p>
                                <p style="word-break: break-all;">{otp} is your OTP. Please dont share it with anyone.</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 20px;">
                                <p>Sincerely,</p>
                                <p>CarryShipment.com</p>
                            </td>
                        </tr>
                    </table>
                    <table style="width: 100%;margin-top: 20px;">
                        <tr style="width: 100%;">
                            <td style="text-align: center;font-size: 16px; color: #b0adc5;">Copyright © {date} For All Doctors Inc. All Rights Reserved.</td>
                        </tr>
                    </table>
                </div>',
                'created_at' => '2024-04-22 11:30:16',
                'updated_at' => null,
            ]
            ];
        DB::table('email_templates')->insert($templates);

    }
}
