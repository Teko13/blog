<?php

namespace App\src;

class Session
{

    protected const FLASH_KEY = 'flash message';

    public function __construct()
    {
        session_start();
        $flashMessages = $this->get(self::FLASH_KEY) ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
            $flashMessage['remove'] = true;
        }
        $this->set(self::FLASH_KEY, $flashMessages);
    }

    public function setFlash(string $key, array|string $message): void
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'message' => $message
        ];
    }

    public function getFlash(string $key): array|null|string
    {
        return $this->get(self::FLASH_KEY)[$key]['message'] ?? null;
    }

    public function __destruct()
    {
        $flashMessages = $this->get(self::FLASH_KEY) ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
            if ($flashMessage['remove']) {
                unset($flashMessages[$key]);
            }
        }
        $this->set(self::FLASH_KEY, $flashMessages);
    }

    public function set(string|array $name, array|string $data): void
    {
        $_SESSION[$name] = $data;
    }

    public function get(string|null $name): array|null
    {
        return $_SESSION[$name] ?? null;
    }

    public function remove(string $name): void
    {
        unset($_SESSION[$name]);
    }
}
