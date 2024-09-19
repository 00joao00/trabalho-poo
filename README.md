# Sistema de Gestão de Despesas

## Descrição do Sistema
Este sistema permite gerenciar despesas, incluindo a criação, listagem e pagamento de despesas. Ele é construído utilizando PHP e adota os princípios de Programação Orientada a Objetos (POO) para abstrair as regras de negócio.

## Estrutura de Arquivos

/projeto
│
├── README.md
├── src
│   ├── Usuario.php
│   ├── Despesa.php
│   ├── TipoDespesa.php
│   └── Pagamento.php
├── data
│   ├── despesas.txt
│   ├── despesas_pagas.txt
│   └── tipos_despesas.txt
└── index.php

## Arquivos de Dados
- `despesas.txt`: Armazena as despesas abertas.
- `despesas_pagas.txt`: Armazena as despesas que foram pagas.
- `tipos_despesas.txt`: Armazena os tipos de despesas.

## Classes e Funcionalidades

### 1. Classe `Usuario`
- **Atributos**:
  - `id`: Identificador do usuário.
  - `usuario`: Nome de usuário.
  - `senha`: Senha do usuário.
  
- **Métodos**:
  - `cadastrar()`: Cadastra um novo usuário.
  - `atualizar()`: Atualiza os dados do usuário.
  - `excluir()`: Exclui um usuário.

### 2. Classe `Despesa`
- **Atributos**:
  - `id`: Identificador da despesa.
  - `descricao`: Descrição da despesa.
  - `valor`: Valor da despesa.
  - `data`: Data de vencimento.
  - `categoria`: Categoria da despesa.
  - `status`: Status da despesa (aberta/paga).
  
- **Métodos**:
  - `cadastrar()`: Cadastra uma nova despesa.
  - `pagar()`: Marca a despesa como paga.
  - `listar()`: Lista todas as despesas.

### 3. Classe `TipoDespesa`
- **Atributos**:
  - `id`: Identificador do tipo de despesa.
  - `descricao`: Descrição do tipo de despesa.
  
- **Métodos**:
  - `cadastrar()`: Cadastra um novo tipo de despesa.
  - `atualizar()`: Atualiza um tipo de despesa.
  - `excluir()`: Exclui um tipo de despesa.

### 4. Classe `Pagamento`
- **Atributos**:
  - `id`: Identificador do pagamento.
  - `despesa_id`: Identificador da despesa paga.
  - `data_pagamento`: Data em que o pagamento foi feito.
  - `valor`: Valor do pagamento.
  
- **Métodos**:
  - `registrar()`: Registra um pagamento.
  - `listarPagamentos()`: Lista todos os pagamentos.

