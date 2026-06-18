<?php
$form_url = user_url($controller_name . "/store/" . $tab);
$form_attributes = array('class' => 'form actionForm row', 'data-redirect' => current_url(), 'method' => "POST");
$class_element = app_config('template')['form']['class_element'];
$class_element_select = app_config('template')['form']['class_element_select'];
$status = [
  '0' => 'Inactive',
  '1' => 'Active'
];

$active = [
  'personal' => 'Personal Mode (Manual)',
  'live'     => 'Live Mode (Auto API)',
];

$general_elements = [
  [
    'label'      => form_label('Status'),
    'element'    => form_dropdown('status', $status, @$payment_settings->status, ['class' => $class_element_select]),
    'class_main' => "col-md-6",
  ],


  [
    'label'      => form_label('API URL(Leave as it is if don\'t need)'),
    'element'    => form_input(['name' => 'api_url', 'value' =>  @get_value($payment_settings->params, 'api_url') ?? 'https://bpay.binanceapi.com/binancepay/openapi/', 'type' => 'text', 'class' => $class_element]),
    'class_main' => "col-md-6 col-sm-12 col-xs-12",
  ],
  [
    'label'      => form_label('API KEY'),
    'element'    => form_input(['name' => 'api_key', 'value' =>  @get_value($payment_settings->params, 'api_key'), 'type' => 'text', 'class' => $class_element]),
    'class_main' => "col-md-6 col-sm-12 col-xs-12",
  ],
  [
    'label'      => form_label('Secret KEY'),
    'element'    => form_input(['name' => 'secret_key', 'value' =>  @get_value($payment_settings->params, 'secret_key'), 'type' => 'text', 'class' => $class_element]),
    'class_main' => "col-md-6 col-sm-12 col-xs-12",
  ],
  [
    'label'      => form_label('Dollar Rate'),
    'element'    => form_input(['name' => 'dollar_rate', 'value' =>  @get_value($payment_settings->params, 'dollar_rate'), 'required' => 'required', 'type' => 'text', 'class' => $class_element]),
    'class_main' => "col-md-6 col-sm-12 col-xs-12",
  ],

  [
    'label'      => form_label('Binance Pay ID (Personal Mode)'),
    'element'    => form_input(['name' => 'personal_pay_id', 'value' =>  @get_value($payment_settings->params, 'personal_pay_id'), 'type' => 'text', 'class' => $class_element]),
    'class_main' => "col-md-6 col-sm-12 col-xs-12",
  ],
  [
    'label'      => form_label('Deposit Address (Live Mode)'),
    'element'    => form_input(['name' => 'deposit_address', 'value' =>  @get_value($payment_settings->params, 'deposit_address'), 'type' => 'text', 'class' => $class_element]),
    'class_main' => "col-md-6 col-sm-12 col-xs-12",
  ],
  [
    'label'      => form_label('Deposit Network (e.g. TRC20, BEP20)'),
    'element'    => form_input(['name' => 'deposit_network', 'value' =>  @get_value($payment_settings->params, 'deposit_network') ?? 'TRC20', 'type' => 'text', 'class' => $class_element]),
    'class_main' => "col-md-6 col-sm-12 col-xs-12",
  ],
  [
    'label'      => form_label('Accepted Coin (e.g. USDT)'),
    'element'    => form_input(['name' => 'accepted_coin', 'value' =>  @get_value($payment_settings->params, 'accepted_coin') ?? 'USDT', 'type' => 'text', 'class' => $class_element]),
    'class_main' => "col-md-6 col-sm-12 col-xs-12",
  ],
  [
    'label'      => form_label('Live Dollar Rate (Live Mode)'),
    'element'    => form_input(['name' => 'live_dollar_rate', 'value' =>  @get_value($payment_settings->params, 'live_dollar_rate'), 'type' => 'text', 'class' => $class_element]),
    'class_main' => "col-md-6 col-sm-12 col-xs-12",
  ],

];
include 'common.php';
?>

<div class="">
  <div class="card-header">
    <h3 class="card-title"><?= show_item_transaction_type($tab) ?> <?= lang("Binance Setup") ?></h3>
  </div>
  <div class="">
    <div class="">
      <?php echo form_open($form_url, $form_attributes); ?>
      <?php echo render_elements_form($general_elements); ?>

      <?= modal_buttons2('Save Setting', ''); ?>

      <?php echo form_close(); ?>
    </div>
  </div>
</div>