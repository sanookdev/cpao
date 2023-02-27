<?php
// error_reporting(0);

class Email_reader
{

    // imap server connection
    public $conn;

    // inbox storage and inbox message count
    private $inbox = [];
    private $sent = [];
    private $msg_cnt;

    // email login credentials
    private $server = 'chon.go.th';
    private $user   = 'Kansita_b@chon.go.th';
    private $pass   = 'KB965442SG';
    private $port   = 143; // adjust according to server settings

    // connect to the server and get the inbox emails
    function __construct($user = 'test01@chon.go.th', $pass = 'test01')
    {
        $this->user = $user;
        $this->pass = $pass;
        $this->connect();
        $this->inbox();
        $this->getSent();
    }

    function getInboxAll()
    {
        return $this->inbox;
    }

    function getSentAll()
    {
        return $this->sent;
    }

    // close the server connection
    function close()
    {
        $this->inbox = array();
        $this->msg_cnt = 0;

        imap_close($this->conn);
    }

    // open the server connection
    // the imap_open function parameters will need to be changed for the particular server
    // these are laid out to connect to a Dreamhost IMAP server
    function connect()
    {
        echo $this->user;
        echo $this->pass;
        $this->conn = imap_open('{' . $this->server . '/notls}', $this->user, $this->pass, OP_READONLY);
    }

    function getSent()
    {
        $conn = imap_open('{' . $this->server . '/notls}Sent', $this->user, $this->pass, OP_READONLY);
        $this->sent($conn);
    }

    // move the message to a new folder
    function move($msg_index, $folder = 'INBOX.Processed')
    {
        // move on server
        imap_mail_move($this->conn, $msg_index, $folder);
        imap_expunge($this->conn);

        // re-read the inbox
        $this->inbox();
    }

    // get a specific message (1 = first email, 2 = second email, etc.)
    function get($msg_index = NULL)
    {
        if (count($this->inbox) <= 0) {
            return array();
        } elseif (!is_null($msg_index) && isset($this->inbox[$msg_index])) {
            return $this->inbox[$msg_index];
        }

        return $this->inbox[0];
    }

    function mail_parse_headers($headers)
    {
        $headers = preg_replace('/\r\n\s+/m', '', $headers);
        preg_match_all('/([^: ]+): (.+?(?:\r\n\s(?:.+?))*)?\r\n/m', $headers, $matches);
        foreach ($matches[1] as $key => $value) $result[$value] = $matches[2][$key];
        return ($result);
    }

    // read the sent
    function sent($conn)
    {
        $this->msg_cnt = imap_num_msg($conn);

        $in = array();
        for ($i = 1; $i <= $this->msg_cnt; $i++) {
            $in[] = array(
                'index'     => $i,
                'header'    => imap_headerinfo($conn, $i),
                'body'      => imap_body($conn, $i),
                'structure' => imap_fetchstructure($conn, $i)
            );
        }
        $this->sent = $in;
    }

    // read the inbox
    function inbox()
    {
        $this->msg_cnt = imap_num_msg($this->conn);

        $in = array();
        for ($i = 1; $i <= $this->msg_cnt; $i++) {
            $in[] = array(
                'index'     => $i,
                'header'    => imap_headerinfo($this->conn, $i),
                'body'      => imap_body($this->conn, $i),
                'fetchbody' => imap_fetchbody($this->conn, $i, 2),
                'structure' => imap_fetchstructure($this->conn, $i)
            );
        }
        $this->inbox = $in;
    }

    function getSubject($inbox)
    {
        return $this->decode($inbox['header']->subject);
    }

    function getBody($inbox)
    {
        return imap_qprint($inbox['fetchbody']);
    }

    function getTo($inbox)
    {
        return $inbox['header']->to[0];
    }

    function getFrom($inbox)
    {
        return $inbox['header']->from[0];
    }

    function getDate($inbox)
    {
        return $inbox['header']->date;
    }

    function decode($text)
    {
        $resp = iconv_mime_decode($text, ICONV_MIME_DECODE_CONTINUE_ON_ERROR, "UTF-8");
        return $resp;
    }
}
$conn = mysqli_connect("localhost:3306", "chon_chonburi", "rbH6dAW0WD", "chon_chonburi");

if (mysqli_connect_errno($conn)) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "SELECT * FROM mail_account";
$result = mysqli_query($conn, $sql);

$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
// print_r($rows);
// return;
$accounts = [
    // [
    //     'mail' => 'Kansita_b@chon.go.th',
    //     'mail_password' => 'KB965442SG',
    // ],
    [
        'mail' => 'test01@chon.go.th',
        'mail_password' => 'test01',
    ],
    // [
    //     'mail' => 'test02@chon.co.th',
    //     'mail_password' => 'test02',
    // ],
];
$total = count($accounts);
$count = 0;
foreach ($accounts as $account) {
    print_r($account);
    // $password = $this->encryption->decrypt($account['mail_password']);
    $password = $account['mail_password'];
    // $email = new Email_reader();
    $email = new Email_reader($account['mail'], $password);

    echo '<b>ขาเข้า</b>';
    echo '<br />';
    foreach ($email->getInboxAll() as $inbox) {
        echo $email->decode($inbox['header']->subject);
        echo '<br />';
        echo 'to: ' . $email->decode($inbox['header']->toaddress);
        echo '<br />';
        echo 'from: ' . $email->decode($inbox['header']->fromaddress);
        echo '<br />';
        echo 'reply to: ' . $email->decode($inbox['header']->reply_toaddress);
        echo '<br />';
        echo $inbox['header']->date;
        echo '<br />';
        echo imap_qprint($inbox['fetchbody']);
        echo '<br />';
        echo '<br />';
    }

    echo '<b>ขาออก</b>';
    echo '<br />';

    foreach ($email->getSentAll() as $inbox) {
        echo $email->decode($inbox['header']->subject);
        echo '<br />';
        echo 'to: ' . $email->decode($inbox['header']->toaddress);
        echo '<br />';
        echo 'from: ' . $email->decode($inbox['header']->fromaddress);
        echo '<br />';
        echo 'reply to: ' . $email->decode($inbox['header']->reply_toaddress);
        echo '<br />';
        echo $inbox['header']->date;
        echo '<br />';
        echo '<br />';
    }
}

// print_r($email->getAll());
