<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Purchase is Ready!</title>
</head>
<body style="margin:0;padding:0;background-color:#0f172a;font-family:'Segoe UI','Helvetica Neue',Arial,sans-serif;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color:#0f172a;">
        <tr>
            <td align="center" style="padding:30px 15px;">
                <table role="presentation" width="520" cellspacing="0" cellpadding="0" style="background:linear-gradient(135deg,#1e1b4b,#1e293b);border-radius:16px;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,0.4);">

                    <!-- Header -->
                    <tr>
                        <td style="background:linear-gradient(135deg,#6366f1,#8b5cf6);padding:30px 30px 25px;text-align:center;">
                            <div style="width:60px;height:60px;background:rgba(255,255,255,0.2);border-radius:50%;display:inline-flex;align-items:center;justify-content:center;margin-bottom:12px;">
                                <span style="font-size:28px;">🎉</span>
                            </div>
                            <h1 style="color:#ffffff;font-size:22px;margin:0 0 6px;font-weight:700;">Purchase Successful!</h1>
                            <p style="color:rgba(255,255,255,0.8);font-size:13px;margin:0;">Your digital product is ready for download</p>
                        </td>
                    </tr>

                    <!-- Greeting -->
                    <tr>
                        <td style="padding:25px 30px 10px;">
                            <p style="color:#e2e8f0;font-size:15px;margin:0 0 5px;">Hello <strong><?= esc($cus_name) ?></strong>,</p>
                            <p style="color:#94a3b8;font-size:13px;margin:0;line-height:1.6;">
                                Thank you for your purchase! Your payment has been verified and your product is ready.
                            </p>
                        </td>
                    </tr>

                    <!-- Product Info -->
                    <tr>
                        <td style="padding:15px 30px;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08);border-radius:12px;">
                                <tr>
                                    <td style="padding:16px 18px;">
                                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td style="color:#94a3b8;font-size:12px;padding-bottom:8px;">Product</td>
                                                <td align="right" style="color:#e2e8f0;font-size:13px;font-weight:600;padding-bottom:8px;"><?= esc($product_name) ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="border-bottom:1px solid rgba(255,255,255,0.06);padding-bottom:8px;"></td>
                                            </tr>
                                            <tr>
                                                <td style="color:#94a3b8;font-size:12px;padding-top:8px;padding-bottom:8px;">Amount Paid</td>
                                                <td align="right" style="color:#34d399;font-size:16px;font-weight:700;padding-top:8px;padding-bottom:8px;">৳<?= number_format($amount, 2) ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="border-bottom:1px solid rgba(255,255,255,0.06);padding-bottom:8px;"></td>
                                            </tr>
                                            <tr>
                                                <td style="color:#94a3b8;font-size:12px;padding-top:8px;padding-bottom:8px;">Payment Method</td>
                                                <td align="right" style="color:#e2e8f0;font-size:13px;font-weight:500;padding-top:8px;padding-bottom:8px;"><?= ucwords($method) ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="border-bottom:1px solid rgba(255,255,255,0.06);padding-bottom:8px;"></td>
                                            </tr>
                                            <tr>
                                                <td style="color:#94a3b8;font-size:12px;padding-top:8px;">Transaction ID</td>
                                                <td align="right" style="color:#a78bfa;font-size:12px;font-weight:600;padding-top:8px;"><?= esc($transaction_id) ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Download Button -->
                    <tr>
                        <td style="padding:10px 30px 20px;text-align:center;">
                            <p style="color:#94a3b8;font-size:12px;margin:0 0 14px;">Click the button below to access your product:</p>
                            <a href="<?= esc($delivery_link) ?>" style="display:inline-block;padding:16px 40px;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#ffffff;font-size:16px;font-weight:700;text-decoration:none;border-radius:12px;letter-spacing:0.5px;">
                                📥 Download Now
                            </a>
                        </td>
                    </tr>

                    <!-- Alternative Link -->
                    <tr>
                        <td style="padding:0 30px 20px;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:rgba(99,102,241,0.08);border:1px solid rgba(99,102,241,0.15);border-radius:10px;">
                                <tr>
                                    <td style="padding:12px 16px;">
                                        <p style="color:#94a3b8;font-size:11px;margin:0 0 4px;">If the button doesn't work, copy this link:</p>
                                        <p style="color:#a78bfa;font-size:11px;margin:0;word-break:break-all;"><?= esc($delivery_link) ?></p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding:20px 30px;border-top:1px solid rgba(255,255,255,0.06);text-align:center;">
                            <p style="color:rgba(255,255,255,0.25);font-size:11px;margin:0 0 4px;">
                                This is an automated email from <strong><?= esc($brand_name) ?></strong>
                            </p>
                            <p style="color:rgba(255,255,255,0.15);font-size:10px;margin:0;">
                                Powered by <?= get_option('site_name', 'Ekhoni Digital') ?>
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
