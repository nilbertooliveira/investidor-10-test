## Ambiente Docker

Foi utlizado a arquitetura abaixo para concepção do projeto.


Estilo arquitetural: Hexagonal

Padrões de projetos: Services, Repository, DI, IoC, Acl, Docker e outros padrões.

OBS: Portas 80, 8081, 3306 e 6379 precisam estar liberadas.

1. Clonar o repositório:
     ```
    git clone https://github.com/nilbertooliveira/investidor-10-test.git
     ```

2. Rodar o comando abaixo para fazer o build do projeto, pulling das images, criar rede externa e hosts:
   ```
   ./entrypoint.sh 
   docker-compose up -d
   ```
3. Instalar as dependências e permissões:
    ```
    docker exec app composer install
    docker exec app npm run build
    sudo chmod -R 777 storage/
    ```

4. Configurar a base de dados
    ```
    docker exec app php artisan migrate
    docker exec app php artisan db:seed
    ```

##### Usuário:
```
Host: https://54.198.116.11/
Email: administrator@test.com.br
Password: 123456
```
