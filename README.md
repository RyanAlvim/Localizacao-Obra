# 📍 Localização Obra

> Sistema web em PHP para realização de vistorias de obras, integrado ao ERP Sankhya, com registro de dados da vistoria, localização geográfica e assinatura digital do responsável.

---

## 📌 Sobre o projeto

O **Localização Obra** é uma aplicação web desenvolvida em **PHP** para apoiar o processo de **vistoria de obras**.

O sistema utiliza a API do **Sankhya** para autenticar usuários, consultar informações de obras e pedidos e registrar os dados coletados durante a vistoria.

Durante o processo, o usuário pode:

- 🔐 Autenticar-se utilizando suas credenciais do Sankhya;
- 🏗️ Consultar obras/pedidos associados ao seu usuário;
- 📋 Iniciar uma vistoria;
- 📝 Preencher informações relacionadas à obra;
- 📊 Responder um questionário de vistoria;
- 📍 Registrar latitude e longitude do local;
- ✍️ Coletar a assinatura do responsável diretamente na tela;
- 👤 Registrar nome e e-mail do responsável;
- 💾 Enviar os dados para o Sankhya;
- 🚪 Encerrar a sessão.

---

# 🎯 Objetivo

O sistema foi criado para digitalizar o processo de vistoria realizado em obras.

Em vez de depender exclusivamente de registros manuais, o sistema centraliza as informações coletadas durante a vistoria e as envia para uma estrutura própria no Sankhya.

O fluxo permite relacionar:

    Usuário
       │
       ▼
    Pedido
       │
       ▼
    Obra
       │
       ▼
    Vistoria
       │
       ├── Data/hora inicial
       ├── Data/hora final
       ├── Responsável
       ├── E-mail
       ├── Localização
       ├── Assinatura
       ├── Respostas
       └── Observações

---

# 🏗️ Arquitetura

A aplicação é dividida em alguns componentes principais:

    Localizacao-Obra/
    │
    ├── Connect/
    │   ├── ConnectAPI.php
    │   └── Login.php
    │
    ├── Disconnect/
    │   └── Disconnect.php
    │
    ├── Download/
    │   └── DownloadAssinatura.php
    │
    ├── Header/
    │   └── Header.php
    │
    ├── Mensagens/
    │   └── Mensagem.php
    │
    ├── Protect/
    │   └── Protect.php
    │
    ├── Requisicao/
    │   ├── ReqPost.php
    │   └── Send.php
    │
    ├── Views/
    │   ├── BuscarObra.php
    │   ├── Confirmacao.php
    │   ├── Diversos.php
    │   ├── Observacao.php
    │   ├── Tabela.php
    │   └── Termos.php
    │
    ├── assets/
    │   ├── css/
    │   ├── js/
    │   ├── assinaturas/
    │   └── vendor/
    │
    └── index.php

A aplicação possui uma separação básica entre:

- autenticação;
- proteção de sessão;
- comunicação com a API;
- telas da vistoria;
- JavaScript do navegador;
- recursos visuais.

---

# 🔐 Autenticação

A autenticação é realizada através da API do Sankhya.

O usuário informa:

- usuário;
- senha.

O sistema envia essas informações para o serviço:

    MobileLoginSP.login

O retorno da API fornece um `JSESSIONID`, que é armazenado na sessão PHP.

A sessão mantém:

    $_SESSION["id"]

e:

    $_SESSION["usuario"]

O `JSESSIONID` posteriormente é utilizado nas requisições seguintes à API do Sankhya.

---

# 🔄 Fluxo de autenticação

    Usuário
       │
       ▼
    Login.php
       │
       ▼
    ConnectAPI
       │
       ▼
    Sankhya
       │
       ├── Login inválido
       │
       └── Login válido
              │
              ▼
        JSESSIONID
              │
              ▼
        Sessão PHP
              │
              ▼
        Página inicial

---

# 🛡️ Proteção de páginas

O arquivo:

    Protect/Protect.php

é utilizado para proteger páginas que necessitam de autenticação.

Ele verifica se existe:

    $_SESSION["id"]

Caso a sessão não possua um ID válido, o usuário é redirecionado para a tela de login.

Isso permite que as páginas internas da aplicação sejam acessadas somente após a autenticação.

---

# 🚪 Logout

O arquivo:

    Disconnect/Disconnect.php

