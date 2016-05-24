<?php

namespace Illuminate\Foundation\Auth;

trait AuthenticatesAndRegistersUsers
{
    use AuthenticatesUsers, RegistersUsers {
        AuthenticatesUsers::redirectPath insteadof RegistersUsers;
        AuthenticatesUsers::failredirectPath insteadof RegistersUsers;
        AuthenticatesUsers::getGuard insteadof RegistersUsers;
    }
}
