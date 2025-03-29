# Exemplo de Testes de Contrato com Pact-PHP

Este repositório é um exemplo de testes de contrato utilizando **Pact** com **PHP**. Ele demonstra a implementação de testes do lado do **provedor**.

## Tecnologias Utilizadas

- **Symfony** (Apenas para montar a estrutura base do projeto)
- **Pact-PHP**
- **PHPUnit**
- **Pact Broker** (para publicação dos contratos)

## Estrutura do Projeto

O projeto segue a seguinte estrutura:

```
ms-user/
├── src/                  # Código fonte da aplicação
├── tests/                # Testes de contrato
│   ├── ProviderTest.php  # Testes do lado do provedor
├── pact/                 # Arquivos gerados pelo Pact
├── composer.json         # Dependências do projeto
├── README.md             # Documentação do projeto
```

## Instalação e Uso

Para rodar o projeto localmente, siga os passos abaixo:

1. Clone o repositório:
   ```bash
   git clone https://github.com/lucasoliveiralops/contract-tests-provider-example.git
   cd contract-tests-provider-example
   ```
2. Iniciando o container docker:
   ```bash
   docker compose up -d --build
   ```
3. Rode os testes:
   ```bash
   docker exec -it ms-user sh
   ./vendor/bin/phpunit 
   ```

## Publicação no Pact Broker

Os testes do lado do provedor são publicados automaticamente.

## Contribuição

Fique à vontade para abrir **issues** e **pull requests** para melhorias no projeto!

Este projeto tem como objetivo demonstrar uma implementação simples e funcional de testes de contrato no PHP! 😃

