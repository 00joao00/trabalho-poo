# Sistema de Gestão de Despesas

## Descrição
Este sistema ajuda a gerenciar suas finanças. Você pode registrar e acompanhar despesas, organizar pagamentos e categorias de gastos. Foi feito em PHP, usando Programação Orientada a Objetos (POO) para manter o código organizado.



## Estrutura de Arquivos
A estrutura do projeto é organizada da seguinte forma:

/projeto
│
├── README.md                     # Documentação geral do sistema
├── index.php                     # Tela inicial do sistema
├── listar_despesas_abertas.php   # Página para listar despesas em aberto
├── listar_despesas_pagas.php     # Página para listar despesas que já foram pagas
├── entrar_despesa.php            # Página para registrar novas despesas
├── anotar_pagamento.php          # Página para anotar pagamentos realizados
├── gerenciar_tipos_despesa.php    # Página para gerenciar categorias de despesas
├── gerenciar_usuarios.php         # Página para gerenciar usuários do sistema
├── data
│   ├── despesas.txt              # Arquivo que armazena as despesas abertas
│   ├── despesas_pagas.txt        # Arquivo que armazena as despesas pagas
│   └── tipos_despesas.txt        # Arquivo que armazena os tipos de despesas
└── src
    ├── Usuario.php               # Classe para manipulação de usuários
    ├── Despesa.php               # Classe para manipulação de despesas
    ├── TipoDespesa.php           # Classe para manipulação de tipos de despesas
    └── Pagamento.php              # Classe para manipulação de pagamentos

## Classes e Funcionalidades

### Classe Usuario
- **Atributos:**
  - `id`: Identificador único do usuário.
  - `usuario`: Nome de usuário.
  - `senha`: Senha do usuário (armazenada de forma segura).
  
- **Métodos:**
  - `cadastrar()`: Método para cadastrar um novo usuário.
  - `atualizar()`: Método para atualizar as informações do usuário.
  - `excluir()`: Método para excluir um usuário do sistema.

### Classe Despesa
- **Atributos:**
  - `id`: Identificador único da despesa.
  - `descricao`: Descrição da despesa.
  - `valor`: Valor da despesa.
  - `data`: Data de vencimento da despesa.
  - `categoria`: Categoria da despesa.
  - `status`: Status da despesa (aberta ou paga).
  
- **Métodos:**
  - `cadastrar()`: Método para registrar uma nova despesa.
  - `pagar()`: Método para marcar uma despesa como paga.
  - `listar()`: Método para listar todas as despesas.

### Classe TipoDespesa
- **Atributos:**
  - `id`: Identificador único do tipo de despesa.
  - `descricao`: Descrição do tipo de despesa.
  
- **Métodos:**
  - `cadastrar()`: Método para cadastrar um novo tipo de despesa.
  - `listar()`: Método para listar todos os tipos de despesas.
  - `excluir()`: Método para excluir um tipo de despesa.

