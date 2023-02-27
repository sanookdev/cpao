<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cron extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function statusJobMail()
    {
        $this->load->model('job_Model');
        $job = $this->job_Model->job('mail');
        if (!$job) {
            $this->job_Model->save(['job_name' => 'mail', 'job_status' => 1, 'job_progress' => '', 'is_start' => 0, 'update_date' => null]);
            $job = $this->job_Model->job('mail');
        }
		header('Content-Type: application/json');
        echo json_encode($job);
    }

    public function startJobMail()
    {
        $this->load->model('job_Model');
        $this->job_Model->save(['job_name' => 'mail', 'job_status' => 0, 'job_progress' => '', 'is_start' => 1]);
    }

    public function updateMail()
    {
        $this->load->library('Email_reader');
        $this->load->model('mailHistory_Model');
        $this->load->model('mail_Model');
        $this->load->model('job_Model');
        $job = $this->job_Model->job('mail');
        if (!$job) {
            $this->job_Model->save(['job_name' => 'mail', 'job_status' => 1, 'job_progress' => '', 'is_start' => 0, 'update_date' => null]);
            $job = $this->job_Model->job('mail');
        }
        if ($job['job_status'] == 1) {
            return;
        }
        $this->job_Model->save(['job_name' => 'mail', 'job_status' => 1, 'job_progress' => '', 'is_start' => 1]);
        $accounts = $this->mail_Model->getAll();
        $total = count($accounts);
        $count = 0;
        $this->mailHistory_Model->removeAll();
        foreach ($accounts as $account) {
            $password = $this->encryption->decrypt($account['mail_password']);
            $reader = new Email_reader($account['mail'], $password);
            foreach ($reader->getAll() as $mail) {
                $to = $reader->getTo($mail);
                $from = $reader->getFrom($mail);
                $mail_to = $to->mailbox . '@' . $to->host;
                $mail_from = $from->mailbox . '@' . $from->host;
                $subject = $reader->getSubject($mail);
                
                $old_date = $reader->getDate($mail);
                $old_date_timestamp = strtotime($old_date);
                $new_date = date('Y-m-d H:i:s', $old_date_timestamp);

                $data = [
                    'mail_sender' => $mail_from,
                    'mail_sender_host' => $from->host,
                    'mail_to' => $mail_to,
                    'mail_to_host' => $to->host,
                    'mail_date' => $new_date,
                    'status' => 1,
                ];

                if (strpos($subject, 'Mail delivery failed') !== false) {
                    $body = $reader->getBody($mail);
                    preg_match('/([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})/', $body, $output_array);
                    if (count($output_array) > 0) {
                        $sent = [
                            'mail_sender' => $mail_to,
                            'mail_sender_host' => $to->host,
                            'mail_to' => $output_array[0],
                            'mail_to_host' => $output_array[2].'.'.$output_array[3],
                            'mail_date' => $new_date,
                            'status' => 0,
                        ];
                        $this->mailHistory_Model->saveMailFail($sent);
                    }
                }
                $this->mailHistory_Model->save($data);
            }
            $reader->close();
            $count += 1;
            $this->job_Model->save(['job_name' => 'mail', 'job_status' => 1, 'job_progress' => $count.'/'.$total, 'update_date' => date('Y-m-d H:i:s')]);
        }

        $this->job_Model->save(['job_name' => 'mail', 'job_status' => 1, 'job_progress' => '', 'is_start' => 0, 'update_date' => date('Y-m-d H:i:s')]);

        echo json_encode($job);
        return;
    }
}
