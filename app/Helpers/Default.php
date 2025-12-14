<?php
use Carbon\Carbon;
use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| FORMATAÇÕES BRASIL
|--------------------------------------------------------------------------
*/
function only_numbers($value)
{
    return preg_replace('/\D/', '', $value);
}
function format_cpf($cpf)
{
    $cpf = only_numbers($cpf);
    return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
}
function format_date($date)
{
    return Carbon::parse($date)->format('d/m/Y');
}
/*
|--------------------------------------------------------------------------
| RESPOSTAS PADRÃO API
|--------------------------------------------------------------------------
*/
function api_success($data = [], $message = 'Sucesso')
{
    return response()->json(['success' => true, 'message' => $message, 'data' => $data]);
}
function api_error($message = 'Erro', $status = 400)
{
    return response()->json(['success' => false, 'message' => $message], $status);
}
/*
|--------------------------------------------------------------------------
| SISTEMA / AUTH
|--------------------------------------------------------------------------
*/
function user()
{
    return auth()->user();
}

/*
|--------------------------------------------------------------------------
| VESSION
|--------------------------------------------------------------------------
*/
function vession()
{
    $path = base_path('pom.xml');

    if (!file_exists($path)) {
        return 'Arquivo pom.xml não encontrado';
    }

    $xml = simplexml_load_file($path);
    $versao = str_replace("-SNAPSHOT", "", (string) $xml->version);

    return $versao;
}

/*
|--------------------------------------------------------------------------
| CRYTIPTOGRAFICA DE ID
|--------------------------------------------------------------------------
*/
function encrypitar($valor)
{
    $key = env('CIPHER_KEY');
    $iv  = env('CIPHER_IV');

    return bin2hex(openssl_encrypt($valor, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv));
}

/*
|--------------------------------------------------------------------------
| DESCRIPTOGRAFIA DE ID
|--------------------------------------------------------------------------
*/
function decrypitar($valor)
{
    $key = env('CIPHER_KEY');
    $iv  = env('CIPHER_IV');

    if(strlen($valor) % 2 != 0 || strlen($valor) == 0){
        return false;
    }
    if($valor == 'pesquisa'){
        return false;
    }

    return openssl_decrypt(hex2bin($valor), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
}


/*
|--------------------------------------------------------------------------
| ATIVAR MENU
|--------------------------------------------------------------------------
*/
function ativadorLinks( array $routes)
{
    if(is_array($routes)){
        foreach ($routes as $ms) {
            if (request()->routeIs($ms)) {
                return "kt-menu__item--open kt-menu__item--here";
            }
        }
    }
}
/*
|--------------------------------------------------------------------------
| ATIVAR SUB MENU
|--------------------------------------------------------------------------
*/
function ativadorSubLinks( array $routes)
{
    if(is_array($routes)){
        foreach ($routes as $link) {
            if (request()->routeIs($link)) {
                return 'kt-menu__item--active';
            }
        }
    }
}


/*
|--------------------------------------------------------------------------
| DINHEIRO E NÚMEROS (Formato BR)
|--------------------------------------------------------------------------
*/
/**
 * Formata número para moeda brasileira.
 * Ex: 1000.5 → R$ 1.000,50
 */
function format_money($value)
{
    return 'R$ ' . number_format($value, 2, ',', '.');
}
/**
 * Formata número com casas decimais e separadores BR.
 */
function format_number($value, $decimals = 2)
{
    return number_format($value, $decimals, ',', '.');
}
/**
 * Converte dinheiro BR para float.
 * Ex: "1.234,56" → 1234.56
 */
function money_to_float($value)
{
    if (is_null($value)) return 0;
    $value = str_replace('.', '', $value);
    $value = str_replace(',', '.', $value);
    return (float) $value;
}

function normalizeMoney($value): string
{
    if ($value === null || $value === '') {
        return '0.00';
    }

    // remove espaços
    $value = trim($value);

    // se tiver vírgula, ela é decimal (pt-BR)
    if (str_contains($value, ',')) {
        $value = str_replace('.', '', $value); // remove milhar
        $value = str_replace(',', '.', $value);
    }

    // agora é número válido
    $number = (float) $value;

    // sempre com 2 casas
    return number_format($number, 2, '.', '');
}

/*
|--------------------------------------------------------------------------
| STRINGS
|--------------------------------------------------------------------------
*/
/**
 * Gera slug seguro.
 */
function str_slug($string)
{
    return Str::slug($string);
}
/**
 * Limita string com reticências.
 */
function str_limit_string($string, $limit = 50)
{
    return Str::limit($string, $limit);
}
/**
 * Gera UUID.
 */
function uuid()
{
    return Str::uuid()->toString();
}

/**
 * Verifica se o usuário é admin.
 * Pressupõe que existe um campo "is_admin" ou role "admin".
 */
function is_admin()
{
    $u = user();
    if (!$u) return false;
    // Caso use ACL baseada em roles
    if (method_exists($u, 'hasRole')) {
        return $u->hasRole('admin');
    }
    // Caso use campo direto
    return $u->is_admin ?? false;
}
/**
 * Verifica se o usuário tem um role.
 */
function has_role($role)
{
    $u = user();
    if (!$u) return false;
    if (method_exists($u, 'hasRole')) {
        return $u->hasRole($role);
    }
    // Caso o usuário tenha relacionamento roles
    if (isset($u->roles)) {
        return $u->roles->pluck('name')->contains($role);
    }
    return false;
}
/**
 * Verifica se o usuário possui uma ability.
 */
function has_ability($ability)
{
    $u = user();
    if (!$u) return false;
    if (method_exists($u, 'hasAbility')) {
        return $u->hasAbility($ability);
    }
    // Caso abilities venham por roles
    if (isset($u->roles)) {
        foreach ($u->roles as $role) {
            if (isset($role->abilities)) {
                if ($role->abilities->pluck('name')->contains($ability)) {
                    return true;
                }
            }
        }
    }
    return false;
}

