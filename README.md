## Liberfly-Test-api

## Ambiente local de desenvolvimento

Requisitos

- PHP 7.4
- Composer

# Configurações do .env
Certifique-se de copiar o arquivo .env.exemple para o .env e configurar devidamente sua conexão com o banco de dados

# Comandos

Instalar composer

```bash
composer install
```

Criar api key
```bash
php artisan key:generate
```

Criar tabelas no banco de dados
```bash
php artisan migrate --seed
```

Gerar o token JWT
```
php artisan jwt:secret
```

Você pode checar os testes unitários executando:
```
php artisan test
```

## Descrição

Após executar:
```
php artisan serve
```

Você poderá acessar a documentação da API ao acessar sua aplicação na rota: /api/documentation

![Exemplo 2](/public/img/exemple1.png)

Foi utilizado a pacote [L5-Swagger](https://github.com/DarkaOnLine/L5-Swagger) 

### Objetos

O sistema conta com dois objetos principais:
- User
- Product

#### User

User possui uma API completa que não necessita de autenticação para acessar

A área de auth utiliza as credenciais do Objeto User para gerar os tokens para a API


#### Product

Product possui uma API dedicada à ele que só poderá ser acessada caso o usuário esteja autenticado com seu token

### Credenciais

Primeiramente será necessário criar um usuário na rota indicada na documentação: POST /api/users

Após criar seu usuário, terá de fazer sua autenticação para receber seu token: POST /api/auth/login

Com seu token jwt em mãos, agora é só realizar suas requisições para criação, alteração, remoção e listagem de produtos.

### API de Produtos

A API de produtos só pode ser utilizada mediante autenticação.

![Exemplo 2](/public/img/exemple2.png)

O user_id é pego automaticamente baseado no cliente referente ao usuário que esteja autenticado na requisição, por isso não é necessário no json.

Na documentação está descrito Listagem, Criação, Alteração e Remoção.

Podendo buscar o produto por um ID específico.
