<?php

namespace User\Controllers;

use User\Models\Merchant;

class MerchantController extends UserController
{
    public $data = [];
    public $model, $db;
    public function __construct()
    {
        parent::__construct();
        $this->controller_name = 'invoice';
        $this->path_views = 'merchant/invoice/';
        $this->main_model = new Merchant();
        $this->tb_main = 'invoice';
    }
    public function update($ids = null)
    {

        _is_ajax();
        $item = null;
        if ($ids !== null) {
            $this->params = ['ids' => $ids];
            $item = $this->main_model->get_item($this->params, ['task' => 'get-item']);
        }
        $brands = $this->main_model->get_item(null, ['task' => 'get-brand-object']);


        $this->data = array(
            "controller_name"   => $this->controller_name,
            "item"              => $item,
            "item2"             => $brands
        );
        return view('User\Views\\' . $this->path_views . 'update', $this->data);
    }

    public function settings($tab = "")
    {
        $path              = APPPATH . 'Modules/User/Views/merchant/settings/elements';
        
        $elements = get_name_of_files_in_dir($path, ['.php']);
        if (!in_array($tab, $elements)) {
            $tab = 'bkash';
        }

        $brands = $this->main_model->get_item($this->params, ['task' => 'get-brand-object']);
        $items_payment = $this->main_model->get_item($this->params, ['task' => 'active-list-items']);
        $data2 = [];
        $data = array(
            "controller_name"   => 'user-settings',
            "tab"               => $tab,
            "items_payment"     => $items_payment,
            "brands"            => $brands,
        );
        $this->template->view('merchant/settings/index', array_merge($data2, $data))->render();
    }
    public function walletStore($tab = '')
    {
        _is_ajax();

        unset($_POST['honeypot']);

        $type = '';
        $validationRules = [];
        switch ($tab) {
            case 'bkash':
            case 'nagad':
            case 'rocket':
            case 'cellfin':
            case 'upay':
            case 'tap':
            case 'Ipay':
            case 'okwallet':
            case 'surecash':
            case 'mcash':
            case 'easypaisa':
            case 'mycash':
                $type = 'mobile';
                break;
            case 'abbank':
            case 'agrani':
            case 'citybank':
            case 'basia':
            case 'bbrac':
            case 'ific':
            case 'jamuna':
            case 'sonali':
            case 'dbbl':
            case 'ebl':
            case 'ibl':
            case 'basic':
                $type = 'bank';
                $validationRules = [
                    'bank_account_name' => [
                        'label' => 'Bank Account Name',
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'The {field} is required.'
                        ]
                    ],
                    'bank_account_number' => [
                        'label' => 'Bank Account Number',
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'The {field} is required.'
                        ]
                    ],
                    'bank_account_branch_name' => [
                        'label' => 'Bank Account Branch Name',
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'The {field} is required.'
                        ]
                    ],
                    'bank_account_routing_number' => [
                        'label' => 'Bank Account Routing Number',
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'The {field} is required.'
                        ]
                    ]
                ];

                break;
            case 'payeer':
            case 'paypal':
            case 'binance':
            case 'coinbase':
            case 'mastercard':
            case '2checkout':
            case 'perfectmoney':
            case 'coinpayments':
                $type = 'int_b';
                break;
            default:
                return ms(['status' => 'error', 'message' => 'Invalid payment type']);
        }

        // Validate if required
        if (!empty($validationRules) && !$this->validate($validationRules)) {
            return ms(['status' => 'error', 'message' => $this->validator->listErrors()]);
        }

        // Process POST data
        $data = [
            'params' => json_encode($_POST),
            'g_type' => $tab,
            't_type' => $type,
            'status' => (int) post('status'),
        ];

        $existing = $this->main_model->get('*', 'user_payment_settings', [
            'brand_id' => post('brand_id'),
            'g_type' => $tab,
            'uid' => session('uid')
        ]);

        if ($existing) {
            $this->db->table('user_payment_settings')->where([
                'brand_id' => post('brand_id'),
                'g_type' => $tab,
                'uid' => session('uid')
            ])->update($data);
        } else {
            $data['uid'] = session('uid');
            $data['brand_id'] = post('brand_id');
            $data['created_at'] = now();
            $this->db->table('user_payment_settings')->insert($data);
        }

        $this->db->close();

        return ms(["status" => "success", "message" => lang($tab . ' settings updated successfully')]);
    }

    public function brands()
    {

        $data = [
            "items" => $this->main_model->get_item($this->params, ['task' => 'get-brands']),
        ];

        $this->template->view('merchant/brands/index', $data)->render();
    }

    public function brandsUpdate($id = '')
    {
        _is_ajax();
        $item = null;
        if (!empty($id)) {
            $item = $this->main_model->get('*', 'brands', ['id' => $id, 'uid' => session('uid')], '', '', true);
        }
        $data = array(
            "controller_name"   => $this->controller_name,
            "item"              => $item,
        );
        return view('User\Views\merchant\brands\update', $data);
    }
    public function resetKey($id)
    {
        _is_ajax();
        $response = $this->main_model->save_item(['id' => $id], ['task' => "reset_key"]);
        ms($response);
    }

    public function brandChangeStatus($id = '')
    {
        _is_ajax();
        $status = post('status');
        db_connect()->table('brands')->where(['id' => $id, 'uid' => session('uid')])->update(['status' => $status]);
        ms(['status' => 'success', 'message' => lan('Successfully updated')]);
    }

    public function brandDeleteItem($id = '')
    {
        _is_ajax();
        db_connect()->table('brands')->where(['id' => $id, 'uid' => session('uid')])->delete();
        ms(['status' => 'success', 'message' => lan('Successfully deleted')]);
    }

    public function store($tab = '')
    {
        _is_ajax();

        if (post('type') == 'brand_setup') {
            $rules = [
                'brand_name'      => 'required',
                'mobile_number'   => 'required|regex_match[/^\+?[0-9]{6,}$/]',
                'whatsapp_number' => 'required|regex_match[/^\+?[0-9]{6,}$/]',
                'brand_logo'      => 'required',
                'fees'            => 'required|numeric',
                'fees_type'       => 'required|numeric',
                'status'          => 'required|numeric',
            ];
            if (!empty(post('id'))) {
                $id = post('id');
                $rules2 = [
                    'domain'          => 'is_unique[brands.domain,id,{$id}]',
                ];
            } else {
                if (!is_valid_domain(post('domain'))) {
                    ms(['status' => 'error', 'message' => "Domain is not Valid"]);
                }
                $rules2 = [
                    'domain'          => 'is_unique[brands.domain]',
                ];
            }
            if (!$this->validate(array_merge($rules, $rules2))) {
                $errors = $this->validator->listErrors();
                ms(['status' => 'error', 'message' => $errors]);
            }


            $response = $this->main_model->save_item($this->params, ['task' => post('type')]);
            ms($response);
        }
        if (post('type') == 'devices') {
            $devices = $this->main_model->fetch('*', 'devices', ['uid' => session('uid')], '', '', '', '', true);

            if (!canAddDevice($devices)) {
                ms(['status' => 'error', 'message' => "Device reaches it's limit! Upgrade your Subscription "]);
            }
            $rules = [
                'device_name'          => 'required',
            ];
            if (!$this->validate($rules)) {
                $errors = $this->validator->listErrors();
                ms(['status' => 'error', 'message' => $errors]);
            }

            $data = array(
                "uid"               => session("uid"),
                "user_email"        => current_user('email'),
                "device_name"       => post('device_name'),
                "device_key"        => create_random_string_key(40),
                "created_at"        => now(),
            );
            $this->db->table('devices')->insert($data);
            if ($this->db->affectedRows() > 0) {
                ms(['status' => 'success', 'message' => post('device_name') . " Device Added Successfully"]);
            } else {
                ms(['status' => 'error', 'message' => "Something went wrong! "]);
            }
        }
        if ($tab == 'sms_setting') {
            $userSms = $this->db->get_where('email_templates', ['uid' => session('uid'),'template_key'=>'user_trx'])->row();
            $userCusSms = $this->db->get_where('email_templates', ['uid' => session('uid'),'template_key'=>'user_customer_trx'])->row();

            $item_infor =  get_current_user_data()->more_information;

            $datam = [
                'uid' =>session('uid'),
                'template_key' => 'user_trx',
                'email_from'  => get_value($item_infor, 'business_email'),
                'name'  => get_value($item_infor, 'business_name'),
                'sms_status' =>post('is_user_trx_sms'),
                'sms_body' => post('user_trx_sms'),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $datam2 = [
                'uid' =>session('uid'),
                'template_key' => 'user_customer_trx',
                'email_from'  => get_value($item_infor, 'business_email'),
                'name'  => get_value($item_infor, 'business_name'),
                'sms_body' => post('user_cus_trx_sms'),
                'sms_status'=>post('is_user_customer_trx_sms'),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (!empty($userSms)) {
                $this->db->update('email_templates', $datam,['uid'=>session('uid'),'template_key'=>'user_trx']);
            }else{
                $this->db->insert('email_templates', $datam);
            }
            if (!empty($userCusSms)) {
                $this->db->update('email_templates', $datam2,['uid'=>session('uid'),'template_key'=>'user_customer_trx']);
            }else{
                $this->db->insert('email_templates', $datam2);
            }
            ms(['status'=>'success','message'=>'SMS settings updated successfully']);

        }
        
        if (post('type') == 'invoice') {
            $rules = [
                'customer_amount' => [
                    'rules' => 'required|xss_clean',
                    'errors' => [
                        'required' => 'The Amount field is mandatory. Please provide the amount.',
                    ]
                ],
                'brand_id' => [
                    'rules' => 'required|numeric|xss_clean',
                    'errors' => [
                        'required' => 'The Brand field is mandatory. Please provide the brand ID.',
                        'numeric' => 'The Brand field must be a numeric value.',
                    ]
                ],
                'status' => [
                    'rules' => 'required|numeric|xss_clean',
                    'errors' => [
                        'required' => 'The Status field is mandatory. Please provide the status.',
                        'numeric' => 'The Status field must be a numeric value.',
                    ]
                ],
            ];

            if (!$this->validate($rules)) {
                $errors = $this->validator->listErrors();
                ms(['status' => 'error', 'message' => $errors]);
            }

            $response = $this->main_model->save_item($this->params, ['task' => 'invoice-item']);
            ms($response);
        }
    }
    public function devices()
    {

        $data = [
            "items" => $this->main_model->fetch('*', 'devices', ['uid' => session('uid'), 'deleted_at' => null]),
        ];

        $this->template->view('merchant/devices/index', $data)->render();
    }
    public function devicesUpdate()
    {
        _is_ajax();
        $item = null;

        $data = array(
            "controller_name"   => $this->controller_name,
            "item"              => $item,
        );
        return view('User\Views\merchant\devices\update', $data);
    }
    public function view_invoice($id = '')
    {
        $this->params = ['ids' => $id];
        $item = $this->main_model->get_item($this->params, ['task' => 'get-item']);
        $data['items'] = $item;
        $this->template->view('merchant/invoice/view', $data)->render();
    }

    // ═══════════════════════════════════════════════
    // ═══ PRODUCT INVOICE SYSTEM ═══
    // ═══════════════════════════════════════════════

    public function productInvoice()
    {
        $items = $this->db->table('product_invoices')
            ->select('product_invoices.*, brands.brand_name')
            ->join('brands', 'brands.id = product_invoices.brand_id', 'left')
            ->where('product_invoices.uid', session('uid'))
            ->where('product_invoices.deleted_at IS NULL')
            ->orderBy('product_invoices.id', 'DESC')
            ->get()->getResultArray();

        $data = [
            'controller_name' => 'product-invoice',
            'items' => $items,
        ];
        $this->template->view('merchant/product_invoice/index', $data)->render();
    }

    public function productInvoiceUpdate($id = null)
    {
        _is_ajax();
        $item = null;
        if ($id !== null) {
            $item = $this->db->table('product_invoices')
                ->where('uid', session('uid'))
                ->where('ids', $id)
                ->get()->getRowArray();
        }
        $brands = $this->main_model->get_item(null, ['task' => 'get-brand-object']);

        $data = [
            'controller_name' => 'product-invoice',
            'item' => $item,
            'brands' => $brands,
        ];
        return view('User\Views\merchant\product_invoice\update', $data);
    }

    public function productInvoiceStore()
    {
        _is_ajax();

        $rules = [
            'product_name' => [
                'rules' => 'required',
                'errors' => ['required' => 'প্রোডাক্টের নাম আবশ্যক।']
            ],
            'product_price' => [
                'rules' => 'required|numeric|greater_than[0]',
                'errors' => [
                    'required' => 'প্রোডাক্টের দাম আবশ্যক।',
                    'numeric' => 'দাম সংখ্যা হতে হবে।',
                    'greater_than' => 'দাম ০ এর বেশি হতে হবে।',
                ]
            ],
            'brand_id' => [
                'rules' => 'required|numeric',
                'errors' => ['required' => 'ব্র্যান্ড সিলেক্ট করুন।']
            ],
            'delivery_link' => [
                'rules' => 'required',
                'errors' => ['required' => 'ডেলিভারি লিংক আবশ্যক।']
            ],
        ];

        if (!$this->validate($rules)) {
            ms(['status' => 'error', 'message' => $this->validator->listErrors()]);
        }

        $data = [
            'uid'                 => session('uid'),
            'brand_id'            => (int)post('brand_id'),
            'product_name'        => post('product_name'),
            'product_price'       => (float)post('product_price'),
            'product_description' => post('product_description'),
            'delivery_link'       => post('delivery_link'),
            'status'              => (int)(post('status') ?? 1),
            'updated_at'          => now(),
        ];

        if (!empty(post('id'))) {
            // Update
            $this->db->table('product_invoices')
                ->where('id', post('id'))
                ->where('uid', session('uid'))
                ->update($data);
            ms(['status' => 'success', 'message' => 'Product Invoice updated successfully']);
        } else {
            // Create new
            $shortCode = $this->generateShortCode();
            $data['ids'] = ids();
            $data['short_code'] = $shortCode;
            $data['total_sales'] = 0;
            $data['created_at'] = now();

            $this->db->table('product_invoices')->insert($data);
            if ($this->db->affectedRows() > 0) {
                ms(['status' => 'success', 'message' => 'Product Invoice created! Short Link: ' . base_url('p/' . $shortCode)]);
            } else {
                ms(['status' => 'error', 'message' => 'কিছু সমস্যা হয়েছে, আবার চেষ্টা করুন।']);
            }
        }
    }

    public function productInvoiceDelete($id = '')
    {
        _is_ajax();
        $this->db->table('product_invoices')
            ->where('ids', $id)
            ->where('uid', session('uid'))
            ->update(['deleted_at' => now()]);

        if ($this->db->affectedRows() > 0) {
            ms(['status' => 'success', 'message' => 'Deleted successfully', 'ids' => $id]);
        } else {
            ms(['status' => 'error', 'message' => 'Delete failed']);
        }
    }

    private function generateShortCode($length = 8)
    {
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789';
        do {
            $code = '';
            for ($i = 0; $i < $length; $i++) {
                $code .= $chars[random_int(0, strlen($chars) - 1)];
            }
            $exists = $this->db->table('product_invoices')->where('short_code', $code)->countAllResults();
        } while ($exists > 0);
        return $code;
    }
}