encerra a sessão através de:

    session_destroy()

Depois disso, o usuário é redirecionado para a página inicial.

---

# 🏗️ Consulta de obras

Depois de autenticado, o usuário pode acessar:

    Views/BuscarObra.php

Essa página consulta o Sankhya para identificar as obras/pedidos disponíveis para o usuário.

Primeiramente o sistema consulta o código do usuário:

    SELECT CODUSU
    FROM TSIUSU
    WHERE NOMEUSU = ...

Depois utiliza esse código na consulta das obras.

---

# 🔎 Dados consultados

A consulta principal relaciona informações de diferentes estruturas do Sankhya, incluindo:

- `BH_CCTCAB`
- `BH_CCTCON`
- `BH_CCTOBR`
- `TGFPAR`
- `AD_RELVISTOBRA`

Entre os dados obtidos estão:

- nome da obra;
- razão social do cliente;
- data prevista;
- número do pedido;
- situação da vistoria.

A aplicação identifica se existe uma vistoria finalizada para determinado pedido.

O resultado pode indicar:

    PEND

ou:

    OK

---

# 🔄 Fluxo da vistoria

O processo principal pode ser representado assim:

    ┌──────────────────┐
    │      Login       │
    └────────┬─────────┘
             │
             ▼
    ┌──────────────────┐
    │ Buscar obras     │
    └────────┬─────────┘
             │
             ▼
    ┌──────────────────┐
    │ Selecionar obra  │
    └────────┬─────────┘
             │
             ▼
    ┌──────────────────┐
    │ Confirmar dados  │
    └────────┬─────────┘
             │
             ▼
    ┌──────────────────┐
    │ Iniciar vistoria │
    └────────┬─────────┘
             │
             ▼
    ┌──────────────────┐
    │ Questionário     │
    └────────┬─────────┘
             │
             ▼
    ┌──────────────────┐
    │ Dados diversos   │
    └────────┬─────────┘
             │
             ▼
    ┌──────────────────┐
    │ Observações      │
    └────────┬─────────┘
             │
             ▼
    ┌──────────────────┐
    │ Termos e         │
    │ assinatura       │
    └────────┬─────────┘
             │
             ▼
    ┌──────────────────┐
    │ Finalização      │
    └────────┬─────────┘
             │
             ▼
          Sankhya

---

# 📋 Início da vistoria

Ao selecionar uma obra/pedido, o sistema apresenta informações da obra.

A classe `Confirmacao.php` consulta informações como:

- código da obra;
- nome da obra;
- cliente;
- endereço;
- bairro;
- cidade.

Quando o usuário inicia a vistoria, o sistema cria um novo código de vistoria.

O código é obtido a partir da quantidade existente na estrutura:

    AD_RELVISTOBRA

e incrementado em 1.

A aplicação então registra:

- data/hora inicial;
- código do usuário;
- número do pedido.

Essas informações são enviadas ao Sankhya através do serviço:

    DatasetSP.save

utilizando a entidade:

    AD_RELVISTOBRA

---

# 📝 Questionário

A página:

    Views/Tabela.php

é responsável por uma parte importante da vistoria.

Ela envia respostas para campos específicos da entidade:

    AD_RELVISTOBRA

Cada pergunta possui dois campos:

    Pergunta
    Observação

Por exemplo:

    QUADRO_PERG_01
    QUADRO_OBS_01

até:

    QUADRO_PERG_10
    QUADRO_OBS_10

Isso permite armazenar não somente a resposta, mas também uma observação relacionada.

---

# ⚙️ Dados diversos

A página:

    Views/Diversos.php

registra informações adicionais da vistoria.

Entre os campos utilizados estão:

    SITUACAODAPECA
    TIPODELANAMENTO
    DISTANCIAENTREBOMBAEAPEA
    QUANTIDADEDETUBOS
    QUANTIDADEDEMANGOTES
    VOLUMETRANSPORTADOPORBT
    QUANTIDADEDECIMENTOPARAARGAMAS
    QUANTIDADEDEAREIAPARAARGAMASSA
    PECA

Esses dados são enviados individualmente através da classe:

    SendDados

---

# 📝 Observações

A página:

    Views/Observacao.php

permite registrar observações gerais da vistoria.

O valor é armazenado no campo:

    OBS_GERAIS

