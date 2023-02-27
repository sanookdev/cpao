<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Poll_Model extends CI_Model
{
    public function getPoll()
    {
        $this->db->where('poll.is_show', 1);
        $res = $this->db->get('poll');
        $poll = $res->row_array();
        $result = [];
        if ($poll) {
            $this->db->where('poll_topic.poll_id', $poll['poll_id']);
            $topic = $this->db->get('poll_topic')->result_array();

            foreach ($topic as &$row) {
                $this->db->where('poll_topic_detail.poll_topic_id', $row['poll_topic_id']);
                $detail = $this->db->get('poll_topic_detail')->result_array();
                $row['detail'] = $detail;
            }
            $result = [
                'poll' => $poll,
                'topic' => $topic,
            ];
        }
        return $result;
    }

    public function getResultPoll() {
        $result = [];
        $this->db->where('poll.is_show', 1);
        $res = $this->db->get('poll');
        $polls = $res->result_array();
        foreach ($polls as $row) {
            $query = $this->db->query("SELECT poll_topic.title_result, poll_topic_detail.detail_result, count(*) as count
                FROM poll_user_detail
                inner join poll_topic on poll_user_detail.poll_topic_id = poll_topic.poll_topic_id
                inner join poll_topic_detail on poll_user_detail.poll_topic_detail_id = poll_topic_detail.poll_topic_detail_id
                where poll_topic.is_comment = 0
                group by poll_topic_detail.poll_topic_id, poll_topic_detail.poll_topic_detail_id");
            $poll = $row;
            $detail = $query->result_array();
            $topic = [];
            foreach ($detail as $item) {
                if (!isset($topic[$item['title_result']])) {
                    $topic[$item['title_result']] = [
                        'title_result' => $item['title_result'],
                        'total' => 0,
                        'detail' => [],
                    ];
                }
                $topic[$item['title_result']]['total'] += $item['count'];
                $topic[$item['title_result']]['detail'][] = $item;
            }
            $poll['topic'] = $topic;
            $result[] = $poll;
        }

        return $result;
    }

    public function saveUser($ip, $poll_id, $data) {
        $this->db->where('poll_user.poll_user_ip', $ip);
        $this->db->where('DATE_FORMAT(poll_user.create_date, "%Y-%m-%d") =', date('Y-m-d'));
        $user = $this->db->get('poll_user')->row_array();
        if ($user) {
            return [
                'success' => false,
                'message' => 'วันนี้ท่านได้ทำแบบสอบถามแล้ว กรุณาทำใหม่ในวันถัดไป.'
            ];
        }
        $this->db->insert('poll_user', [
            'poll_user_ip' => $ip,
            'poll_id' => $poll_id,
            'create_date' => date('Y-m-d H:i:s')
        ]);
        $poll_user_id = $this->db->insert_id();
        foreach ($data as $row) {
            $this->db->where('poll_topic.poll_topic_id', $row['name']);
            $topic = $this->db->get('poll_topic')->row_array();
            $user_detail = [
                'poll_user_id' => $poll_user_id,
                'poll_topic_id' => $topic['poll_topic_id'],
                'poll_topic_detail_id' => $topic['is_comment'] == '1' ? null : $row['value'],
                'poll_user_detail_value' => $topic['is_comment'] == '1' ? $row['value'] : '',
            ];
            $this->db->insert('poll_user_detail', $user_detail);
        }
        return [
            'success' => true,
			'message' => 'ขอบคุณสำหรับการทำแบบทดสอบ <br /> ความคิดเห็นของท่านเราจะนำไปพัฒนาต่อไป'
        ];
    }
}

/* End of file Poll_Model.php */
