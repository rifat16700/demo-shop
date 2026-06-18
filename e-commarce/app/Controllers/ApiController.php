<?php
namespace App\Controllers;

use Blocks\Models\QueueModel;

class ApiController extends BaseController
{
    protected $tb_file_manage;
    protected $controller_name;
    protected $image;
    public $model, $db;

    public function __construct()
    {
        $this->model = new QueueModel;
    }

    public function deviceConnect()
    {
        $this->db = db_connect();
        $request = service('request');

        $user_email = $request->getVar('user_email');
        $device_key = $request->getVar('device_key');
        $device_ip = $request->getVar('device_ip');

        if ($user_email && $device_key && $device_ip) {
            $uid = $this->model->get('id, uid, device_ip', 'devices', [
                'user_email' => $user_email, 
                'device_key' => $device_key
            ]);

            if ($uid) {
                if (deviceValidation($device_key, $uid->uid)) {
                    if (empty($uid->device_ip) || $uid->device_ip !== $device_ip) {
                        $this->db->table('devices')->where('id', $uid->id)->update(['device_ip' => $device_ip]);
                    }
                    return json_encode(["status" => "1", "message" => $uid->uid]);
                } else {
                    return json_encode(["status" => "2", "message" => 'Your key is expired']);
                }
            }
        }

        return json_encode(['status' => '0', 'message' => 'Failed to connect with the server']);
    }
    
    public function addMessage()
    {
        $request = service('request');
        $deviceResponse = $this->deviceConnect();
        $device = json_decode($deviceResponse);

        if (json_last_error() !== JSON_ERROR_NONE) {
            ms(['status' => 0, 'message' => 'JSON Parsing Error']);
            return;
        }

        $address = trim($request->getVar('address') ?? '');
        $message = trim($request->getVar('message') ?? '');

        /* ── Security: Strict address whitelist ── */
        $validAddresses = [
            'bkash', 'nagad', '16216', 'upay', '16495',
            'Islami.Bank', 'tap', '09638900800', '01401195496', 'mCash', '3737'
        ];

        $isValid = false;
        foreach ($validAddresses as $valid) {
            if (strcasecmp($address, $valid) === 0) {
                $address = $valid;
                $isValid = true;
                break;
            }
        }

        if (empty($message) || !$isValid) {
            ms(["status" => "0", "message" => 'Invalid request']);
            return;
        }

        /* ── Security: Message length check ── */
        if (strlen($message) < 20 || strlen($message) > 1000) {
            ms(["status" => "0", "message" => 'Invalid message length']);
            return;
        }

        if (!empty($device->status) && $device->status == 1 && !empty($message)) {
            /* ── Security: Duplicate message detection (prevent replay attacks) ── */
            $existing = $this->db->table('module_data')
                ->where('uid', $device->message)
                ->where('address', $address)
                ->where('message', preg_replace("/\r?\n/", " ", $message))
                ->where('created_at >', date('Y-m-d H:i:s', strtotime('-1 hour')))
                ->get()->getRow();

            if ($existing) {
                ms(['status' => 1, 'message' => 'Already exists']);
                return;
            }

            $data = [
                'uid'        => $device->message,
                'message'    => preg_replace("/\r?\n/", " ", $message),
                'address'    => $address,
                'status'     => 0,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->db->table('module_data')->insert($data);

            if ($this->db->affectedRows() > 0) {
                ms(['status' => 1, 'message' => 'Data inserted successfully']);
            } else {
                ms(["status" => "0", "message" => 'Failed to insert data']);
            }
        } else {
            ms(['status' => "0", 'message' => 'Device auth failed']);
        }
    }

    public function cron()
    {
        $this->model->processPendingTasks();
    }
}

?>
