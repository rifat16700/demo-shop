<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - <?= get_brand_data($items['brand_id'], $items['uid'])->brand_name; ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url(get_brand_data($items['brand_id'], $items['uid'])->brand_logo); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-500: #6b7280;
            --gray-700: #374151;
            --gray-900: #111827;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--gray-100);
            color: var(--gray-700);
            line-height: 1.6;
            padding: 3rem 1rem;
        }
        .invoice-wrapper {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }
        .invoice-header {
            padding: 3.5rem 3.5rem 2.5rem;
            background: #fff;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .invoice-title h1 {
            font-size: 2.75rem;
            font-weight: 700;
            color: var(--gray-900);
            letter-spacing: -0.025em;
            margin-bottom: 0.25rem;
            line-height: 1;
        }
        .invoice-title p {
            color: var(--gray-500);
            font-size: 1.1rem;
            font-weight: 500;
        }
        .brand-logo img {
            max-height: 65px;
            border-radius: 8px;
        }
        .invoice-body {
            padding: 3.5rem;
        }
        .meta-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2.5rem;
            margin-bottom: 3.5rem;
        }
        .meta-section h3 {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--gray-500);
            margin-bottom: 0.75rem;
            font-weight: 600;
        }
        .meta-section p {
            font-size: 1.05rem;
            color: var(--gray-900);
            margin-bottom: 0.25rem;
        }
        .meta-section .bold {
            font-weight: 600;
        }
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 1rem;
            border-radius: 9999px;
            font-size: 0.85rem;
            font-weight: 700;
            margin-top: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .status-paid { background: #dcfce7; color: #166534; }
        .status-unpaid { background: #fee2e2; color: #991b1b; }
        .status-pending { background: #dbeafe; color: #1e40af; }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2.5rem;
        }
        th {
            text-align: left;
            padding: 1rem 0;
            border-bottom: 2px solid var(--gray-200);
            color: var(--gray-900);
            font-weight: 600;
            font-size: 0.95rem;
        }
        td {
            padding: 1.5rem 0;
            border-bottom: 1px solid var(--gray-200);
            color: var(--gray-700);
            font-size: 1.05rem;
        }
        th:last-child, td:last-child {
            text-align: right;
        }
        .td-desc {
            font-weight: 500;
            color: var(--gray-900);
        }
        
        .totals {
            width: 100%;
            max-width: 320px;
            margin-left: auto;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            font-size: 1.05rem;
            color: var(--gray-700);
        }
        .total-row.final {
            border-top: 2px solid var(--gray-900);
            margin-top: 0.5rem;
            padding-top: 1.25rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gray-900);
        }
        
        .invoice-footer {
            padding: 2rem 3.5rem;
            background: var(--gray-50);
            border-top: 1px solid var(--gray-200);
            text-align: center;
        }
        .note {
            color: var(--gray-500);
            font-size: 0.95rem;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-bottom: 1.5rem;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.85rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1.05rem;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            border: none;
        }
        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2), 0 2px 4px -1px rgba(79, 70, 229, 0.1);
        }
        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3), 0 4px 6px -2px rgba(79, 70, 229, 0.15);
        }
        .btn-secondary {
            background: white;
            color: var(--gray-700);
            border: 1px solid var(--gray-300);
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        .btn-secondary:hover {
            background: var(--gray-50);
            border-color: var(--gray-400);
        }

        @media print {
            body { background: white; padding: 0; }
            .invoice-wrapper { box-shadow: none; border: none; margin: 0; max-width: 100%; }
            .invoice-header, .invoice-body, .invoice-footer { padding: 2rem 0; }
            .action-buttons { display: none; }
        }
        @media (max-width: 640px) {
            .invoice-header { flex-direction: column-reverse; gap: 1.5rem; padding: 2rem; }
            .invoice-body { padding: 2rem; }
            .invoice-footer { padding: 2rem; }
            .meta-grid { grid-template-columns: 1fr; gap: 1.5rem; }
            .action-buttons { flex-direction: column; padding: 0 1rem; }
            .btn { width: 100%; }
        }
    </style>
</head>
<body>
<?php 
    $brand = get_brand_data($items['brand_id'], $items['uid']);
    // Generate a professional short Invoice ID (e.g. INV-17B1C6)
    $short_id = 'INV-' . strtoupper(substr(@$items['ids'], 0, 6));
    
    // Fix Time formatting by just showing the Date
    $date = date('F j, Y', strtotime(@$items['created_at']));
    
    // Status Logic
    $status_class = 'status-unpaid';
    $status_text = 'UNPAID';
    if (@$items['pay_status'] == 1) {
        $status_class = 'status-pending';
        $status_text = 'PENDING';
    } elseif (@$items['pay_status'] == 2) {
        $status_class = 'status-paid';
        $status_text = 'PAID';
    }
?>

<div class="action-buttons">
    <button class="btn btn-secondary" onclick="window.print()">
        <svg style="width:20px;height:20px;margin-right:8px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
        Print Invoice
    </button>
</div>

<div class="invoice-wrapper">
    <div class="invoice-header">
        <div class="invoice-title">
            <h1>INVOICE</h1>
            <p><?= $short_id ?></p>
        </div>
        <div class="brand-logo">
            <img src="<?= base_url($brand->brand_logo) ?>" alt="<?= $brand->brand_name ?>">
        </div>
    </div>

    <div class="invoice-body">
        <div class="meta-grid">
            <div class="meta-section">
                <h3>Billed From</h3>
                <p class="bold"><?= get_option('business_name') ?></p>
                <p><?= $brand->brand_name ?></p>
            </div>
            
            <?php if (!empty(@$items['customer_name'])) : ?>
            <div class="meta-section">
                <h3>Billed To</h3>
                <p class="bold"><?= @$items['customer_name'] ?></p>
            </div>
            <?php endif; ?>

            <div class="meta-section">
                <h3>Invoice Details</h3>
                <p><span class="bold">Date:</span> <?= $date ?></p>
                <div class="status-badge <?= $status_class ?>">
                    <?= $status_text ?>
                </div>
                <?php if (@$items['pay_status'] == 1 || @$items['pay_status'] == 2) : ?>
                    <p style="margin-top: 0.5rem; font-size: 0.85rem; color: var(--gray-500);">
                        TrxID: <?= @$items['transaction_id'] ?>
                    </p>
                <?php endif; ?>
                
                <?php if (@$items['pay_status'] != 2) : ?>
                <div style="margin-top: 1.25rem;">
                    <a href="?start_payment=<?= @$items['ids'] ?>" class="btn btn-primary" style="padding: 0.65rem 1.25rem; font-size: 0.95rem; width: max-content;">
                        <svg style="width:18px;height:18px;margin-right:6px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        Pay <?= @$items['customer_amount'] . get_option('currency_symbol') ?>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <span class="td-desc">
                            <?= !empty(@$items['customer_description']) ? @$items['customer_description'] : 'Payment for ' . $short_id ?>
                        </span>
                        <?php if (!empty(get_value(@$items['extras'], 'reference'))) : ?>
                            <br><small style="color: var(--gray-500); font-size: 0.9rem;">Ref: <?= get_value(@$items['extras'], 'reference') ?></small>
                        <?php endif; ?>
                    </td>
                    <td class="bold"><?= @$items['customer_amount'] . get_option('currency_symbol') ?></td>
                </tr>
            </tbody>
        </table>

        <div class="totals">
            <div class="total-row">
                <span>Subtotal</span>
                <span><?= @$items['customer_amount'] . get_option('currency_symbol') ?></span>
            </div>
            <div class="total-row final">
                <span>Total Due</span>
                <span><?= @$items['customer_amount'] . get_option('currency_symbol') ?></span>
            </div>
        </div>
    </div>

    <div class="invoice-footer">
        <p class="note">Thank you for your business. Please process this payment within the due date.</p>
    </div>
</div>



</body>
</html>
