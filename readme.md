<p align="center">
    <img src="https://c5gwmsmjx1.execute-api.us-east-1.amazonaws.com/prod/empresa/logo/77018/Nova_marca_-_Zamix_Prancheta_1.png" alt="Logo Zamix">
</p>

## Projeto Inventory

### Instruções para Clonar o Repositório

1. Clone o repositório:
    ```bash
    git clone git@github.com:julianoborel/inventory.git
    cd inventory
    ```

2. Atualize as dependências do Composer:
    ```bash
    composer install
    ```

3. Configure seu banco de dados no arquivo `.env` e execute as migrações:
    ```bash
    php artisan migrate
    ```

### Especificações do Projeto

#### Tecnologias Utilizadas

- **PHP**: 7.1
- **Laravel**: 5.6
- **MySQL**: 5.7
- **Composer**: 2.2

#### Funcionalidades do Sistema

- **Gerenciamento de Produtos**: Cadastro e edição de produtos simples e compostos.
- **Controle de Estoque**: Atualização automática de estoque com base nas requisições.
- **Relatórios**: Geração de relatórios de entrada e saída de estoque.
- **Autenticação**: Implementação de autenticação básica utilizando o Laravel Passport para APIs.
- **Validação de Dados**: Validações manuais nos controladores e utilizando `FormRequest` para requisições complexas.

### Resumo das Funcionalidades

Este sistema foi desenvolvido para gerenciar o controle de estoque de uma empresa. Entre suas funcionalidades principais estão o cadastro e a edição de produtos, sejam eles simples ou compostos, a gestão de requisições de entrada e saída de produtos, e a geração de relatórios detalhados sobre o estoque. O sistema também possui um robusto mecanismo de autenticação e validação de dados, garantindo a segurança e a integridade das informações.
