# Projeto: API Consulta CPF
> Resumo: Consulta se CPF está na BLACKLIST


### Linguagem/Versão: 
PHP 5.5.9


### URLs:
* API: 
- GET <http://127.0.0.1/api/cpf/status> Serviço de suporte com contagem de consultas e de status no BLACKLIST
- GET <http://127.0.0.1/api/cpf/14091670709 ou http://127.0.0.1/api/cpf?q=14091670709> Serviço com status do CPF
- POST <http://127.0.0.1/api/cpf> Salva um novo CPF
- PUT <http://127.0.0.1/api/cpf/14091670709> Altera status do CPF

* SITE:
- <http://127.0.0.1/> Página de consulta
- <http://127.0.0.1/novo> Página de cadastro


### Componentes: 
- [Bootstrap](https://getbootstrap.com/docs) 4.0
- [AngularJS](https://docs.angularjs.org/api) 1.3.16
- [SQLITE](php5-sqlite) Local: '/dao/consulta_cpf.db'


### Anotações:
*Comandos:
- docker-compose up -d (Inicia ambiente utilizando porta 80)