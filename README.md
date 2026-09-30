# 📍 Localização Obra

> Sistema desenvolvido em PHP para registro de contratos e identificação da localização das obras onde os contratos eram assinados.

---

## 📌 Sobre o projeto

O **Localização Obra** é um sistema desenvolvido em **PHP** para auxiliar no gerenciamento de contratos de empresas e no registro da localização geográfica associada a cada obra.

A aplicação era utilizada durante o processo de assinatura de contratos. No momento em que o contrato era realizado em uma determinada obra, o sistema permitia registrar e enviar a **localização daquele local**, criando uma associação entre o contrato e o ponto onde ele foi realizado.

Dessa forma, era possível manter um registro mais organizado das obras e de seus respectivos locais.

---

## 🎯 Objetivo

O projeto foi criado para resolver uma necessidade prática:

- 📄 Registrar contratos de empresas;
- 🏗️ Identificar a obra relacionada ao contrato;
- 📍 Registrar a localização no momento da assinatura;
- 🗺️ Associar a localização ao local onde o contrato foi realizado;
- 📊 Facilitar o controle e a organização das informações das obras.

---

## ⚙️ Funcionamento

O fluxo básico da aplicação era:

```text
┌──────────────────────┐
│      Empresa         │
└──────────┬───────────┘
           │
           ▼
┌──────────────────────┐
│ Assinatura do        │
│      contrato        │
└──────────┬───────────┘
           │
           ▼
┌──────────────────────┐
│ Identificação da     │
│       obra           │
└──────────┬───────────┘
           │
           ▼
┌──────────────────────┐
│ Captura da           │
│    localização       │
└──────────┬───────────┘
           │
           ▼
┌──────────────────────┐
│ Registro da obra +   │
│     localização      │
└──────────────────────┘
