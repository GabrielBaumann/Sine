<?php

/**
 * URL
 */

 function url(?string $path = null) : string
 {
    if (strpos($_SERVER['HTTP_HOST'], "localhost") !== false) {
        if($path) {
            return CONF_URL_TEST . "/" . ($path[0] == "/" ? mb_substr($path, 1): $path);
        }
        return CONF_URL_TEST;
    }
    
    if ($path) {
        return CONF_URL_BASE . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }
    return CONF_URL_BASE;
 }

function redirect(string $url): void
{
    header("HTTP/1.1 302 Redirect");
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        header("Location: {$url}");
        exit;
    }

    if (filter_input(INPUT_GET, "route", FILTER_DEFAULT) != $url) {
        $location = url($url);
        header("Location: {$location}");
        exit;
    }
}

 /**
  * ASSETS
  */
function user() : ?\Source\Models\User
{
    return \Source\Models\Auth::user();    
}

function messageHelpers() : \Source\Support\Message
{
    return new \Source\Support\Message();
}

function session(): \Source\Core\Session
{
    return new \Source\Core\Session();
}

function theme(?string $path = null, $theme = CONF_VIEW_THEME) : string
{
    if (strpos($_SERVER['HTTP_HOST'], "localhost") !== false) {
        if($path) {
            return CONF_URL_TEST . "/themes/{$theme}/" . ($path[0] == "/" ? mb_substr($path, 1): $path);
        }
        return CONF_URL_TEST . "/themes/{$theme}";
    }
    
    if ($path) {
        return CONF_URL_BASE . "/themes/{$theme}/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }
    return CONF_URL_BASE . "/themes/{$theme}";   
}

function is_email(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * REQUEST
 */
function csrf_input(): string
{
    $session = new \Source\Core\Session();
    $session->csrf();
    return "<input type='hidden' name='csrf' value='" . ($session->csrf_token ?? "") . "'/>";
}

function csrf_verify($request) : bool
{
    $session = new \Source\Core\Session();
    if (empty($session->csrf_token) || empty($request['csrf']) || $request['csrf'] != $session->csrf_token) {
        return false;
    }
    return true;
}

function flash() : ?string
{
    $session = new \Source\Core\Session();
    if ($flash = $session->flash()) {
        echo $flash;
    }
    return null;
}
 
/**
 * ####################
 * ###   PASSWORD   ###
 * ####################
 */

/**
 * @param string $password
 * @return string
 */
function passwd(string $password): string
{
    if (!empty(password_get_info($password)['algo'])) {
        return $password;
    }

    return password_hash($password, PASSWORD_DEFAULT, ["cost" => 10]);
}

/**
 * @param string $password
 * @param string $hash
 * @return bool
 */
function passwd_verify(string $password, string $hash): bool
{
    return password_verify($password, $hash);
}

/**
 * Funções de sanitização
 */

 function cleanInputData(array $data, ?array $removerFilds = null): array
 {
    $allKeys = array_keys($data);
    
    $sanitezed = [];
    $errors = [];

    if ($removerFilds) {
        $requiredFields = array_diff($allKeys, $removerFilds);

        foreach ($removerFilds as $field) {
            $value = trim($data[$field]);
            $value = strip_tags($value);
            $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');

            $sanitezed[$field] = $value;
        }

    } else {
        $requiredFields = $allKeys;
    }
    
    foreach ($requiredFields as $field) {
        if (!isset($data[$field])) {
            $errors[$field] = $field;
            continue;
        }

        // Remove espaços em branco
        $value = trim($data[$field]);

        // Se estiver vazio após o trim, é inválido
        if ($value === "") {
            $errors[$field] = $field;
            continue;
        }

        // Sanitize contra scripts e HTML

        $value = strip_tags($value);
        $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');

        if($field === "cpf") {
            $value = preg_replace("/\D/", "", $data['cpf']);
        }

        if($field === "phone") {
            $value = preg_replace("/\D/", "", $data['phone']);
        }

        $sanitezed[$field] = $value;
    }

    return [
        "valid" => empty($errors),
        "data" => $sanitezed,
        "errors" => $errors
    ];
}

/**
 * STRING
 */

function str_price(string $price) : string
{
    return  "R$ " . number_format($price, 2, ",", ".");
}

/**
 * DATE
 */

function date_fmt(string $date = "now", string $format = "d/m/Y H\hi"): string
{
    return (new DateTime($date))->format($format);
}

function date_simple(string $date = "now", string $format = "d/m/Y"): string
{
    return (new DateTime($date))->format($format);
}

/**
 * NUMBER
 */

 function format_number(int $number): string {
    return str_pad($number, 3, '0', STR_PAD_LEFT);
}

function mask_phone(string $phone): string
{   

    // Remove tudo que não for número
    $digits = preg_replace('/\D/', '', $phone);

    if (strlen($digits) === 11) {
        // Celular: (11) 91234-5678
        return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $digits);
    } elseif (strlen($digits) === 10) {
        // Fixo: (11) 1234-5678
        return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $digits);
    }

    // Se não for 10 ou 11 dígitos, retorna como está
    return $phone;
}

/**
 * Formats string
 */

function validateCPF($cpf) {
    // Remove caracteres não numéricos
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    // Verifica se o CPF tem 11 dígitos
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se todos os dígitos são iguais (ex: 111.111.111-11)
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Cálculo do primeiro dígito verificador
    for ($t = 9; $t < 11; $t++) {
        $soma = 0;
        for ($i = 0; $i < $t; $i++) {
            $soma += $cpf[$i] * (($t + 1) - $i);
        }
        $resto = ($soma * 10) % 11;
        $digito = ($resto == 10) ? 0 : $resto;

        if ($cpf[$t] != $digito) {
            return false;
        }
    }

    return true;
}

function formatCPF($cpf) {
    return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
}