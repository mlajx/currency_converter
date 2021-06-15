# Currency Converter

## 1. Instalação

1. Clone desse repositório `git clone git@github.com:mlajx/currency_converter.git`
2. Abrir o diretório e então executar `composer require` para baixar todas as dependências.
3. Criar um banco de dados e configurando o `.env`
4. Executar `php artisan migrate --seed` para criar as tabelas no banco de dados e executar os `seeders` padrões para esse projeto
5. Executar `php artisan serve` para rodar o servidor na porta 8000 (lembre-se de configurar o `APP_URL` para `http://localhost:8000`)
6. Acessar a home (`http://localhost:8000/`) e então utilizar o projeto.

## 2. Teste

Caso seja necessário realizar testes, digitando `php artisan test` será realizado todos os testes feito para a API.
  
## 3. Dificuldade

O mais complicado foi a utilização do `Bootstrap` e do `ajax`, pois estou familiarizado com o `TailwindCSS`. Para os eventos do `javascript`, foi utilizado o `AlpineJS` ao invés do nativo ou `jQuery`.

## 4. Utilizado no projeto

- Laravel 8
- Bootstrap 5
- [AwesomeAPI - API de Moedas](https://docs.awesomeapi.com.br/api-de-moedas)
- AlpineJS
- Axios
