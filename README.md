# VivaTur - Sistema de Gestão de Experiências Turísticas

## Credenciais de Acesso

### Administrador
- **Username:** `admin`
- **Password:** `12345678`
- **Permissões:** Acesso total ao sistema

---

### Gestor
- **Username:** `gestor`
- **Password:** `12345678`
- **Permissões:** Gestão de experiências, comentários e reservas

---

###  Turista 1
- **Username:** `turista1`
- **Password:** `12345678`
- **Permissões:** Visualização, reserva e avaliação de experiências

---

###  Turista 2
- **Username:** `turista2`
- **Password:** `12345678`
- **Permissões:** Visualização, reserva e avaliação de experiências

---

##  Elementos do Grupo

| Nº Estudante | Nome |
|--------------|------|
| **2024144618** | Beatriz Dias |
| **2024144221** | Gabriel Silvestre |
| **2024144369** | Rafael Barreiro |

---

##  Informações do Projeto

**Instituição:** Instituto Politécnico de Leiria  
**Curso:** Programação e Linguagens de Scripting para Internet  
**Ano Letivo:** 2024/2025  
**Projeto:** Sistema de Gestão de Experiências Turísticas - VivaTur

---

### Mosquitto (MQTT)

O broker Mosquitto foi preparado no projeto (config + serviço Docker) e há integração no Yii2 para **publicar** e **subscrever** tópicos via comandos de consola.

#### Notificações (alinhado com os slides)

Quando uma **experiência** é criada/atualizada/apagada no backend, o model `backend\models\Experiencias` publica uma notificação MQTT em:

- `vivaTur/experiencias/insert`
- `vivaTur/experiencias/update`
- `vivaTur/experiencias/delete`

O payload é JSON (com `entity`, `action`, `id`, `ts`, e `data`).

#### Opção A — Mosquitto via Docker Compose (se tiveres Docker)

- No diretório `VivaTur/`:
  - Subir só o broker:
    - `docker compose up -d mosquitto`
  - Portas expostas:
    - **1883** (MQTT TCP)
    - **9001** (MQTT WebSockets)

Config do broker: `VivaTur/mosquitto/config/mosquitto.conf`.

#### Opção B — Mosquitto instalado no Windows

- Instala o Mosquitto (Eclipse Mosquitto) e garante que o serviço está a correr na porta **1883**.
- Se precisares de WebSockets, ativa um listener WebSockets na **9001** (podes usar como base o `mosquitto.conf` do projeto).

#### Testar a integração no Yii2 (publisher/subscriber)

Os comandos estão em `VivaTur/console/controllers/MqttController.php`.

- **Subscrição (terminal 1)**:
  - `php VivaTur/yii mqtt/subscribe "vivaTur/#"`

- **Publicação (terminal 2)**:
  - `php VivaTur/yii mqtt/publish "vivaTur/teste" "ola mundo"`

#### Testar as notificações de todas as entidades (recomendado)

Este teste cria, atualiza e apaga registos de **Experiencias**, **Comentarios**, **Favoritos**, **Avaliacoes**, **Reservas**, **Users**, **Linguas** e **Paises** — e deve gerar **23 mensagens** MQTT (3+3+2+3+3+3+3+3).

- **Terminal 1**:
  - `php VivaTur/yii mqtt/subscribe "vivaTur/#"`

- **Terminal 2**:
  - `php VivaTur/yii vivatur/mqtt-test`

#### Configuração do host/porta

Defaults em `VivaTur/common/config/params.php` (podes sobrescrever em `VivaTur/common/config/params-local.php`):

- `MQTT_HOST` (ex.: `127.0.0.1` em WAMP / `mosquitto` em Docker)
- `MQTT_PORT` (default 1883)
- `MQTT_WS_PORT` (default 9001)