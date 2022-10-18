<?php

namespace App\Http\Helper;

class WeNoMana {

    public static function send_notifs($users, $subject, $data) {
        $whatsapp = [];
        $email = [];
        $content = view('mails', $data)->render();
        foreach ($users as $user) {
            $data['name'] = $user->name;
            $whatsapp[] = ["name" => $user->name, "phone" => $user->no_hp, "message" => WeNoMana::renderMessage($data)];
            $email[] = ["name" => $user->name, "email" => $user->email, "subject" => $subject, "body" => view('mails', $data)->render()];
        }
        return WeNoMana::sendWeNoMana([
            'whatsapp' => $whatsapp,
            'email' => $email
        ]);
    }
    public static function send_notif($email, $pnumber, $subject, $data) {
        $edata = [];
        $body = view('mails', $data)->render();
        $edata = array(["name" => $data['name'], "email" => $email, "subject" => $subject, "body" => $body]);
        return WeNoMana::sendWeNoMana([
            "whatsapp" => [
                ["name" => $data['name'], "phone" => $pnumber, "message" => WeNoMana::renderMessage($data)]
            ],
            "email" => $edata
        ]);
    }
    public static function send_wa($name, $pnumber, $message) {
        return WeNoMana::sendWeNoMana([
            "whatsapp" => [
                ["name" => $name, "phone" => $pnumber, "message" => $message]
            ]
        ]);
    }
    public static function send_many_wa($list) {
        return WeNoMana::sendWeNoMana([
            "whatsapp" => $list
        ]);
    }
    public static function send_email($name, $email, $subject, $body) {
        return WeNoMana::sendWeNoMana([
            "email" => [
                ["name" => $name, "email" => $email, "subject" => $subject, "body" => $body]
            ]
        ]);
    }
    public static function send_many_email($list) {
        return WeNoMana::sendWeNoMana([
            "email" => $list
        ]);
    }
    public static function send($list) {
        return WeNoMana::sendWeNoMana($list);
    }
    public function sendWeNoMana($req) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://192.168.0.23/api/v1/sendRequest',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode([
                "key" => "z7uGkw",
                "body" => $req
            ]),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
    private function renderMessage($data) {
        // $txt = preg_split('/\r\n|\r|\n/', $budget['note_header']);
        // $txt = '*'.implode('*
        // *',$txt).'*';
        $txt = "*YTH " . $data['name'] . ",*

" . $data['intro'] . "
";
        foreach ($data['table'] as $key => $attr) {
            $txt .= "
" . $key . " : " . ($key == 'Keperluan' ? '*' . $attr . '*' : $attr);
        }
        $txt .= "

Silahkan *KLIK* link di bawah ini untuk proses selanjutnya.

" . $data['link'] . '

_*jika link tidak dapat diklik, harap tambahkan nomor ini ke kontak anda._';
        return $txt;
    }
}
