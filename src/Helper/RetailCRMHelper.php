<?php

namespace App\Helper;

class RetailCRMHelper{
    public function createOrder($name){
        $crmKey = 'YdpTME9aItM0eudVGfuTxOYLYkpxTQIv';
        $myCurl = curl_init();
        curl_setopt_array($myCurl, array(
            CURLOPT_URL => 'https://testya.retailcrm.ru/api/v5/orders/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query(array(
                'site' => 'AF345',
                'order' => json_encode(array(
                    'firstName' => $name,
                    'phone' => 'Телефон',
                    'email' => 'abc@abc.abc',
                    'items' => array(
                      array(
                      'productName' => 'Наименование товара',
                      ),
                    ),
            )),
            'apiKey' => $crmKey,
        ))
        ));

        $response = curl_exec($myCurl);
        curl_close($myCurl);
        return $response;
    }
    public function createCourier(){
        $crmKey = 'YdpTME9aItM0eudVGfuTxOYLYkpxTQIv';
        $myCurl = curl_init();
        curl_setopt_array($myCurl, array(
            CURLOPT_URL => 'https://testya.retailcrm.ru/api/v5/reference/couriers/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query(array(
            'courier' => json_encode(array(
                'firstName' => 'Имя',
                'lastName' => 'Имейл',
                'patronymic' => 'Имейл',
                'active' => 1,
                'email' => 'ivanov@mail.ru',
                'phone' => array(
                    'number' => 'Телефон',
                ),
                'description' => 'Примечания',
            )),
            'apiKey' => $crmKey,
        ))
        ));

        $response = curl_exec($myCurl);
        curl_close($myCurl);
        return $response;
    }
    public function showOrders(){
        $domain = 'https://testya.retailcrm.ru';
        $crmKey = 'YdpTME9aItM0eudVGfuTxOYLYkpxTQIv';
        $params = array (
            'apiKey' => $crmKey,
        );
        $result = json_decode(
            file_get_contents($domain . '/api/v5/orders/' . '?' . http_build_query($params)),
            true
        );
        return($result);
    }
}