da estrutura `AD_RELVISTOBRA`.

---

# 📍 Geolocalização

Um dos recursos mais importantes do projeto é o registro da localização da vistoria.

O JavaScript:

    assets/js/location.js

utiliza a API de geolocalização do navegador:

    navigator.geolocation.getCurrentPosition(...)

Quando o navegador fornece a posição, o sistema preenche automaticamente:

    latitude
    longitude

Esses valores são armazenados em campos ocultos do formulário.

Durante a finalização da vistoria, os dados são enviados para:

    LATITUDE
    LONGITUDE

da entidade `AD_RELVISTOBRA`.

---

# ✍️ Assinatura digital

A aplicação possui um sistema para coleta de assinatura diretamente no navegador.

A tela utiliza um elemento:

    <canvas>

e a biblioteca:

    Fabric.js

O usuário pode desenhar sua assinatura diretamente na tela.

---

# 🖊️ Funcionamento da assinatura

O arquivo:

    assets/js/assinatura.js

cria um canvas utilizando:

    new fabric.Canvas('quadro', {
        isDrawingMode: true
    })

O usuário pode desenhar livremente.

Também existe um botão para limpar a assinatura:

    Limpar assinatura

---

# 🖼️ Conversão da assinatura

Antes do envio do formulário, o JavaScript:

    assets/js/downloadAssinatura.js

converte o conteúdo do canvas para uma imagem PNG em Base64:

    canvas.toDataURL("image/png")

O resultado é colocado no campo:

    assinatura

Esse valor é enviado ao PHP junto com os demais dados da vistoria.

---

# 💾 Armazenamento da assinatura

No servidor, a classe:

    Download/DownloadAssinatura.php

recebe uma URL e baixa o conteúdo para:

    assets/assinaturas/

A assinatura é armazenada utilizando o código da vistoria:

    Vistoria<CODIGO>.png

Depois o sistema registra no Sankhya o endereço dessa imagem através do campo:

    IMAGEMASSINATURA

---

# 👤 Dados do responsável

Durante a finalização são solicitados:

- nome do responsável;
- e-mail do responsável.

Esses dados são enviados para:

    RESPONSAVELPELOATENDIMENTO
    EMAILDORESPONSAVEL

Também é registrada a:

    DATAHORAFINAL

Assim a vistoria possui um intervalo entre:

    DATAHORAINICIAL
             │
             ▼
        preenchimento
             │
             ▼
    DATAHORAFINAL

---

# 🗄️ Integração com Sankhya

A aplicação não possui um banco de dados local próprio para armazenar as informações principais.

Ela utiliza os serviços do **Sankhya** como camada de acesso aos dados.

As requisições são realizadas utilizando HTTP e JSON.

Os principais serviços utilizados são:

    MobileLoginSP.login

    DbExplorerSP.executeQuery

    DatasetSP.save

---

# 🔎 Consultas SQL

A classe:

    Requisicao/ReqPost.php

é responsável por executar consultas SQL através do serviço:

    DbExplorerSP.executeQuery

Ela recebe uma consulta SQL e envia para o Sankhya.

O resultado JSON é convertido para um array PHP.

A aplicação pode então recuperar uma coluna específica através de:

    ReqAPI($retornoNumber)

---

# 💾 Gravação de dados

A classe:

    Requisicao/Send.php

centraliza o envio de dados para o Sankhya.

Ela utiliza:

    DatasetSP.save

e grava informações na entidade:

    AD_RELVISTOBRA

Existem dois métodos principais:

    EnviarAPI()

e:

    EnviarAPI1()

A diferença é que `EnviarAPI()` trabalha com dois campos enquanto `EnviarAPI1()` trabalha com um campo.

---

# 🧱 Entidade principal

A entidade utilizada pelo sistema é:

    AD_RELVISTOBRA

Ela funciona como o registro central da vistoria.

Durante o processo, diferentes páginas alimentam campos diferentes da mesma vistoria.

