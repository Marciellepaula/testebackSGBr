## Event Mnagement  

Para Executar o Projeto basta seguir os seguintes passos:

1. Clone o repositório:

    ```bash
    git clone https://github.com/Marciellepaula/testebackSGBr
    cd testebackSGBr
    ```

2. Crie uma Cópia do arquivo ```.env.example```
    
    2.1. Renomeie o arquivo para ```.env```

    2.2. Eu ja deixei o arquivo de exemplo preenchido comforme o necessário para fazer as conexoes.

    Caso haja algum problema com a utilização das portas padroes do laravel, você pode sempre editar conforme necessario no seu arquivo ```.env``` e caso seja necessario no arquivo ```docker-compose.yml```

3. Na pasta raiz do repositorio execute o seguinte comando:
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs
```


Esse comando vai instalar as nossas dependencias do php e baixar a Imagem do Sail para executar o projeto

4. Uma vez que o comando anterior ja foi executado
vamos executar o seguinte comando para iniciar o Sail

```
./vendor/bin/sail up
```

Agora temos o projeto executando, mas ainda faltam alguns passos.

5. Execute para criar a chave da aplicação 

```
./vendor/bin/sail artisan key:generate
```

6. Então execute as Migrations para criar a estrutura do banco de dados

```
./vendor/bin/sail artisan migrate 
```

e em seguida executar as seeders para popular o banco 
```
./vendor/bin/sail artisan db:seed  
```

## Tecnologias Utilizadas

- **Docker**
- **Laravel 12**
- **PHP**


### Pré-requisitos

Certifique-se de ter os seguintes itens instalados:

- **Node.js** (v18.18.2)
- **npm** ou **yarn**

