<?php
require __DIR__ . '/const.php';
require __DIR__ . '/vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * データ取得処理。
 * JWT が正しい場合は username を返却する。
 */
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET') {
    $auth = isset($_SERVER['HTTP_AUTHORIZATION']) ? $_SERVER['HTTP_AUTHORIZATION'] : '';
    if (preg_match('#\ABearer\s+(.+)\z#', $auth, $m)) { // Bearer xxxx...
        $jwt = $m[1];
        try {
            $payload = JWT::decode($jwt, new Key(JWT_KEY, JWT_ALG)); // JWT デコード (失敗時は例外を投げる)
            $username = $payload->username; // エンコード時のデータ取得

            header('Content-Type: application/json');
            echo json_encode(array('username' => $username)); // とりあえず username を返却
            return;
        }
        catch (Exception $e) {}
    }
    // Bearer が取得できない、JWT のデコードに失敗した場合は 401
    http_response_code(401);
}