Conceitualmente:

    AD_RELVISTOBRA
    │
    ├── CODVISTORIA
    ├── CODUSU
    ├── NUPEDIDO
    ├── DATAHORAINICIAL
    ├── DATAHORAFINAL
    │
    ├── QUADRO_PERG_01
    ├── QUADRO_OBS_01
    ├── ...
    ├── QUADRO_PERG_10
    ├── QUADRO_OBS_10
    │
    ├── Dados diversos
    │
    ├── OBS_GERAIS
    │
    ├── RESPONSAVELPELOATENDIMENTO
    ├── EMAILDORESPONSAVEL
    │
    ├── LATITUDE
    ├── LONGITUDE
    │
    └── IMAGEMASSINATURA

---

# 🌐 Comunicação HTTP

As integrações com o Sankhya são realizadas utilizando:

    PHP
      │
      ▼
    cURL
      │
      ▼
    HTTP POST
      │
      ▼
    Sankhya
      │
      ▼
    JSON

O PHP utiliza a extensão `cURL` para realizar as chamadas.

As respostas da API são posteriormente processadas com:

    json_decode()

---

# 🧩 Componentes principais

| Componente | Responsabilidade |
|------------|------------------|
| `ConnectAPI` | Autenticação no Sankhya |
| `Login` | Tela e processamento do login |
| `Protect` | Proteção das páginas através da sessão |
| `Disconnect` | Encerramento da sessão |
| `RequisicaoPost` | Execução de consultas SQL via API |
| `SendDados` | Gravação de dados da vistoria |
| `Assinatura` | Download da imagem da assinatura |
| `location.js` | Captura da localização |
| `assinatura.js` | Desenho da assinatura |
| `downloadAssinatura.js` | Conversão da assinatura para PNG/Base64 |
| `BuscarObra` | Consulta das obras disponíveis |
| `Confirmacao` | Confirmação e início da vistoria |
| `Tabela` | Questionário principal |
| `Diversos` | Dados complementares |
| `Observacao` | Observações gerais |
| `Termos` | Finalização da vistoria |

---

# 🔄 Fluxo de dados

O fluxo completo pode ser representado da seguinte maneira:

    ┌───────────────┐
    │    Usuário    │
    └───────┬───────┘
            │
            ▼
    ┌───────────────┐
    │    PHP Web    │
    │   Aplicação   │
    └───────┬───────┘
            │
            │ HTTP / JSON
            ▼
    ┌─────────────────────┐
    │       Sankhya       │
    │                     │
    │ MobileLoginSP       │
    │ DbExplorerSP        │
    │ DatasetSP           │
    └─────────┬───────────┘
              │
              ▼
       AD_RELVISTOBRA

Enquanto isso, o navegador fornece:

    Navegador
       │
       ├── Geolocation API
       │       │
       │       └── Latitude / Longitude
       │
       └── Fabric.js
               │
               └── Assinatura PNG/Base64

Essas informações são posteriormente enviadas para o servidor e registradas no Sankhya.

---

# 🛠️ Tecnologias

| Tecnologia | Utilização |
|------------|------------|
| PHP | Backend e páginas dinâmicas |
| JavaScript | Interações no navegador |
| HTML | Estrutura das páginas |
| CSS | Estilização |
| Bootstrap | Interface responsiva |
| Fabric.js | Captura da assinatura |
| cURL | Comunicação HTTP com o Sankhya |
| JSON | Comunicação com as APIs |
| Sankhya | ERP e armazenamento dos dados |
| Geolocation API | Captura da posição geográfica |
| jQuery | Recursos de interface |
| Swiper | Componentes visuais |
| Bootstrap Icons | Ícones |

---

# 📁 Estrutura do projeto

    Localizacao-Obra/
    │
    ├── Connect/
    │   ├── ConnectAPI.php
    │   └── Login.php
    │
    ├── Disconnect/
    │   └── Disconnect.php
    │
    ├── Download/
    │   └── DownloadAssinatura.php
    │
    ├── Header/
    │   └── Header.php
    │
    ├── Mensagens/
    │   └── Mensagem.php
    │
    ├── Protect/
    │   └── Protect.php
    │
    ├── Requisicao/
    │   ├── ReqPost.php
    │   └── Send.php
    │
    ├── Views/
    │   ├── BuscarObra.php
    │   ├── Confirmacao.php
    │   ├── Diversos.php
    │   ├── Observacao.php
    │   ├── Tabela.php
    │   └── Termos.php
    │
    ├── assets/
    │   ├── assinaturas/
    │   ├── css/
    │   ├── js/
    │   │   ├── assinatura.js
    │   │   ├── downloadAssinatura.js
    │   │   ├── location.js
    │   │   ├── main.js
    │   │   └── teste.js
    │   │
    │   └── vendor/
    │
    ├── index.php
    └── README.md

