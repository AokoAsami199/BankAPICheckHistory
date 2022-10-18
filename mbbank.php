<?php
/**
{
  "refNo": "ABC-2022100222430400",
  "result": {
    "message": "OK",
    "responseCode": "00",
    "ok": true
  },
  "transactionHistoryList": [
    {
      "postingDate": "01/10/2022 19:08:00",
      "transactionDate": "01/10/2022 19:08:00",
      "accountNo": "2730091234",
      "creditAmount": "25000",
      "debitAmount": "0",
      "currency": "VND",
      "description": "MB AokoAsami199 chuyen khoan. TU: AokoAsami199",
      "availableBalance": "34969",
      "beneficiaryAccount": null,
      "refNo": "FT22274331901069",
      "benAccountName": null,
      "bankName": null,
      "benAccountNo": null,
      "dueDate": null,
      "docId": null,
      "transactionType": null
    }
  ]
}
**/
class MBbank
{
    
    private $username       = 'ABC';
    private $deviceIdCommon = 'k6udlnkg-mbib-0000-0000-2022100221521435'; 
    private $sessionId      = '762ac4da-1f0c-4122-a746-3779dead0ce8';
    private $stk            = '2730091234';
    
    public function __construct()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
    }
    
    public function history()
    {
        $url = 'https://online.mbbank.com.vn/retail_web/common/getTransactionHistory';
        $data = json_encode(array(
        "accountNo"         => "{$this->stk}",
        "deviceIdCommon"    => "{$this->deviceIdCommon}",
        "fromDate"          => '25/9/2022',
        "historyNumber"     => "" ,
        "historyType"       => "DATE_RANGE",
        "refNo"             => "{$this->username}-".date("YmdHis").'00',
        "sessionId"         => "{$this->sessionId}",
        "toDate"            => date("d/m/Y"),
        "type"              => "ACCOUNT"  ));
        
        return $this->curl($url,$data);
        
    }
    public function curl($url,$data)
    {
        $ch = curl_init($url); 
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
        'Accept: application/json, text/plain, */*',
        'Accept-Encoding: gzip, deflate, br',
        'Accept-Language: vi-US,vi;q=0.9',
        'Authorization: Basic QURNSU46QURNSU4=',
        'Connection: keep-alive',
        'Host: online.mbbank.com.vn',
        'Origin: https://online.mbbank.com.vn',
        'Referer: https://online.mbbank.com.vn/information-account/source-account',
        'sec-ch-ua: "Google Chrome";v="105", "Not)A;Brand";v="8", "Chromium";v="105"',
        'sec-ch-ua-mobile: ?0',
        'sec-ch-ua-platform: "Windows"',
        'Sec-Fetch-Dest: empty',
        'Sec-Fetch-Mode: cors',
        'Sec-Fetch-Site: same-origin',
        'User-Agent: '.$_SERVER['HTTP_USER_AGENT'],
        ));
        $result = curl_exec($ch);
        curl_close($ch);
        
        return $result;
    }
}