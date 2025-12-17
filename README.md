# 🚀 Ambiente Laravel 12 com Docker

Este repositório é um guia passo a passo para configurar o Laravel 12 com Docker utilizando um setup customizado.

## ✅ Pré-requisitos

- [Git](https://git-scm.com/)
- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/install/)

---

## 📦 Passo a passo para subir o projeto

### 1. Clone o repositório do Laravel 12

```bash
git clone --branch 12.x --single-branch https://github.com/laravel/laravel.git laravelapp
````

### 2. Clone o repositório com a configuração Docker

```bash
git clone --branch laravel-12 https://github.com/felipe-rodolfo/docker-laravel
```

### 3. Copie os arquivos de Docker para dentro da pasta do Laravel

```bash
cp -r docker-laravel/* laravelapp/
```

### 4. Acesse o diretório do projeto Laravel

```bash
cd laravelapp
```

### 5. Crie o arquivo `.env` a partir do exemplo

```bash
cp .env.example .env
```

### 6. Altere as variáveis do banco de dados no arquivo `.env`

Edite o `.env` e configure a conexão Dados no .ENV:

```dotenv
DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=laravel
DB_USERNAME=username
DB_PASSWORD=root
```

> 💡 Essas credenciais devem corresponder ao que está definido no `docker-compose.yml`.

> 💡 
> Todas as configurações de banco de dado esta dentro da pastar database. arquivos, migrations e seeders`.
---

## 🐳 Suba os containers com Docker

```bash
docker compose up -d
```

---

## 🛠 Acesse o container da aplicação

```bash
docker compose exec app bash
```

---

## ⚙️ Instale as dependências do Laravel

```bash
composer install
```

---

## 🔐 Gere a chave da aplicação

```bash
php artisan key:generate
```

---

## 🗄 Rode as migrations e Permissions

```bash
php artisan migrate
```

```bash
docker exec -it laravel_app bash
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
exit
```
---

## 🌐 Acesse o projeto no navegador

Abra [http://localhost:9010](http://localhost:8000) no seu navegador.

---

## 🧼 Finalizando

Pronto! Seu ambiente Laravel 12 com Docker está funcionando! 🎉

---

## 🐞 Dúvidas ou problemas?

Abra uma issue no repositório.



sudo truncate -s 0 storage/logs/laravel.log
