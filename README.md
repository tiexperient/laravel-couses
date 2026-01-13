## Requisitos 

* Xampp 3.3.0
* Laravel 12.38.1
* PHP 8.2.12
* Node 18.20.0
* Composer 2.8.10
* Npm 10.5.0
* Git 2.32.0
 

## Comandos do Laravel

- composer create-project laravel/laravel .
- php artisan serve


## Sequência de Trabalho

- Criar Rotas | routes/web.php
- Criar Controllers | php artisan make:controller nome-da-controller
- Criar Views | php artisan make:view nome-da-view
- Criar Model | php artisan make:model Model
- Criar Tabela | php artisan make:migration create_nome_tabela
- Criar Base e Tabela no Xampp | php artisan migrate
- Criar registro Seed de teste | php artisan make:seeder NomeSeeder
- Executar a Seed no Xampp | php artisan db:seed
- Executar a Seed no Xampp excluindo a anterior | php artisan migrate:fresh --seed
- Criar componentes no Laravel | php artisan make:component alert
- Criar Request de validação | php artisan make:request NomeRequest


## Instalando Auditoria

- Criar pacote de auditoria | composer require owen-it/laravel-auditing
- Publicar auditoria | php artisan vendor:publish --provider "OwenIt\Auditing\AuditingServiceProvider" --tag="config"
- Criar migrations para a auditoria | php artisan vendor:publish --provider "OwenIt\Auditing\AuditingServiceProvider" --tag="migrations"
- Executar as migrations | php artisan migrate
- Limpar cache | php artisan config:clear
- Alterar as models conforme a fonte bibliográfica: https://laravel-auditing.com/guide/general-configuration.html


## Instalando Tradução

- php artisan lang:publish
- composer require lucascudo/laravel-pt-br-localization --dev 
- php artisan vendor:publish --tag=laravel-pt-br-localization
- Configure o Framework para utilizar 'pt_BR' como linguagem padrão

    // Altere Linha 85 do arquivo config/app.php para:
    'locale' => 'pt_BR'

    // Para versões >= 11.x altere a linha 8 do arquivo .env
    APP_LOCALE=pt_BR


## Instalar Dependências ao clonar

- composer install
- php artisan key:generate
- Verificar Chave no arquivo .env
- instalar a pasta node_modules com npm install

- Duplicar o arquivo ".env.example" e renomear para ".env".
- Alterar as credenciais do banco de dados:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=celke
DB_USERNAME=root
DB_PASSWORD=
```

- Para a funcionalidade enviar e-mail funcionar, necessário alterar as credenciais do servidor de envio de e-mail no arquivo .env.
- Utilizar o servidor fake durante o desenvolvimento: [Acessar envio gratuito de e-mail](https://mailtrap.io/inboxes)
```
MAIL_MAILER=smtp
MAIL_SCHEME=null
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=nome-do-usuario-na-mailtrap
MAIL_PASSWORD=senha-do-usuario-na-mailtrap
MAIL_FROM_ADDRESS="colocar-email-remetente@meu-dominio.com.br"
MAIL_FROM_NAME="${APP_NAME}"
```


## Instalando Permissões

- composer require spatie/laravel-permission
- php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
- php artisan config:clear
- php artisan migrate


## Instalando Tailwind

- Node ajustado, criar projeto | npm install tailwindcss @tailwindcss/cli
- Crie na raíz src/input.css e acrescente @import "tailwindcss";
- Executar o Tailwind | npx @tailwindcss/cli -i ./src/input.css -o ./src/output.css --watch
- Criar index.html e seguir padrão de https://tailwindcss.com/docs/installation/tailwind-cli


## Github

- Criar repositório **"curso-laravel"**
- Criar branch **"develop"** repositório


## Clonar uma branch 

git clone -b develop https://github.com/tiexperient/laravel-couses.git


## Enviar uma branch 

git push origin develop


## Sequência

primeiro a request
segundo a controller
terceiro as views
quarto routes
quinto permissões na seeder
sexto quem possue as permissões
sétimo menu