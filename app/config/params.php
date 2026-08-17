<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Books Catalog',
    'smsPilotApiKey' => getenv('SMSPILOT_API_KEY') ?: 'emulator',
    'smsPilotSender' => getenv('SMSPILOT_SENDER') ?: 'BooksCatalog',
    'smsPilotMode' => getenv('SMSPILOT_MODE') ?: 'emulator',
];
