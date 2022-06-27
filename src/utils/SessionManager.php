<?php

class SessionManager
{
    public function startSession(User $user) {
        session_start();
        $_SESSION['user'] = $user->getId();
    }

    public function validateSession(): bool
    {
        if(!isset($_SESSION))
        {
            session_start();
        }

        session_regenerate_id();
        if(!isset($_SESSION['user']))
        {
            return false;
        }
        return true;
    }

    public function closeSession(): bool
    {
        if(!isset($_SESSION))
        {
            session_start();
        }

        if (!isset($_SESSION['user'])) return false;
        unset($_SESSION['user']);
        session_destroy();
        return true;
    }
}