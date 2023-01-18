## PHP JWT 解析サンプル

### 環境構築

#### インストール

```shell
composer require firebase/php-jwt
```

#### PHP ビルトイン Web サーバー起動

```shell
cd path/to/project/dir
php -S 127.0.0.1:8080
```

### 動作確認

#### ログイン処理

```shell
POST http://localhost:8080/login.php
Content-Type: application/json

{
    "username": "test",
    "password": "test"
}
```

#### レスポンス

```json
{
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3QiLCJleHAiOjE1ODk1NTI1ODksInVzZXJuYW1lIjoidGVzdCJ9.N7gVU75BNSjxrSPPjBU-bLaUbUuFlMP3YHHq5-vGr5s"
}
```

#### データ取得処理

```shell
GET http://localhost:8080/data.php
Content-Type: application/json
Authorization: Bearer <取得したトークン>
```

#### レスポンス

```json
{
  "username": "test"
}
```
