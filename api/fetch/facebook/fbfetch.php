<?php
 include 'simple_html_dom.php';
$url = $_GET['url'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://www.getfvid.com/downloader');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "url=https://m.facebook.com/watch/?v=508785143784519");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Authority: www.getfvid.com';
$headers[] = 'Cache-Control: max-age=0';
$headers[] = 'Sec-Ch-Ua: ^^';
$headers[] = 'Sec-Ch-Ua-Mobile: ?0';
$headers[] = 'Sec-Ch-Ua-Platform: ^^Windows^^\"\"';
$headers[] = 'Origin: https://www.getfvid.com';
$headers[] = 'Upgrade-Insecure-Requests: 1';
$headers[] = 'Dnt: 1';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36';
$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
$headers[] = 'Sec-Fetch-Site: same-origin';
$headers[] = 'Sec-Fetch-Mode: navigate';
$headers[] = 'Sec-Fetch-User: ?1';
$headers[] = 'Sec-Fetch-Dest: document';
$headers[] = 'Referer: https://www.getfvid.com/';
$headers[] = 'Accept-Language: en-IN,en-US;q=0.9,en;q=0.8,bn;q=0.7,id;q=0.6,pt;q=0.5,hr;q=0.4';
$headers[] = 'Cookie: __cf_bm=buYRGkvafh4KcKU5cHQ92gh72PYkxy0CuwwrubiiYQ4-1643687700-0-ARN2MYZ9ew6hSQKmg/Jy95AYkDpISTkGfYgbacgJU01Kl9CnfduiA10G2hcFfCHEJZq9UiSAjDgdZFLaMJqHZp0=; _ga=GA1.2.1875706292.1643687703; _gid=GA1.2.1597101775.1643687703; _gat=1; XSRF-TOKEN=eyJpdiI6IlBSc3h1U1JQSW15dFZrOExWUExnM0E9PSIsInZhbHVlIjoid3VrTlE2dUtTeDg3OWVQREVUdjVFKzBoM1A2QUlnMnpRMUJXWXM4UjUzNjNYU2o0eFJYQTNUVkpjb29XNEhnRG1kcGVmU0tvUHdxeVluT1ZqTElUM3c9PSIsIm1hYyI6IjdiYTQyMDEwOTJmZmMxMDQwNjJhMzcwYmYwMzY3ZTI4ZjhjNjc5MDBjZjhjZjg5ODA3OWNiMzg4NjgyNTg1YzMifQ^%^3D^%^3D; laravel_session=eyJpdiI6InlkNWt3MFFPNFB3bzZVaXJIZ3ZZUXc9PSIsInZhbHVlIjoiSnZyNzM5V1lKZkt3M3V0dkt5dGNZdnVDUFNoTlRqejI4bCtSc1hSeEpWZjR4ZUNVWFRMR0ZKMWRoQkw1NXRodVVlSWtIbjlhK0VCVDRJMU9QM3cyVUE9PSIsIm1hYyI6IjA5NzE2ZDVhMWQ3ZTIwY2NiMjIwZDg5NGUzNTNhMmFmZDQzZTBmYzEwNjhlNzkxM2U0NWQ0MjljMjY3NGE3MTMifQ^%^3D^%^3D; __atuvc=3^%^7C5; __atuvs=61f8af1aeb9e7db5002; __atssc=google^%^3B2';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);


$html = new simple_html_dom();   
    $html->load($result);
    $msg['success'] = true;
    $msg['title'] = $html->find('h5[class=card-title]')[0]->plaintext;

    foreach ($html->find('a') as $element) {
        if($element->plaintext  == "Download in HD Quality") {
            $msg['links']['High_Quality'] = $element->href;
        } else if($element->plaintext  == "Download in Normal Quality") {
             $msg['links']['Low_Quality'] = $element->href;
        }
        
    }
    
echo json_encode($msg);