---

# 🔐 Segurança

O sistema utiliza autenticação baseada em sessão.

Após o login:

    Sankhya
       │
       ▼
    JSESSIONID
       │
       ▼
    $_SESSION["id"]

Esse identificador é posteriormente enviado nas requisições HTTP através do header:

    Cookie: JSESSIONID=...

Isso permite que as requisições seguintes sejam executadas dentro da sessão autenticada do usuário.

---

# ⚠️ Pontos de atenção

O projeto possui características típicas de uma aplicação interna desenvolvida para uma necessidade específica.

Alguns pontos que poderiam ser aprimorados em uma evolução do sistema:

- [ ] Utilizar HTTPS em todas as comunicações;
- [ ] Centralizar configurações da API;
- [ ] Utilizar variáveis de ambiente para URLs e credenciais;
- [ ] Validar e tratar melhor erros da API;
- [ ] Utilizar prepared statements ou mecanismos equivalentes para consultas;
- [ ] Melhorar validações dos dados recebidos via `POST`;
- [ ] Implementar proteção CSRF;
- [ ] Melhorar gerenciamento da sessão;
- [ ] Criar uma camada de serviço para a API Sankhya;
- [ ] Separar melhor lógica de negócio e apresentação;
- [ ] Evitar dependência de caminhos absolutos;
- [ ] Melhorar o tratamento de falhas na geolocalização;
- [ ] Validar assinatura antes da finalização;
- [ ] Centralizar o gerenciamento de arquivos de assinatura.

Esses pontos são **possíveis melhorias arquiteturais**, não necessariamente problemas que impediam o funcionamento da versão original.

---

# 📱 Características do sistema

O projeto combina recursos que normalmente ficam separados em aplicações diferentes:

    Sistema Web
         │
         ├── Autenticação
         │
         ├── Integração ERP
         │
         ├── Consultas SQL
         │
         ├── Formulários
         │
         ├── Geolocalização
         │
         ├── Assinatura digital
         │
         ├── Upload/download de arquivos
         │
         └── Registro de vistoria

---

# 🧠 Conhecimentos demonstrados

O projeto demonstra experiência prática com:

### Backend

- PHP
- Sessões
- Orientação a objetos
- cURL
- APIs REST/HTTP
- JSON
- Integração com ERP
- Processamento de requisições

### Frontend

- HTML
- CSS
- JavaScript
- Bootstrap
- jQuery
- Fabric.js
- Canvas
- APIs do navegador

### Integração

- Sankhya ERP
- Autenticação via API
- `JSESSIONID`
- Consultas SQL através de API
- Persistência através de `DatasetSP.save`

### Recursos específicos

- Geolocalização
- Assinatura manuscrita digital
- Conversão Canvas → PNG/Base64
- Armazenamento de imagens
- Formulários multi-etapas

---

# 🚀 Fluxo resumido

    LOGIN
      │
      ▼
    Autenticação Sankhya
      │
      ▼
    Sessão PHP
      │
      ▼
    Lista de obras/pedidos
      │
      ▼
    Seleção da obra
      │
      ▼
    Criação da vistoria
      │
      ▼
    Questionário
      │
      ▼
    Informações complementares
      │
      ▼
    Observações
      │
      ▼
    Termos
      │
      ├── Nome
      ├── E-mail
      ├── Latitude
      ├── Longitude
      └── Assinatura
      │
      ▼
    Finalização
      │
      ▼
    AD_RELVISTOBRA
      │
      ▼
    Vistoria registrada

---

# 📌 Status

🟢 **Projeto funcional desenvolvido para uso interno/específico.**

A estrutura presente no repositório representa uma aplicação web integrada a um ambiente Sankhya, com um fluxo completo de autenticação, consulta, preenchimento e registro de vistorias.

---

# 👤 Autor

**Ryan Alvim**

Desenvolvedor de software com experiência em Java, PHP, integração de sistemas, automação e desenvolvimento de aplicações web.

- GitHub: [RyanAlvim](https://github.com/RyanAlvim)

---

## 📄 Licença

Consulte os arquivos do projeto para verificar as condições de utilização e distribuição.
