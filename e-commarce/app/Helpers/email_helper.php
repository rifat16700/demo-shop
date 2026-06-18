<?php
if (!function_exists('getEmailTemplate')) {
    function getEmailTemplate($key = "")
    {
        $result = (object) array();
        $result->subject = '';
        $result->content = '';
        if (!empty($key)) {
            switch ($key) {

                case 'user_plan':
                    $result->subject = "{{website_name}} - Congratulations on your new plan!";
                    $result->short_keys = json_encode([
                        'website_name' => 'website name',
                        'first_name' =>'User Firstname',
                        'last_name' =>'User Lastname',
                        'pay_amount'   => 'Transaction amount',
                        'plan'   => 'Plan Name',
                        'device'       => 'Number of device',
                        'website'       => 'Number of website',
                        'expire'         => 'Date of expire',
                        'date'         => 'Date',
                    ]);
                    $result->content = "
                        <h2 style='color:#333;margin-top:0;'>Congratulations, {{first_name}}!</h2>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>A new plan of <strong>{{pay_amount}} tk</strong> has been successfully added to your account.</p>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>Enjoy your new features and let us know if you need any help getting started!</p>
                        <p style='margin-top:20px;color:#777;'>Best Regards,<br><strong>The {{website_name}} Team</strong></p>
                    ";
                    return $result;
                    break;

                case 'user_addon':
                    $result->subject = "{{website_name}} - Addon Successfully Added!";
                    $result->short_keys = json_encode([
                        'website_name' => 'website name',
                        'first_name' =>'User Firstname',
                        'last_name' =>'User Lastname',
                        'pay_amount'   => 'Transaction amount',
                        'addon'       => 'Name of addon',
                        'date'         => 'Date',
                    ]);
                    $result->content = "
                        <h2 style='color:#333;margin-top:0;'>Hi {{first_name}},</h2>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>Your requested addon <strong>{{addon}}</strong> (Value: {{pay_amount}} tk) has been successfully added to your account!</p>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>Thank you for enhancing your experience with us.</p>
                        <p style='margin-top:20px;color:#777;'>Best Regards,<br><strong>The {{website_name}} Team</strong></p>
                    ";
                    return $result;
                    break;

                case 'user_customer_trx':
                    $result->subject = "{{website_name}} - Transaction Successful!";
                    $result->short_keys = json_encode([
                        'website_name' => 'website name',
                        'first_name' =>' User Firstname',
                        'last_name' =>' User Lastname',
                        'pay_amount'   => 'Transaction amount',
                        'trx_id'         => 'Transaction id',
                        'customer_name' =>'Your Customer Name',
                        'customer_email' =>'Your Customer Email',
                        'date'         => 'Date',
                    ]);
                    $result->content = "
                        <h2 style='color:#333;margin-top:0;'>Payment Confirmation</h2>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>Hi <strong>{{customer_name}}</strong>,</p>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>This email is to confirm that a payment of <strong style='color:#28a745;'>{{pay_amount}} tk</strong> has been successfully processed and delivered to <strong>{{first_name}} {{last_name}}</strong>.</p>
                        <div style='background-color:#f9f9f9;padding:15px;border-radius:5px;margin:20px 0;'>
                            <p style='margin:0;color:#555;'><strong>Transaction ID:</strong> {{trx_id}}</p>
                            <p style='margin:5px 0 0 0;color:#555;'><strong>Date:</strong> {{date}}</p>
                        </div>
                        <p style='margin-top:20px;color:#777;'>Thank you for using {{website_name}}!</p>
                    ";
                    return $result;
                    break;
                case 'user_trx':
                    $result->subject = "{{website_name}} - Transaction Successful!";
                    $result->short_keys = json_encode([
                        'website_name' => 'website name',
                        'first_name' =>' User Firstname',
                        'last_name' =>' User Lastname',
                        'pay_amount'   => 'Transaction amount',
                        'trx_id'         => 'Transaction id',
                        'customer_email' =>'Your Customer Email',
                        'customer_name' =>'Your Customer Name',
                        'date'         => 'Date',
                    ]);
                    $result->content = "
                        <h2 style='color:#333;margin-top:0;'>Payment Confirmation</h2>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>Hi <strong>{{customer_name}}</strong>,</p>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>This email is to confirm that a payment of <strong style='color:#28a745;'>{{pay_amount}} tk</strong> has been successfully processed and delivered to <strong>{{first_name}}</strong>.</p>
                        <div style='background-color:#f9f9f9;padding:15px;border-radius:5px;margin:20px 0;'>
                            <p style='margin:0;color:#555;'><strong>Transaction ID:</strong> {{trx_id}}</p>
                            <p style='margin:5px 0 0 0;color:#555;'><strong>Date:</strong> {{date}}</p>
                        </div>
                        <p style='margin-top:20px;color:#777;'>Thank you for using {{website_name}}!</p>
                    ";
                    return $result;
                    break;

                case 'payment':
                    $result->short_keys = json_encode([
                        'website_name'    => 'website name',
                        'pay_amount'      => 'Payment amount',
                        'first_name'      =>' User Firstname',
                        'last_name'       =>' User Lastname',
                        'email'           =>' User Email',
                        'balance'         => 'User Balance',
                        'date'            => 'Date',
                    ]);
                    $result->subject = "{{website_name}} - Deposit Payment Received";
                    $result->content = "
                        <h2 style='color:#333;margin-top:0;'>Thank You!</h2>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>Hi <strong>{{first_name}}</strong>,</p>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>We've just received your deposit payment of <strong style='color:#28a745;'>{{pay_amount}} tk</strong>. We appreciate your diligence in adding funds to your account balance.</p>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>Your current balance is now updated. It has been a pleasure doing business with you.</p>
                        <p style='margin-top:20px;color:#777;'>Best Regards,<br><strong>The {{website_name}} Team</strong></p>
                    ";
                    return $result;
                    break;

                case 'verify':
                    $result->short_keys = json_encode([
                        'website_name'    => 'website name',
                        'activation_link' => 'Activation link',
                        'first_name'      =>' User Firstname',
                        'last_name'       =>' User Lastname',
                        'email'           =>' User Email',
                        'balance'         => 'User Balance',
                        'date'            => 'Date',
                    ]);
                    $result->subject = "{{website_name}} - Please verify your email address";
                    $result->content = "
                        <h2 style='color:#333;margin-top:0;'>Welcome to {{website_name}}!</h2>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>Hello <strong>{{first_name}}</strong>,</p>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>Thank you for joining us! We're thrilled to have you as a member, and we can't wait for you to start exploring our services.</p>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>To fully activate your account, please verify your email address by clicking the button below:</p>
                        <div style='text-align:center;margin:30px 0;'>
                            <a href='{{activation_link}}' style='display:inline-block;background-color:#3869D4;color:#ffffff;padding:12px 25px;font-size:16px;font-weight:bold;text-decoration:none;border-radius:5px;'>Verify My Account</a>
                        </div>
                        <p style='color:#555;font-size:14px;line-height:1.6;'>If the button doesn't work, you can also copy and paste the following link into your browser:<br><a href='{{activation_link}}' style='color:#3869D4;word-break:break-all;'>{{activation_link}}</a></p>
                        <p style='margin-top:20px;color:#777;'>Thanks,<br><strong>The {{website_name}} Team</strong></p>
                    ";
                    return $result;
                    break;

                case 'welcome':
                    $result->short_keys = json_encode([
                        'website_name'=> 'website name',
                        'first_name'  =>' User Firstname',
                        'last_name'   =>' User Lastname',
                        'email'       =>' User Email',
                        'timezone'    =>' User Timezone',
                        'balance'     => 'User Balance',
                        'date'        => 'Date',
                    ]);
                    $result->subject = "{{website_name}} - Getting Started with Our Service!";
                    $result->content = "
                        <h2 style='color:#333;margin-top:0;'>Welcome to {{website_name}}!</h2>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>Hello <strong>{{first_name}}</strong>,</p>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>Congratulations! You have successfully signed up for our service. Here is a summary of your account information:</p>
                        <ul style='color:#555;font-size:16px;line-height:1.6;background-color:#f9f9f9;padding:15px 15px 15px 35px;border-radius:5px;'>
                            <li><strong>First Name:</strong> {{first_name}}</li>
                            <li><strong>Last Name:</strong> {{last_name}}</li>
                            <li><strong>Email:</strong> {{email}}</li>
                            <li><strong>Timezone:</strong> {{user_timezone}}</li>
                        </ul>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>We want to exceed your expectations, so please do not hesitate to reach out at any time if you have any questions or concerns. We look forward to serving you.</p>
                        <p style='margin-top:20px;color:#777;'>Best Regards,<br><strong>The {{website_name}} Team</strong></p>
                    ";
                    return $result;
                    break;

                case 'forgot_password':
                    $result->short_keys = json_encode([
                        'website_name'=> 'website name',
                        'first_name'  =>' User Firstname',
                        'last_name'   =>' User Lastname',
                        'email'       =>' User Email',
                        'timezone'    =>' User Timezone',
                        'recovery_password_link' => 'Recovery Password Link For User',
                        'balance'     => 'User Balance',
                        'date'        => 'Date',
                    ]);
                    $result->subject = "{{website_name}} - Password Recovery";
                    $result->content = "
                        <h2 style='color:#333;margin-top:0;'>Password Reset Request</h2>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>Hi <strong>{{first_name}}</strong>,</p>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>Somebody recently requested a password reset for your account. No changes have been made to your account yet.</p>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>You can easily reset your password by clicking the button below:</p>
                        <div style='text-align:center;margin:30px 0;'>
                            <a href='{{recovery_password_link}}' style='display:inline-block;background-color:#E53E3E;color:#ffffff;padding:12px 25px;font-size:16px;font-weight:bold;text-decoration:none;border-radius:5px;'>Reset Password</a>
                        </div>
                        <p style='color:#555;font-size:14px;line-height:1.6;'>If you did not request a password reset, you can safely ignore this email.</p>
                        <p style='margin-top:20px;color:#777;'>Thanks,<br><strong>The {{website_name}} Team</strong></p>
                    ";
                    return $result;
                    break;
                case 'admin_forgot_password':
                    $result->short_keys = json_encode([
                        'website_name'=> 'website name',
                        'first_name'  =>' User Firstname',
                        'last_name'   =>' User Lastname',
                        'email'       =>' User Email',
                        'balance'     => 'User Balance',
                        'admin_recovery_password_link' => 'Recovery Password Link For Admin',
                        'date'        => 'Date',
                    ]);
                    $result->subject = "{{website_name}} - Admin Password Recovery";
                    $result->content = "
                        <h2 style='color:#333;margin-top:0;'>Password Reset Request</h2>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>Hi <strong>{{first_name}}</strong>,</p>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>Somebody recently requested a password reset for your admin account. No changes have been made to your account yet.</p>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>You can reset your password by clicking the button below:</p>
                        <div style='text-align:center;margin:30px 0;'>
                            <a href='{{admin_recovery_password_link}}' style='display:inline-block;background-color:#E53E3E;color:#ffffff;padding:12px 25px;font-size:16px;font-weight:bold;text-decoration:none;border-radius:5px;'>Reset Admin Password</a>
                        </div>
                        <p style='color:#555;font-size:14px;line-height:1.6;'>If you did not request a password reset, you can safely ignore this email.</p>
                        <p style='margin-top:20px;color:#777;'>Thanks,<br><strong>The {{website_name}} Team</strong></p>
                    ";
                    return $result;
                    break;


                case 'new_user':
                    $result->short_keys = json_encode([
                        'website_name'=> 'website name',
                        'first_name'  =>' User Firstname',
                        'last_name'   =>' User Lastname',
                        'email'       =>' User Email',
                        'timezone'    =>' User Timezone',
                        'balance'     => 'User Balance',
                        'date'        => 'Date',
                    ]);
                    $result->subject = "{{website_name}} - New User Registration";
                    $result->content = "
                        <h2 style='color:#333;margin-top:0;'>New Registration Alert</h2>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>Hi Admin,</p>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>A new user has just signed up in <strong>{{website_name}}</strong> with the following data:</p>
                        <ul style='color:#555;font-size:16px;line-height:1.6;background-color:#f9f9f9;padding:15px 15px 15px 35px;border-radius:5px;'>
                            <li><strong>First Name:</strong> {{first_name}}</li>
                            <li><strong>Last Name:</strong> {{last_name}}</li>
                            <li><strong>Email:</strong> {{email}}</li>
                            <li><strong>Timezone:</strong> {{user_timezone}}</li>
                        </ul>
                    ";
                    return $result;
                    break;
                
                case 'user_message':
                    $result->subject    = "{{website_name}} - Important Notification";
                    $result->short_keys = json_encode([
                        'website_name'=> 'website name',
                        'first_name'  =>' User Firstname',
                        'last_name'   =>' User Lastname',
                        'email'       =>' User Email',
                        'timezone'    =>' User Timezone',
                        'balance'     => 'User Balance',
                        'date'        => 'Date',
                    ]);
                    $result->content = "
                        <h2 style='color:#333;margin-top:0;'>Notification</h2>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>Hi <strong>{{first_name}}</strong>,</p>
                        <p style='color:#555;font-size:16px;line-height:1.6;'>This is a message from <strong>{{website_name}}</strong>. A payment of <strong style='color:#28a745;'>{{pay_amount}} tk</strong> has been successfully processed for your account.</p>
                        <p style='margin-top:20px;color:#777;'>Best Regards,<br><strong>The {{website_name}} Team</strong></p>
                    ";
                    return $result;
                    break;


            }
        }
        return $result;
    }
}

