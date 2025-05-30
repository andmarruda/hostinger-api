# hostinger-api

Hostinger API

# Hostinger API no Laravel

Este pacote ajuda a usar a API de VPS da Hostinger dentro do Laravel de um jeito fácil.

## Como instalar

1. **(Desenvolvimento local)**

   - No seu `composer.json`, adicione:

     ```json
     "repositories": [
       { "type": "path", "url": "../pacote-hostinger" }
     ]
     ```

2. Rode:

   ```bash
   composer require andmarruda/hostinger-api:@dev
   ```

3. Depois publique a config:

   ```bash
   php artisan vendor:publish --provider="Hostinger\\Providers\\HostingerServiceProvider" --tag=hostinger-config
   ```

4. No seu `.env`, coloque:

   ```dotenv
   HOSTINGER_TOKEN=seu_token_aqui
   HOSTINGER_URL=https://developers.hostinger.com/api/vps/v1
   ```

5. Limpe o cache de config:

   ```bash
   php artisan config:clear
   ```

## Config

O arquivo `config/hostinger.php` vai ficar assim:

```php
return [
  'token' => env('HOSTINGER_TOKEN', ''),
  'url'   => env('HOSTINGER_URL', 'https://developers.hostinger.com/api/vps/v1'),
];
```

## Como usar

Dentro de um controller ou serviço, injete o `Hostinger`:

```php
use Hostinger\\Services\\Hostinger;

public function exemplo(Hostinger $hostinger)
{
  // Pega todas as VMs
  $vms = $hostinger->list();

  // Pega uma VM específica
  $vm = $hostinger->get('vm1');

  // Liga, desliga e reinicia
  $hostinger->start('vm1');
  $hostinger->stop('vm1');
  $hostinger->restart('vm1');

  // Pega métricas
  $metrics = $hostinger->metrics('vm1');

  // Pega chaves anexadas
  $keys = $hostinger->getAttachedPublicKeys('vm1');

  return view('vms.list', compact('vms'));
}
```

### Métodos disponíveis

#### VM (em `Traits/VM.php`)

- `list()` — lista todas as VMs.
- `get($vmId)` — detalhes de uma VM.
- `start($vmId)` — inicia a VM.
- `stop($vmId)` — para a VM.
- `restart($vmId)` — reinicia a VM.
- `metrics($vmId)` — traz CPU, RAM etc.
- `getAttachedPublicKeys($vmId)` — mostra chaves da VM.

#### Chaves Públicas (em `Traits/PublicKeys.php`)

- `listPublicKeys()` — lista todas as chaves.
- `createPublicKey($keyData)` — cria uma chave nova.
- `attachPublicKey($vmId, $keyData)` — anexa a VM.
- `deletePublicKey($keyId)` — deleta chave.
