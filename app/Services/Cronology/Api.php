<?php

namespace App\Services\Cronology;

use App\Services\Cronology\Exception\Exception;
use App\Services\Cronology\Response\ApiError;
use App\Services\Cronology\Response\AppDataResponse;
use App\Services\Cronology\Response\CreateAccessTokenResponse;
use App\Services\Cronology\Response\CreateUserResponse;
use App\Services\Cronology\Response\PingResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Api
{

    protected string $url;
    protected string $appId;
    protected string $caFile;
    protected \OpenSSLAsymmetricKey $privateKey;
    protected bool $useTimestampInSignature = false;
    protected string $signatureIp;

    /**
     * @throws Exception
     */
    public function __construct(array $config)
    {
        if (isset($config["url"]))
        {
            $this->url = $config["url"];
        }
        else
        {
            throw new Exception("Missing parameter: 'url'.");
        }

        if (isset($config["appId"]))
        {
            $this->appId = $config["appId"];
        }
        else
        {
            throw new Exception("Missing parameter: 'appId'.");
        }

        if (isset($config["privateKey"]))
        {
            if (Storage::missing($config["privateKey"]))
            {
                throw new Exception("Invalid parameter: 'privateKey'. File does not exists.");
            }
            $this->privateKey = openssl_pkey_get_private("file://" . Storage::path($config["privateKey"]));
        }
        else
        {
            throw new Exception("Missing parameter: 'privateKey'.");
        }

        $this->caFile = $config["caFile"] ?? "";

        if (isset($config["signatureUseTimestamp"]))
        {
            $this->useTimestampInSignature = ($config["signatureUseTimestamp"] === "true");
        }

        $this->signatureIp = $config["signatureIp"] ?? "";
    }

    protected function request(string $method, string $endpoint, string $signature = null, array $data = []): array|ApiError
    {
        $request = Http::withOptions([
            "verify" => $this->caFile ?: true,
        ]);
        $headers = [
            "Crnlg-App" => $this->appId
        ];
        if ($signature !== null)
        {
            $headers["Crnlg-Signature"] = $signature;
        }
        $request->withHeaders($headers);
        if ($data)
        {
            $request->withBody(json_encode($data));
        }
        try {
            $response = $request->send($method, $this->url . $endpoint);
            if ($response->ok())
            {
                $result = $response->json();
                $result["statusCode"] = $response->status();
            }
            else
            {
                $result = new ApiError($response->json(), $response->status());
            }
        }
        catch (\Throwable $e)
        {
            $exception = new Exception($e);
            $result = new ApiError([
                "error" => $exception->getMessage()
            ], $exception->getCode());
        }

        return $result;
    }

    protected function createSignature(array $message): string
    {
        if (!isset($message["ip"]))
        {
            $message["ip"] = $_SERVER["SERVER_ADDR"] ?? $this->signatureIp ?: "::ffff:127.0.0.1";
        }

        $hash = hash("sha256", json_encode($message));

        if ($this->useTimestampInSignature)
        {
            $hash .= ":" . time();
        }

        openssl_sign($hash, $binarySignature, $this->privateKey, "sha256WithRSAEncryption");

        return base64_encode($binarySignature);
    }

    public function ping(): ApiError|PingResponse
    {
        $response = $this -> request("GET", "/");
        if ($response instanceof ApiError)
        {
            return $response;
        }

        return new PingResponse($response, $response["statusCode"]);
    }

    public function getAppData(string $id = null): ApiError|AppDataResponse
    {
        if ($id === null)
        {
            $id = $this -> appId;
        }

        $message = [
            "uuid" => $id
        ];
        $response = $this -> request("GET", "/app/" . $id, $this->createSignature($message));
        if ($response instanceof ApiError)
        {
            return $response;
        }

        try
        {
            $result = new AppDataResponse($response, $response["statusCode"]);
        }
        catch (\Exception $e)
        {
            $exception = new Exception($e);
            $result = new ApiError([
                "error" => $exception->getMessage()
            ], $exception->getCode());
        }

        return $result;
    }

    public function createUser(string $username, ?string $password = null): ApiError|CreateUserResponse
    {
        $message = array(
            "username" => $username
        );
        if ($password !== null)
        {
            $message["password"] = $password;
        }
        $rawResult = $this -> request("PUT", "/user", $this -> createSignature($message), $message);
        if ($rawResult instanceof ApiError)
        {
            return $rawResult;
        }

        try
        {
            $result = new CreateUserResponse($rawResult, $rawResult["statusCode"]);
        }
        catch (\Exception $e)
        {
            $exception = new Exception($e);
            $result = new ApiError([
                "error" => $exception->getMessage()
            ], $exception->getCode());
        }

        return $result;
    }

    public function getUserByUsername(string $username): ApiError|CreateUserResponse
    {
        $message = array(
            "username" => $username
        );
        $rawResult = $this->request("GET", "/user", $this->createSignature($message), $message);
        if ($rawResult instanceof ApiError)
        {
            return $rawResult;
        }

        try
        {
            $result = new CreateUserResponse($rawResult, $rawResult["statusCode"]);
        }
        catch (\Exception $e)
        {
            $exception = new Exception($e);
            $result = new ApiError([
                "error" => $exception->getMessage()
            ], $exception->getCode());
        }

        return $result;
    }

    public function createAccessToken(string $user_id): ApiError|CreateAccessTokenResponse
    {
        $message = [
            "user_id" => $user_id
        ];
        $rawResult = $this->request("POST", "/user/accessToken", $this->createSignature($message), $message);
        if ($rawResult instanceof ApiError)
        {
            return $rawResult;
        }

        try
        {
            $result = new CreateAccessTokenResponse($rawResult, $rawResult["statusCode"]);
        }
        catch (\Exception $e)
        {
            $exception = new Exception($e);
            $result = new ApiError([
                "error" => $exception->getMessage()
            ], $exception->getCode());
        }

        return $result;
    }

}
