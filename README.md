# 🏗 Testes de Contrato com Pact-PHP (Lado Provedor)

Este repositório exemplifica a implementação de testes de contrato do lado do **provedor** utilizando Pact-PHP, garantindo que sua API atenda aos contratos definidos pelos consumidores.

## 🛠 Stack Tecnológica

- **Symfony** (Estrutura base)
- **Pact-PHP** (Validação de contratos)
- **PHPUnit** (Framework de testes)
- **Pact Broker** (Gerenciamento centralizado)

## 🔍 Visão Geral da Implementação

### Conceitos Fundamentais

**📌 Teste de Contrato (CDC)**  
Consumer-Driven Contracts: abordagem onde os consumidores definem as expectativas do contrato (requests/responses esperados) que o provedor deve cumprir.

**📌 Pact**  
Arquivo JSON que documenta:
- As interações esperadas (requests/responses)
- Os cenários de teste
- Metadados sobre consumidor/provedor

**📌 Pact Broker**  
Serviço que:
- Armazena e versiona contratos (pacts)
- Fornece dashboard para visualização
- Gerencia matriz de compatibilidade entre consumidores/provedores

### Papel do Provedor

Em testes CDC (Consumer-Driven Contracts), o provedor:
- 1\. Busca os pactos publicados no Broker
- 2\. Valida se suas implementações atendem aos contratos
- 3\. Garante compatibilidade com todos consumidores

- Para conferir como a validação é feita no lado do consumidor acesse: [ 🔗 Consumidor de Exemplo](https://github.com/lucasoliveiralops/contract-tests-consumer-example)

## 🧪 Testes do Provedor

### ⚙️ Estrutura de Arquivos

```plaintext
tests/
└── Cases/
    └── Contract/
        ├── FakeServer/          # Servidor mock para simulação
        ├── PactManager.php      # Gerenciador de estados do contrato
        └── PactVerifyTest.php   # Teste principal de verificação
```


## 🚀 Instalação e Execução

### Pré-requisitos
- Docker
- Docker Compose

### Passo a Passo

```bash
# 1. Clonar o repositório
git clone https://github.com/lucasoliveiralops/contract-tests-provider-example.git
cd contract-tests-provider-example

# 2. Iniciar containers
docker compose up -d --build

# 3. Executar testes
docker exec -it ms-user sh -c "./vendor/bin/phpunit"
```


## 🤝 Contribuição

Abra uma issue ou envie um pull request! Este projeto tem como objetivo facilitar a adoção de testes de contrato em PHP. 🚀
