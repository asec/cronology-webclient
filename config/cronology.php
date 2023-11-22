<?php

return [

    "url" => env("CRONOLOGY_API"),
    "appId" => env("CRONOLOGY_APP_ID"),
    "caFile" => env("CRONOLOGY_CAFILE") ?: "",
    "privateKey" => env("CRONOLOGY_PRIVATEKEY"),
    "signatureUseTimestamp" => env("CRONOLOGY_SIGNATURE_USETIMESTAMP"),
    "signatureIp" => env("CRONOLOGY_SIGNATURE_IP")

];
